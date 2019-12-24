<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{


    public function index()
    {
        $categories = Category::with('parent')->get();

        return view('admin.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return  view('admin.pages.category.create', compact('categories'));
    }



    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'required'
        ]);

        $data = new Category();
        if ($request->hasFile('thumbnail')){

            $setName = sprintf('thaumbnail_%s.png', random_int(1,1000));
            $path = $request->file('thumbnail')->storeAs('categories', $setName, 'public');
            $data->thumbnail = $path;
        }

        $data->title = $request->title;
        $data->parent_id = $request->parent_id;
        $data->content = $request->input('content');
        $data->save();

        return redirect()->route('categories.index')->with('success', 'Category create successfully done !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return  view('admin.pages.category.edit', compact('category', 'categories'));
    }



    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'nullable'
        ]);

        if ($request->hasFile('thumbnail')){

            // delete the old image
            if ( Storage::disk('public')->exists($category->thumbnail)){
                Storage::disk('public')->delete($category->thumbnail);
            }



            $setName = sprintf('thaumbnail_%s.png', random_int(1,1000));
            $path = $request->file('thumbnail')->storeAs('categories', $setName, 'public');
            $category->thumbnail = $path;
        }

        $category->title = $request->title;
        $category->parent_id = $request->parent_id;
        $category->content = $request->input('content');
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category create successfully done !');
    }



    public function destroy(Category $category)
    {
        if ( Storage::disk('public')->exists($category->thumbnail)){
            Storage::disk('public')->delete($category->thumbnail);
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category Updated successfully done !');
    }


    public function tinyMceUpload()
    {
        if (request()->hasFile('file')){

            $setName = sprintf('tinymcs_%s.png', random_int(1,1000));

            $path = request()->file('file')->storeAs('tinymce', $setName, 'public');

        }else{
            $path = null;
        }
        if ($path !== null){
            return response()->json(['location' => Storage::disk('public')->url($path)], 200);
        }else{
            return response()->json(['location' => 'File not uploaded'], 200);
        }
    }


}
