<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Register New Staff') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ __('Create a new administrative or field staff account.') }}
                </p>
            </div>
            
            <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100">
                    
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Account Credentials') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('The user will use these details to access the system.') }}
                        </p>
                    </div>

                    <div class="p-6 lg:p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <div class="space-y-6">
                                <div class="border-b border-gray-100 pb-2">
                                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Personal Details') }}</h4>
                                </div>

                                <div>
                                    <x-label for="name" value="{{ __('Full Name') }}" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="e.g. Ankit Sati" required autofocus />
                                    <x-input-error for="name" class="mt-2" />
                                </div>

                                <div>
                                    <x-label for="email" value="{{ __('Email Address') }}" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="user@company.com" required />
                                    <x-input-error for="email" class="mt-2" />
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="border-b border-gray-100 pb-2">
                                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Access Configuration') }}</h4>
                                </div>

                                <div>
                                    <x-label for="role_id" value="{{ __('System Role') }}" />
                                    <select id="role_id" name="role_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full text-sm">
                                        <option value="">{{ __('Select a Role') }}</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="role_id" class="mt-2" />
                                </div>

                                <div>
                                    <x-label for="password" value="{{ __('Password') }}" />
                                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                    <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-tight">{{ __('Minimum 8 characters required.') }}</p>
                                    <x-input-error for="password" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end px-6 py-4 bg-gray-50 border-t border-gray-200">
                        <a href="{{ route('users.index') }}" class="mr-4 text-sm text-gray-600 hover:text-gray-900 transition font-medium">
                            {{ __('Cancel') }}
                        </a>
                        <x-button>
                            {{ __('Create User Account') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>