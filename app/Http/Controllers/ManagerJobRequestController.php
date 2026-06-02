<?php

namespace App\Http\Controllers;

use App\JobRequestStatusEnum;
use App\Models\JobOpportunity;
use App\Models\JobRequest;
use Illuminate\Database\Query\Expression;
use Illuminate\Http\Request;

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
    public function show(JobRequest $jobRequest, JobOpportunity $jobOpportunity)
    {
        $jobRequest->load('user', 'user.personal_info', 'user.resume', 'user.resume.files', 'job_opportunity');
        return view('manager.job-requests.show', compact('jobRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
