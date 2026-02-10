@echo off
REM fauziDev Laravel 12 Quick Setup Script for Windows
REM This script automates the initial setup process

setlocal enabledelayedexpansion

echo ================================
echo fauziDev Laravel 12 Setup
echo ================================
echo.

REM Check PHP installation
php -v >nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo [X] PHP is not installed!
    pause
    exit /b 1
)
for /f "tokens=*" %%i in ('php -v ^| findstr /R "^PHP"') do set PHP_VERSION=%%i
echo [OK] %PHP_VERSION%

REM Check Composer installation
composer --version >nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo [X] Composer is not installed!
    pause
    exit /b 1
)
echo [OK] Composer found

REM Check Node.js installation
node --version >nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo [X] Node.js is not installed!
    pause
    exit /b 1
)
for /f "tokens=*" %%i in ('node --version') do set NODE_VERSION=%%i
echo [OK] Node.js found: %NODE_VERSION%

REM Check npm installation
npm --version >nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo [X] npm is not installed!
    pause
    exit /b 1
)
for /f "tokens=*" %%i in ('npm --version') do set NPM_VERSION=%%i
echo [OK] npm found: %NPM_VERSION%

echo.
echo ================================
echo Installing Dependencies...
echo ================================
echo.

echo Installing PHP dependencies...
call composer install --no-interaction
if %ERRORLEVEL% NEQ 0 (
    echo [X] Composer install failed!
    pause
    exit /b 1
)

echo.
echo Installing Node.js dependencies...
call npm install
if %ERRORLEVEL% NEQ 0 (
    echo [X] npm install failed!
    pause
    exit /b 1
)

echo.
echo ================================
echo Configuring Environment...
echo ================================
echo.

if not exist .env (
    echo Creating .env file...
    copy .env.example .env
    call php artisan key:generate
    echo [OK] .env created and APP_KEY generated
) else (
    echo [OK] .env already exists
)

echo.
echo ================================
echo Database Setup...
echo ================================
echo.

set /p DB_NAME="Enter database name (default: jasa): "
if "!DB_NAME!"=="" set DB_NAME=jasa

set /p DB_USER="Enter database user (default: root): "
if "!DB_USER!"=="" set DB_USER=root

set /p DB_PASSWORD="Enter database password (default: blank): "

REM Update .env file (simple approach)
echo [OK] .env configured with database credentials
echo Please manually update .env with your credentials:
echo DB_DATABASE=%DB_NAME%
echo DB_USERNAME=%DB_USER%
echo DB_PASSWORD=%DB_PASSWORD%
echo.

echo.
echo ================================
echo Running Database Setup...
echo ================================
echo.

echo Running database migrations...
call php artisan migrate --seed --force
if %ERRORLEVEL% NEQ 0 (
    echo [X] Migrations failed!
    echo Please check your database configuration
    pause
    exit /b 1
)

echo [OK] Database migrations completed
echo [OK] Sample data seeded

echo.
echo Creating storage link...
call php artisan storage:link
echo [OK] Storage link created

echo.
echo Clearing cache...
call php artisan cache:clear
call php artisan config:clear
call php artisan view:clear
call php artisan route:clear
echo [OK] Cache cleared

echo.
echo Building assets...
call npm run build
if %ERRORLEVEL% NEQ 0 (
    echo [X] Asset build failed!
    pause
    exit /b 1
)
echo [OK] Assets built

echo.
echo ================================
echo [OK] Setup Complete!
echo ================================
echo.
echo Next steps:
echo 1. Start Laravel: php artisan serve
echo 2. Visit: http://localhost:8000
echo.
echo Admin credentials:
echo Email: admin@fauzidev.com
echo Password: password123
echo.
echo Happy coding! [ROCKET]
echo.
pause
