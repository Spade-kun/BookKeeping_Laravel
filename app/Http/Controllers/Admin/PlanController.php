<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of plans.
     */
    public function index()
    {
        $plans = Plan::withCount('subscriptions')
            ->latest()
            ->paginate(15);

        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new plan.
     */
    public function create()
    {
        return view('admin.plans.create');
    }

    /**
     * Store a newly created plan in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'billing_period' => 'required|in:monthly,yearly',
            'transaction_limit' => 'nullable|integer|min:0',
            'accounts_supported' => 'nullable|integer|min:1',
            'reports_frequency' => 'required|string|max:255',
            'support_level' => 'required|string|max:255',
            'features' => 'nullable|array',
            'features.*' => 'string',
        ]);

        // Handle is_active checkbox (unchecked = not in request)
        $validated['is_active'] = $request->has('is_active');

        Plan::create($validated);

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan created successfully.');
    }

    /**
     * Display the specified plan.
     */
    public function show(Plan $plan)
    {
        $plan->loadCount('subscriptions');
        
        return view('admin.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified plan.
     */
    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified plan in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'billing_period' => 'required|in:monthly,yearly',
            'transaction_limit' => 'nullable|integer|min:0',
            'accounts_supported' => 'nullable|integer|min:1',
            'reports_frequency' => 'required|string|max:255',
            'support_level' => 'required|string|max:255',
            'features' => 'nullable|array',
            'features.*' => 'string',
        ]);

        // Handle is_active checkbox (unchecked = not in request)
        $validated['is_active'] = $request->has('is_active');

        $plan->update($validated);

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan updated successfully.');
    }

    /**
     * Remove the specified plan from storage.
     */
    public function destroy(Plan $plan)
    {
        // Soft delete
        $plan->delete();

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan disabled successfully.');
    }
}
