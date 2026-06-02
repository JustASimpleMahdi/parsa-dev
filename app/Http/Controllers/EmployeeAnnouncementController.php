<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class EmployeeAnnouncementController extends Controller
{
    public function index()
    {
        $employee = Employee::where('user_id', auth()->user()->id)->first();
        $employee->announcements()->wherePivotNull('read_at')->update(['read_at' => now()]);
        $announcements = $employee->announcements;
        return view('employee.announcements.index', compact('announcements'));
    }
}
