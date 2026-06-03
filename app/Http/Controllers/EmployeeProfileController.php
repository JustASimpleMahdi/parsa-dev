<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Hash;
use Illuminate\Http\Request;

class EmployeeProfileController extends Controller
{
    public function index()
    {
        $employee = Employee::with(['personal_info', 'job'])->where('user_id', auth()->user()->id)->first();
        return view('employee.profile.index', compact('employee'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'username' => 'sometimes|required|unique:users,username,' . auth()->user()->id,
            'password' => 'sometimes|required|confirmed',
            'current_password' => 'required_with:password',
        ]);
        if ($validated['password']) {
            if (!Hash::check($validated['current_password'], auth()->user()->password)) {
                return back()->withErrors(['current_password' => 'رمز عبور فعلی اشتباه است.']);
            }
        }
        auth()->user()->update($validated);
        return back()->with('update-success', true);
    }
}
