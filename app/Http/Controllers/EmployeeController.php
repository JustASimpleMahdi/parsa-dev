<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = Employee::where('user_id', auth()->user()->id)->first();
        $requests = $employee->requests()->with('type', 'response')->latest()->get();
        return view('employee.index', compact('requests'));
    }
}
