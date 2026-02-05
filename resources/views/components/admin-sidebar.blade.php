<nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
    
    <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-2">Overview</p>
    
    <x-admin-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" icon="home">
        Dashboard
    </x-admin-nav-link>

    <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 mt-6">Management</p>

    <x-admin-nav-link href="{{ route('drivers.index') }}" :active="request()->routeIs('drivers.*')" icon="users">
        Raft Drivers
    </x-admin-nav-link>

    <x-admin-nav-link href="{{ route('boats.index') }}" :active="request()->routeIs('boats.*')" icon="ship">
        Boats
    </x-admin-nav-link>

    <x-admin-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.*')" icon="cog">
        Staff Users
    </x-admin-nav-link>

</nav>

<div class="border-t border-slate-800 p-4">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <img class="h-8 w-8 rounded-full border border-slate-600" src="{{ Auth::user()->profile_photo_url }}" alt="">
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
            <p class="text-xs text-slate-400">Admin Account</p>
        </div>
    </div>
</div>