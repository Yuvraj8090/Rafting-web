<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'RaftManager') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
        
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white transition-transform duration-300 ease-in-out transform md:translate-x-0 md:static md:inset-0 flex flex-col"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            <div class="flex items-center justify-center h-16 border-b border-slate-800 bg-slate-900">
                <span class="text-xl font-bold tracking-wider uppercase text-blue-400">🌊 Raft<span class="text-white">Manager</span></span>
            </div>

            <x-admin-sidebar />
        </aside>

        <div class="flex flex-col flex-1 w-0 overflow-hidden">
            
            <header class="flex items-center justify-between h-16 px-6 bg-white border-b border-gray-200 shadow-sm z-10">
                <button @click="sidebarOpen = true" class="p-1 mr-4 text-gray-500 rounded-md md:hidden focus:outline-none hover:text-gray-700 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <h1 class="text-xl font-semibold text-gray-800">
                    {{ $header ?? 'Dashboard' }}
                </h1>

                <div class="flex items-center space-x-4">
                    <x-admin-topbar />
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
                {{ $slot }}
            </main>
        </div>

        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity 
             class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 md:hidden"></div>
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>