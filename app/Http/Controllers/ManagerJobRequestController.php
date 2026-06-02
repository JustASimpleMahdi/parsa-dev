<?php

namespace App\Http\Controllers;

use App\JobRequestStatusEnum;
use App\Models\Employee;
use App\Models\Job;
use App\Models\JobRequest;
use Illuminate\Database\Query\Expression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerJobRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, JobRequestStatusEnum $status)
    {
        $query = JobRequest::query();
        if ($request->has('search')) {
            $query->whereHas('user.personal_info', function ($q) use ($request) {
                $q->whereRaw(new Expression("CONCAT(firstname, ' ', lastname) LIKE ?"), ["%$request->search%"]);
            });
            $query->orWhereHas('job_opportunity', function ($q) use ($request) {
                $q->where('title', 'LIKE', "%$request->search%");
            });
        }
        $jobRequests = $query->with(['user', 'job_opportunity'])->whereStatus($status)->latest()->paginate();
        return view('manager.job-requests.index', compact('jobRequests', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobRequest $jobRequest)
    {
        $jobRequest->load('user', 'user.personal_info', 'user.resume', 'user.resume.files', 'job_opportunity');
        return view('manager.job-requests.show', compact('jobRequest'));
    }

    public function accept(JobRequest $jobRequest)
    {
        $jobRequest->load('job_opportunity', 'user');

        DB::transaction(function () use ($jobRequest) {
            $jobRequest->update(['status' => JobRequestStatusEnum::ACCEPTED]);

            $job = Job::firstOrCreate(
                ['title' => $jobRequest->job_opportunity->title],
                ['title' => $jobRequest->job_opportunity->title]
            );

            $employee = new Employee();
            $employee->job()->associate($job);
            $employee->user()->associate($jobRequest->user);
            $employee->save();

            $jobRequest->job_opportunity->hired++;
            $jobRequest->job_opportunity->save();

            $jobRequest->user->job_requests()->where('status', JobRequestStatusEnum::PENDING)
                ->update(['status' => JobRequestStatusEnum::REJECTED]);
        });
        return redirect()->route('manager.job-requests.show', $jobRequest)->with('accepted', true);
    }

    public function reject(JobRequest $jobRequest)
    {
        $jobRequest->update(['status' => JobRequestStatusEnum::REJECTED]);

        return redirect()->route('manager.job-requests.show', $jobRequest)->with('rejected', true);
    }
}
