<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\ServiceProvider;

class InfoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //return notifications to header 
        if (auth()->check()) {
            view()->composer(['layouts.*'], function ($view) {
                $notifications = Notification::where('receiver_id', auth()->user()->id)->unread()->get();
                $view->with('notifications', $notifications);
            });
        }
    }
}
