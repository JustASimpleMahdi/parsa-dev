<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Employee;
use Illuminate\Http\Request;

class ManagerAnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::latest()->get();

        $employees = Employee::with(['personal_info', 'job'])->get();

        return view('manager.announcements.index', compact('announcements', 'employees'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'text' => 'required',
            'employees' => 'array|required',
            'employees.*' => 'exists:employees,id',
        ]);

        $announcement = Announcement::create([
            'title' => $request->title,
            'text' => $request->text,
        ]);
        $announcement->employees()->attach($request->employees);
        $announcement->save();

        return redirect()->route('manager.announcements.index');
    }

}
