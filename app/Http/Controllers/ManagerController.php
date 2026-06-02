<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\JobOpportunity;
use App\Models\JobRequest;
use App\Models\Request;
use App\RequestStatusEnum;

class ManagerController extends Controller
{
    public function index()
    {
        $jobOpportunities = JobOpportunity::all();

        $jobRequestsCount = JobRequest::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');
        $jobRequestsCount->put('all', JobRequest::count());

        $pendingRequests = Request::with(['type', 'employee.personal_info'])->where('status', RequestStatusEnum::PENDING)->get();
        $otherRequests = Request::with(['type', 'employee.personal_info'])->whereNot('status', RequestStatusEnum::PENDING)->get();

        $employees = Employee::with(['personal_info', 'job'])->latest()->get();

        return view('manager.index',
            compact('jobOpportunities', 'jobRequestsCount', 'pendingRequests', 'otherRequests', 'employees')
        );
    }
}
