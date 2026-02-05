<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use Illuminate\Http\Request;

class BoatController extends Controller
{
    public function index()
    {
        $boats = Boat::with('uploader')->paginate(10);
        return view('admin.boats.index', compact('boats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'boat_dept_id' => 'required|unique:boats',
            'capacity' => 'required|integer',
            'owner_name' => 'required',
            'owner_mobile' => 'required',
            'boat_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('boat_image')) {
            $data['boat_image'] = $request->file('boat_image')->store('boats', 'public');
        }

        $data['uploader_id'] = auth()->id();
        
        Boat::create($data);

        return redirect()->route('boats.index')->with('success', 'Boat registered successfully.');
    }
}