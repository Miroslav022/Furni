<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\User\Controller;

class AdminController extends Controller
{
    public function index(){
        return view('admin.adminpage');
    }
}
