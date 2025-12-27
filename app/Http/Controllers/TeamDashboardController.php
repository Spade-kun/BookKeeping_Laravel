<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;

class TeamDashboardController extends Controller
{
    /**
     * Display the team dashboard.
     */
    public function index()
    {
        $user = auth()->user();

        if (!$user->isTeam()) {
            return redirect()->route('dashboard');
        }

        $team = $user->primaryTeam();

        if (!$team) {
            return view('team.dashboard', [
                'team' => null,
                'openThreads' => collect(),
                'recentThreads' => collect(),
                'assignedUsers' => collect(),
            ]);
        }

        // Get team statistics
        $openThreads = Thread::where('team_id', $team->id)
            ->where('status', 'open')
            ->with(['user', 'latestMessage'])
            ->latest('last_message_at')
            ->get();

        $recentThreads = Thread::where('team_id', $team->id)
            ->with(['user', 'latestMessage'])
            ->latest('last_message_at')
            ->take(10)
            ->get();

        $assignedUsers = User::whereHas('thread', function ($query) use ($team) {
            $query->where('team_id', $team->id);
        })->with('thread')->get();

        return view('team.dashboard', compact('team', 'openThreads', 'recentThreads', 'assignedUsers'));
    }

    /**
     * Display assigned users for the team.
     */
    public function assignedUsers()
    {
        $user = auth()->user();

        if (!$user->isTeam()) {
            return redirect()->route('dashboard');
        }

        $team = $user->primaryTeam();

        if (!$team) {
            return view('team.assigned-users', ['users' => collect(), 'team' => null]);
        }

        $users = User::whereHas('thread', function ($query) use ($team) {
            $query->where('team_id', $team->id);
        })->with(['thread', 'documents', 'reports'])->paginate(20);

        return view('team.assigned-users', compact('users', 'team'));
    }
}
