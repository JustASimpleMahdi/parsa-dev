<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\RegisterStatusEnum;
use App\Services\FileService;
use Auth;
use DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginSubmit(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($validated, remember: true)) {
            return back()->withInput()->withErrors(['login' => 'نام کاربری یا رمز عبور اشتباه است.']);
        }
        // TODO: Redirect to right place
        return redirect()->route('index');
    }

    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function registerSubmit(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'father_name' => 'required',
            'birthdate' => 'required|regex:/^\d{4}\/\d{2}\/\d{2}$/',
            'birthplace' => 'required',
            'id_number' => 'required',
            'national_code' => 'required|unique:personal_infos,national_code',
            'phone' => 'required|unique:personal_infos,phone',
            'address' => 'required',
            'postal_code' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:4|confirmed',
            'personal_image' => 'file|image|max:2048',
            'last_degree' => 'file|mimes:jpg,jpeg,png,webp,pdf|max:2048',
        ]);
        $user = DB::transaction(function () use ($validated, $request) {
            $user = User::create([
                'username' => $validated['username'],
                'password' => $validated['password'],
                'register_status' => RegisterStatusEnum::PERSONAL_INFO
            ]);
            unset($validated['username']);
            unset($validated['password']);

            $personalImage = FileService::upload($request->file('personal_image'), path: 'personal_image', public: true);


            $lastDegree = FileService::upload($request->file('last_degree'), path: 'last_degree');


            $user->personal_info()->create([
                ...$validated,
                'personal_image' => $personalImage->id,
                'last_degree' => $personalImage->id,
            ]);
            return $user;
        });
        Auth::login($user, true);
        // TODO: Redirect to upload resume
        return redirect()->route('index');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
