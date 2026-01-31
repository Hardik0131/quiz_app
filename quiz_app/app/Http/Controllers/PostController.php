<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $categories = Category::orderBy('name')->get();

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
            'slug' => 'unique:posts,slug',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image',
            'desc' => 'required',
        ]);

        $filename = null;
        $slug = Str::slug($request->post_name);

        if ($request->has('image')) {
            $filename = $request->file('image')->store('post', 'public');
        }

        Post::create([
            'post_name' => $request->post_name,
            'category_id' => $request->category_id,
            'slug' => $slug,
            'image' => $filename,
            'desc' => $request->desc,
        ]);

        return redirect()->route('admin.post.display')->with('success', 'Post Create Succesfully.');
    }

    public function displayPost(Request $request)
    {
        $categories = Category::all();
        $posts = Post::query()
            ->when($request->category_id, function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            })
            ->when($request->post_id, function ($q) use ($request) {
                $q->where('post_id', $request->category_id);
            })
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($static) use ($request) {
                    $static->where('post_name', 'like', "%{$request->search}%")
                        ->orWhere('desc', 'like', "%{$request->search}%");
                });
            })
            ->orderBy('id', 'desc')->paginate(5)->withQueryString();

        if ($request->ajax() && $request->has('page')) {
            return view('admin.layout.row', compact('posts', 'categories'))->render();
        }

        if ($request->ajax()) {
            return view('admin.post.post', compact('posts', 'categories'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.post.post', compact('posts', 'categories')),
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
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        try {
            $post->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Post Delete Successfully',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getPostByCategory(Request $request)
    {
        if ($request->category_id) {
            return Post::when(filled($request->category_id), function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            })
                ->select('id', 'post_name')
                ->orderBy('post_name')
                ->get();
        }

        return Post::select('id', 'post_name')->get();
    }
}
