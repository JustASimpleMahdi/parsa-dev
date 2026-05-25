<?php

namespace App\Http\Controllers;

use App\Models\File;
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
        $user = auth()->user();
        $validated = $request->validate([
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'father_name' => 'required|alpha',
            'birthdate' => 'required|regex:/^\d{4}\/\d{2}\/\d{2}$/',
            'birthplace' => 'required|alpha',
            'id_number' => 'required|numeric',
            'national_code' => "required|numeric|unique:personal_infos,national_code,{$user->id},user_id",
            'phone' => "required|numeric|regex:/^09\d{9}$/|unique:personal_infos,phone,{$user->id},user_id",
            'address' => 'required',
            'postal_code' => 'required|numeric',
            'username' => "required|unique:users,username,{$user->id}",
            'password' => 'nullable|min:4|confirmed',
            'personal_image' => 'nullable|file|image|max:2048',
            'last_degree' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:2048',
            'resume_text' => 'required',
            'delete_resume_files' => 'array',
            'delete_resume_files.*' => 'required|exists:files,id',
            'new_resume_files' => 'array',
            'new_resume_files.*' => 'required|file|mimes:jpg,jpeg,png,webp,pdf|max:2048',
        ]);
        DB::transaction(function () use ($validated, $user) {
            $validated = collect($validated);
            $userValidated = $validated->only(['username', 'password']);
            $resumeValidated = $validated->only(['resume_text', 'new_resume_files', 'delete_resume_files']);
            $personalInfoValidated = $validated->except($userValidated->merge($resumeValidated)->keys()->toArray());

            $update['username'] = $userValidated['username'];
            if ($userValidated->has('password') && $userValidated['password']) {
                $update['password'] = $userValidated['password'];
            }
            $user->update($update);

            if ($personalInfoValidated->has('personal_image') && $personalInfoValidated['personal_image']) {
                FileService::remove($user->personal_info->personal_image);
                $personalImage = FileService::upload($personalInfoValidated['personal_image'], path: UploadPathEnum::PERSONAL_IMAGE->value, public: true);
                $personalInfoValidated['personal_image_file_id'] = $personalImage->id;
            }
            if ($personalInfoValidated->has('last_degree') && $personalInfoValidated['last_degree']) {
                FileService::remove($user->personal_info->last_degree);
                $lastDegree = FileService::upload($personalInfoValidated['last_degree'], path: UploadPathEnum::LAST_DEGREE->value);
                $personalInfoValidated['last_degree_file_id'] = $lastDegree->id;
            }

            $user->personal_info()->update($personalInfoValidated->except(['personal_image', 'last_degree'])->toArray());

            $user->resume()->update(['text' => $resumeValidated['resume_text']]);

            foreach ($resumeValidated->get('delete_resume_files', []) as $file_id) {
                File::find($file_id)->delete();
            }

            collect($resumeValidated->get('new_resume_files', []))
                ->map(fn($uploadedFile) => FileService::upload($uploadedFile, UploadPathEnum::RESUME->value))
                ->each(fn($file) => ResumeFile::create(['file_id' => $file->id, 'resume_user_id' => $user->id]));
        });
        return redirect()->route('job-requested.info');
    }

    public function showInformation()
    {
        return view('auth.show');
    }

    public function editInformation()
    {
        return view('auth.edit');
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
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'father_name' => 'required|alpha',
            'birthdate' => 'required|regex:/^\d{4}\/\d{2}\/\d{2}$/',
            'birthplace' => 'required|alpha',
            'id_number' => 'required|numeric',
            'national_code' => "required|numeric|unique:personal_infos,national_code,{$user->id},user_id",
            'phone' => "required|numeric|regex:/^09\d{9}$/|unique:personal_infos,phone,{$user->id},user_id",
            'address' => 'required',
            'postal_code' => 'required|numeric',
            'username' => "required|unique:users,username,{$user->id}",
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
                    $user->personal_info->personal_image->delete();
                    $personalImage = FileService::upload($validated['personal_image'], path: UploadPathEnum::PERSONAL_IMAGE->value, public: true);
                    $validated['personal_image'] = $personalImage->id;
                }
                if (isset($validated['last_degree']) && $validated['last_degree']) {
                    $user->personal_info->last_degree->delete();
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
