<?php

namespace App\View\Composers;


use App\Models\Employee;
use Illuminate\View\View;

class AnnouncementComposer
{
    public function compose(View $view)
    {
        $employee = Employee::where('user_id', auth()->user()->id)->first();

        $view->with('unreadAnnouncementsCount', $employee->unreadAnnouncementsCount());
    }
}
