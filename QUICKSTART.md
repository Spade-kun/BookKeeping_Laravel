# 🚀 Quick Start - Bookkeeping Application

## ⚡ Fast Setup (5 minutes)

### Step 1: Clone & Install
```bash
cd c:\GITHUB\WORK\BookKeepingWebsite
composer install
npm install
```

### Step 2: Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set:
```env
DB_DATABASE=bookkeeping
DB_USERNAME=your_username
DB_PASSWORD=your_password

GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
```

### Step 3: Database Setup
```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

### Step 4: Build & Run
```bash
npm run build
php artisan serve
```

Visit: **http://localhost:8000**

---

## 📋 Test Accounts

Create manually via Google OAuth or database:

**Admin:**
- Email: `admin@bookkeeping.com`
- Password: `password`
- Role: `admin`

**User:**
- Email: `user@bookkeeping.com`
- Password: `password`
- Role: `user`

---

## 🗺️ Routes Overview

### User Routes
- `/documents` - Manage your documents
- `/reports` - View your reports
- `/subscriptions` - Choose a plan
- `/profile` - Your account settings

### Admin Routes
- `/admin/users` - User management
- `/admin/documents` - All documents
- `/admin/reports` - Create reports
- `/admin/transactions` - Income/Expenses
- `/admin/plans` - Subscription plans
- `/admin/subscriptions` - All subscriptions

---

## 🎨 Design Colors

- **Primary**: `#0066CC` (Everly Blue)
- **Secondary**: `#003366` (Deep Blue)
- **Dark**: `#002147` (Navy)
- **Light**: `#E6F2FF` (Pale Blue)

---

## 🔧 Common Commands

### Clear Caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Reset Database
```bash
php artisan migrate:fresh --seed
```

### Development
```bash
npm run dev    # Watch mode for assets
php artisan serve    # Start server
```

### Production
```bash
npm run build    # Build optimized assets
```

---

## 📦 What's Included

✅ **7 Modules**: Documents, Reports, Transactions, Plans, Subscriptions, Users, Profile  
✅ **26 Views**: All CRUD operations  
✅ **8 Controllers**: User + Admin controllers  
✅ **5 Database Tables**: Migrations + seeders  
✅ **6 Models**: Full relationships  
✅ **2 Policies**: Authorization  
✅ **Role-Based Access**: User vs Admin  
✅ **File Management**: Private storage  
✅ **Subscription System**: 6 pre-seeded plans  

---

## 🧪 Quick Test

1. Login with Google OAuth
2. Subscribe to "Professional Monthly" plan
3. Upload a document (PDF/Excel)
4. View your subscription status in Profile
5. **(Admin)** Create a report for a user
6. **(Admin)** Add an income transaction

---

## 📚 Documentation

- **[PROJECT_COMPLETE.md](PROJECT_COMPLETE.md)** - Full project overview
- **[TESTING_GUIDE.md](TESTING_GUIDE.md)** - 55+ test cases
- **[SETUP.md](SETUP.md)** - Detailed setup instructions
- **[DEPLOYMENT_CHECKLIST.md](DEPLOYMENT_CHECKLIST.md)** - Production deployment

---

## 🆘 Troubleshooting

**Ports in use?**
```bash
php artisan serve --port=8001
```

**Storage permission errors?**
```bash
chmod -R 775 storage bootstrap/cache
```

**Migrations fail?**
Check database credentials in `.env`

**Routes not found?**
```bash
php artisan route:cache
```

---

## 🎯 Next Steps

1. ✅ Run migrations: `php artisan migrate:fresh --seed`
2. ✅ Create admin account via Google OAuth
3. ✅ Test all modules (see TESTING_GUIDE.md)
4. ✅ Customize colors/branding if needed
5. ✅ Add payment gateway (Stripe/PayPal)
6. ✅ Deploy to production (see DEPLOYMENT_CHECKLIST.md)

---

**Status**: ✅ 100% Complete  
**Version**: 1.0.0  
**Updated**: December 2023  

🚀 **Ready to launch!**
