<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Team;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Display user's support thread or team's assigned threads.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            // Admin sees all threads
            $threads = Thread::with(['user', 'team', 'latestMessage'])
                ->latest('last_message_at')
                ->paginate(20);

            return view('admin.threads.index', compact('threads'));
        } elseif ($user->isTeam()) {
            // Team members see threads assigned to their team
            $team = $user->primaryTeam();
            
            if (!$team) {
                return view('team.threads.index', ['threads' => collect()]);
            }

            $threads = Thread::where('team_id', $team->id)
                ->with(['user', 'latestMessage'])
                ->latest('last_message_at')
                ->paginate(20);

            return view('team.threads.index', compact('threads', 'team'));
        } else {
            // Regular users are redirected to their support thread
            $thread = $user->thread;

            if (!$thread) {
                // Create thread if it doesn't exist
                $thread = Thread::create([
                    'user_id' => $user->id,
                    'status' => 'open',
                ]);
            }

            return redirect()->route('support.show');
        }
    }

    /**
     * Display the user's support thread (for regular users).
     */
    public function show()
    {
        $user = auth()->user();
        
        if (!$user->isUser()) {
            return redirect()->route('threads.index');
        }

        $thread = $user->thread;

        if (!$thread) {
            // Create thread if it doesn't exist
            $thread = Thread::create([
                'user_id' => $user->id,
                'status' => 'open',
            ]);
        }

        $thread->load(['messages.sender', 'team']);

        return view('support.show', compact('thread'));
    }

    /**
     * Display a specific thread (for team/admin).
     */
    public function showThread(Thread $thread)
    {
        $this->authorize('view', $thread);

        $thread->load(['messages.sender', 'user', 'team']);

        $user = auth()->user();

        if ($user->isAdmin()) {
            $availableTeams = Team::all();
            return view('admin.threads.show', compact('thread', 'availableTeams'));
        } else {
            return view('team.threads.show', compact('thread'));
        }
    }

    /**
     * Update thread status (close/reopen).
     */
    public function updateStatus(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        $validated = $request->validate([
            'status' => 'required|in:open,closed',
        ]);

        $thread->update(['status' => $validated['status']]);

        return back()->with('success', 'Thread status updated successfully!');
    }

    /**
     * Reassign thread to a different team (admin only).
     */
    public function reassign(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
        ]);

        $thread->update(['team_id' => $validated['team_id']]);

        return back()->with('success', 'Thread reassigned successfully!');
    }

    /**
     * Assign initial team to a thread.
     */
    public function assignTeam(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
        ]);

        $thread->update(['team_id' => $validated['team_id']]);

        return back()->with('success', 'Team assigned to thread successfully!');
    }
}
