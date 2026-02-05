<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Raft Drivers</h2>
            <a href="{{ route('drivers.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow">Register Driver</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table id="drivers-table" class="w-full text-sm text-left border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border">No</th>
                            <th class="p-3 border">Dept ID</th>
                            <th class="p-3 border">Name</th>
                            <th class="p-3 border">Company</th>
                            <th class="p-3 border">Status</th>
                            <th class="p-3 border">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#drivers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('drivers.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'dept_id', name: 'dept_id'},
                    {data: 'name', name: 'name'},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
    @endpush
</x-app-layout>