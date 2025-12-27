<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;

class DocumentPolicy
{
    /**
     * Determine if the user can view any documents.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can view the document.
     */
    public function view(User $user, Document $document): bool
    {
        // Admins can view all documents
        if ($user->isAdmin()) {
            return true;
        }

        // Users can view their own documents
        if ($user->id === $document->user_id) {
            return true;
        }

        // Team members can view documents of users assigned to their team
        if ($user->isTeam()) {
            $team = $user->primaryTeam();
            if ($team) {
                $documentOwner = $document->user;
                if ($documentOwner->thread && $documentOwner->thread->team_id === $team->id) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Determine if the user can create documents.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can update the document.
     */
    public function update(User $user, Document $document): bool
    {
        return $user->isAdmin() || $user->id === $document->user_id;
    }

    /**
     * Determine if the user can delete the document.
     */
    public function delete(User $user, Document $document): bool
    {
        return $user->isAdmin() || $user->id === $document->user_id;
    }
}
