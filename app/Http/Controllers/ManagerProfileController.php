<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;

class ManagerProfileController extends Controller
{
    public function index()
    {
        $manager = auth()->user();
        return view('manager.profile.index', compact('manager'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'username' => 'sometimes|required|unique:users,username,' . auth()->user()->id,
            'password' => 'sometimes|required|confirmed',
            'current_password' => 'required_with:password',
        ]);
        if (!empty($validated['password'])) {
            if (!Hash::check($validated['current_password'], auth()->user()->password)) {
                return back()->withErrors(['current_password' => 'رمز عبور فعلی اشتباه است.']);
            }
        }
        auth()->user()->update($validated);
        return back()->with('update-success', true);
    }
}
