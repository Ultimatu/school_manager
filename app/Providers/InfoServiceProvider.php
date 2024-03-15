<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
            View::composer(['layouts.*'], function ($view) {
                $notifications = Notification::where('receiver_id', auth()->user()->id)->unread()->get();
                $view->with(compact('notifications'));
            });
        }
    }
}
