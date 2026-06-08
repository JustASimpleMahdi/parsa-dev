<?php

namespace App\Http\Controllers;

use App\JobRequestStatusEnum;
use App\Models\File;
use App\Models\JobOpportunity;
use App\Models\User;
use App\RegisterStatusEnum;
use App\RoleEnum;
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

        if ($user->isEmployee() || $user->role === RoleEnum::MANAGER) abort(403);

        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'father_name' => 'required',
            'birthdate' => 'required|regex:/^\d{4}\/\d{2}\/\d{2}$/',
            'birthplace' => 'required',
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
            'job_opportunities' => 'required|array|min:1',
            'job_opportunities.*' => 'required|exists:job_opportunities,id',
        ]);
        DB::transaction(function () use ($validated, $user) {
            $validated = collect($validated);
            $userValidated = $validated->only(['username', 'password']);
            $resumeValidated = $validated->only(['resume_text', 'new_resume_files', 'delete_resume_files']);
            $jobRequestValidated = $validated->only('job_opportunities');
            $personalInfoValidated = $validated->except(
                $userValidated->merge($resumeValidated)->merge($jobRequestValidated)
                    ->keys()->toArray());

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

            $files = collect($resumeValidated->get('new_resume_files', []))
                ->map(fn($uploadedFile) => FileService::upload($uploadedFile, UploadPathEnum::RESUME->value));
            $user->resume->files()->saveMany($files);


            $currentJobOpportunities = $user->job_requests->pluck('job_opportunity_id');
            $wantedJobOpportunities = collect($jobRequestValidated['job_opportunities']);

            $newJobRequests = $wantedJobOpportunities->diff($currentJobOpportunities);

            $updateJobRequests = $currentJobOpportunities->intersect($wantedJobOpportunities)
                ->map(fn(int $jobOpportunityId) => $user->job_requests->where('job_opportunity_id', $jobOpportunityId)->first());

            $deleteJobRequest = $currentJobOpportunities->diff($wantedJobOpportunities)
                ->map(fn(int $jobOpportunityId) => $user->pending_job_requests->where('job_opportunity_id', $jobOpportunityId)->first())
                ->whereNotNull();

            $deleteJobRequest->each->delete();

            $updateJobRequests->each->update(['status' => JobRequestStatusEnum::PENDING]);

            $user->job_requests()->createMany($newJobRequests->map(fn($jobOpportunityId) => ['job_opportunity_id' => $jobOpportunityId]));
        });
        return redirect()->route('job-requested.info');
    }

    public function showInformation()
    {
        return view('auth.show');
    }

    public function editInformation()
    {
        $jobOpportunities = JobOpportunity::all();
        return view('auth.edit', compact('jobOpportunities'));
    }

    public function storeResumeAndJobRequest(Request $request)
    {
        $validated = $request->validate([
            'resume_files' => 'nullable|array',
            'resume_files.*' => 'file|mimes:jpg,jpeg,png,doc,docx,pdf|max:2048',
            'resume_text' => 'required',
            'job_opportunities' => 'required|array|min:1',
            'job_opportunities.*' => 'required|exists:job_opportunities,id',
        ]);
        DB::transaction(function () use ($validated) {
            $user = auth()->user();
            $resume = $user->resume()->create(['text' => $validated['resume_text']]);

            if (isset($validated['resume_files'])) {
                $files = collect($validated['resume_files'])
                    ->map(fn($uploadedFile) => FileService::upload($uploadedFile, UploadPathEnum::RESUME->value));
                $resume->files()->saveMany($files);
            }

            $user->job_requests()->createMany(
                collect($validated['job_opportunities'])->map(fn($id) => ['job_opportunity_id' => $id])
            );

            $user->update(['register_status' => RegisterStatusEnum::COMPLETE]);
        });

        return redirect()->route('job-requested');
    }

    public function registerResume()
    {
        $jobOpportunities = JobOpportunity::all();
        return view('auth.resume', compact('jobOpportunities'));
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
        $user = auth()->user();

        if ($user->role === RoleEnum::MANAGER)
            return redirect()->route('manager.index');

        if ($user->isEmployee())
            return redirect()->route('employee.index');

        if ($user->register_status === RegisterStatusEnum::COMPLETE)
            return redirect()->route('job-requested');

        if ($user->register_status === RegisterStatusEnum::PERSONAL_INFO)
            return redirect()->route('register.resume');

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
            'id_number' => 'required|numeric',
            'national_code' => "required|numeric|unique:personal_infos,national_code,{$user?->id},user_id",
            'phone' => "required|numeric|regex:/^09\d{9}$/|unique:personal_infos,phone,{$user?->id},user_id",
            'address' => 'required',
            'postal_code' => 'required|numeric',
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
                    $user->personal_info->personal_image->delete();
                    $personalImage = FileService::upload($validated['personal_image'], path: UploadPathEnum::PERSONAL_IMAGE->value, public: true);
                    $validated['personal_image_file_id'] = $personalImage->id;
                }
                unset($validated['personal_image']);

                if (isset($validated['last_degree']) && $validated['last_degree']) {
                    $user->personal_info->last_degree->delete();
                    $lastDegree = FileService::upload($validated['last_degree'], path: UploadPathEnum::LAST_DEGREE->value);
                    $validated['last_degree_file_id'] = $lastDegree->id;
                }
                unset($validated['last_degree']);

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
                $validated['personal_image_file_id'] = $personalImage->id;
                unset($validated['personal_image']);

                $lastDegree = FileService::upload($validated['last_degree'], path: UploadPathEnum::LAST_DEGREE->value);
                $validated['last_degree_file_id'] = $lastDegree->id;
                unset($validated['last_degree']);


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
