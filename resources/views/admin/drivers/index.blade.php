<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Raft Drivers') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    {{ __('Manage all registered drivers and their approval status.') }}
                </p>
            </div>
            
            <a href="{{ route('drivers.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                {{ __('Register Driver') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100">
                
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ __('Driver Directory') }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Search and manage driver profiles.') }}
                        </p>
                    </div>
                </div>

                <div class="p-6">
                    <table id="drivers-table" class="w-full text-sm text-left text-gray-500">
                        <thead>
                            <tr>
                                <th>{{ __('No') }}</th>
                                <th>{{ __('Dept ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Company') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th class="text-right">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#drivers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('drivers.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "font-medium text-gray-900"},
                    {data: 'dept_id', name: 'dept_id', className: "font-bold text-indigo-600"},
                    {data: 'name', name: 'name', className: "font-medium text-gray-900"},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-right"},
                ],
                // Simple DOM layout to let CSS handle the rest
                dom: 'lfrtip',
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search drivers...",
                    lengthMenu: "Show _MENU_",
                    paginate: {
                        next: "Next &rarr;",
                        previous: "&larr; Prev"
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>