<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Request;
use App\Models\RequestType;
use Illuminate\Http\Request as HttpRequest;

class EmployeeRequestController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(HttpRequest $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'exists:request_types,name'],
            'text' => ['required', 'string'],
        ]);

        $employee = Employee::where('user_id', auth()->user()->id)->first();
        $requestType = RequestType::where('name', $validated['name'])->first('id');
        $employeeRequest = new Request([
            'text' => $validated['text'],
        ]);
        $employeeRequest->type()->associate($requestType);
        $employee->requests()->save($employeeRequest);

        return redirect()->back()->with("request-{$validated['name']}-created", true);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HttpRequest $httpRequest, Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
