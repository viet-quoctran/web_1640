<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use App\Models\Contribution;
use App\Models\Image;
use App\Models\Word;

class AdminController extends Controller
{
    public function dashboard(){
        $contributions = Contribution::with(['words', 'images', 'user'])->get();

        return view('admin.dashboard.index', compact('contributions'));
    }
}
