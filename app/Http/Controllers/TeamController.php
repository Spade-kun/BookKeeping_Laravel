<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    /**
     * Display a listing of teams.
     */
    public function index()
    {
        $this->authorize('viewAny', Team::class);

        $teams = Team::withCount('users')
            ->with(['users' => function ($query) {
                $query->withPivot('role');
            }])
            ->latest()
            ->paginate(15);

        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new team.
     */
    public function create()
    {
        $this->authorize('create', Team::class);

        $availableUsers = User::whereDoesntHave('team')
            ->whereIn('role', ['team', 'user'])
            ->get();

        return view('admin.teams.create', compact('availableUsers'));
    }

    /**
     * Store a newly created team.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Team::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'members' => 'nullable|array',
            'members.*' => 'exists:users,id',
            'leads' => 'nullable|array',
            'leads.*' => 'exists:users,id',
        ]);

        DB::beginTransaction();
        try {
            $team = Team::create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
            ]);

            // Attach team leads
            if (!empty($validated['leads'])) {
                foreach ($validated['leads'] as $leadId) {
                    $team->users()->attach($leadId, ['role' => 'lead']);
                }
            }

            // Attach team members
            if (!empty($validated['members'])) {
                foreach ($validated['members'] as $memberId) {
                    if (!in_array($memberId, $validated['leads'] ?? [])) {
                        $team->users()->attach($memberId, ['role' => 'member']);
                    }
                }
            }

            DB::commit();

            return redirect()->route('admin.teams.index')
                ->with('success', 'Team created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create team: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified team.
     */
    public function show(Team $team)
    {
        $this->authorize('view', $team);

        $team->load(['users' => function ($query) {
            $query->withPivot('role');
        }, 'threads.user']);

        return view('admin.teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified team.
     */
    public function edit(Team $team)
    {
        $this->authorize('update', $team);

        $team->load(['users' => function ($query) {
            $query->withPivot('role');
        }]);

        $availableUsers = User::whereDoesntHave('team')
            ->orWhereHas('team', function ($query) use ($team) {
                $query->where('teams.id', $team->id);
            })
            ->whereIn('role', ['team', 'user'])
            ->get();

        return view('admin.teams.edit', compact('team', 'availableUsers'));
    }

    /**
     * Update the specified team.
     */
    public function update(Request $request, Team $team)
    {
        $this->authorize('update', $team);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'members' => 'nullable|array',
            'members.*' => 'exists:users,id',
            'leads' => 'nullable|array',
            'leads.*' => 'exists:users,id',
        ]);

        DB::beginTransaction();
        try {
            $team->update([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
            ]);

            // Sync team members
            $team->users()->detach();

            // Attach team leads
            if (!empty($validated['leads'])) {
                foreach ($validated['leads'] as $leadId) {
                    $team->users()->attach($leadId, ['role' => 'lead']);
                }
            }

            // Attach team members
            if (!empty($validated['members'])) {
                foreach ($validated['members'] as $memberId) {
                    if (!in_array($memberId, $validated['leads'] ?? [])) {
                        $team->users()->attach($memberId, ['role' => 'member']);
                    }
                }
            }

            DB::commit();

            return redirect()->route('admin.teams.index')
                ->with('success', 'Team updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update team: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified team.
     */
    public function destroy(Team $team)
    {
        $this->authorize('delete', $team);

        try {
            $team->delete();

            return redirect()->route('admin.teams.index')
                ->with('success', 'Team deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete team: ' . $e->getMessage());
        }
    }

    /**
     * Assign a user to a team.
     */
    public function assignUser(Request $request, Team $team)
    {
        $this->authorize('update', $team);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:lead,member',
        ]);

        try {
            $team->users()->attach($validated['user_id'], ['role' => $validated['role']]);

            return back()->with('success', 'User assigned to team successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to assign user: ' . $e->getMessage());
        }
    }

    /**
     * Remove a user from a team.
     */
    public function removeUser(Team $team, User $user)
    {
        $this->authorize('update', $team);

        try {
            $team->users()->detach($user->id);

            return back()->with('success', 'User removed from team successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to remove user: ' . $e->getMessage());
        }
    }
}
