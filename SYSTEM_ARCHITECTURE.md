# 🏗️ System Architecture & Database Schema

## 📊 Application Flow Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                    FAUZIDEV CMS APPLICATION                     │
└─────────────────────────────────────────────────────────────────┘

                              │
                ┌─────────────┼─────────────┐
                │             │             │
        ┌───────▼────────┐  │  ┌──────────▼──────────┐
        │   PUBLIC PAGES │  │  │  AUTHENTICATION    │
        │                │  │  │                    │
        │ • Home         │  │  │ • Login            │
        │ • Services     │  │  │ • Register         │
        │ • Portfolio    │  │  │ • Logout           │
        │ • Contact      │  │  │ • Forgot Password  │
        └─────────────────┘  │  └────────────────────┘
                │             │
                │    ┌────────▼────────┐
                │    │                 │
                │    ▼                 ▼
                │  ┌──────────────┐ ┌─────────────┐
                │  │   DATABASE   │ │ MIDDLEWARE  │
                │  │  (MySQL)     │ │             │
                │  └──────────────┘ │ • auth      │
                │                   │ • admin     │
                │                   └─────────────┘
                │
        ┌───────┴───────┬────────────┬───────────┐
        │               │            │           │
        ▼               ▼            ▼           ▼
    ┌────────┐   ┌──────────┐  ┌─────────┐  ┌────────────┐
    │ ADMIN  │   │ CUSTOMER │  │ GUEST   │  │ MIDDLEWARE │
    │DASHBOARD   │ DASHBOARD   │ USER    │  │ CHECK      │
    └────────┘   └──────────┘  └─────────┘  └────────────┘
        │               │            │
    ┌───┴───────┐   ┌──┴──────┐    │
    │           │   │         │    │
    ▼           ▼   ▼         ▼    ▼
┌────────┐  ┌─────────┐  ┌────────────────┐
│Service │  │Payment  │  │View Dashboard  │
│Manager │  │Manager  │  │& Order History │
└────────┘  └─────────┘  └────────────────┘
```

---

## 🗄️ Database Schema

### Users Table
```
┌─────────────────────────────────────────┐
│           USERS TABLE                   │
├─────────────────────────────────────────┤
│ id (PK)                                 │
│ name          (string)                  │
│ email         (string, unique)          │
│ password      (hashed)                  │
│ role          ('admin' | 'client')      │
│ phone         (nullable)                │
│ company_name  (nullable)                │
│ address       (nullable)                │
│ is_active     (boolean)                 │
│ created_at, updated_at                  │
└─────────────────────────────────────────┘
```

### Services Table
```
┌─────────────────────────────────────────┐
│        SERVICES TABLE (CMS)             │
├─────────────────────────────────────────┤
│ id (PK)                                 │
│ name          (string)                  │
│ description   (text)                    │
│ icon          (string)                  │
│ features      (json)                    │
│ is_active     (boolean)                 │
│ created_at, updated_at                  │
└─────────────────────────────────────────┘
     │
     │ (1:M) 
     ▼
┌─────────────────────────────────────────┐
│  PRICING PACKAGES TABLE                 │
├─────────────────────────────────────────┤
│ id (PK)                                 │
│ service_id (FK)                         │
│ name          (string)                  │
│ description   (text)                    │
│ price         (decimal)                 │
│ delivery_days (integer)                 │
│ revision_rounds (integer)               │
│ features      (json)                    │
│ is_active     (boolean)                 │
│ created_at, updated_at                  │
└─────────────────────────────────────────┘
```

### Orders & Payments Tables
```
┌─────────────────────────────────────────┐
│          ORDERS TABLE                   │
├─────────────────────────────────────────┤
│ id (PK)                                 │
│ user_id (FK) ──────────────┐            │
│ package_id (FK)            │            │
│ total_amount  (decimal)    │            │
│ status        ('pending'   │            │
│               'in_progress'│            │
│               'completed') │            │
│ created_at, updated_at     │            │
└─────────────────────────────────────────┘
     │                        │
     │ (1:M)          ┌───────▼──────┐
     │                │ USER (PK)    │
     ▼                └──────────────┘
┌─────────────────────────────────────────┐
│        PAYMENTS TABLE                   │
├─────────────────────────────────────────┤
│ id (PK)                                 │
│ order_id (FK)                           │
│ amount        (decimal)                 │
│ status        ('pending'                │
│               'completed'               │
│               'failed')                 │
│ transaction_id (string)                 │
│ payment_method (string)                 │
│ created_at, updated_at                  │
└─────────────────────────────────────────┘
```

### Other Tables
```
┌─────────────────────────────────────────┐
│  PORTFOLIO PROJECTS TABLE               │
├─────────────────────────────────────────┤
│ id (PK)                                 │
│ title, description, image_url           │
│ category, link                          │
│ is_active, created_at, updated_at       │
└─────────────────────────────────────────┘

┌─────────────────────────────────────────┐
│     TESTIMONIALS TABLE                  │
├─────────────────────────────────────────┤
│ id (PK)                                 │
│ name, company, message, rating          │
│ image_url, is_active                    │
│ created_at, updated_at                  │
└─────────────────────────────────────────┘

┌─────────────────────────────────────────┐
│    ACTIVITY LOGS TABLE                  │
├─────────────────────────────────────────┤
│ id (PK)                                 │
│ user_id (FK)                            │
│ action, model_type, model_id            │
│ description                             │
│ created_at                              │
└─────────────────────────────────────────┘
```

---

## 🔄 User Journey

### Admin User Journey
```
┌──────────┐
│  Login   │ (admin@fauzidev.com)
└────┬─────┘
     │
     ▼
┌─────────────────┐
│ Admin Dashboard │
└────┬────────────┘
     │
     ├─→ View Analytics (Orders, Revenue, Pending Payments)
     │
     ├─→ Manage Services
     │    ├─→ View All Services
     │    ├─→ Add New Service
     │    ├─→ Edit Service
     │    └─→ Delete Service
     │
     ├─→ Manage Payments
     │    ├─→ View All Payments
     │    ├─→ View Payment Details
     │    └─→ Confirm Pending Payment
     │
     └─→ Logout
```

### Customer User Journey
```
┌──────────┐
│ Register │ (or Login)
└────┬─────┘
     │
     ▼
┌─────────────────┐
│     Dashboard   │
└────┬────────────┘
     │
     ├─→ View Order History
     │    ├─→ Order ID
     │    ├─→ Service Name
     │    ├─→ Total Amount
     │    ├─→ Status
     │    └─→ Date
     │
     ├─→ View Payment History
     │    ├─→ Transaction ID
     │    ├─→ Amount
     │    ├─→ Status
     │    └─→ Date
     │
     └─→ Logout
```

### Guest User Journey
```
┌──────────┐
│   Home   │
└────┬─────┘
     │
     ├─→ View Services (from DB)
     │
     ├─→ View Portfolio
     │
     ├─→ View Contact Info
     │
     ├─→ Click Login → Login Form
     │
     └─→ Click Register → Register Form
```

---

## 🔐 Authentication Flow

```
User Registration
├─ Form Input: name, email, password, company
│
├─ Validation:
│  ├─ Email unique check
│  ├─ Password min 8 chars
│  └─ Password confirmation match
│
├─ Create User:
│  ├─ Hash password with bcrypt
│  ├─ Set role = 'client'
│  └─ Save to database
│
└─ Auto Login + Redirect to Dashboard


User Login
├─ Form Input: email, password
│
├─ Validation:
│  ├─ Email exists
│  └─ Password matches
│
├─ Authentication:
│  ├─ Check credentials
│  ├─ Create session
│  └─ Generate remember token
│
└─ Redirect:
   ├─ If admin → /admin/dashboard
   └─ If client → /dashboard
```

---

## 🎯 Permission/Authorization Flow

```
Request to /admin/*
     │
     ▼
┌─────────────────────┐
│ Check is_auth?      │
└──┬──────────────┬───┘
   │              │
  NO             YES
   │              │
   ▼              ▼
REDIRECT    ┌────────────────┐
 to /login  │ Check is_admin? │
            └────┬───────┬────┘
                 │       │
                NO      YES
                 │       │
                 ▼       ▼
            403 ABORT   ALLOW
            FORBIDDEN   ACCESS
```

---

## 📱 View Layer Architecture

```
layouts/app.blade.php (Master Layout)
│
├─ Navbar
│  ├─ Logo & Brand
│  ├─ Navigation Links
│  └─ Auth Links
│     ├─ If Guest: Login, Register
│     ├─ If Admin: Admin Dashboard
│     └─ If Client: Dashboard
│
├─ @yield('content')
│  ├─ home.blade.php (Services from DB)
│  ├─ services.blade.php
│  ├─ portfolio.blade.php
│  ├─ contact.blade.php
│  ├─ dashboard.blade.php (Customer)
│  ├─ admin/dashboard.blade.php
│  ├─ admin/services/index.blade.php
│  ├─ admin/services/create.blade.php
│  ├─ admin/payments/index.blade.php
│  ├─ auth/login.blade.php
│  └─ auth/register.blade.php
│
└─ Footer
   ├─ Company Info
   ├─ Links
   └─ Social Media
```

---

## 🔗 Route Structure

```
Laravel Routing
│
├─ Public Routes (No Auth Required)
│  ├─ GET  /                   → HomeController@index
│  ├─ GET  /services           → view('services')
│  ├─ GET  /portfolio          → view('portfolio')
│  └─ GET  /contact            → view('contact')
│
├─ Auth Routes (No Auth Required)
│  ├─ GET  /login              → LoginController@showLoginForm
│  ├─ POST /login              → LoginController@login
│  ├─ GET  /register           → RegisterController@showRegisterForm
│  ├─ POST /register           → RegisterController@register
│  └─ POST /logout             → LoginController@logout
│
├─ Client Routes (auth middleware)
│  └─ GET  /dashboard          → DashboardController@index
│
└─ Admin Routes (auth + admin middleware)
   ├─ GET  /admin/dashboard                 → Admin\DashboardController@index
   ├─ GET  /admin/services                  → Admin\ServiceManagementController@index
   ├─ GET  /admin/services/create           → Admin\ServiceManagementController@create
   ├─ POST /admin/services                  → Admin\ServiceManagementController@store
   ├─ GET  /admin/services/{id}/edit        → Admin\ServiceManagementController@edit
   ├─ PUT  /admin/services/{id}             → Admin\ServiceManagementController@update
   ├─ DELETE /admin/services/{id}           → Admin\ServiceManagementController@destroy
   ├─ GET  /admin/payments                  → Admin\PaymentManagementController@index
   ├─ GET  /admin/payments/{id}             → Admin\PaymentManagementController@show
   └─ PATCH /admin/payments/{id}/confirm    → Admin\PaymentManagementController@confirm
```

---

## 💾 Data Flow Example: Add New Service

```
┌─────────────────────────────────────────┐
│ Admin clicks "Tambah Layanan"           │
└──────────────┬──────────────────────────┘
               │
               ▼
      ┌─────────────────────┐
      │ GET /admin/services │
      │      /create        │
      └──────────┬──────────┘
                 │
                 ▼
      ┌───────────────────────────┐
      │ Display Form              │
      │ - Nama Layanan            │
      │ - Deskripsi               │
      │ - Icon                    │
      │ - Features (comma-sep)    │
      │ - Status checkbox         │
      └──────────┬────────────────┘
                 │
                 ▼ (user fills form & submits)
      ┌────────────────────────┐
      │ POST /admin/services   │
      │ (Form data)            │
      └──────────┬─────────────┘
                 │
                 ▼
      ┌──────────────────────────┐
      │ Validate:                │
      │ - name (required)        │
      │ - description (required) │
      │ - icon (nullable)        │
      │ - features (parse JSON)  │
      └──────────┬───────────────┘
                 │
            ┌────┴────┐
            │          │
        VALID      INVALID
            │          │
            ▼          ▼
      ┌─────────┐  ┌──────────┐
      │ Create  │  │ Return   │
      │ Service │  │ Error    │
      │ Record  │  │ Message  │
      └────┬────┘  └──────────┘
           │
           ▼
      ┌────────────────────┐
      │ Create Activity    │
      │ Log Entry          │
      └────┬───────────────┘
           │
           ▼
      ┌────────────────────┐
      │ Redirect with      │
      │ Success Message    │
      └────┬───────────────┘
           │
           ▼
      ┌──────────────────────────┐
      │ Home Page Query DB       │
      │ Shows Updated 3 Services │
      │ INSTANTLY!               │
      └──────────────────────────┘
```

---

## 🎨 Color System

```
Primary Colors:
├─ Primary Orange    #FF6B35  (Buttons, Icons, Active States)
├─ Secondary Yellow  #FFE66D  (Highlights, Warnings)
└─ Accent Green      #6BCB77  (Success, Positives)

Status Colors:
├─ Success Green     #4AFF6A  (Completed, Active)
├─ Warning Orange    #FFD93D  (Pending, Caution)
└─ Danger Red        #FF6B6B  (Failed, Errors)

Admin Panel:
├─ Dark Background   #1E293B  (Slate-900)
├─ Card Background   #0F172A  (Slate-800)
└─ Text              #FFFFFF  (White)

Public Pages:
├─ Background        #FFFFFF  (White)
├─ Text              #1E293B  (Dark Slate)
└─ Light Gray        #F1F5F9  (Slate-50)
```

---

**Created**: February 9, 2026
**Version**: 1.0.0
**Status**: Complete & Production Ready
