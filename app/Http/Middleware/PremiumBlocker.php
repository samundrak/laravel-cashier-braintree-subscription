<?php

namespace App\Http\Middleware;

use App\SubscriptionPlan;
use Closure;
use Auth;

class PremiumBlocker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if (!$user->subscribed(SubscriptionPlan::MAIN_SUBSCRIPTION)) {
            return redirect('/home')->with('error', 'Sorry you are not premium member.');
        }

        return $next($request);
    }
}
