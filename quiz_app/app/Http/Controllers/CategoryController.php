<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::limit(3)->orderBy('name', 'asc')->whereHas('posts', function ($q){
            $q->has('questions', '>=', 2)->has('results', '>=', 3);
        })->get();
        $posts = Post::with(['category', 'questions'])->has('questions', '>=', 2)->orderByDesc('post_name')->limit(10)->get();
        $trending_posts = Post::orderByDesc('attempts_count')->has('questions', '>=', 2)->limit(5)->get();
        
        return view('front.home', compact('posts', 'trending_posts', 'categorys'));
    }

    /**
     * Show the form for creating a new resource.
     */

    // public function create()
    // {
    //     return view('category');
    // }

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

        $slug = Str::slug($request->name);

        $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count) {
            $slug .= '-' . ($count + 1);
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
        ]);

        return redirect()->route('admin.category.display')->with('success', 'Category Create SuccesFully');
    }

    public function categoryPost(Category $category)
    {
        $categorys = Category::limit(3)->orderBy('name', 'asc')->whereHas('posts', function ($q){
            $q->has('questions', '>=', 2)->has('results', '>=', 3);
        })->get();
        $category = Category::where('name', $category->name)->firstOrFail();
        $posts = Post::with('category')->has('questions', '>=', 2)->has('results', '>=', 3)->where('category_id', $category->id)->get();
        $trending_posts = Post::orderBy('attempts_count', 'desc')->has('questions', '>=', 2)->has('results', '>=', 3)->limit(5)->get();
        return view('front.home', compact('posts', 'trending_posts', 'category', 'categorys'));
    }

    public function postQuestion(Category $category, Post $post)
    {
        if ($post->category_id !== $category->id) {
            abort(404);
        }

        $trending_posts = Post::where('attempts_count', 'desc')->limit(5)->get();
        $posts = Post::where('category_id', $category->id)->get();
        $questions = $post->questions()->get()->map(function ($question) {
            $options = [
                ['text' => $question->option_a, 'value' => $question->a_val],
                ['text' => $question->option_b, 'value' => $question->a_val],
                ['text' => $question->option_c, 'value' => $question->c_val],
                ['text' => $question->option_d, 'value' => $question->d_val],
            ];

            shuffle($options);

            $question->shuffled_options = $options;

            return $question;
        });

        return view('front.quiz', compact('category', 'trending_posts', 'post', 'questions', 'posts'));
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
        // $posts = Post::with('category')->get();

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

        if ($request->ajax()) {
            return view('admin.category.category', compact('categories'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.category.category', compact('categories')),
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
            'slug' => 'unique:categories,slug',
            'short_desc' => 'nullable',
            'long_desc' => 'nullable',
        ]);

        $slug = Str::slug($request->name);

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
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

        try {
            $category->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Category Delete Successfully',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
