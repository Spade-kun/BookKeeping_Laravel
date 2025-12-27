# Team Management & Messaging System

## Overview

This feature adds comprehensive team management and messaging capabilities to the Everly BookKeeping application. It introduces a new "team" role, team organization features, and a support messaging system.

## New Features

### 1. Team Role
- **New Role Added**: `team` (in addition to existing `admin` and `user` roles)
- Team members can communicate with users and view assigned data
- Separate dashboard for team members

### 2. Team Management (Admin Only)
Admins can:
- Create, read, update, and delete teams
- Assign team members and leads
- Organize staff into teams (e.g., Team 1, Team 2, Tax Team, Payroll Team)
- View team statistics and assigned users

#### Team Structure
- **Team Fields**: id, name, description, created_at, deleted_at (soft deletes)
- **Team-User Relationship**: Many-to-many with pivot table
- **Pivot Fields**: team_id, user_id, role (lead/member)
- **Business Rules**:
  - Each user can belong to only one team
  - Each team can have many users
  - Teams can have both leads and members

### 3. Messaging/Support Thread System

#### For Users (role: user)
- One support thread per user
- Can send messages to assigned team
- Can attach files to messages
- View conversation history
- Thread automatically created on first access

#### For Team Members (role: team)
- View all threads assigned to their team
- Reply to user messages
- Close/reopen threads
- View assigned users
- Access user documents (read-only)

#### For Admins (role: admin)
- View all threads
- Reassign threads to different teams
- Assign teams to unassigned threads
- Full message history access
- Delete messages if needed

## Database Structure

### Migrations Created
1. `2025_12_27_000001_create_teams_table.php`
2. `2025_12_27_000002_create_team_user_table.php`
3. `2025_12_27_000003_create_threads_table.php`
4. `2025_12_27_000004_create_messages_table.php`

### Models Created
- `Team.php` - Team management
- `Thread.php` - Message thread management
- `Message.php` - Individual messages

### Relationships
```php
// User Model
$user->team() // BelongsToMany
$user->primaryTeam() // Get first team
$user->thread() // HasOne
$user->sentMessages() // HasMany

// Team Model
$team->users() // BelongsToMany
$team->leads() // BelongsToMany (filtered)
$team->members() // BelongsToMany (filtered)
$team->threads() // HasMany

// Thread Model
$thread->user() // BelongsTo
$thread->team() // BelongsTo
$thread->messages() // HasMany
$thread->latestMessage() // HasOne (latest)

// Message Model
$message->thread() // BelongsTo
$message->sender() // BelongsTo (User)
```

## Routes

### User Routes
```php
GET  /support                    - View support thread
POST /threads/{thread}/messages  - Send message
```

### Team Routes
```php
GET  /team/dashboard            - Team dashboard
GET  /team/assigned-users       - View assigned users
GET  /threads                   - View assigned threads
GET  /threads/{thread}          - View specific thread
```

### Admin Routes
```php
// Team Management
GET    /admin/teams              - List all teams
GET    /admin/teams/create       - Create team form
POST   /admin/teams              - Store new team
GET    /admin/teams/{team}       - View team details
GET    /admin/teams/{team}/edit  - Edit team form
PUT    /admin/teams/{team}       - Update team
DELETE /admin/teams/{team}       - Delete team

// Thread Management
GET   /threads                   - View all threads
GET   /threads/{thread}          - View thread
PATCH /threads/{thread}/reassign - Reassign to team
PATCH /threads/{thread}/status   - Update status
```

## Views Created

### Admin Views
- `resources/views/admin/teams/index.blade.php` - Team listing
- `resources/views/admin/teams/create.blade.php` - Create team
- `resources/views/admin/teams/edit.blade.php` - Edit team

### Team Views
- `resources/views/team/dashboard.blade.php` - Team dashboard
- `resources/views/team/threads/index.blade.php` - Thread listing

### User Views
- `resources/views/support/show.blade.php` - Support chat interface

### Partials
- `resources/views/partials/team-sidebar.blade.php` - Team navigation

## Policies

### TeamPolicy
- Only admins can create, update, delete teams
- Team members can view their own team

### ThreadPolicy
- Users can only view their own thread
- Team members can view threads assigned to their team
- Admins can view all threads

### MessagePolicy
- All authenticated users can send messages
- Users can view messages in their thread
- Team members can view messages in assigned threads
- Only admins can delete messages
- No one can edit messages (audit trail)

## Controllers

1. **TeamController** - Team CRUD operations
2. **ThreadController** - Thread management and viewing
3. **MessageController** - Message sending and attachments
4. **TeamDashboardController** - Team dashboard and statistics

## Setup Instructions

### 1. Run Migrations
```bash
php artisan migrate
```

### 2. Run Seeder (Optional - for testing)
```bash
php artisan db:seed --class=TeamMessagingSeeder
```

This creates:
- 3 team members (2 leads, 1 member)
- 2 teams (Tax Services, Payroll Services)
- 3 test users
- Sample threads and messages

### Test Accounts Created by Seeder:
- **Team Lead 1**: sarah.johnson@everly.com / password
- **Team Member**: mike.davis@everly.com / password
- **Team Lead 2**: emily.chen@everly.com / password
- **User 1**: john.client@example.com / password
- **User 2**: jane.smith@example.com / password
- **User 3**: bob.williams@example.com / password

### 3. Update Existing Users
To convert existing users to team members:
```php
$user = User::find($id);
$user->role = 'team';
$user->save();
```

### 4. Storage Setup
Make sure the private storage directory exists:
```bash
php artisan storage:link
```

## Security Features

- **Authorization**: Policy-based access control
- **File Uploads**: Stored in private disk, not publicly accessible
- **Validation**: All inputs validated
- **Soft Deletes**: Teams can be soft-deleted
- **Audit Trail**: Messages cannot be edited (only deleted by admin)

## SEO & Performance

- Messaging pages have `noindex` meta tags (add to views if needed)
- Paginated message loading
- Optimized database queries with eager loading
- Indexed columns for performance (thread_id, created_at)

## User Interface

### Design System
- Everly blue color palette (`#0066CC`, `#003366`, `#E6F2FF`)
- Chat-style message bubbles
- Responsive design
- Auto-scroll to newest message
- File attachment support

### Sidebar Navigation

**User Sidebar**:
- Dashboard
- Documents
- Reports
- **Support** (new)
- Subscription
- Profile

**Team Sidebar**:
- Dashboard
- Assigned Users
- Messages
- Documents (read-only)
- Profile

**Admin Sidebar**:
- Dashboard
- Users
- **Teams** (new)
- **Messages** (new)
- Documents
- Reports
- Plans
- Subscriptions
- Settings

## File Attachments

- Supported formats: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG
- Max file size: 10MB
- Stored in: `storage/app/private/message-attachments/`
- Download route: `/messages/{message}/download`

## Future Enhancements (Optional)

1. Real-time notifications (Laravel Echo + Pusher)
2. Email notifications for new messages
3. Message read receipts
4. Typing indicators
5. File preview for images
6. Message search functionality
7. Bulk thread assignment
8. Team performance metrics
9. SLA tracking for response times
10. Canned responses/templates

## Troubleshooting

### Issue: Team members can't see threads
- Check if user has `role = 'team'`
- Verify user is assigned to a team
- Check if threads have team_id set

### Issue: File downloads not working
- Verify storage/app/private directory exists
- Check file permissions
- Ensure private disk is configured in config/filesystems.php

### Issue: Messages not updating thread timestamp
- Check Message model boot method
- Verify last_message_at column exists

## API Documentation (if needed)

The system is currently designed for web interface only. To add API support:
1. Create API controllers in `app/Http/Controllers/Api/`
2. Add routes in `routes/api.php`
3. Use API resources for JSON transformation
4. Add authentication (Sanctum/Passport)

## Testing

To test the feature:
1. Run seeder to create test data
2. Login as different roles
3. Test messaging flow:
   - User sends message
   - Team member replies
   - Admin reassigns thread
4. Test team management:
   - Create team
   - Assign members
   - Update team details
   - Delete team

## Notes

- All timestamps are in the application's timezone
- Soft deletes enabled for teams (can be restored)
- Thread status: 'open' or 'closed'
- Sender role in messages: 'user', 'team', or 'admin'
- Each user can only have ONE thread (enforced by unique constraint)
- Each user can only belong to ONE team (enforced by unique constraint)

## Support

For issues or questions:
1. Check this documentation
2. Review the code comments
3. Check Laravel logs: `storage/logs/laravel.log`
4. Review database constraints and relationships

---

**Version**: 1.0
**Date**: December 27, 2025
**Laravel Version**: 10+
