<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class UserNotification extends Component
{
    public $notifications;
    public $newCount ;
    /**
     * Create a new component instance.
     */
    public function __construct($count = 10)
    {
        $user = Auth::user();
        $this->notifications = $user->notifications()->take($count)->get();
        $this->newCount = $user->unreadNotifications()->count();
//        $this->notification = $user->readNotifications;
//        $this->notification = $user->unreadNotifications;


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.user-notification');
    }
}
