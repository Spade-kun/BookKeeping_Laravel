<a href="{{ route('team.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('team.dashboard') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
    <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
    </svg>
    <p class="text-white">Dashboard</p>
</a>
<a href="{{ route('team.assigned-users') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('team.assigned-users') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
    <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
    </svg>
    <p class="text-white">Assigned Users</p>
</a>
<a href="{{ route('threads.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('threads.*') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
    <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
    </svg>
    <p class="text-white">Messages</p>
</a>
<a href="{{ route('documents.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('documents.*') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
    <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
    </svg>
    <p class="text-white">Documents (View)</p>
</a>
<a href="{{ route('profile.show') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('profile.*') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
    <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
    </svg>
    <p class="text-white">Profile</p>
</a>

<!-- Team Info Badge -->
@if(auth()->user()->primaryTeam())
<div class="mt-auto pt-4 border-t border-blue-700">
    <div class="bg-gradient-to-br from-blue-800 to-blue-900 rounded-lg p-3 shadow-lg">
        <div class="flex items-center justify-between mb-1">
            <span class="text-[10px] font-semibold text-blue-300 uppercase tracking-wide">Your Team</span>
            @if(auth()->user()->isTeamLead())
                <span class="inline-flex items-center px-1.5 py-0.5 text-[9px] font-bold rounded-full bg-yellow-500 text-white">
                    Lead
                </span>
            @else
                <span class="inline-flex items-center px-1.5 py-0.5 text-[9px] font-bold rounded-full bg-blue-500 text-white">
                    Member
                </span>
            @endif
        </div>
        <p class="text-white font-bold text-sm mb-0.5">{{ auth()->user()->primaryTeam()->name }}</p>
        @if(auth()->user()->primaryTeam()->description)
            <p class="text-blue-200 text-[11px] mb-2">
                {{ Str::limit(auth()->user()->primaryTeam()->description, 50) }}
            </p>
        @endif
    </div>
</div>
@endif
