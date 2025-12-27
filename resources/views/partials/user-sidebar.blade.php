<a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
    <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
    </svg>
    <p class="text-white">Dashboard</p>
</a>
<a href="{{ route('documents.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('documents.*') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
    <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
    </svg>
    <p class="text-white">Documents</p>
</a>
<a href="{{ route('reports.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('reports.*') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
    <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
    </svg>
    <p class="text-white">Reports</p>
</a>
<a href="{{ route('support.show') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('support.*') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
    <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
    </svg>
    <p class="text-white">Support</p>
</a>
<a href="{{ route('subscriptions.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('subscriptions.*') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
    <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
    </svg>
    <p class="text-white">Subscription</p>
</a>
<a href="{{ route('profile.show') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('profile.*') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
    <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
    </svg>
    <p class="text-white">Profile</p>
</a>
<a href="#" class="flex items-center px-4 py-3 text-blue-200 hover:bg-blue-900 rounded-lg transition-colors">
    <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
    </svg>
    <p class="text-white">Support</p>
</a>

<!-- Current Plan Badge -->
<div class="mt-auto pt-4 border-t border-blue-700">
    @if(auth()->user()->activeSubscription)
        <div class="bg-gradient-to-br from-blue-800 to-blue-900 rounded-lg p-3 shadow-lg">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] font-semibold text-blue-300 uppercase tracking-wide">Current Plan</span>
                <span class="inline-flex items-center px-1.5 py-0.5 text-[9px] font-bold rounded-full bg-green-500 text-white">
                    Active
                </span>
            </div>
            <p class="text-white font-bold text-sm mb-0.5">{{ auth()->user()->activeSubscription->plan->name }}</p>
            <p class="text-blue-200 text-[11px] mb-2">
                ${{ number_format(auth()->user()->activeSubscription->plan->price, 2) }}/{{ auth()->user()->activeSubscription->plan->billing_period }}
            </p>
            @if(auth()->user()->activeSubscription->ends_at)
                <div class="flex items-center text-[10px] text-blue-300">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Renews {{ \Carbon\Carbon::parse(auth()->user()->activeSubscription->ends_at)->format('M d, Y') }}
                </div>
            @endif
        </div>
    @else
        <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-lg p-3 shadow-lg">
            <p class="text-white font-semibold text-xs mb-2">No Active Plan</p>
            <a href="{{ route('subscriptions.index') }}" 
               class="inline-flex items-center justify-center w-full px-2 py-1.5 text-[10px] font-medium text-white bg-[#0066CC] hover:bg-[#003366] rounded-lg transition-colors">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Choose Plan
            </a>
        </div>
    @endif
</div>
