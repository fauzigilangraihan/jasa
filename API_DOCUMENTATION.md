# fauziDev API Documentation

## Overview

This document describes the current API structure and provides guidance for future API expansion. The application is currently designed as a traditional Laravel web application but has a foundation ready for API integration.

## Current Structure

### Web Routes (Public)
```
GET  /                          → Landing page
GET  /services                  → Services listing
GET  /portfolio                 → Portfolio projects
```

### Authentication Routes
```
GET  /register                  → Registration form
POST /register                  → Process registration
GET  /login                     → Login form
POST /login                     → Process login
POST /logout                    → Logout
```

### Client Routes (Protected by 'auth' middleware)
```
GET  /home                      → Client dashboard
GET  /home/orders               → List client orders
POST /home/orders               → Create new order
GET  /home/orders/{order}       → View order details
PUT  /home/orders/{order}       → Update order
DELETE /home/orders/{order}     → Delete order
GET  /home/payments             → Payment history
POST /home/payments             → Submit payment
GET  /home/payments/pending     → Pending payment
GET  /home/payments/invoice     → View invoice
```

### Admin Routes (Protected by 'auth' and 'admin' middleware)
```
GET  /admin                     → Admin dashboard
GET  /admin/orders              → List all orders
GET  /admin/orders/{order}      → Order details
PUT  /admin/orders/{order}      → Update order status
GET  /admin/payments            → List payments
GET  /admin/payments/{payment}  → Payment details
POST /admin/payments/{payment}  → Process payment approval
GET  /admin/services            → Manage services
POST /admin/services            → Create service
GET  /admin/services/{id}/edit  → Edit service
PUT  /admin/services/{id}       → Update service
DELETE /admin/services/{id}     → Delete service
POST /admin/services/{id}/packages → Add pricing package
```

### Current API Endpoint
```
GET  /api/packages/{service_id} → Fetch pricing packages for a service (JSON)
```

## REST API Implementation Guide

To convert the application to a full REST API, follow these steps:

### Step 1: Create API Routes

Create `routes/api.php`:

```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    
    // Services
    Route::apiResource('services', ServiceController::class)->only(['index', 'show']);
    
    // Orders
    Route::apiResource('orders', OrderController::class);
    
    // Payments
    Route::apiResource('payments', PaymentController::class);
    Route::post('/payments/{payment}/approve', [PaymentController::class, 'approve']);
    Route::post('/payments/{payment}/reject', [PaymentController::class, 'reject']);
});
```

### Step 2: Create API Controllers

Example: `app/Http/Controllers/Api/AuthController.php`

```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'company_name' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'company_name' => $validated['company_name'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'role' => 'client',
            'is_active' => true,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }
}
```

### Step 3: Create API Resources

Create resource classes for consistent JSON responses:

`app/Http/Resources/OrderResource.php`:

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'service_id' => $this->service_id,
            'pricing_package_id' => $this->pricing_package_id,
            'status' => $this->status,
            'description' => $this->description,
            'requirements' => $this->requirements,
            'total_price' => $this->total_price,
            'down_payment' => $this->down_payment,
            'payment_verified' => $this->payment_verified,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'service' => new ServiceResource($this->whenLoaded('service')),
            'package' => new PricingPackageResource($this->whenLoaded('pricingPackage')),
            'payments' => PaymentResource::collection($this->whenLoaded('payments')),
        ];
    }
}
```

### Step 4: Implement Sanctum Authentication

Install Sanctum if not already installed:

```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

Update `app/Models/User.php`:

```php
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens;
    // ...
}
```

### Step 5: API Response Formatting

Create a consistent response format. Add to `app/Traits/ApiResponser.php`:

```php
<?php

namespace App\Traits;

trait ApiResponser
{
    protected function sendResponse($data, $message = '', $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function sendError($message = '', $code = 400, $errors = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}
```

## API Endpoints Reference

### Authentication

```
POST /api/auth/register
Content-Type: application/json

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "company_name": "Acme Corp",
  "phone": "+1234567890"
}

Response: 201 Created
{
  "success": true,
  "message": "User registered successfully",
  "data": {
    "user": { ... },
    "token": "token_value"
  }
}
```

### Services

```
GET /api/services
Authorization: Bearer {token}

Response: 200 OK
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Web Development",
      "description": "...",
      "icon": "💻",
      "pricing_packages": [ ... ]
    }
  ]
}
```

### Orders

```
POST /api/orders
Authorization: Bearer {token}
Content-Type: application/json

{
  "service_id": 1,
  "pricing_package_id": 3,
  "description": "Build a new website",
  "requirements": "Responsive, dark mode, dashboard",
  "delivery_timeline": 30
}

Response: 201 Created
{
  "success": true,
  "message": "Order created successfully",
  "data": {
    "id": 1,
    "order_number": "ORD-20240101120000-1234",
    "status": "pending",
    "total_price": 5000000,
    ...
  }
}
```

### Payments

```
POST /api/payments
Authorization: Bearer {token}
Content-Type: multipart/form-data

{
  "order_id": 1,
  "payment_type": "down_payment",
  "payment_method": "bank_transfer",
  "payment_proof": <file>,
  "notes": "Bank BCA transfer"
}

Response: 201 Created
{
  "success": true,
  "message": "Payment submitted successfully",
  "data": { ... }
}
```

## Database Queries via API

The API will use the same Eloquent models and database queries as the web application:

### Available Models
- `App\Models\Service`
- `App\Models\PricingPackage`
- `App\Models\Order`
- `App\Models\Payment`
- `App\Models\Invoice`
- `App\Models\PortfolioProject`
- `App\Models\Testimonial`
- `App\Models\User`

### Example Query in Controller

```php
$orders = auth()->user()
    ->orders()
    ->with(['service', 'pricingPackage', 'payments'])
    ->paginate(15);

return OrderResource::collection($orders);
```

## Rate Limiting

Implement rate limiting to prevent abuse:

```php
// Add to api routes
Route::middleware('throttle:60,1')->group(function () {
    // API routes
});
```

## CORS Configuration

Update `config/cors.php` for API access:

```php
'paths' => ['api/*', 'sanctum/csrf-cookie'],
'allowed_methods' => ['*'],
'allowed_origins' => ['https://yourdomain.com'],
'allowed_headers' => ['*'],
'exposed_headers' => ['*'],
'max_age' => 0,
'supports_credentials' => true,
```

## Versioning Strategy

As the API grows, implement versioning:

```
routes/api/v1/
routes/api/v2/
```

## Testing API Endpoints

Use tools like:
- Postman
- Insomnia
- REST Client VS Code extension

## Documentation Tools

For auto-generated API documentation, consider:
- Swagger/OpenAPI with `darkaonline/l5-swagger`
- API Platform
- LaravelAPI

Install Swagger:
```bash
composer require darkaonline/l5-swagger
php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider"
```

## WebSocket Support (Real-time Updates)

For real-time notifications, implement Laravel Reverb:

```bash
composer require laravel/reverb
php artisan reverb:install
php artisan reverb:start
```

Example: Real-time order status updates

```php
// In OrderManagementController
OrderStatusUpdated::dispatch($order);
```

```javascript
// Client-side
Echo.channel('orders.' + orderId)
    .listen('OrderStatusUpdated', (e) => {
        console.log('Order status:', e.order.status);
    });
```

## Error Handling

Standard error responses:

```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "email": ["Email already exists"],
    "password": ["Password too short"]
  }
}
```

## Security Best Practices

1. ✓ Use HTTPS in production
2. ✓ Implement rate limiting
3. ✓ Validate all input
4. ✓ Use CORS appropriately
5. ✓ Implement CSRF protection
6. ✓ Sanitize output
7. ✓ Use authorization policies
8. ✓ Log API access
9. ✓ Implement API key management
10. ✓ Use API versioning

## Mobile App Integration

The API can be consumed by mobile apps:

- iOS (Swift)
- Android (Kotlin/Java)
- React Native
- Flutter

Store API token securely using platform-specific keychain/keystore.

## Performance Optimization

1. Implement pagination
2. Use eager loading with `with()`
3. Add database indexes
4. Cache frequently accessed data
5. Implement filtering and sorting
6. Use API resources for transformation

```php
// Optimized query
Order::with('service', 'pricingPackage', 'payments')
    ->where('user_id', auth()->id())
    ->orderBy('created_at', 'desc')
    ->paginate(20);
```

## Next Steps

1. Choose authentication method (Sanctum, Passport)
2. Design API response structure
3. Create API resources and routes
4. Implement comprehensive validation
5. Add API documentation (Swagger)
6. Write API tests
7. Deploy to staging for testing
8. Monitor API usage and performance
