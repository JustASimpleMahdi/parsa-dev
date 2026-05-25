<?php

namespace App\Http\Middleware;

use App\RegisterStatusEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobRequestedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->register_status !== RegisterStatusEnum::COMPLETE) {
            return redirect()->route('register.resume');
        }
        return $next($request);
    }
}
