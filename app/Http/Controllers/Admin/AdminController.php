<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\User\Controller;

class AdminController extends Controller
{
    public function index(){
        $logFilePath = storage_path('logs\user_activity.log');
        $logContents = file_get_contents($logFilePath);
        $logContents = explode("\n", $logContents);
//        dd($logContents);
        return view('admin.adminpage', ['activity'=>$logContents]);
    }
}
