<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class ManagerEmployeeController extends Controller
{
    public function fire(Employee $employee)
    {
        $employee->load('personal_info');
        return view('manager.employees.fire', compact('employee'));
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('manager.index')->with('fire-employee-success', true);
    }
}
