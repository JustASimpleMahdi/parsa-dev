<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RequestType;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = Employee::where('user_id', auth()->user()->id)->first();
        $requests = $employee->requests()->with('type', 'response')->latest()->get();
        $requestTypes = RequestType::all();
        return view('employee.index', compact('requests', 'requestTypes'));
    }
}
