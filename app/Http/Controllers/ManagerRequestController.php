<?php

namespace App\Http\Controllers;

use App\DefaultRequestTypeNameEnum;
use App\Models\Request;
use App\RequestStatusEnum;
use DB;
use Illuminate\Http\Request as HttpRequest;

class ManagerRequestController extends Controller
{
    public function show(Request $request)
    {
        $request->load('response', 'type', 'employee', 'employee.personal_info');
        if ($request->type->name === DefaultRequestTypeNameEnum::RESIGNATION_REQUEST->name) {
            return view('manager.requests.resignation', compact('request'));
        }
        return view('manager.requests.show', compact('request'));
    }

    public function response(HttpRequest $httpRequest, Request $request)
    {
        $validated = $httpRequest->validate([
            'text' => 'required',
        ]);
        $this->sendResponse($request, $validated);
        return redirect()->route('manager.index')->with("request-$request->id-responded", true);
    }

    private function sendResponse(Request $request, array $validated): void
    {
        DB::transaction(function () use ($request, $validated) {
            $request->response()->updateOrCreate([], ['text' => $validated['text']]);
            $request->status = RequestStatusEnum::RESPONDED;
            $request->save();
        });
    }

    public function resign(HttpRequest $httpRequest, Request $request)
    {
        if ($request->status === RequestStatusEnum::RESPONDED) {
            abort(403);
        }
        $validated = $httpRequest->validate([
            'response' => 'required|in:accept,reject',
            'text' => 'required_if:response,reject',
        ]);
        if ($validated['response'] === 'accept') {
            $request->employee->delete();
            return redirect()->route('manager.index')->with("request-$request->id-resigned", true);
        }

        unset($validated['response']);
        $this->sendResponse($request, $validated);
        return redirect()->route('manager.index')->with("request-$request->id-responded", true);
    }

    public function destroy(Request $request)
    {
        $request->delete();
        return redirect()->route('manager.index')->with("request-$request->id-responded", true);
    }
}
