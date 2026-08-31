<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
{
    $ip = $request->ip();
    $userAgent = $request->userAgent();
    $today = now()->toDateString();

    $exists = Visitor::where('ip_address', $ip)
        ->where('user_agent', $userAgent)
        ->where('visit_date', $today)
        ->exists();

    if (!$exists) {
        Visitor::create([
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'visit_date' => $today,
        ]);
    }

    return $next($request);
}
}
