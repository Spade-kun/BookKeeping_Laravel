<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;

class MessagePolicy
{
    /**
     * Determine if the user can view any messages.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can view the message.
     */
    public function view(User $user, Message $message): bool
    {
        $thread = $message->thread;

        // Admin can view all messages
        if ($user->isAdmin()) {
            return true;
        }

        // User can view messages in their own thread
        if ($thread->user_id === $user->id) {
            return true;
        }

        // Team members can view messages in threads assigned to their team
        if ($user->isTeam() && $thread->team_id) {
            return $user->team()->where('teams.id', $thread->team_id)->exists();
        }

        return false;
    }

    /**
     * Determine if the user can create messages.
     */
    public function create(User $user): bool
    {
        // All authenticated users can send messages
        return true;
    }

    /**
     * Determine if the user can update the message.
     */
    public function update(User $user, Message $message): bool
    {
        // No one can edit messages (for audit trail)
        return false;
    }

    /**
     * Determine if the user can delete the message.
     */
    public function delete(User $user, Message $message): bool
    {
        // Only admin can delete messages
        return $user->isAdmin();
    }
}
