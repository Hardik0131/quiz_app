<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Exception;
use Illuminate\Validation\Rule;

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

    public function postQuestion($category_name, $post_name)
    {
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

    public function addCategory(Request $request)
    {
        if ($request->ajax()) {
            return view('admin.category.addCategory');
        }

        return view('admin.layout.master', [
            'content' => view('admin.category.addCategory'),
        ]);
    }

    public function display(Request $request)
    {
        $posts = Post::with('category')->get();

        $categories = Category::query()
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('short_desc', 'like', "%{$request->search}%")
                    ->orWhere('long_desc', 'like', "%{$request->search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        if ($request->ajax() && $request->has('page')) {
            return view('admin.layout.row', compact('categories'))->render();
        };

        if($request->ajax()){
            return view('admin.category.category', compact('categories'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.category.category', compact('categories', 'posts')),
        ]);
    }

    // public function root(Request $request)
    // {
    //     $categories = Category::latest()->paginate(10);
    //     $posts = Post::with('category')->get();

    //     if ($request->ajax()) {
    //         return view('admin.category.category', compact('categories', 'posts'));
    //     }

    //     return view('admin.layout.master', [
    //         'content' => view('admin.category.category', compact('categories', 'posts')),
    //     ]);
    // }

    public function edit(Category $category, Request $request)
    {
        if ($request->ajax()) {
            return view('admin.category.edit', compact('category'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.category.edit', compact('category')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', Rule::unique('categories', 'name')->ignore($category->id)],
            'short_desc' => 'nullable',
            'long_desc' => 'nullable',
        ]);

        $category->update([
            'name' => $request->name,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
        ]);

        return redirect()->route('admin.category.display')->with('success', 'Category Update Successfully.');
    }

    // public function search(Request $request)
    // {
    //     $query = Category::query()
    //         ->when($request->query('search'), function ($q) use ($request) {
    //             $search = $request->query('search');

    //             $q->where('name', 'like', "%{$search}%")
    //                 ->orwhere('short_desc', 'like', "%{$search}%")
    //                 ->orwhere('long_desc', 'like', "%{$search}%");
    //         })->orderBy('id', 'asc');


    //     $categories = Category::query()->paginate(10);

    //     if ($request->ajax()) {
    //         return view('admin.layout.row', compact('categories'))->render();
    //     }

    //     return view('admin.layout.master', [
    //         'content' => view('admin.category.category', compact('categories')),
    //     ], compact('categories'));
    // }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        try{
            $category->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Category Delete Successfully',
            ]) ;
        } catch(\Throwable $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
