<?php

namespace App\Http\Controllers;

use App\Models\JobOpportunity;
use App\Models\JobRequest;

class ManagerController extends Controller
{
    public function index()
    {
        $jobOpportunities = JobOpportunity::all();

        $jobRequestsCount = JobRequest::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');
        $jobRequestsCount->put('all', JobRequest::count());

        return view('manager.index', compact('jobOpportunities', 'jobRequestsCount'));
    }
}
