<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscriptions;
class Subscriber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            $subscription = Subscriptions::where('user', Auth::user()->id)->where('state', '>=', 1)->latest()->first();
            if(!is_null($subscription)){
                return $next($request);
            }
            return redirect()->route('subscritption.description');
        }
        return redirect()->route('login.view');
    }
}
