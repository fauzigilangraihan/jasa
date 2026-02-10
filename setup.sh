#!/bin/bash

# fauziDev Laravel 12 Quick Setup Script
# This script automates the initial setup process

set -e

echo "================================"
echo "fauziDev Laravel 12 Setup"
echo "================================"
echo ""

# Check PHP installation
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed!"
    exit 1
fi
echo "✓ PHP found: $(php -v | head -n 1)"

# Check Composer installation
if ! command -v composer &> /dev/null; then
    echo "❌ Composer is not installed!"
    exit 1
fi
echo "✓ Composer found"

# Check Node.js installation
if ! command -v node &> /dev/null; then
    echo "❌ Node.js is not installed!"
    exit 1
fi
echo "✓ Node.js found: $(node -v)"

# Check npm installation
if ! command -v npm &> /dev/null; then
    echo "❌ npm is not installed!"
    exit 1
fi
echo "✓ npm found: $(npm -v)"

echo ""
echo "================================"
echo "Installing Dependencies..."
echo "================================"
echo ""

# Install PHP dependencies
echo "Installing PHP dependencies..."
composer install --no-interaction

# Install Node dependencies
echo ""
echo "Installing Node.js dependencies..."
npm install

# Environment setup
echo ""
echo "================================"
echo "Configuring Environment..."
echo "================================"
echo ""

if [ ! -f .env ]; then
    echo "Creating .env file..."
    cp .env.example .env
    php artisan key:generate
    echo "✓ .env created and APP_KEY generated"
else
    echo "✓ .env already exists"
fi

# Create database
echo ""
echo "================================"
echo "Database Setup..."
echo "================================"
echo ""

read -p "Enter database name (default: jasa): " DB_NAME
DB_NAME=${DB_NAME:-jasa}

read -p "Enter database user (default: root): " DB_USER
DB_USER=${DB_USER:-root}

read -sp "Enter database password: " DB_PASSWORD
echo ""

# Update .env file
sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USER/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" .env

echo "✓ .env updated with database credentials"

# Run migrations
echo ""
echo "Running database migrations..."
php artisan migrate --seed --force

echo "✓ Database migrations completed"
echo "✓ Sample data seeded"

# Create storage link
echo ""
echo "Creating storage link..."
php artisan storage:link
echo "✓ Storage link created"

# Clear cache
echo ""
echo "Clearing cache..."
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
echo "✓ Cache cleared"

# Build assets
echo ""
echo "Building assets..."
npm run build
echo "✓ Assets built"

# Set permissions
echo ""
echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache
echo "✓ Permissions set"

echo ""
echo "================================"
echo "✓ Setup Complete!"
echo "================================"
echo ""
echo "Next steps:"
echo "1. Update .env with your configuration"
echo "2. Start Laravel: php artisan serve"
echo "3. Visit: http://localhost:8000"
echo ""
echo "Admin credentials:"
echo "Email: admin@fauzidev.com"
echo "Password: password123"
echo ""
echo "Happy coding! 🚀"
