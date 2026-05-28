<?php

namespace App\Http\Controllers;

use App\Models\JobOpportunity;
use Illuminate\Http\Request;

class JobOpportunityController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'capacity' => 'required|integer|min:1',
        ]);
        JobOpportunity::create($validated);
        return redirect()->route('manager.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.job-opportunities.create');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobOpportunity $jobOpportunity)
    {
        return view('manager.job-opportunities.edit', compact('jobOpportunity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobOpportunity $jobOpportunity)
    {
        $minCapacity = max($jobOpportunity->hired, 1);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'capacity' => "required|integer|min:$minCapacity",
        ]);
        $jobOpportunity->update($validated);
        return redirect()->route('manager.index');
    }

    public function delete(JobOpportunity $jobOpportunity)
    {
        return view('manager.job-opportunities.delete', compact('jobOpportunity'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobOpportunity $jobOpportunity)
    {
        $jobOpportunity->delete();
        return redirect()->route('manager.index');
    }
}
