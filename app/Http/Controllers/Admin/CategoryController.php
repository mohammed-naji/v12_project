<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest('id')->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name_en' => 'required',
        //     'name_ar' => 'required'
        // ]);

        $validator = Validator::make($request->all(), [
                'name_en' => 'required',
                'name_ar' => 'required'
        ]);

        $exists = Category::where('name', 'like', '%' . $request->name_en . '%')->exists();

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

        Category::create([
            'name' => $name,
            'slug' => Str::slug($request->name_en)
        ]);

        return redirect()->route('admin.categories.index')->with('msg', 'Category created successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_en' => 'required|unique:categories,name',
            'name_ar' => 'required'
        ]);

        $name = json_encode([
            'en' => $request->name_en,
            'ar' => $request->name_ar
        ], JSON_UNESCAPED_UNICODE);
        // {"en":"ff", "ar":"ff"}

        $category->update([
            'name' => $name,
            // 'slug' => Str::slug($request->name_en)
        ]);

        return redirect()->route('admin.categories.index')->with('msg', 'Category updated successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('msg', 'Category deleted successfully')->with('type', 'danger');
    }
}
