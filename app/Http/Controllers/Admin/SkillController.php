<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skill;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skill::latest('id')->paginate(10);

        return view('admin.skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.skills.create');
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
            'name_ar' => 'required'
    ]);

    $exists = Skill::where('name', 'like', '%' . $request->name_en . '%')->exists();

    if($exists) {
        $validator->after(function ($validator) {
            $validator->errors()->add('name_en', 'Name already exists');
        });

        return redirect()->back()->withErrors($validator)->withInput();
    }

    $name = json_encode([
        'en' => $request->name_en,
        'ar' => $request->name_ar
    ], JSON_UNESCAPED_UNICODE);
    // {"en":"ff", "ar":"ff"}

    Skill::create([
        'name' => $name,
        'slug' => Str::slug($request->name_en)
    ]);

    return redirect()->route('admin.skills.index')->with('msg', 'Skill created successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required'
        ]);

        $name = json_encode([
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ], JSON_UNESCAPED_UNICODE);
        // {"en":"ff", "ar":"ff"}

        $skill->update([
            'name' => $name
        ]);

        return redirect()->route('admin.skills.index')->with('msg', 'Skill updated successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('msg', 'Skill deleted successfully')->with('type', 'danger');
    }
}
