# Authentication System Setup Guide

## ✅ What's Been Implemented

### 1. **Google OAuth Authentication**
- Single Sign-On (SSO) with Google
- Automatic user creation on first login
- No traditional email/password authentication

### 2. **Role-Based Access Control**
- Two roles: `user` (default) and `admin`
- Separate dashboards for each role
- Protected routes with middleware

### 3. **User Interface**
- Tesla-style modal for authentication
- Smooth animations and transitions
- Mobile-responsive design
- Matches existing blue color palette

### 4. **Dashboards**
- **User Dashboard** (`/dashboard`)
  - Welcome message
  - Account stats
  - Quick actions
  - Profile information
  
- **Admin Dashboard** (`/admin/dashboard`)
  - User statistics
  - Management widgets
  - System settings
  - Recent activity

---

## 🔧 Setup Instructions

### Step 1: Google OAuth Configuration

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select existing one
3. Enable **Google+ API**
4. Go to **Credentials** → **Create Credentials** → **OAuth Client ID**
5. Configure OAuth consent screen if prompted
6. Choose **Web Application**
7. Add authorized redirect URIs:
   - Local: `http://localhost/auth/google/callback`
   - Production: `https://your-domain.com/auth/google/callback`
8. Copy **Client ID** and **Client Secret**

### Step 2: Environment Configuration

Add to your `.env` file:

```env
GOOGLE_CLIENT_ID=your-client-id.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=your-client-secret
GOOGLE_REDIRECT_URI=${APP_URL}/auth/google/callback
```

### Step 3: Database Migration

Already completed! The migration adds:
- `google_id` - Google user ID
- `avatar` - User profile picture URL
- `role` - User role (default: 'user')
- Makes `password` nullable

### Step 4: Create First Admin User

After logging in with Google for the first time, manually set yourself as admin:

```bash
php artisan tinker
```

Then run:
```php
$user = User::where('email', 'your-email@gmail.com')->first();
$user->role = 'admin';
$user->save();
```

Or directly in database:
```sql
UPDATE users SET role = 'admin' WHERE email = 'your-email@gmail.com';
```

---

## 🎯 How It Works

### Authentication Flow

1. User clicks **"Get Started"** button
2. Modal appears with **"Sign in with Google"** button
3. User authenticates with Google
4. System checks if user exists:
   - **Existing user**: Login
   - **New user**: Create account with role='user'
5. Redirect to appropriate dashboard based on role

### Routes

**Public Routes:**
- `GET /` - Home page
- `GET /services` - Services page
- `GET /pricing` - Pricing page
- etc.

**Auth Routes:**
- `GET /auth/google` - Redirect to Google
- `GET /auth/google/callback` - Handle Google callback
- `POST /logout` - Logout user

**Protected Routes:**
- `GET /dashboard` - User dashboard (role:user)
- `GET /admin/dashboard` - Admin dashboard (role:admin)

### Middleware

- `auth` - Requires authentication
- `role:user` - Requires user role
- `role:admin` - Requires admin role

---

## 🎨 UI Components

### Auth Modal (`resources/views/auth/modal.blade.php`)
- Centered modal with backdrop
- Google sign-in button
- Animated entrance/exit
- ESC and click-outside to close
- Focus trap for accessibility

### Dashboard Layout (`resources/views/layouts/dashboard.blade.php`)
- Fixed sidebar with navigation
- Mobile-responsive
- User profile in sidebar
- Logout button
- Same styling as main site

### User Dashboard (`resources/views/dashboard/user.blade.php`)
- Welcome card
- Stats widgets
- Quick actions
- Account information

### Admin Dashboard (`resources/views/dashboard/admin.blade.php`)
- User statistics
- Management sections
- System settings
- Analytics placeholder

---

## 🔒 Security Features

- CSRF protection on all forms
- Authenticated routes only accessible when logged in
- Role-based access control
- Session invalidation on logout
- No password storage (Google handles auth)

---

## 🚀 Testing

1. **Test Login:**
   - Click "Get Started"
   - Sign in with Google
   - Should redirect to `/dashboard`

2. **Test Admin:**
   - Set role to 'admin' in database
   - Logout and login again
   - Should redirect to `/admin/dashboard`

3. **Test Protected Routes:**
   - Try accessing `/dashboard` without login
   - Should redirect to home

4. **Test Logout:**
   - Click logout
   - Should redirect to home
   - Session should be cleared

---

## 📝 Notes

- Only Google OAuth is enabled (as per requirements)
- Default role is always 'user'
- Admin role can only be set manually via database
- No email/password authentication
- SEO: Dashboards have `noindex, nofollow` meta tags
- All animations use CSS transitions for smooth UX

---

## 🔧 Future Enhancements

The system is designed to be scalable:
- Add file uploads
- Add client management
- Add reporting features
- Add activity logs
- Add email notifications
- Add two-factor authentication

---

## ✅ Validation Checklist

- [x] "Get Started" opens modal
- [x] Google is ONLY login method
- [x] First login creates user automatically
- [x] Default role = user
- [x] Admin role via DB only
- [x] Separate dashboards work
- [x] UI matches existing design
- [x] No public page layout changes
- [x] Mobile responsive
- [x] Accessible (keyboard navigation, focus trap)
- [x] CSRF protection
- [x] Role-based middleware
- [x] Logout invalidates session

---

## 🆘 Troubleshooting

**Issue: "Invalid credentials" error**
- Check Google Client ID and Secret in `.env`
- Verify redirect URI matches in Google Console

**Issue: Modal doesn't open**
- Check Alpine.js is loaded
- Check browser console for errors
- Verify modal is included in layout

**Issue: Can't access dashboard**
- Verify you're logged in
- Check database for user record
- Verify role is set correctly

**Issue: "Permission denied"**
- Check user role matches route requirement
- Verify middleware is registered in `bootstrap/app.php`

---

**All done! The authentication system is ready to use.** 🎉
