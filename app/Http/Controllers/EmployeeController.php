<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\PhoneNumberHelper;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

class EmployeeController extends Controller
{
    public function web_index(){
        return view('dashboard1', [
            "employees" => User::all(),
        ]);
    }

    public function list()
    {
        $employees = User::all()->map(function($employee) {
            $employee->formatted_phone_number = PhoneNumberHelper::format($employee->phone_number);
            return $employee;
        });
        return response()->json(['employees' => $employees]);
    }


    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'gender' => 'required|string|in:Male,Female',
        ]);

        $path = $request->file('profile_photo') ? $request->file('profile_photo')->store('profile_photos', 'public') : null;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo_path' => $path,
            'department' => $request->department,
            'position' => $request->position,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
        ]);

        return redirect()->route('dashboard')->with('status', 'User created successfully.');
    }

    public function destroy(User $employee)
{
    // Hapus foto profil dari penyimpanan jika ada
    if ($employee->profile_photo_path) {
        \Storage::disk('public')->delete($employee->profile_photo_path);
    }

    // Hapus user dari database
    $employee->delete();

    return redirect()->route('dashboard')->with('status', 'User deleted successfully.');
}
}
