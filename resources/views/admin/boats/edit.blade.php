<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Edit Boat Details') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ __('Update information for boat ID:') }} <span class="font-mono text-indigo-600 font-semibold">{{ $boat->boat_dept_id }}</span>
                </p>
            </div>
            
            <a href="{{ route('boats.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('boats.update', $boat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100">
                    
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Boat Configuration') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Update the verification details for this vessel.') }}
                        </p>
                    </div>

                    <div class="p-6 lg:p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <div class="space-y-6">
                                <div class="border-b border-gray-100 pb-2">
                                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Identification') }}</h4>
                                </div>

                                <div>
                                    <x-label for="boat_dept_id" value="{{ __('Boat Unique ID') }}" />
                                    <x-input id="boat_dept_id" class="block mt-1 w-full bg-gray-50" type="text" name="boat_dept_id" :value="old('boat_dept_id', $boat->boat_dept_id)" placeholder="e.g. BT-101" />
                                    <x-input-error for="boat_dept_id" class="mt-2" />
                                </div>

                                <div>
                                    <x-label for="owner_name" value="{{ __('Owner Name') }}" />
                                    <x-input id="owner_name" class="block mt-1 w-full" type="text" name="owner_name" :value="old('owner_name', $boat->owner_name)" placeholder="Full Name" />
                                    <x-input-error for="owner_name" class="mt-2" />
                                </div>

                                <div>
                                    <x-label for="owner_mobile" value="{{ __('Owner Mobile') }}" />
                                    <x-input id="owner_mobile" class="block mt-1 w-full" type="text" name="owner_mobile" :value="old('owner_mobile', $boat->owner_mobile)" placeholder="10-digit number" />
                                    <x-input-error for="owner_mobile" class="mt-2" />
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="border-b border-gray-100 pb-2">
                                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Specifications') }}</h4>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-label for="capacity" value="{{ __('Capacity') }}" />
                                        <x-input id="capacity" class="block mt-1 w-full" type="number" name="capacity" :value="old('capacity', $boat->capacity)" />
                                        <x-input-error for="capacity" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-label for="status" value="{{ __('Status') }}" />
                                        <select id="status" name="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full text-sm">
                                            <option value="active" {{ $boat->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $boat->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <x-label for="boat_image" value="{{ __('Boat Photo') }}" />

                                    @if($boat->boat_image)
                                        <div class="mb-3 mt-2">
                                            <p class="text-xs text-gray-500 mb-1">{{ __('Current Image:') }}</p>
                                            <img src="{{ asset('storage/'.$boat->boat_image) }}" class="h-32 w-full object-cover rounded-md border border-gray-200" alt="Current Boat Image">
                                        </div>
                                    @endif
                                    
                                    <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition cursor-pointer group" onclick="document.getElementById('boat_image').click()">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-500 transition" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600 justify-center">
                                                <span class="font-medium text-indigo-600 hover:text-indigo-500">Click to change</span>
                                            </div>
                                            <p class="text-xs text-gray-500">Leave empty to keep current photo</p>
                                        </div>
                                    </div>
                                    
                                    <input id="boat_image" name="boat_image" type="file" class="hidden" onchange="previewImage(event)" />
                                    <x-input-error for="boat_image" class="mt-2" />
                                    
                                    <div id="image-preview" class="mt-4 hidden relative">
                                        <p class="text-xs text-gray-500 mb-2 text-indigo-600 font-bold">{{ __('New Selection Preview:') }}</p>
                                        <img src="" class="h-40 w-full object-cover rounded-md shadow-sm border border-indigo-200">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end px-6 py-4 bg-gray-50 border-t border-gray-200">
                        <a href="{{ route('boats.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                            {{ __('Cancel') }}
                        </a>
                        <x-button>
                            {{ __('Update Boat Details') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.querySelector('#image-preview img');
                output.src = reader.result;
                document.getElementById('image-preview').classList.remove('hidden');
            };
            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
    @endpush
</x-app-layout>