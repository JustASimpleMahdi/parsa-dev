<?php

namespace App\Http\Middleware;

use App\RegisterStatusEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobNotRequestedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if (!$user) return $next($request);

        if ($user->register_status === RegisterStatusEnum::COMPLETE) {
            return redirect()->route('job-requested');
        }
        return $next($request);
    }
}
