<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Register New Driver') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ __('Onboard a new guide to the raft management system.') }}
                </p>
            </div>
            
            <a href="{{ route('drivers.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('drivers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100">
                    
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Driver Profile') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Ensure Aadhaar and contact details are verified before submission.') }}
                        </p>
                    </div>

                    <div class="p-6 lg:p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <div class="space-y-6">
                                <div class="border-b border-gray-100 pb-2">
                                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Identity Information') }}</h4>
                                </div>

                                <div>
                                    <x-label for="dept_id" value="{{ __('Driver Unique ID') }}" />
                                    <x-input id="dept_id" class="block mt-1 w-full" type="text" name="dept_id" :value="old('dept_id')" placeholder="e.g. DRV-2024-001" autofocus />
                                    <x-input-error for="dept_id" class="mt-2" />
                                </div>

                                <div>
                                    <x-label for="name" value="{{ __('Full Name') }}" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="e.g. Rahul Kumar" />
                                    <x-input-error for="name" class="mt-2" />
                                </div>

                                <div>
                                    <x-label for="aadhaar" value="{{ __('Aadhaar Number') }}" />
                                    <x-input id="aadhaar" class="block mt-1 w-full" type="text" name="aadhaar" :value="old('aadhaar')" placeholder="12-digit UID" maxlength="12" />
                                    <x-input-error for="aadhaar" class="mt-2" />
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="border-b border-gray-100 pb-2">
                                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Contact & Employment') }}</h4>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-label for="mobile" value="{{ __('Mobile Number') }}" />
                                        <x-input id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile')" placeholder="+91 XXXXX XXXXX" />
                                        <x-input-error for="mobile" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-label for="company_name" value="{{ __('Company Name') }}" />
                                        <x-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" placeholder="Optional" />
                                        <x-input-error for="company_name" class="mt-2" />
                                    </div>
                                </div>

                                <div>
                                    <x-label for="profile_image" value="{{ __('Driver Photo') }}" />
                                    
                                    <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition cursor-pointer group" onclick="document.getElementById('profile_image').click()">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-500 transition" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600 justify-center">
                                                <span class="font-medium text-indigo-600 hover:text-indigo-500">Upload a photo</span>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">Professional headshot (PNG, JPG up to 2MB)</p>
                                        </div>
                                    </div>
                                    
                                    <input id="profile_image" name="profile_image" type="file" class="hidden" onchange="previewDriverImage(event)" />
                                    <x-input-error for="profile_image" class="mt-2" />
                                    
                                    <div id="driver-preview" class="mt-4 hidden relative">
                                        <p class="text-xs text-gray-500 mb-2">Selected Preview:</p>
                                        <img src="" class="h-32 w-32 object-cover rounded-full shadow-sm border-4 border-white ring-1 ring-gray-200 mx-auto md:mx-0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end px-6 py-4 bg-gray-50 border-t border-gray-200">
                        <a href="{{ route('drivers.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                            {{ __('Cancel') }}
                        </a>
                        <x-button>
                            {{ __('Save Driver Profile') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewDriverImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.querySelector('#driver-preview img');
                output.src = reader.result;
                document.getElementById('driver-preview').classList.remove('hidden');
            };
            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
    @endpush
</x-app-layout>