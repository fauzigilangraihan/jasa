# fauziDev Configuration Guide

## Database Setup

### MySQL Configuration
```sql
CREATE DATABASE jasa;
USE jasa;
```

### Environment File (.env)
```
APP_NAME="fauziDev"
APP_ENV=production  # or local for development
APP_KEY=
APP_DEBUG=false
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jasa
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=cookie
QUEUE_CONNECTION=sync

# Email Configuration (when ready for notifications)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@fauzidev.com
MAIL_FROM_NAME="fauziDev"
```

## Installation Checklist

- [ ] Clone repository
- [ ] Run `composer install`
- [ ] Run `npm install`
- [ ] Copy `.env.example` to `.env`
- [ ] Generate app key: `php artisan key:generate`
- [ ] Create MySQL database
- [ ] Update `.env` with database credentials
- [ ] Run migrations: `php artisan migrate --seed`
- [ ] Create storage link: `php artisan storage:link`
- [ ] Build assets: `npm run build`
- [ ] Set directory permissions: `chmod -R 775 storage bootstrap/cache`
- [ ] Clear cache: `php artisan cache:clear`
- [ ] Test application at `http://localhost:8000`

## User Management

### Create Admin User
```bash
php artisan tinker
```

```php
$user = App\Models\User::create([
    'name' => 'Admin Name',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'role' => 'admin',
    'is_active' => true,
]);
```

### Create Client User
```php
$user = App\Models\User::create([
    'name' => 'Client Name',
    'email' => 'client@example.com',
    'password' => bcrypt('password'),
    'role' => 'client',
    'company_name' => 'Company Name',
    'phone' => '+62 XXX XXXX XXXX',
    'is_active' => true,
]);
```

## File Upload Configuration

### Storage Configuration
Files are stored in `storage/app/public/`:
- Orders: `orders/{order_id}/`
- Results: `orders/{order_id}/results/`
- Payments: `payments/`

### Permissions
```bash
chmod -R 755 storage/app/public
chmod -R 755 storage/framework
chmod -R 755 storage/logs
```

## Deployment

### Production Checklist

1. **Environment**
   ```bash
   APP_ENV=production
   APP_DEBUG=false
   ```

2. **Performance**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   npm run build
   ```

3. **Security**
   - Update APP_URL to your domain
   - Set strong database password
   - Enable HTTPS
   - Configure CORS if needed

4. **Database**
   ```bash
   php artisan migrate --force
   ```

5. **Queue Setup** (if using background jobs)
   ```bash
   php artisan queue:work
   ```

### Hosting Requirements
- PHP 8.2+
- MySQL 8.0+
- 512MB+ RAM (minimum)
- 1GB+ Disk Space
- Composer support
- Node.js for build

## API Integration (Future)

### For Payment Gateway Integration
1. Create a Payment Service class in `app/Services/`
2. Implement payment processing logic
3. Update PaymentController to use the service
4. Add payment gateway credentials to `.env`

Example:
```php
// app/Services/PaymentService.php
namespace App\Services;

class PaymentService {
    public function processPayment($payment) {
        // Integration with payment gateway
    }
}
```

## Monitoring & Logging

### Log Files
Location: `storage/logs/`

Monitor important events:
```bash
tail -f storage/logs/laravel.log
```

### Admin Activity Tracking
All admin actions are logged in `activity_logs` table for audit trail.

## Backup Strategy

### Database Backup
```bash
mysqldump -u root -p jasa > backup_$(date +%Y%m%d_%H%M%S).sql
```

### File Backup
Backup these directories:
- `storage/app/public/` - User uploads
- `.env` - Configuration
- `database/` - Migrations and seeders

## Troubleshooting

### Common Issues

**1. Migration Errors**
```bash
php artisan migrate:reset
php artisan migrate --seed
```

**2. Storage Link Issues**
```bash
rm public/storage
php artisan storage:link
```

**3. Permission Errors**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap
```

**4. Cache Issues**
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

## Email Notifications

When ready to implement email notifications:

1. Create notification classes:
```bash
php artisan make:notification OrderStatusUpdated
php artisan make:notification PaymentConfirmed
```

2. Update controllers to send notifications:
```php
$order->user->notify(new OrderStatusUpdated($order));
```

3. Configure mail service in `.env`

## SEO Optimization

The application includes SEO-ready structure:
- Meta tags in layouts
- Semantic HTML
- Mobile-responsive design
- Fast page load (Tailwind CSS)
- Sitemap ready (add `laravel-sitemap` package)

## Analytics Ready

Structure supports adding Google Analytics:
1. Add tracking script in layout
2. Track custom events for conversions
3. Monitor admin dashboard usage

## Security Features Implemented

✓ CSRF protection on all forms
✓ SQL injection prevention (Eloquent ORM)
✓ XSS protection (Blade escaping)
✓ Password hashing (bcrypt)
✓ Rate limiting ready
✓ File upload validation
✓ Authorization policies
✓ Activity logging

## Next Steps

1. **Customize branding**
   - Update company logo
   - Modify color scheme
   - Add custom content

2. **Configure services**
   - Add real services
   - Set accurate pricing
   - Define realistic timelines

3. **Add portfolio projects**
   - Upload project screenshots
   - Add project descriptions
   - Link to live websites

4. **Set up email notifications**
   - Configure SMTP
   - Create notification templates
   - Test email sending

5. **Deploy to production**
   - Purchase domain
   - Set up SSL certificate
   - Deploy application
   - Monitor performance

## Support Resources

- [Laravel 12 Documentation](https://laravel.com/docs/12.x)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [PHP Documentation](https://www.php.net/docs.php)
