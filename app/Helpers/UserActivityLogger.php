<?php

namespace App\Helpers;

use Carbon\Carbon;

class UserActivityLogger
{
    public static function logActivity($methodName, $className,$message)
    {
        $user = session()->get('user')->username ?? 'Anon user';

        $time = Carbon::now();
        $logMessage = "\p{$user},{$message},{$methodName},$className,{$time}";

        \Log::channel('user_activity')->info($logMessage);
    }

}
