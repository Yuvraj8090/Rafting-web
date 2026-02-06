<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource using Yajra.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Eager load roles to prevent N+1 query issues
            $data = User::with('role')->select('users.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('role', function($row) {
                    $color = match($row->role?->slug) {
                        'admin' => 'purple',
                        'verifier' => 'green',
                        'uploader' => 'blue',
                        default => 'gray'
                    };
                    return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-'.$color.'-100 text-'.$color.'-800">
                                '.($row->role->name ?? "N/A").'
                            </span>';
                })
                ->addColumn('action', function($row){
                    return '
                        <div class="flex items-center space-x-3">
                            <a href="'.route('users.edit', $row->id).'" class="text-indigo-600 hover:text-indigo-900 transition" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="'.route('users.destroy', $row->id).'" method="POST" onsubmit="return confirm(\'Permanently delete this user?\')">
                                '.csrf_field().method_field('DELETE').'
                                <button type="submit" class="text-red-600 hover:text-red-900 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>';
                })
                ->rawColumns(['role', 'action'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'User account created successfully.');
    }
}