<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DataTables;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Project::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row){
                            return $row->trans_name;
                    })
                    ->addColumn('user', function($row){
                        return $row->user->name;
                    })
                    ->addColumn('category', function($row){
                        return $row->category->trans_name;
                    })
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        // $projects = Project::with('category', 'user')->latest('id')->paginate(10);

        // return view('admin.projects.index', compact('projects'));
        return view('admin.projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_en' => 'required',
            'name_ar' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            'budget' => 'required',
            'time' => 'required',
            'category_id' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $count = Project::where('name', 'like', '%' . $request->name_en . '%')->count();

        $slug = Str::slug($request->name_en);
        if($count >= 1) {
            $slug = $slug . '-' . $count;
        }

        $name = json_encode([
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ], JSON_UNESCAPED_UNICODE);

        $description = json_encode([
            'en' => $request->description_en,
            'ar' => $request->description_ar
        ], JSON_UNESCAPED_UNICODE);

        Project::create([
            'name' => $name,
            'slug' => $slug,
            'status' => 1,
            'user_id' => Auth::id(),
            'description' => $description,
            'budget' => $request->budget,
            'time' => $request->time,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.projects.index')->with('msg', 'Project created successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name_en' => 'required|unique:projects,name',
            'name_ar' => 'required'
        ]);

        $name = json_encode([
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ], JSON_UNESCAPED_UNICODE);
        // {"en":"ff", "ar":"ff"}

        $project->update([
            'name' => $name,
            // 'slug' => Str::slug($request->name_en)
        ]);

        return redirect()->route('admin.projects.index')->with('msg', 'Project updated successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('msg', 'Project deleted successfully')->with('type', 'danger');
    }
}
