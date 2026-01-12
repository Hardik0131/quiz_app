<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::all();
        $posts = Post::with('category')->get();
        return view('front.home', compact('posts', 'categorys'));
    }
    
    
    public function display(Request $request)
    {
        $categories = Category::latest()->paginate(10);
        $posts = Post::with('category')->get();
        
        if($request->ajax()){
            return view('admin.category', compact('categories', 'posts'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.category', compact('categories', 'posts')),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:categories,name'],
            'short_desc' => 'nullable',
            'long_desc' => 'nullable',
        ]);

        Category::create([
            'name' => $request->name,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
        ]);

        return back()->with('success', 'Category Create SuccesFully');
    }

    public function categoryPost($name)
    {
        $categories = Category::all();
        $category = Category::where('name', $name)->firstOrFail();
        $posts = Post::with('category')->where('category_id', $category->id)->get();
        return view('front.home', compact('categories', 'posts', 'category'));
    }

    public function postQuestion($category_name, $post_name){
        $category_name = urldecode($category_name);
        $post_name = urldecode($post_name);

        $posts = Post::all();
        $category = Category::where('name', $category_name)->firstOrFail();
        $post = Post::where('post_name', $post_name)->where('category_id', $category->id)->firstOrFail();
        $questions = $post->questions()->with('options')->get();
        
        return view('front.quiz', compact('category', 'posts', 'post', 'questions'));
    }

    // Admin Controller

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
