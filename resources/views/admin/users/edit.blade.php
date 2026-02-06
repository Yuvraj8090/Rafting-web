<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Edit User Account') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ __('Modify details for:') }} <span class="font-bold text-indigo-600">{{ $user->email }}</span>
                </p>
            </div>
            
            <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100">
                    
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Update Permissions') }}
                        </h3>
                    </div>

                    <div class="p-6 lg:p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <div class="space-y-6">
                                <div>
                                    <x-label for="name" value="{{ __('Full Name') }}" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required />
                                    <x-input-error for="name" class="mt-2" />
                                </div>

                                <div>
                                    <x-label for="email" value="{{ __('Email Address') }}" />
                                    <x-input id="email" class="block mt-1 w-full bg-gray-50" type="email" name="email" :value="old('email', $user->email)" required />
                                    <x-input-error for="email" class="mt-2" />
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div>
                                    <x-label for="role_id" value="{{ __('System Role') }}" />
                                    <select id="role_id" name="role_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full text-sm">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="role_id" class="mt-2" />
                                </div>

                                <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-indigo-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-indigo-800">{{ __('Security Note') }}</h3>
                                            <div class="mt-2 text-xs text-indigo-700">
                                                <p>{{ __('Password updates are managed through the profile security section by the user themselves.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end px-6 py-4 bg-gray-50 border-t border-gray-200">
                        <a href="{{ route('users.index') }}" class="mr-4 text-sm text-gray-600 hover:text-gray-900 transition font-medium">
                            {{ __('Cancel') }}
                        </a>
                        <x-button>
                            {{ __('Update User Account') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>