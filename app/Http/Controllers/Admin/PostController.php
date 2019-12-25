<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Post;
use App\Role;
use App\UserProfile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.pages.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return  view('admin.pages.post.create', compact( 'categories'));
    }



    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'longtext' => 'required',
            'thumbnail' => 'nullable',
        ]);


        if ($request->hasFile('thumbnail')){
            $setname = sprintf('postThumbnail_%s.png', random_int(1,1000));
            $path = $request->file('thumbnail')->storeAs('posts', $setname, 'public');
        }else{
            $path = 'posts/default_post.png';
        }

        $user = auth()->id(); // add auth::id()

            $post = new Post();
            $post->user_id = $user;
            $post->title = $request->title;
            $post->slug = $request->title;
            $post->content = $request->longtext;
            $post->thumbnail = $path;
            $post->status = 0;

            $post->save();


            $post->categories()->attach($request->category_id);

            return redirect()->route('posts.index')->with('success', 'Post created Successfully done ');

    }



    public function show($id)
    {
        echo "Comming soon....";
    }



    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::with(['categories'])->where('id', $id)->orWhere('slug', $id)->first();

//        Gate::authorize('allow-Action', $post->user->id);
        $response = Gate::inspect('allow-edit-action', $post->user->id); //inspect method to get the full authorization response returned by the gate

        if ($response->denied()){

            return redirect()->back()->with('error', $response->message());
        }

        return  view('admin.pages.post.edit', compact('categories', 'post'));
    }



    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'longtext' => 'required',
            'thumbnail' => 'nullable',
        ]);

        $post = Post::findOrFail($id);

        if ($request->hasFile('thumbnail')) {

            if (Storage::disk('public')->exists($post->thumbnail)) {

                Storage::disk('public')->delete($post->thumbnail);
            }


            $setname = sprintf('postThumbnail_%s.png', random_int(1, 1000));
            $path = $request->file('thumbnail')->storeAs('posts', $setname, 'public');
        } else {
            $path = $post->thumbnail;
        }

        $post->title = $request->title;
        $post->slug = $request->title;
        $post->content = $request->longtext;
        $post->thumbnail = $path;
        $post->status = 0;
        $post->update();


        $post->categories()->sync($request->category_id);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully ');


    }

    public function destroy($id)
    {
        $post = Post::where('id', $id)->orWhere('slug', $id)->first();

        $response = Gate::inspect('allow-delete-action', $post->user->id);

        if ($response->allowed()){

            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post deleted success !');
        }
        return redirect()->back()->with('error', $response->message());

    /*    if (Storage::disk('public')->exists($post->thumbnail)) {

            Storage::disk('public')->delete($post->thumbnail);
        }*/  // for soft delte here

//        $post->categories()->detach();

    }



}
