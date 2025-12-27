<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;

class ReportPolicy
{
    /**
     * Determine if the user can view any reports.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can view the report.
     */
    public function view(User $user, Report $report): bool
    {
        // Admins can view all reports
        if ($user->isAdmin()) {
            return true;
        }

        // Users can view their own reports
        if ($user->id === $report->user_id) {
            return true;
        }

        // Team members can view reports of users assigned to their team
        if ($user->isTeam()) {
            $team = $user->primaryTeam();
            if ($team) {
                $reportOwner = $report->user;
                if ($reportOwner->thread && $reportOwner->thread->team_id === $team->id) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Determine if the user can create reports.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can update the report.
     */
    public function update(User $user, Report $report): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can delete the report.
     */
    public function delete(User $user, Report $report): bool
    {
        return $user->isAdmin();
    }
}
