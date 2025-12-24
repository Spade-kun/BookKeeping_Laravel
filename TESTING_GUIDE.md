# 🧪 Testing Guide - Bookkeeping Application

## Pre-Testing Checklist

### 1. Run Migrations
```bash
php artisan migrate:fresh --seed
```

This will:
- Create all database tables
- Seed the database with 6 subscription plans (Startup, Professional, Enterprise - monthly/yearly)

### 2. Clear Caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### 3. Create Storage Link
```bash
php artisan storage:link
```

### 4. Set Permissions (if on Unix/Linux)
```bash
chmod -R 775 storage bootstrap/cache
```

---

## Manual Testing Workflow

### 🔐 Authentication Testing

#### Test 1: Google OAuth Login
1. Navigate to `/login`
2. Click "Sign in with Google"
3. Authorize the application
4. **Expected**: Redirected to appropriate dashboard based on role

#### Test 2: Role-Based Access
1. **As User**: Should only see user routes (documents, reports, subscriptions, profile)
2. **As Admin**: Should see all admin routes (users, plans, transactions, subscriptions, etc.)
3. **Test Unauthorized Access**: Try accessing `/admin/users` as a regular user
   - **Expected**: 403 Forbidden or redirect

---

### 📁 Documents Module Testing

#### Test 3: Upload Document (User)
1. Navigate to `/documents`
2. Click "Upload Document"
3. Fill in:
   - File: Upload a PDF/Excel file
   - Description: "Q4 2023 Receipts"
4. Submit form
5. **Expected**: Success message, document appears in table

#### Test 4: Download Document
1. From documents table, click download icon
2. **Expected**: File downloads successfully

#### Test 5: Edit Document
1. Click edit icon on a document
2. Update description
3. **Expected**: Success message, changes reflected

#### Test 6: Delete Document
1. Click delete icon
2. Confirm deletion
3. **Expected**: Document removed from list

#### Test 7: Admin View All Documents
1. Login as admin
2. Navigate to `/admin/documents`
3. **Expected**: See documents from all users

---

### 📊 Reports Module Testing

#### Test 8: View Reports (User)
1. Navigate to `/reports`
2. **Expected**: See only your reports

#### Test 9: Create Report (Admin)
1. Login as admin
2. Navigate to `/admin/reports/create`
3. Fill in:
   - User: Select a user
   - Title: "Monthly Report - January 2024"
   - Type: Monthly
   - Period: "January 2024"
   - Start Date: 2024-01-01
   - End Date: 2024-01-31
   - File: Upload PDF/Excel
   - Description: Optional notes
4. Submit form
5. **Expected**: Report created and visible to both admin and assigned user

#### Test 10: Download Report
1. Click download icon on report
2. **Expected**: File downloads successfully

#### Test 11: Edit Report (Admin)
1. Click edit on a report
2. Change title or dates
3. **Expected**: Changes saved successfully

---

### 💳 Subscriptions Module Testing

#### Test 12: View Plans (User)
1. Navigate to `/subscriptions`
2. **Expected**: See 6 plans in 3-column grid (Startup, Professional, Enterprise - each monthly/yearly)

#### Test 13: Subscribe to Plan
1. Click "Get Started" on a plan
2. **Expected**: 
   - Success message
   - Subscription created with correct dates
   - Status shows as "Active"
   - Plan features are accessible

#### Test 14: Switch Plans
1. While subscribed, click "Switch to [Other Plan]"
2. Confirm
3. **Expected**: 
   - Old subscription cancelled
   - New subscription active
   - End date updated

#### Test 15: Cancel Subscription
1. Click "Cancel Subscription"
2. Confirm cancellation
3. **Expected**: 
   - Subscription status changes to "cancelled"
   - Access remains until end date

---

### 👤 Profile Module Testing

#### Test 16: View Profile
1. Navigate to `/profile`
2. **Expected**: See your account information, Google avatar (if available), subscription status

#### Test 17: Edit Profile
1. Click "Edit Profile"
2. Update name or email
3. **Expected**: Changes saved successfully

#### Test 18: Change Password
1. In edit profile form
2. Fill in:
   - Current Password
   - New Password
   - Confirm Password
3. **Expected**: Password updated, can login with new password

---

### 🔧 Admin - User Management Testing

#### Test 19: View All Users
1. Login as admin
2. Navigate to `/admin/users`
3. **Expected**: 
   - See stats cards (Total Users, Active Subscriptions, Admins, Regular Users)
   - Table showing all users with subscription status

#### Test 20: View User Details
1. Click "View" icon on a user
2. **Expected**: See user profile, subscription details, recent documents, recent reports

#### Test 21: Edit User Role
1. Navigate to `/admin/users/{user}/edit`
2. Change role from "user" to "admin" (or vice versa)
3. Save
4. **Expected**: Role updated, user sees appropriate dashboard on next login

#### Test 22: Change User Password (Admin)
1. In user edit form
2. Fill in new password and confirm
3. Save
4. **Expected**: User can login with new password

#### Test 23: Delete User
1. Click delete icon on a user
2. Confirm deletion
3. **Expected**: 
   - User deleted
   - Associated documents/reports also removed (cascade)

---

### 💰 Admin - Transactions Testing

#### Test 24: View Transactions
1. Navigate to `/admin/transactions`
2. **Expected**: 
   - Stats cards showing Total Income (green), Total Expenses (red), Net Balance
   - Table with income (green badges) and expense (red badges)

#### Test 25: Create Income Transaction
1. Click "Create Transaction"
2. Fill in:
   - User: Select user
   - Type: Income
   - Amount: 5000.00
   - Description: "January Revenue"
   - Transaction Date: 2024-01-15
3. Submit
4. **Expected**: Transaction created, shows in table with green badge

#### Test 26: Create Expense Transaction
1. Create another transaction
2. Select Type: Expense
3. Fill in amount and details
4. **Expected**: Transaction shows with red badge

#### Test 27: View Transaction Details
1. Click "View" icon on transaction
2. **Expected**: See transaction details, user info, amount with color coding

#### Test 28: Edit Transaction
1. Click edit icon
2. Change amount or description
3. **Expected**: Changes saved

#### Test 29: Delete Transaction
1. Click delete icon
2. Confirm
3. **Expected**: Transaction removed, stats updated

---

### 📋 Admin - Plans Management Testing

#### Test 30: View All Plans
1. Navigate to `/admin/plans`
2. **Expected**: 
   - Stats cards (Total Plans, Active Plans, Total Subscribers)
   - Plans displayed in grid with features, prices, subscriber counts

#### Test 31: Create New Plan
1. Click "Create Plan"
2. Fill in:
   - Name: "Custom Plan"
   - Price: 49.99
   - Billing Cycle: Monthly
   - Features: Click "Add Feature" and enter 3-5 features
   - Is Active: Checked
3. Submit
4. **Expected**: Plan created and visible in grid

#### Test 32: Edit Plan Features
1. Click edit on a plan
2. Add or remove features using Alpine.js buttons
3. Save
4. **Expected**: Features updated successfully

#### Test 33: Deactivate Plan
1. In edit form, uncheck "Is Active"
2. Save
3. **Expected**: 
   - Plan shows "Inactive" badge
   - Plan hidden from user subscription page (only active plans shown)

#### Test 34: Delete Plan
1. **Test with plan that has no subscribers**: Delete successfully
2. **Test with plan that has subscribers**: Should show warning or prevent deletion
3. **Expected**: System prevents deleting plans with active subscriptions

---

### 🎫 Admin - Subscriptions Management Testing

#### Test 35: View All Subscriptions
1. Navigate to `/admin/subscriptions`
2. **Expected**: 
   - Stats cards (Total, Active, Expired, Cancelled)
   - Table showing all subscriptions with user info, plan, dates, status

#### Test 36: Filter Subscriptions
1. Use status dropdown to filter by "Active"
2. **Expected**: Only active subscriptions shown

#### Test 37: Search Subscriptions
1. Type user name in search box
2. **Expected**: Results filtered to that user's subscriptions

#### Test 38: Create Subscription (Admin)
1. Click "Create Subscription"
2. Fill in:
   - User: Select user
   - Plan: Select plan
   - Start Date: Today
   - End Date: Auto-calculated based on billing cycle
   - Status: Active
3. Submit
4. **Expected**: 
   - Subscription created
   - User can now access plan features
   - If user had previous active subscription, it's cancelled

#### Test 39: Edit Subscription
1. Click edit on active subscription
2. Change end date or status
3. **Expected**: Warning shown for active subscriptions, changes saved

#### Test 40: Cancel Subscription (Admin)
1. Click "Cancel" action on active subscription
2. Confirm
3. **Expected**: Status changes to "cancelled", user retains access until end_date

---

## Authorization Testing

### Test 41: Document Policies
1. **As User A**: Upload a document
2. **As User B**: Try to access User A's document via direct URL
3. **Expected**: 403 Forbidden (DocumentPolicy blocks access)

### Test 42: Report Policies
1. **As User**: Try to access `/admin/reports/create`
2. **Expected**: 403 Forbidden (only admins can create reports)
3. **As Admin**: Access should work

### Test 43: Middleware Protection
1. **Logged out**: Try accessing `/documents`
2. **Expected**: Redirect to login
3. **As User**: Try accessing `/admin/users`
4. **Expected**: 403 or redirect (CheckRole middleware)

---

## File Upload Testing

### Test 44: Valid File Uploads
Test these file types:
- ✅ PDF (.pdf)
- ✅ Excel (.xlsx, .xls)
- ✅ CSV (.csv)
- ✅ Word (.doc, .docx)
- ✅ Images (.jpg, .png) - for documents

### Test 45: Invalid File Uploads
1. Try uploading:
   - .exe file
   - .zip file
   - File larger than 10MB
2. **Expected**: Validation errors shown

### Test 46: File Storage
1. After upload, check `storage/app/private/documents/` and `storage/app/private/reports/`
2. **Expected**: Files stored with unique names

---

## Database Validation Testing

### Test 47: Required Fields
1. Try submitting forms with missing required fields
2. **Expected**: Validation errors displayed

### Test 48: Unique Constraints
1. Try creating user with existing email
2. **Expected**: Validation error

### Test 49: Foreign Key Constraints
1. Try deleting a plan that has subscriptions
2. **Expected**: Error or warning (protect data integrity)

---

## UI/UX Testing

### Test 50: Responsive Design
1. Test on mobile (< 768px)
2. Test on tablet (768px - 1024px)
3. Test on desktop (> 1024px)
4. **Expected**: Layouts adapt correctly, tables scroll horizontally

### Test 51: Loading States
1. Upload large file
2. **Expected**: Loading indicator or disabled button during upload

### Test 52: Success/Error Messages
1. Perform various actions
2. **Expected**: 
   - Green success messages after successful operations
   - Red error messages for failures
   - Messages auto-dismiss or have close button

---

## Performance Testing

### Test 53: Pagination
1. Create 20+ documents/reports/transactions
2. **Expected**: Pagination controls appear, page loads quickly

### Test 54: Large File Handling
1. Upload 8-10MB file
2. **Expected**: Upload completes successfully without timeout

---

## Final Integration Test

### Test 55: Complete User Journey
1. **New user signs up** via Google OAuth
2. **Browses subscription plans**
3. **Subscribes to Professional Monthly** ($29.99/month)
4. **Uploads 3 documents** (receipts, invoices)
5. **Admin creates quarterly report** for the user
6. **User downloads the report**
7. **User switches to Enterprise Yearly**
8. **User updates profile** (name, password)
9. **User cancels subscription**

**Expected**: All steps work seamlessly without errors

---

## Automated Testing (Optional)

### Create Feature Tests
```bash
php artisan test
```

Example test files to create:
- `tests/Feature/DocumentTest.php`
- `tests/Feature/ReportTest.php`
- `tests/Feature/SubscriptionTest.php`
- `tests/Feature/Admin/UserManagementTest.php`

---

## Common Issues & Troubleshooting

### Issue: 404 Not Found on routes
**Solution**: Run `php artisan route:cache`

### Issue: Class not found errors
**Solution**: Run `composer dump-autoload`

### Issue: File uploads fail
**Solution**: Check storage permissions and disk configuration in `config/filesystems.php`

### Issue: Policies not working
**Solution**: Verify policies are registered in `app/Providers/AppServiceProvider.php`

### Issue: Seeder errors
**Solution**: Check `database/seeders/PlanSeeder.php` runs without errors

---

## Post-Testing Checklist

- [ ] All routes accessible and working
- [ ] All forms submit successfully
- [ ] All CRUD operations functional
- [ ] Authorization working (users can't access admin routes)
- [ ] File uploads/downloads working
- [ ] Subscription logic correct (dates, status, cancellation)
- [ ] UI responsive on all screen sizes
- [ ] No console errors in browser
- [ ] No Laravel errors in logs (`storage/logs/laravel.log`)
- [ ] Database relationships working correctly

---

## Next Steps After Testing

1. **Fix any bugs** discovered during testing
2. **Add unit tests** for critical business logic
3. **Optimize database queries** (use eager loading where needed)
4. **Set up monitoring** (error tracking, performance monitoring)
5. **Prepare for deployment** (see DEPLOYMENT_CHECKLIST.md)

---

## Test Credentials

### Admin User (Create manually or via seeder)
- Email: `admin@bookkeeping.com`
- Password: `password`
- Role: `admin`

### Regular User (Create via Google OAuth or manually)
- Email: `user@bookkeeping.com`
- Password: `password`
- Role: `user`

---

**Last Updated**: January 2024  
**Version**: 1.0  
**Status**: Ready for Testing ✅
