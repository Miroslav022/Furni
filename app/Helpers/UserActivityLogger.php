<?php

namespace App\Helpers;

use Carbon\Carbon;

class UserActivityLogger
{
    public static function logActivity($methodName, $className)
    {
        $user = session()->get('user');
        $time = Carbon::now();
        $logMessage = "User {$user->username} called {$methodName} in $className class at {$time}";

        // Log the activity to a file (you can customize the log channel and file path)
        \Log::info($logMessage);
    }
}
