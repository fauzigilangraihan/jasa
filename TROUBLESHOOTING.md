# fauziDev Troubleshooting Guide

## Common Issues & Solutions

### Database Issues

#### Issue: "SQLSTATE[HY000]: General error: 1030 Got error 28 from storage engine"
**Cause**: Disk space full
**Solution**:
```bash
# Check disk space
df -h

# Clean up Laravel cache/logs
php artisan cache:clear
php artisan logs:clear
```

#### Issue: "SQLSTATE[HY000] [1049] Unknown database"
**Cause**: Database doesn't exist
**Solution**:
```bash
# Create database via MySQL CLI
mysql -u root -p
mysql> CREATE DATABASE jasa;
mysql> EXIT;

# Run migrations
php artisan migrate --seed
```

#### Issue: "SQLSTATE[HY000] [1045] Access denied for user"
**Cause**: Wrong database credentials
**Solution**:
```bash
# Verify credentials in .env file
cat .env | grep DB_

# Test connection
php artisan db:show

# Update .env if needed
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=jasa
# DB_USERNAME=root
# DB_PASSWORD=
```

#### Issue: Migration fails with foreign key errors
**Cause**: Tables created in wrong order
**Solution**:
```bash
# Reset all migrations
php artisan migrate:reset

# Re-run migrations
php artisan migrate --seed

# Or specify --force if needed
php artisan migrate:refresh --force
```

### File Upload Issues

#### Issue: "File upload failed" or files not appearing
**Cause**: Storage link not created
**Solution**:
```bash
# Create storage link
php artisan storage:link

# Verify link exists
ls -la public/

# Should show: storage -> ../storage/app/public
```

#### Issue: "Permission denied" on file upload
**Cause**: Incorrect file permissions
**Solution** (Linux/Mac):
```bash
# Set proper permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
```

**Solution** (Windows):
```bash
# Run as Administrator
icacls storage /grant Everyone:F /T
icacls bootstrap\cache /grant Everyone:F /T
```

#### Issue: File uploads work but don't appear in public folder
**Cause**: Accessing wrong path
**Solution**:
```php
// Correct way to get file URL
$file_url = asset('storage/orders/' . $order->id . '/' . $file->filename);

// In view
<a href="{{ asset('storage/orders/' . $order->id . '/' . $filename) }}">
    Download File
</a>
```

### Authentication Issues

#### Issue: "Route [login] not defined"
**Cause**: Missing authentication routes
**Solution**: Ensure `routes/web.php` has:
```php
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});
```

#### Issue: Login page blank/not loading
**Cause**: Blade template syntax error
**Solution**:
```bash
# Check for Blade syntax errors
php artisan view:clear

# Manually check template
grep -n "@" resources/views/auth/login.blade.php

# Fix any unclosed tags or syntax errors
```

#### Issue: "Attempt to read property on null" on login
**Cause**: User not found or password wrong
**Solution**:
```bash
# Check user exists in database
php artisan tinker
User::where('email', 'admin@fauzidev.com')->first()

# If not found, seed the database
php artisan migrate:refresh --seed
```

### Payment/Order Issues

#### Issue: Order creation fails with validation error
**Cause**: Missing required fields
**Solution**: Check controller validation in `OrderController@store`:
```php
// Ensure all required fields are provided
$validated = $request->validate([
    'service_id' => 'required|exists:services,id',
    'pricing_package_id' => 'required|exists:pricing_packages,id',
    'description' => 'required|string',
    'delivery_timeline' => 'required|integer|min:1',
]);
```

#### Issue: Payment status not updating
**Cause**: Activity log permission issue or payment not found
**Solution**:
```bash
# Check payment exists
php artisan tinker
Payment::find(1)

# Check order relationship
Order::find(1)->payments

# Manually update if needed
Payment::find(1)->update(['status' => 'confirmed'])
```

#### Issue: Invoice not generating
**Cause**: Order ID mismatch or missing data
**Solution**:
```bash
# Verify order has required data
php artisan tinker
$order = Order::find(1);
$order->total_price  // Should not be null
$order->service      // Should load
$order->user         // Should load
```

### Frontend/View Issues

#### Issue: Dark mode toggle not working
**Cause**: JavaScript error or localStorage issue
**Solution**:
```javascript
// Check browser console for errors
console.log('Dark mode:', localStorage.getItem('darkMode'));

// Manually set dark mode
localStorage.setItem('darkMode', 'true');
window.location.reload();
```

#### Issue: Tailwind CSS not applied (styling looks broken)
**Cause**: Assets not built or Tailwind cache issue
**Solution**:
```bash
# Clear Tailwind cache
npm run build

# Or for development
npm run dev

# Check CSS is loaded in browser
# DevTools → Network → check for app.css

# Verify Tailwind config
cat tailwind.config.js
```

#### Issue: Navigation links not working
**Cause**: Named routes not defined or route names wrong
**Solution**:
```bash
# List all routes
php artisan route:list

# Check route names match in views
# Example: route('orders.index') should exist

# Add missing routes to web.php if needed
Route::get('home/orders', [OrderController::class, 'index'])
    ->name('orders.index');
```

#### Issue: 404 on admin pages
**Cause**: Missing route or admin prefix issue
**Solution**:
```bash
# Verify admin routes exist
php artisan route:list | grep admin

# Check middleware is applied
# Routes should have 'auth' and 'admin' middleware

# Test access
# Navigate to /admin - should redirect to login if not authenticated
```

### Performance Issues

#### Issue: Page loads slowly
**Cause**: N+1 query problem or missing indexes
**Solution**:
```bash
# Check database queries
php artisan tinker
\Illuminate\Support\Facades\DB::enableQueryLog();
// Run your code
dd(\Illuminate\Support\Facades\DB::getQueryLog());

# Add indexes to frequently queried columns
// In migration
Schema::table('orders', function (Blueprint $table) {
    $table->index('user_id');
    $table->index('status');
});
```

#### Issue: Memory limit exceeded
**Cause**: Large data processing without pagination
**Solution**:
```php
// Use pagination
$orders = Order::paginate(15);

// Or use chunks for processing
Order::chunk(100, function ($orders) {
    foreach ($orders as $order) {
        // Process
    }
});
```

#### Issue: Timeout on long operations
**Cause**: Operations taking too long
**Solution**:
```bash
# Increase PHP timeout in .env or server config
# php.ini: max_execution_time = 300

# Or use queue for long operations
php artisan queue:work
```

### Deployment Issues

#### Issue: "Class not found" after deployment
**Cause**: Autoloader cache outdated
**Solution**:
```bash
composer dump-autoload

# Or with optimization
composer dump-autoload --optimize

# Clear all Laravel caches
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### Issue: Environment variables not loading
**Cause**: .env not in correct location or not readable
**Solution**:
```bash
# Verify .env exists in project root
ls -la .env

# Check it's readable
cat .env | head -n 5

# Clear config cache
php artisan config:clear

# Rebuild cache
php artisan config:cache
```

#### Issue: Static files (CSS, JS) return 404 on production
**Cause**: Asset build not run or wrong paths
**Solution**:
```bash
# Build assets for production
npm run build

# Verify files exist
ls -la public/build/

# Check .env paths
# APP_URL should match your domain
```

### Email Notification Issues

#### Issue: Emails not sending
**Cause**: Mail configuration not set
**Solution**:
```bash
# Update .env with mail settings
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@fauzidev.com

# Test mail configuration
php artisan tinker
Mail::raw('Test message', function($msg) { 
    $msg->to('test@example.com'); 
});
```

#### Issue: "Failed to authenticate on SMTP server"
**Cause**: Wrong credentials or SMTP not enabled
**Solution**:
```bash
# Verify credentials are correct
# Try telnet connection
telnet smtp.gmail.com 587

# For Gmail, use App Passwords (not account password)
# Enable 2FA and generate app-specific password

# Use Mailtrap for testing
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
```

### Database Seeding Issues

#### Issue: Seeder fails or creates duplicate data
**Cause**: Seeder running multiple times
**Solution**:
```bash
# Reset database before seeding
php artisan migrate:refresh --seed

# Or seed only once
php artisan db:seed

# To clear and reseed
php artisan migrate:reset
php artisan migrate
php artisan db:seed
```

#### Issue: "Integrity constraint violation" during seeding
**Cause**: Foreign key constraints failing
**Solution**:
```bash
# Check migration order - parent tables must exist first
# In seeder, create records in correct order:
// 1. Create services first
// 2. Create pricing packages (depend on services)
// 3. Create orders (depend on services and packages)
// 4. Create payments (depend on orders)

# Temporarily disable foreign key checks
php artisan tinker
DB::statement('SET FOREIGN_KEY_CHECKS=0;');
php artisan migrate:refresh --seed
DB::statement('SET FOREIGN_KEY_CHECKS=1;');
```

### Cache Issues

#### Issue: Changes not appearing after code update
**Cause**: Stale cache
**Solution**:
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Or use convenience command
php artisan optimize:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache
```

#### Issue: "View not found" after creating new view
**Cause**: View cache not cleared
**Solution**:
```bash
php artisan view:clear

# Also check file path matches namespace
# File: resources/views/orders/show.blade.php
// Blade: view('orders.show')
```

## Debugging Tips

### Enable Debug Mode
```bash
# In .env
APP_DEBUG=true

# This shows detailed error messages
# NEVER use in production!
```

### Use Tinker
```bash
# Interactive shell for testing
php artisan tinker

# Examples
User::all()
Order::with('payments')->find(1)
$user = User::find(1)
$user->orders()->count()
```

### Check Logs
```bash
# View application logs
tail -f storage/logs/laravel.log

# Or open in editor
cat storage/logs/laravel.log | tail -100
```

### Use Laravel Debugbar
```bash
# Install
composer require barryvdh/laravel-debugbar --dev

# Automatically appears at bottom of pages
# Shows queries, events, logs, requests
```

### Enable Query Logging
```php
// In controller or tinker
DB::enableQueryLog();
// ... code ...
dd(DB::getQueryLog());
```

## Quick Diagnostics

Run these commands to check system health:

```bash
# Check PHP version
php -v

# Check Laravel version
php artisan --version

# Check all dependencies
composer check-platform-reqs

# Check database connection
php artisan db:show

# Check routes
php artisan route:list

# Check configuration
php artisan config:show

# Check storage permissions
ls -la storage
ls -la bootstrap/cache

# Check Node.js/npm (for assets)
node -v
npm -v
```

## Recovery Steps

### Full Reset (when stuck)
```bash
# 1. Clear all caches
php artisan optimize:clear

# 2. Reset database
php artisan migrate:reset

# 3. Run migrations fresh
php artisan migrate:seed

# 4. Rebuild assets
npm run build

# 5. Clear browser cache
# (Open DevTools → Network → Disable cache, then refresh)
```

### Backup Before Testing
```bash
# Database backup
mysqldump -u root -p jasa > backup_$(date +%Y%m%d).sql

# File backup
cp -r storage/app/public backup_files_$(date +%Y%m%d)
```

## Getting Help

### Check Documentation
- [Laravel Documentation](https://laravel.com/docs)
- [Eloquent ORM](https://laravel.com/docs/eloquent)
- [Blade Templates](https://laravel.com/docs/blade)

### Community Resources
- [Laravel Discord](https://discord.gg/laravel)
- [Stack Overflow](https://stackoverflow.com/questions/tagged/laravel)
- [Laravel Forum](https://laravel.io/forum)

### Log Error Messages
When reporting issues, include:
1. Full error message from logs
2. Steps to reproduce
3. PHP version
4. Laravel version
5. Database type/version
6. Operating system

## Performance Optimization Checklist

- [ ] Enable view caching: `php artisan view:cache`
- [ ] Enable route caching: `php artisan route:cache`
- [ ] Enable config caching: `php artisan config:cache`
- [ ] Use eager loading (with() method)
- [ ] Add database indexes on frequently queried columns
- [ ] Implement pagination for large datasets
- [ ] Use select() to fetch only needed columns
- [ ] Enable query caching for expensive queries
- [ ] Use async queue for heavy operations
- [ ] Minify CSS and JavaScript
- [ ] Enable gzip compression on server
- [ ] Use CDN for static assets
- [ ] Enable browser caching headers
- [ ] Monitor and optimize N+1 queries

## Security Checklist

- [ ] APP_DEBUG=false in production
- [ ] Generate strong APP_KEY
- [ ] Use HTTPS only in production
- [ ] Keep dependencies updated
- [ ] Validate all input data
- [ ] Use authorization policies
- [ ] Implement rate limiting
- [ ] Enable CSRF protection
- [ ] Use bcrypt for passwords
- [ ] Remove sensitive data from logs
- [ ] Set proper file permissions
- [ ] Regular security audits
- [ ] Use environment variables for secrets
- [ ] Implement activity logging
- [ ] Regular database backups
