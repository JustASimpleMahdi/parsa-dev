<?php

namespace App\Http\Controllers;

use App\Models\JobOpportunity;

class LandingPageController extends Controller
{
    public function index()
    {
        $jobOpportunities = JobOpportunity::all();
        return view('index', compact('jobOpportunities'));
    }
}
