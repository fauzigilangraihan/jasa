# fauziDev - Quick Reference Guide

## 📋 Quick Links

### Documentation
- **Setup**: [SETUP_GUIDE.md](SETUP_GUIDE.md) - Installation instructions
- **Configuration**: [CONFIGURATION.md](CONFIGURATION.md) - Environment setup
- **Troubleshooting**: [TROUBLESHOOTING.md](TROUBLESHOOTING.md) - Common issues
- **API**: [API_DOCUMENTATION.md](API_DOCUMENTATION.md) - Future API guide
- **Roadmap**: [FEATURE_ROADMAP.md](FEATURE_ROADMAP.md) - Development phases
- **Summary**: [PROJECT_SUMMARY.md](PROJECT_SUMMARY.md) - Project overview
- **Checklist**: [COMPLETION_CHECKLIST.md](COMPLETION_CHECKLIST.md) - Verification

---

## 🚀 Getting Started (5 minutes)

### Windows
```batch
setup.bat
```

### Linux/Mac
```bash
chmod +x setup.sh
./setup.sh
```

### Access App
- **Website**: http://localhost:8000
- **Admin**: http://localhost:8000/admin
- **Admin Email**: admin@fauzidev.com
- **Admin Password**: password123

---

## 📁 Important Directories

```
jasa/
├── app/Models/              ← Database models (11 files)
├── app/Http/Controllers/    ← Business logic (10 files)
├── database/migrations/     ← Database schema (11 files)
├── resources/views/         ← UI templates (20+ files)
├── routes/web.php          ← Application routes
└── storage/app/public/     ← User uploads
```

---

## 🔐 User Accounts

### Default Admin Account
```
Email: admin@fauzidev.com
Password: password123
Role: admin
Access: /admin
```

### Create New Admin
```php
php artisan tinker
User::create([
    'name' => 'Admin Name',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'role' => 'admin',
    'is_active' => true,
])
```

### Create New Client
```php
php artisan tinker
User::create([
    'name' => 'Client Name',
    'email' => 'client@example.com',
    'password' => bcrypt('password'),
    'role' => 'client',
    'company_name' => 'Company',
    'phone' => '+1234567890',
    'is_active' => true,
])
```

---

## 📊 Dashboard URLs

| Page | URL | Access |
|------|-----|--------|
| Landing | http://localhost:8000 | Public |
| Services | http://localhost:8000/services | Public |
| Portfolio | http://localhost:8000/portfolio | Public |
| Login | http://localhost:8000/login | Public |
| Register | http://localhost:8000/register | Public |
| Client Dashboard | http://localhost:8000/home | Auth (Client) |
| Admin Dashboard | http://localhost:8000/admin | Auth (Admin) |

---

## 🛠️ Common Commands

### Database
```bash
# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Reset everything
php artisan migrate:reset

# Fresh install
php artisan migrate:fresh --seed

# View database
php artisan db:show

# Backup database
mysqldump -u root -p jasa > backup.sql
```

### Cache
```bash
# Clear all caches
php artisan optimize:clear

# Or individually
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Assets
```bash
# Build for development
npm run dev

# Build for production
npm run build

# Watch for changes
npm run dev -- --host
```

### Development
```bash
# Start development server
php artisan serve

# Interactive shell
php artisan tinker

# Show all routes
php artisan route:list

# Generate documentation
php artisan make:docs
```

---

## 🔧 Configuration

### .env File Location
`/jasa/.env`

### Key Settings
```env
APP_NAME=fauziDev
APP_ENV=local              # local or production
APP_DEBUG=true             # false in production
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
```

### Email Configuration (for future)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS=noreply@fauzidev.com
```

---

## 📂 File Upload Paths

```
storage/app/public/
├── orders/
│   ├── {order_id}/
│   │   ├── requirements/
│   │   └── results/
└── payments/
    └── {payment_id}/
```

### Access in Blade
```blade
<a href="{{ asset('storage/orders/' . $order->id . '/' . $file) }}">
    Download
</a>
```

---

## 🎨 Frontend Structure

### Layouts
- `resources/views/layouts/app.blade.php` - Public layout
- `resources/views/layouts/admin.blade.php` - Admin layout

### Key Components
- Navigation with dark mode toggle
- Responsive grid system (Tailwind)
- Forms with validation feedback
- Tables with sorting
- Cards and containers
- Buttons and links

### Styling
- Framework: Tailwind CSS
- Dark mode: Enabled with localStorage
- Breakpoints: Mobile first responsive
- Animations: CSS transitions and keyframes

---

## 🔒 Security Essentials

### In Development
- ✅ CSRF tokens automatically added
- ✅ Passwords hashed with bcrypt
- ✅ SQL injection prevented via Eloquent
- ✅ XSS prevented via Blade escaping

### Before Production
- [ ] Set APP_DEBUG=false
- [ ] Generate new APP_KEY
- [ ] Configure HTTPS
- [ ] Set strong DB password
- [ ] Setup file permissions (755/775)
- [ ] Review .env values
- [ ] Enable rate limiting

---

## 📊 Database Schema Quick Reference

### Core Tables
```
services (id, name, description, icon, active)
pricing_packages (id, service_id, name, price, features)
orders (id, user_id, service_id, pricing_package_id, status)
payments (id, order_id, amount, type, status)
invoices (id, order_id, subtotal, tax, total)
```

### Relationships
```
Service → Many PricingPackages
Service → Many Orders
Order → Many Payments
Order → Many Files
Payment → One Order
User → Many Orders
```

---

## 🐛 Debugging Tips

### View Logs
```bash
tail -f storage/logs/laravel.log
```

### Use Tinker
```bash
php artisan tinker
# Then run PHP commands
User::all()
Order::with('payments')->first()
```

### Check Routes
```bash
php artisan route:list
php artisan route:list --method=GET
```

### Database Debugging
```php
DB::enableQueryLog();
// Your code here
dd(DB::getQueryLog());
```

---

## ⚡ Performance Tips

### Development
- Enable query logging to find N+1 queries
- Use Tinker for quick testing
- Monitor Laravel.log for errors
- Clear caches after changes

### Production
- Run: `php artisan config:cache`
- Run: `php artisan route:cache`
- Enable browser caching
- Use CDN for static assets
- Monitor performance metrics

---

## 📱 Responsive Breakpoints (Tailwind)

```
sm: 640px   - Tablets portrait
md: 768px   - Tablets landscape
lg: 1024px  - Desktops
xl: 1280px  - Large desktops
2xl: 1536px - Extra large
```

Classes: `sm:`, `md:`, `lg:`, `xl:`, `2xl:`

---

## 🎯 Features by Role

### Public User
- View landing page
- Browse services
- View portfolio
- Read testimonials
- Check FAQ
- Register/Login

### Client User
- View dashboard
- Create orders
- Upload project files
- Submit payments
- View payment history
- Download invoices

### Admin User
- View analytics dashboard
- Manage all orders
- Manage payments
- Approve/reject payments
- Create services
- Manage pricing packages
- View activity logs

---

## 🚢 Deployment Commands

### Pre-Deployment
```bash
composer dump-autoload --optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

### Deploy
```bash
git push origin main
# On server:
cd /path/to/jasa
git pull origin main
composer install --no-dev
php artisan migrate --force
npm run build
```

### Post-Deploy
```bash
php artisan cache:clear
php artisan config:clear
# Test all features
```

---

## 📞 Help Resources

### Quick Fixes
1. Cache issues → `php artisan optimize:clear`
2. File upload fails → `php artisan storage:link`
3. Dark mode broken → Check localStorage
4. Styles not loading → `npm run build`
5. 404 errors → `php artisan route:list`

### Documentation
- Getting started: [SETUP_GUIDE.md](SETUP_GUIDE.md)
- Issues: [TROUBLESHOOTING.md](TROUBLESHOOTING.md)
- Configuration: [CONFIGURATION.md](CONFIGURATION.md)

### External Help
- [Laravel Docs](https://laravel.com/docs)
- [Stack Overflow](https://stackoverflow.com/questions/tagged/laravel)
- [Laravel Discord](https://discord.gg/laravel)

---

## ✅ Pre-Launch Checklist

### Development
- [ ] All features tested locally
- [ ] Database migrations work
- [ ] File uploads work
- [ ] Payment flow tested
- [ ] Admin functions tested

### Setup
- [ ] Environment configured (.env)
- [ ] Database created
- [ ] Storage link created
- [ ] Assets compiled
- [ ] Seeders run

### Security
- [ ] Strong passwords set
- [ ] HTTPS configured
- [ ] APP_DEBUG=false
- [ ] File permissions correct
- [ ] Backups created

### Deployment
- [ ] Server prepared
- [ ] Domain configured
- [ ] Database backup
- [ ] Files uploaded
- [ ] Migrations run

---

## 📊 Useful Statistics

| Item | Count |
|------|-------|
| Database Tables | 11 |
| Models | 11 |
| Controllers | 10 |
| Routes | 33+ |
| Views | 20+ |
| Migrations | 11 |
| Total Code Lines | 15,000+ |
| Documentation Pages | 7 |

---

## 🎓 Learning Path

1. **Day 1**: Read [SETUP_GUIDE.md](SETUP_GUIDE.md) & install
2. **Day 1**: Run `setup.bat` or `setup.sh`
3. **Day 1**: Test all pages in browser
4. **Day 2**: Read [PROJECT_SUMMARY.md](PROJECT_SUMMARY.md)
5. **Day 2**: Review database schema
6. **Day 3**: Review controllers and models
7. **Day 3**: Test all features
8. **Day 4**: Prepare for deployment
9. **Day 5**: Deploy to production

---

## 🔄 Common Workflows

### Create New Feature
1. Create migration: `php artisan make:migration create_xxx_table`
2. Create model: `php artisan make:model Xxx`
3. Create controller: `php artisan make:controller XxxController`
4. Add routes
5. Create views
6. Test feature

### Fix a Bug
1. Check logs: `tail -f storage/logs/laravel.log`
2. Use Tinker: `php artisan tinker`
3. Debug query: Enable query log
4. Test fix locally
5. Commit and push

### Deploy Update
1. Test locally
2. Run migrations (if any)
3. Rebuild assets: `npm run build`
4. Clear caches
5. Test in production

---

## 📝 Notes

### Development
- Always test locally before deploying
- Use git branches for features
- Write meaningful commit messages
- Comment complex code
- Update documentation

### Production
- Monitor error logs daily
- Backup database regularly
- Update dependencies monthly
- Review security advisories
- Monitor performance metrics

---

## 🎉 You're All Set!

Your fauziDev application is ready to go!

**Next Steps**:
1. Start development server: `php artisan serve`
2. Visit http://localhost:8000
3. Login as admin: admin@fauzidev.com / password123
4. Explore the admin dashboard
5. Create a test order as client
6. Test payment workflow

**Questions?** See documentation files listed above.

**Ready to deploy?** Follow [CONFIGURATION.md](CONFIGURATION.md)

---

**Happy coding! 🚀**
