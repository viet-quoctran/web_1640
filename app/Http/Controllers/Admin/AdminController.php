<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard.index');
    }
}
