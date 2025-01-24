<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationAcceptController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(DatabaseNotification $notification, Request $request)
    {
//        $this->authorize('update', $notification);
        Gate::authorize('update', $notification);
        $notification->markAsRead();

        return redirect()->back()->with('success', 'Notification marked as read');
    }
}
