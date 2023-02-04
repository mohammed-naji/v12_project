<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // public function index($lang)
    public function index()
    {

        // App::setLocale($lang);

        return view('admin.index');
    }
}
