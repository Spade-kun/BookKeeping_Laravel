<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;

class UserSubscriptionController extends Controller
{
    /**
     * Display available plans.
     */
    public function index()
    {
        $plans = Plan::where('is_active', true)->get();
        $currentSubscription = auth()->user()->subscription;

        return view('subscriptions.index', compact('plans', 'currentSubscription'));
    }

    /**
     * Subscribe to a plan.
     */
    public function subscribe(Request $request, Plan $plan)
    {
        $validated = $request->validate([
            'billing_period' => 'required|in:monthly,yearly',
        ]);

        $user = auth()->user();

        // Cancel existing active subscriptions
        Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->update(['status' => 'cancelled', 'cancelled_at' => now()]);

        // Calculate end date based on billing period
        $endsAt = $request->billing_period === 'monthly' 
            ? now()->addMonth() 
            : now()->addYear();

        // Create new subscription
        Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'status' => 'active',
            'started_at' => now(),
            'ends_at' => $endsAt,
        ]);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Successfully subscribed to ' . $plan->name . ' plan!');
    }

    /**
     * Show current subscription details.
     */
    public function show()
    {
        $subscription = auth()->user()->subscription;

        if (!$subscription) {
            return redirect()->route('subscriptions.index')
                ->with('info', 'You do not have an active subscription.');
        }

        return view('subscriptions.show', compact('subscription'));
    }

    /**
     * Cancel current subscription.
     */
    public function cancel()
    {
        $subscription = auth()->user()->subscription;

        if (!$subscription) {
            return back()->with('error', 'No active subscription found.');
        }

        $subscription->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription cancelled successfully.');
    }
}
