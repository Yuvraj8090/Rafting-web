<x-app-layout>
    <x-slot name="header">
        Boats Management
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold text-gray-800">All Registered Boats</h2>
            <a href="{{ route('boats.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add New Boat
            </a>
        </div>

        <div class="overflow-x-auto">
            <table id="boats-table" class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 rounded-l-lg">Image</th>
                        <th class="px-4 py-3">Boat ID</th>
                        <th class="px-4 py-3">Owner Name</th>
                        <th class="px-4 py-3">Mobile</th>
                        <th class="px-4 py-3">Capacity</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 rounded-r-lg">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#boats-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('boats.index') }}",
                columns: [
                    {data: 'boat_image', name: 'boat_image', orderable: false, searchable: false},
                    {data: 'boat_dept_id', name: 'boat_dept_id', class: 'font-bold text-gray-900'},
                    {data: 'owner_name', name: 'owner_name'},
                    {data: 'owner_mobile', name: 'owner_mobile'},
                    {data: 'capacity', name: 'capacity'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                // Styling the wrapper to look better in Tailwind
                dom: '<"flex justify-between items-center mb-4"lf>rt<"flex justify-between items-center mt-4"ip>',
                language: {
                    search: "",
                    searchPlaceholder: "Search ID or Owner..."
                }
            });
        });
    </script>
    @endpush
</x-app-layout>