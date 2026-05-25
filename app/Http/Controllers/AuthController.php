<?php

namespace App\Http\Controllers;

use App\Models\ResumeFile;
use App\Models\User;
use App\RegisterStatusEnum;
use App\Services\FileService;
use App\UploadPathEnum;
use Auth;
use DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function updateInformation(Request $request)
    {
        dd();
        $this->showInformation();
    }

    public function editInformation()
    {
        return view('auth.show', ['editMode' => true]);
    }

    public function showInformation()
    {
        return view('auth.show');
    }

    public function storeResumeAndJobRequest(Request $request)
    {
        $validated = $request->validate([
            'resume_files' => 'required|array',
            'resume_files.*' => 'file|mimes:jpg,jpeg,png,doc,docx,pdf|max:2048',
            'resume_text' => 'required',
        ]);

        DB::transaction(function () use ($validated) {
            $user = auth()->user();
            $resume = $user->resume()->create(['text' => $validated['resume_text']]);

            collect($validated['resume_files'])
                ->map(fn($uploadedFile) => FileService::upload($uploadedFile, UploadPathEnum::RESUME->value))
                ->each(fn($file) => ResumeFile::create(['file_id' => $file->id, 'resume_user_id' => $resume->user_id]));

            $user->update(['register_status' => RegisterStatusEnum::COMPLETE]);
        });

        return redirect()->route('job-requested');
    }

    public function registerResume()
    {
        return view('auth.resume');
    }

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
        $user = auth()->user();
        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'father_name' => 'required',
            'birthdate' => 'required|regex:/^\d{4}\/\d{2}\/\d{2}$/',
            'birthplace' => 'required',
            'id_number' => 'required',
            'national_code' => "required|unique:personal_infos,national_code,{$user?->id},user_id",
            'phone' => "required|unique:personal_infos,phone,{$user?->id},user_id",
            'address' => 'required',
            'postal_code' => 'required',
            'username' => "required|unique:users,username,{$user?->id}",
            'password' => (!$user ? 'required|' : 'nullable|') . 'min:4|confirmed',
            'personal_image' => (!$user ? 'required|' : 'nullable|') . 'file|image|max:2048',
            'last_degree' => (!$user ? 'required|' : 'nullable|') . 'file|mimes:jpg,jpeg,png,webp,pdf|max:2048',
        ]);
        if ($user) {
            DB::transaction(function () use ($validated, $user) {
                $update = [
                    'username' => $validated['username'],
                ];
                if (isset($validated['password']) && $validated['password']) {
                    $update['password'] = $validated['password'];
                }
                $user->update($update);
                unset($validated['username']);
                unset($validated['password']);

                if (isset($validated['personal_image']) && $validated['personal_image']) {
                    FileService::remove($user->personal_info->personal_image);
                    $personalImage = FileService::upload($validated['personal_image'], path: UploadPathEnum::PERSONAL_IMAGE->value, public: true);
                    $validated['personal_image'] = $personalImage->id;
                }
                if (isset($validated['last_degree']) && $validated['last_degree']) {
                    FileService::remove($user->personal_info->last_degree);
                    $lastDegree = FileService::upload($validated['last_degree'], path: UploadPathEnum::LAST_DEGREE->value);
                    $validated['last_degree'] = $lastDegree->id;
                }

                $user->personal_info()->update($validated);
            });
        } else {
            $user = DB::transaction(function () use ($validated, $request) {
                $user = User::create([
                    'username' => $validated['username'],
                    'password' => $validated['password'],
                    'register_status' => RegisterStatusEnum::PERSONAL_INFO
                ]);
                unset($validated['username']);
                unset($validated['password']);

                $personalImage = FileService::upload($validated['personal_image'], path: UploadPathEnum::PERSONAL_IMAGE->value, public: true);
                $validated['personal_image'] = $personalImage->id;

                $lastDegree = FileService::upload($validated['last_degree'], path: UploadPathEnum::LAST_DEGREE->value);
                $validated['last_degree'] = $lastDegree->id;


                $user->personal_info()->create($validated);

                return $user;
            });
            Auth::login($user, true);
        }

        return redirect()->route('register.resume');
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
