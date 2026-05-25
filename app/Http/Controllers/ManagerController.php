<?php

namespace App\Http\Controllers;

use App\Models\JobOpportunity;

class ManagerController extends Controller
{
    public function index()
    {
        $jobOpportunities = JobOpportunity::all();

        return view('manager.index', compact('jobOpportunities'));
    }
}
