<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of subscriptions.
     */
    public function index()
    {
        $subscriptions = Subscription::with(['user', 'plan'])
            ->latest()
            ->paginate(20);

        // Calculate statistics
        $totalSubscriptions = Subscription::count();
        $activeSubscriptions = Subscription::where('status', 'active')->count();
        $expiredSubscriptions = Subscription::where('status', 'expired')->count();
        $cancelledSubscriptions = Subscription::where('status', 'cancelled')->count();

        return view('admin.subscriptions.index', compact(
            'subscriptions',
            'totalSubscriptions',
            'activeSubscriptions',
            'expiredSubscriptions',
            'cancelledSubscriptions'
        ));
    }

    /**
     * Show the form for creating a new subscription.
     */
    public function create()
    {
        $users = User::where('role', 'user')->get();
        $plans = Plan::where('is_active', true)->get();
        
        return view('admin.subscriptions.create', compact('users', 'plans'));
    }

    /**
     * Store a newly created subscription in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:plans,id',
            'status' => 'required|in:active,trial,cancelled,expired',
            'started_at' => 'required|date',
            'ends_at' => 'nullable|date|after:started_at',
        ]);

        // Cancel existing active subscriptions for this user
        Subscription::where('user_id', $request->user_id)
            ->where('status', 'active')
            ->update(['status' => 'cancelled', 'cancelled_at' => now()]);

        Subscription::create($validated);

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription created successfully.');
    }

    /**
     * Display the specified subscription.
     */
    public function show(Subscription $subscription)
    {
        return view('admin.subscriptions.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified subscription.
     */
    public function edit(Subscription $subscription)
    {
        $users = User::where('role', 'user')->get();
        $plans = Plan::where('is_active', true)->get();
        
        return view('admin.subscriptions.edit', compact('subscription', 'users', 'plans'));
    }

    /**
     * Update the specified subscription in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'status' => 'required|in:active,trial,cancelled,expired',
            'started_at' => 'required|date',
            'ends_at' => 'nullable|date|after:started_at',
        ]);

        if ($request->status === 'cancelled' && !$subscription->cancelled_at) {
            $validated['cancelled_at'] = now();
        }

        $subscription->update($validated);

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription updated successfully.');
    }

    /**
     * Cancel the specified subscription.
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription cancelled successfully.');
    }
}
