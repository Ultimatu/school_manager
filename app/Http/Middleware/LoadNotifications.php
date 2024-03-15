<?php

namespace App\Http\Middleware;

use App\Models\Notification;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoadNotifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            if (Auth::check()) {
                $notifications = Notification::where('receiver_id', Auth::user()->id)->unread();
                view()->share('notifications', $notifications);
            }
    
            return $next($request);
    }
}
