# 📚 View Templates Creation Guide

This guide will help you create all the remaining Blade view templates following the established design patterns.

## 🎨 Design Patterns to Follow

All views should follow these patterns established in `documents/index.blade.php` and `documents/create.blade.php`:

### Layout Structure
```blade
@extends('layouts.dashboard')
@section('title', 'Page Title')
@section('page-title', 'Page Title')

@section('sidebar')
    @if(auth()->user()->isAdmin())
        @include('partials.admin-sidebar')
    @else
        @include('partials.user-sidebar')
    @endif
@endsection

@section('content')
    <!-- Your content here -->
@endsection
```

### Color Scheme
- Primary Blue: `#0066CC`
- Dark Blue: `#003366`
- Navy: `#002147`
- Light Blue BG: `#E6F2FF`
- Text Gray: `#4A5568`
- Background: `#F7FAFC`

### Common UI Elements

#### Header with Action Button
```blade
<div class="flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-[#003366]">Title</h1>
        <p class="text-[#4A5568] mt-1">Description</p>
    </div>
    <a href="{{ route('...') }}" 
       class="bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
        <svg class="w-5 h-5 mr-2"><!-- icon --></svg>
        Button Text
    </a>
</div>
```

#### Success/Error Messages
```blade
@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
        <p class="text-green-700">{{ session('success') }}</p>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
        <p class="text-red-700">{{ session('error') }}</p>
    </div>
@endif
```

#### Form Input Field
```blade
<div>
    <label for="field_name" class="block text-sm font-medium text-[#003366] mb-2">
        Field Label <span class="text-red-500">*</span>
    </label>
    <input type="text" 
           name="field_name" 
           id="field_name" 
           required
           value="{{ old('field_name') }}"
           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('field_name') border-red-500 @enderror">
    @error('field_name')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
```

#### Table Layout
```blade
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-[#F7FAFC] border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Column</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- rows -->
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $items->links() }}
    </div>
</div>
```

---

## 📁 Views to Create

### 1. Reports Views

#### `resources/views/reports/index.blade.php`
Copy from `documents/index.blade.php` and modify:
- Change "Documents" to "Reports"
- Show report type, period, start/end dates
- User view: read-only (no create/edit/delete)
- Admin view: full CRUD

#### `resources/views/reports/create.blade.php` (Admin only)
Form fields:
- User dropdown (required)
- Title (text input)
- Report Type (select: monthly, quarterly, yearly, custom)
- Period (text input, e.g., "2025-Q1")
- Start Date (date input)
- End Date (date input)
- File upload (optional)
- Description (textarea)

#### `resources/views/reports/edit.blade.php` (Admin only)
Same as create but pre-filled with current data

#### `resources/views/reports/show.blade.php`
Display report details with download button if file exists

### 2. Subscription Views

#### `resources/views/subscriptions/index.blade.php`
Display available plans in grid layout (3 columns):
```blade
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($plans as $plan)
        <div class="bg-white rounded-xl shadow-md p-8">
            <h3 class="text-2xl font-bold text-[#003366]">{{ $plan->name }}</h3>
            <p class="text-4xl font-bold text-[#0066CC] my-4">${{ $plan->price }}<span class="text-sm text-[#4A5568]">/{{ $plan->billing_period }}</span></p>
            <ul class="space-y-3 mb-6">
                @foreach($plan->features as $feature)
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2"><!-- checkmark --></svg>
                        <span>{{ $feature }}</span>
                    </li>
                @endforeach
            </ul>
            <form action="{{ route('subscriptions.subscribe', $plan) }}" method="POST">
                @csrf
                <input type="hidden" name="billing_period" value="{{ $plan->billing_period }}">
                <button type="submit" class="w-full bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg">
                    Subscribe Now
                </button>
            </form>
        </div>
    @endforeach
</div>
```

#### `resources/views/subscriptions/show.blade.php`
Display current subscription details with cancel button

### 3. Profile Views

#### `resources/views/profile/show.blade.php`
Display user information:
- Avatar (from Google)
- Name
- Email
- Role badge
- Member since
- Edit profile button

#### `resources/views/profile/edit.blade.php`
Form with:
- Name (text input)
- Email (email input)
- Password (password input, optional)
- Password Confirmation (password input)

### 4. Admin Views

#### `resources/views/admin/users/index.blade.php`
Table showing:
- Name + Email
- Role badge
- Subscription status
- Actions (view, edit, deactivate)

#### `resources/views/admin/users/show.blade.php`
Display complete user details:
- User info
- Current subscription
- Recent documents (table)
- Recent reports (table)
- Recent transactions (table)

#### `resources/views/admin/users/edit.blade.php`
Form with:
- Name
- Email
- Role (select: user, admin)

#### `resources/views/admin/transactions/index.blade.php`
Table showing:
- Date
- User
- Description
- Category
- Type badge (income/expense)
- Amount
- Actions

#### `resources/views/admin/transactions/create.blade.php`
Form with:
- User dropdown
- Date
- Description
- Category
- Type (select: income, expense)
- Amount
- Reference Number (optional)
- Notes (textarea, optional)

#### `resources/views/admin/transactions/edit.blade.php`
Same as create but pre-filled

#### `resources/views/admin/plans/index.blade.php`
Table/grid showing all plans with:
- Name
- Price
- Billing period
- Active badge
- Subscriber count
- Actions

#### `resources/views/admin/plans/create.blade.php`
Form with:
- Name
- Price
- Billing Period (select: monthly, yearly)
- Transaction Limit (number, nullable)
- Accounts Supported (number, nullable)
- Reports Frequency (text)
- Support Level (text)
- Features (dynamic list with add/remove)
- Is Active (checkbox)

#### `resources/views/admin/plans/edit.blade.php`
Same as create but pre-filled

#### `resources/views/admin/subscriptions/index.blade.php`
Table showing:
- User
- Plan
- Status badge
- Started At
- Ends At
- Actions

#### `resources/views/admin/subscriptions/create.blade.php`
Form with:
- User dropdown
- Plan dropdown
- Status (select)
- Started At (datetime)
- Ends At (datetime, optional)

#### `resources/views/admin/subscriptions/edit.blade.php`
Same as create but pre-filled

---

## 🔧 Quick Tips

### Copy & Modify Strategy
1. Find a similar existing view (like `documents/index.blade.php`)
2. Copy it to the new location
3. Find and replace relevant terms
4. Update field names and table columns
5. Adjust form validation requirements
6. Test!

### Route Helpers
Always use named routes:
- User routes: `route('module.action')`
- Admin routes: `route('admin.module.action')`

### Form Method Spoofing
For PUT/PATCH requests:
```blade
<form action="..." method="POST">
    @csrf
    @method('PUT')
    <!-- fields -->
</form>
```

For DELETE:
```blade
<form action="..." method="POST" onsubmit="return confirm('Are you sure?')">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>
```

### Conditional Admin/User Views
```blade
@if(auth()->user()->isAdmin())
    <!-- Admin content -->
@else
    <!-- User content -->
@endif
```

---

## ✅ Completion Checklist

- [ ] Reports (4 views: index, create, edit, show)
- [ ] Subscriptions (2 views: index, show)
- [ ] Profile (2 views: show, edit)
- [ ] Admin Users (3 views: index, show, edit)
- [ ] Admin Transactions (4 views: index, create, edit, show)
- [ ] Admin Plans (4 views: index, create, edit, show)
- [ ] Admin Subscriptions (4 views: index, create, edit, show)

**Total:** ~23 views remaining

---

## 🚀 After Creating Views

1. Run migrations:
```bash
php artisan migrate
```

2. Seed plans:
```bash
php artisan db:seed --class=PlanSeeder
```

3. Test each module thoroughly
4. Check responsive design on mobile
5. Verify all permissions work correctly
6. Test file uploads and downloads

---

## 📞 Need Help?

Refer to these files for reference:
- Layout: `resources/views/layouts/dashboard.blade.php`
- Example table view: `resources/views/documents/index.blade.php`
- Example form: `resources/views/documents/create.blade.php`
- Sidebar: `resources/views/partials/user-sidebar.blade.php`
- Dashboard example: `resources/views/dashboard/user.blade.php`

Happy coding! 🎉
