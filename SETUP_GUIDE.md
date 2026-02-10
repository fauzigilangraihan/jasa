# fauziDev - Professional Web Development Agency Platform

A full-scale Laravel 12 web application for a software development company providing professional website development services.

## Features

### 🎯 Core Features

- **Landing Page** - Modern, responsive, and interactive landing page with services showcase
- **Service Management** - Admin panel to manage services and pricing packages
- **Ordering System** - Clients can select services, create orders, and track progress
- **Payment System** - Down payment + full payment workflow with payment verification
- **Authentication** - Secure user authentication with Admin and Client roles
- **Admin Dashboard** - Complete admin panel with analytics and management tools
- **Order Management** - Track orders from pending to completion with status updates
- **Activity Logging** - Track all admin actions for transparency and security
- **Dark Mode** - Beautiful dark mode toggle for better UX

### 📋 Services Offered

- Web Development
- E-Commerce Solutions
- Custom Systems
- UI/UX Design
- Maintenance & Support

### 💰 Pricing Packages

Each service has multiple pricing tiers:
- **Basic** - Entry-level solutions
- **Standard** - Professional solutions
- **Premium** - Advanced comprehensive solutions
- **Custom** - Tailored solutions (admin can create)

### 👥 User Roles

- **Admin** - Full access to dashboard, order management, payment verification, service management
- **Client** - Can create orders, make payments, track projects, view invoices

## Tech Stack

- **Framework**: Laravel 12
- **PHP**: 8.2+
- **Database**: MySQL
- **Frontend**: Blade Templates
- **Styling**: Tailwind CSS
- **JavaScript**: Vanilla JS with Alpine.js ready structure
- **Authentication**: Laravel Built-in Authentication

## Installation & Setup

### Prerequisites

- PHP 8.2+
- MySQL 8.0+
- Composer
- Node.js & npm (optional, for Vite)

### Installation Steps

1. **Clone the repository**
```bash
cd c:\laragon\www\jasa
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Configure environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database** in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jasa
DB_USERNAME=root
DB_PASSWORD=
```

5. **Run migrations and seeders**
```bash
php artisan migrate --seed
```

This will create:
- Database tables
- Admin user: `admin@fauzidev.com` / `password123`
- 5 sample clients
- Services with pricing packages
- Portfolio projects
- Testimonials
- FAQ items

6. **Create storage link**
```bash
php artisan storage:link
```

7. **Build frontend assets**
```bash
npm run dev
# For production:
npm run build
```

8. **Start development server**
```bash
php artisan serve
```

Visit: `http://localhost:8000`

## Default Credentials

### Admin Account
- Email: `admin@fauzidev.com`
- Password: `password123`
- Role: Admin

### Sample Clients
Created via factory - check database for email/password combinations

## Application Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/                    # Authentication controllers
│   │   ├── Admin/                   # Admin controllers
│   │   ├── HomeController.php       # Frontend pages
│   │   ├── OrderController.php      # Order management
│   │   └── PaymentController.php    # Payment handling
│   ├── Middleware/
│   │   ├── IsAdmin.php             # Admin authorization
│   │   └── IsClient.php            # Client authorization
│   ├── Policies/
│   │   ├── OrderPolicy.php         # Order authorization
│   │   └── PaymentPolicy.php       # Payment authorization
│
├── Models/
│   ├── User.php
│   ├── Service.php
│   ├── PricingPackage.php
│   ├── Order.php
│   ├── OrderFile.php
│   ├── Payment.php
│   ├── Invoice.php
│   ├── PortfolioProject.php
│   ├── Testimonial.php
│   ├── ActivityLog.php
│   └── FaqItem.php
│
database/
├── migrations/          # Database schema
├── seeders/            # Sample data
└── factories/          # Model factories

resources/views/
├── auth/               # Authentication pages
├── home/               # Frontend pages
├── orders/             # Order pages
├── payments/           # Payment pages
├── admin/              # Admin panel
└── layouts/            # Layout templates
```

## API Endpoints

### Public Routes

```
GET  /                           # Homepage
GET  /services                   # Services listing
GET  /portfolio                  # Portfolio projects
```

### Authentication Routes

```
POST   /register                # Register new client
POST   /login                   # Login
POST   /logout                  # Logout
```

### Client Routes (Authenticated)

```
GET    /orders                          # List client's orders
GET    /orders/create                   # Create order form
POST   /orders                          # Store new order
GET    /orders/{order}                  # View order details
GET    /api/packages/{service_id}       # Get packages for service

GET    /payments/down-payment/{order}   # Down payment page
GET    /payments/full-payment/{order}   # Full payment page
POST   /payments                        # Process payment
GET    /payments/pending/{payment}      # Payment pending page
GET    /payments/history/{order}        # Payment history
GET    /invoices/{order}                # View invoice
```

### Admin Routes (Admin Only)

```
GET    /admin                                    # Dashboard
GET    /admin/orders                            # List all orders
GET    /admin/orders/{order}                    # View order
PUT    /admin/orders/{order}/status             # Update order status
POST   /admin/orders/{order}/upload-result      # Upload project results

GET    /admin/payments                          # List payments
GET    /admin/payments/{payment}                # Payment details
POST   /admin/payments/{payment}/approve        # Approve payment
POST   /admin/payments/{payment}/reject         # Reject payment
GET    /admin/payments/{payment}/invoice        # Generate invoice

GET    /admin/services                          # List services
GET    /admin/services/create                   # Create service form
POST   /admin/services                          # Store service
GET    /admin/services/{service}/edit           # Edit service
PUT    /admin/services/{service}                # Update service
DELETE /admin/services/{service}                # Delete service

GET    /admin/services/{service}/packages       # List packages
GET    /admin/services/{service}/packages/create # Create package
POST   /admin/services/{service}/packages       # Store package
GET    /admin/packages/{package}/edit           # Edit package
PUT    /admin/packages/{package}                # Update package
DELETE /admin/packages/{package}                # Delete package
```

## Key Features Explained

### Order Management
1. Client selects service → selects package → fills project details → uploads files
2. Admin reviews order and updates status (Pending → In Progress → Revision → Completed)
3. Payment must be verified before order starts

### Payment System
1. Down Payment (30% of total) must be made first
2. Client submits payment with proof
3. Admin verifies and approves payment
4. Once full payment is received, project can be marked complete
5. Invoices are auto-generated for each payment

### Activity Logging
- All admin actions are logged (order status changes, payment approvals, etc.)
- Helps track project history and administrative decisions

### Security
- Role-based access control (RBAC)
- Authorization policies for orders and payments
- Only clients can access their own orders
- Admin-only features protected by middleware
- CSRF protection on all forms

## Customization

### Add New Services
1. Go to Admin → Services → Add Service
2. Fill in service details and features
3. Create pricing packages for the service

### Modify Pricing
1. Edit existing packages in Admin panel
2. Change prices, delivery days, revision rounds

### Customize Email Notifications
- Update `config/mail.php` for email settings
- Create notification classes in `app/Notifications/`
- Send notifications on order/payment updates

### Extend with Email Notifications
```php
// Uncomment in OrderManagementController and PaymentManagementController
// to send email notifications on status updates
// EmailService::sendOrderStatusUpdate($order);
```

## Performance Optimization Tips

1. **Database Optimization**
   ```bash
   php artisan queue:work   # Process jobs in background
   ```

2. **Caching**
   ```bash
   php artisan cache:clear
   php artisan config:cache
   ```

3. **Asset Optimization**
   ```bash
   npm run build  # Production-ready assets
   ```

## Testing

```bash
# Run tests
php artisan test

# With coverage
php artisan test --coverage
```

## Troubleshooting

### Migrations fail
```bash
php artisan migrate:reset
php artisan migrate --seed
```

### Assets not loading
```bash
npm run build
php artisan storage:link
```

### Storage issues
```bash
chmod -R 775 storage bootstrap/cache
php artisan storage:link
```

## Future Enhancements

- [ ] Email notifications for order/payment updates
- [ ] Invoice PDF generation
- [ ] Real payment gateway integration (Stripe, PayPal)
- [ ] Client messaging system
- [ ] Project timeline tracking with Gantt chart
- [ ] Multi-language support
- [ ] SEO optimization
- [ ] Analytics dashboard with charts
- [ ] Automated backup system
- [ ] API for third-party integrations

## Security Considerations

✓ Password hashing with bcrypt
✓ CSRF token protection
✓ SQL injection prevention via ORM
✓ XSS protection with Blade escaping
✓ Authorization policies for resources
✓ Activity logging for admin actions
✓ File upload validation
✓ Rate limiting ready

## Support

For issues or questions, refer to:
- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [MySQL Documentation](https://dev.mysql.com/doc/)

## License

This project is built for fauziDev. All rights reserved.

## Author

Built with ❤️ for professional web development agencies
