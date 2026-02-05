<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class BoatController extends Controller
{
    // 1. Index with Yajra DataTables
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Boat::select(['id', 'boat_dept_id', 'boat_image', 'capacity', 'owner_name', 'owner_mobile', 'status']);
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('boat_image', function($row) {
                    $url = $row->boat_image ? asset('storage/'.$row->boat_image) : 'https://ui-avatars.com/api/?name=Boat&background=random';
                    return '<img src="'.$url.'" class="h-10 w-10 rounded-lg object-cover border border-gray-200" alt="Boat">';
                })
                ->editColumn('status', function($row) {
                    $color = $row->status === 'active' ? 'green' : 'red';
                    return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-'.$color.'-100 text-'.$color.'-800 capitalize">
                                '.$row->status.'
                            </span>';
                })
                ->addColumn('action', function($row){
                    return '
                        <div class="flex items-center space-x-3">
                            <a href="'.route('boats.edit', $row->id).'" class="text-indigo-600 hover:text-indigo-900 transition" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="'.route('boats.destroy', $row->id).'" method="POST" onsubmit="return confirm(\'Delete this boat permanently?\')">
                                '.csrf_field().method_field('DELETE').'
                                <button type="submit" class="text-red-600 hover:text-red-900 transition" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>';
                })
                ->rawColumns(['boat_image', 'status', 'action'])
                ->make(true);
        }

        return view('admin.boats.index');
    }

    // 2. Show Create Form
    public function create()
    {
        return view('admin.boats.create');
    }

    // 3. Store New Boat
    public function store(Request $request)
    {
        $data = $request->validate([
            'boat_dept_id' => 'required|unique:boats,boat_dept_id',
            'capacity'     => 'required|integer|min:1',
            'owner_name'   => 'required|string|max:255',
            'owner_mobile' => 'required|digits:10',
            'boat_image'   => 'required|image|max:3072', // Max 3MB
            'status'       => 'required|in:active,inactive'
        ]);

        if ($request->hasFile('boat_image')) {
            $data['boat_image'] = $request->file('boat_image')->store('boats', 'public');
        }

        $data['uploader_id'] = auth()->id();
        
        Boat::create($data);

        return redirect()->route('boats.index')->with('success', 'Boat Registered Successfully.');
    }

    // 4. Show Edit Form
    public function edit(Boat $boat)
    {
        return view('admin.boats.edit', compact('boat'));
    }

    // 5. Update Boat
    public function update(Request $request, Boat $boat)
    {
        $data = $request->validate([
            'boat_dept_id' => 'required|unique:boats,boat_dept_id,'.$boat->id,
            'capacity'     => 'required|integer|min:1',
            'owner_name'   => 'required|string|max:255',
            'owner_mobile' => 'required|digits:10',
            'boat_image'   => 'nullable|image|max:3072',
            'status'       => 'required|in:active,inactive'
        ]);

        if ($request->hasFile('boat_image')) {
            // Delete old image
            if ($boat->boat_image) {
                Storage::disk('public')->delete($boat->boat_image);
            }
            $data['boat_image'] = $request->file('boat_image')->store('boats', 'public');
        }

        $boat->update($data);

        return redirect()->route('boats.index')->with('success', 'Boat Details Updated.');
    }

    // 6. Delete Boat
    public function destroy(Boat $boat)
    {
        if ($boat->boat_image) {
            Storage::disk('public')->delete($boat->boat_image);
        }
        $boat->delete();
        return redirect()->route('boats.index')->with('success', 'Boat Deleted Successfully.');
    }
}