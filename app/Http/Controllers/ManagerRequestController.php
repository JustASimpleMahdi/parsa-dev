<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\RequestStatusEnum;
use DB;
use Illuminate\Http\Request as HttpRequest;

class ManagerRequestController extends Controller
{
    public function show(Request $request)
    {
        $request->load('response', 'type', 'employee', 'employee.personal_info');
        return view('manager.requests.show', compact('request'));
    }

    public function response(HttpRequest $httpRequest, Request $request)
    {
        $validated = $httpRequest->validate([
            'text' => 'required',
        ]);
        DB::transaction(function () use ($request, $validated) {
            $request->response()->updateOrCreate([], ['text' => $validated['text']]);
            $request->update(['status' => RequestStatusEnum::RESPONDED]);
        });
        return redirect()->route('manager.index')->with("request-$request->id-responded", true);
    }
}
