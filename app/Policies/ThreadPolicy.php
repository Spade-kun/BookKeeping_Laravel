<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;

class ThreadPolicy
{
    /**
     * Determine if the user can view any threads.
     */
    public function viewAny(User $user): bool
    {
        // All authenticated users can access threads
        return true;
    }

    /**
     * Determine if the user can view the thread.
     */
    public function view(User $user, Thread $thread): bool
    {
        // Admin can view all threads
        if ($user->isAdmin()) {
            return true;
        }

        // User can view their own thread
        if ($thread->user_id === $user->id) {
            return true;
        }

        // Team members can view threads assigned to their team
        if ($user->isTeam() && $thread->team_id) {
            return $user->team()->where('teams.id', $thread->team_id)->exists();
        }

        return false;
    }

    /**
     * Determine if the user can create threads.
     */
    public function create(User $user): bool
    {
        // Only regular users can create their support thread
        // Admin and team members don't need support threads
        return $user->isUser();
    }

    /**
     * Determine if the user can update the thread.
     */
    public function update(User $user, Thread $thread): bool
    {
        // Admin can update any thread (e.g., reassign to different team)
        if ($user->isAdmin()) {
            return true;
        }

        // Team members can close/reopen threads assigned to their team
        if ($user->isTeam() && $thread->team_id) {
            return $user->team()->where('teams.id', $thread->team_id)->exists();
        }

        return false;
    }

    /**
     * Determine if the user can delete the thread.
     */
    public function delete(User $user, Thread $thread): bool
    {
        return $user->isAdmin();
    }
}
