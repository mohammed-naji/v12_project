<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request)
    {

        if($request->ajax()) {
            return '88888';
        }


        $top_cats = Category::with('projects')->withCount('projects')->orderBy('projects_count', 'desc')->take(4)->get();

        $latest_project = Project::latest('id')->paginate(2);

        // dd($top_cats);

        return view('site.index', compact('top_cats', 'latest_project'));
    }
}
