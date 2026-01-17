<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
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

    // public function create()
    // {
    //     return view('posts', compact('categories'));
    // }

    public function addPost(Request $request)
    {
        $categories = Category::all();

        if ($request->ajax()) {
            return view('admin.post.addPost', compact('categories'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.post.addPost', compact('categories')),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image',
            'desc' => 'required',
        ]);

        $filename = null;

        if ($request->has('image')) {
            $filename = $request->file('image')->store('post', 'public');
        }

        Post::create([
            'post_name' => $request->post_name,
            'category_id' => $request->category_id,
            'image' => $filename,
            'desc' => $request->desc,
        ]);

        return back()->with('success', 'Post Create Succesfully.');
    }

    public function displayPost(Request $request)
    {
        $posts = Post::query()
            ->when($request->search, function ($q) use ($request) {
                $q->where('post_name', 'like', "%{$request->search}%")
                    ->orWhere('desc', 'like', "%{$request->search}%");
            })
            ->orderBy('id', 'desc')->paginate(5);

        if ($request->ajax() && $request->has('page')) {
            return view('admin.layout.row', compact('posts'))->render();
        }

        if ($request->ajax()) {
            return view('admin.post.post', compact('posts'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.post.post', compact('posts')),
        ], compact('posts'));
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
    public function edit(Request $request, post $post)
    {
        $categories = Category::all();

        if ($request->ajax()) {
            return view('admin.post.edit', compact('post', 'categories'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.post.edit', compact('post', 'categories')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
        $request->validate([
            'post_name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable',
            'desc' => 'required',
        ]);

        $filename = $post->image;

        if ($request->has('image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            $filename = $request->file('image')->store('post', 'public');
        }

        $post->update([
            'post_name' => $request->post_name,
            'category_id' => $request->category_id,
            'image' => $filename,
            'desc' => $request->desc,
        ]);

        return redirect()->route('admin.post.display')->with('success', 'Post Update SuccessFully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        $post = Post::findOrFail($post->id);

        try{
            $post->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Post Delete Successfully',
            ]);
        }catch (\Throwable $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getPostByCategory(Request $request){
        if($request->category_id){
            return Post::where('category_id', $request->category_id)
                ->select('id', 'post_name')
                ->orderBy('post_name')
                ->get();
        }

        return Post::select('id', 'post_name')->get(); 
    }
}
