<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('postresult', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required',
            'desc' => 'required',
        ]);

        $filename = null;

        if($request->has('image')){
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();

            $path = 'images/category';
            $filename = time().'.'. $extention;
            $file->move($path, $filename);
        }

        Post::create([
            'post_name' => $request->post_name,
            'category_id' => $request->category_id,
            'image' => $filename,
            'desc' => $request->desc,
        ]);

        return back()->with('success', 'Post Create Succesfully.');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        //
    }
}
