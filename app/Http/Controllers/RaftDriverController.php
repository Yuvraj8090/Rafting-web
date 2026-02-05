<?php

namespace App\Http\Controllers;

use App\Models\RaftDriver;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class RaftDriverController extends Controller
{
    // List drivers with Yajra
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RaftDriver::select(['id', 'dept_id', 'name', 'aadhaar', 'company_name', 'status']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '
                        <div class="flex space-x-2">
                            <a href="'.route('drivers.edit', $row->id).'" class="bg-blue-500 text-white px-3 py-1 rounded text-xs">Edit</a>
                            <form action="'.route('drivers.destroy', $row->id).'" method="POST" onsubmit="return confirm(\'Are you sure?\')">
                                '.csrf_field().method_field('DELETE').'
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-xs">Delete</button>
                            </form>
                        </div>';
                })
                ->editColumn('status', function($row) {
                    $color = $row->status == 'approved' ? 'green' : ($row->status == 'pending' ? 'yellow' : 'red');
                    return '<span class="px-2 py-1 rounded bg-'.$color.'-100 text-'.$color.'-800 text-xs font-bold uppercase">'.$row->status.'</span>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.drivers.index');
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'dept_id'       => 'required|unique:raft_drivers',
            'name'          => 'required',
            'aadhaar'       => 'required|digits:12|unique:raft_drivers',
            'mobile'        => 'required',
            'profile_image' => 'nullable|image|max:2048',
            'company_name'  => 'nullable',
        ]);

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('drivers', 'public');
        }

        $data['uploader_id'] = auth()->id();
        $data['status'] = 'pending';

        RaftDriver::create($data);
        return redirect()->route('drivers.index')->with('success', 'Driver Registered Successfully.');
    }

    public function edit(RaftDriver $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(Request $request, RaftDriver $driver)
    {
        $data = $request->validate([
            'dept_id'       => 'required|unique:raft_drivers,dept_id,'.$driver->id,
            'name'          => 'required',
            'aadhaar'       => 'required|digits:12|unique:raft_drivers,aadhaar,'.$driver->id,
            'mobile'        => 'required',
            'profile_image' => 'nullable|image|max:2048',
            'company_name'  => 'nullable',
            'status'        => 'required|in:pending,approved,suspended'
        ]);

        if ($request->hasFile('profile_image')) {
            // Delete old image
            if ($driver->profile_image) {
                Storage::disk('public')->delete($driver->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('drivers', 'public');
        }

        $driver->update($data);
        return redirect()->route('drivers.index')->with('success', 'Driver Updated Successfully.');
    }

    public function destroy(RaftDriver $driver)
    {
        if ($driver->profile_image) {
            Storage::disk('public')->delete($driver->profile_image);
        }
        $driver->delete();
        return redirect()->route('drivers.index')->with('success', 'Driver Deleted.');
    }
}