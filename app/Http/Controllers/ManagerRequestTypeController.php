<?php

namespace App\Http\Controllers;

use App\DefaultRequestTypeNameEnum;
use App\Models\RequestType;
use Illuminate\Http\Request;

class ManagerRequestTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requestTypes = RequestType::all();
        return view('manager.request-types.index', compact('requestTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        RequestType::create($validated);
        return redirect()->route('manager.request-types.index')->with('create-success', true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(RequestType $requestType)
    {
        return view('manager.request-types.show', compact('requestType'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestType $requestType)
    {
        return view('manager.request-types.edit', compact('requestType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestType $requestType)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|max:255',
            'description' => 'nullable',
        ]);
        if ($requestType->name === DefaultRequestTypeNameEnum::RESIGNATION_REQUEST->name) {
            unset($validated['title']);
        }
        $requestType->update($validated);
        return redirect()->route('manager.request-types.index')->with("update-{$requestType->id}-success", true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequestType $requestType)
    {
        //
    }
}
