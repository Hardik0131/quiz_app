<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Question;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Pcntl\QosClass;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function result()
    {
        if (!session()->has('total_score') || !session()->has('post_id')) {
            abort(404);
        }

        $score = session('total_score');
        $postId = session('post_id');

        $post = Post::with('results')->findOrFail($postId);

        $result = $post->results()
            ->where('min_score', '<=', $score)
            ->where('max_score', '>=', $score)
            ->first();

        return view('front/result', compact('score', 'post', 'result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $result = Result::all();
        return view('postresult', compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = Post::find($request->post_id);
        $Q = $post->questions()->count();

        if ($Q === 0) {
            return back()->withErrors('This Post has no question.');
        }

        $isExist = Result::where('post_id', $post->id)
            ->where('level', $request->level)->exists();

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'post_id' => 'required|exists:posts,id',
            'slug' => 'unique:results,slug',
            'level' => 'required|in:low,medium,hard',
            'title' => 'required',
            'image' => 'required|image',
            'desc' => 'nullable',
        ]);

        $filename = null;
        $slug = Str::slug($request->title);

        if ($request->has('image')) {
            $filename = $request->file('image')->store('result', 'public');
        }

        switch ($request->level) {
            case 'low':
                $minScore = $Q;
                $maxScore = 2 * $Q;
                break;
            case 'medium':
                $minScore = (2 * $Q) + 1;
                $maxScore = (3 * $Q);
                break;
            case 'hard':
                $minScore = (3 * $Q) + 1;
                $maxScore = 4 * $Q;
                break;
        }

        if ($isExist) {
            return back()->withErrors("This Level result is already Exist.");
        }

        Result::create([
            'category_id' => $request->category_id,
            'post_id' => $request->post_id,
            'level' => $request->level,
            'slug' => $slug,
            'min_score' => $minScore,
            'max_score' => $maxScore,
            'title' => $request->title,
            'image' => $filename,
            'desc' => $request->desc,
        ]);

        return back()->with('success', 'Score Added Succesfully.');
    }

    /**
     * Display the specified resource.
     */
    public function displayResult(Request $request)
    {
        $categories = Category::all();
        $posts = Post::all();

        $results = Result::query()
            ->when($request->category_id, function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            })
            ->when($request->post_id, function ($q) use ($request) {
                $q->where('post_id', $request->post_id);
            })
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($static) use ($request) {
                    $static->where('title', 'like', "%{$request->search}%")
                        ->orWhere('desc', 'like', "%{$request->search}%");
                });
            })
            ->paginate(5)
            ->withQueryString();

        if ($request->ajax() && $request->has('page')) {
            return view('admin.layout.row', compact('results', 'categories', 'posts'))->render();
        }

        if ($request->ajax()) {
            return view('admin.result.result', compact('results', 'categories', 'posts'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.result.result', compact('results', 'categories', 'posts')),
        ]);
    }

    public function addResult(Request $request)
    {
        $categories = Category::all();
        $posts = Post::all();

        if ($request->ajax()) {
            return view('admin.result.addResult', compact('categories', 'posts'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.result.addResult', compact('categories', 'posts')),
        ]);
    }

    // public function addResult(Request $request){
    //     $
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Result $result)
    {
        $categories = Category::orderBy('name')->get();
        $posts = Post::where(old('category_id', $request->category_id))
            ->select('id', 'post_name')
            ->get();

        if ($request->ajax()) {
            return view('admin.result.edit', compact('posts', 'categories', 'result'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.result.edit', compact('posts', 'categories', 'result')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'post_id' => 'required|exists:posts,id',
            'level' => 'required|in:low,medium,hard',
            'title' => 'required',
            'image' => 'nullable',
            'desc' => 'nullable',
        ]);

        $post = Post::find($request->post_id);
        $Q = $post->questions()->count();

        switch ($request->level){
                case 'low' : 
                    $minScore = $Q;
                    $maxScore = 2 * $Q;
                    break;
                case 'medium' : 
                    $minScore = (2 * $Q) + 1;
                    $maxScore = 3 * $Q;
                    break;
                case 'hard' : 
                    $minScore = (3 * $Q) + 1;
                    $maxScore = 4 * $Q;
                    break;
        }

        if ($Q === 0) {
            return back()->withErrors('This Post has no question.');
        }

        $filename = $result->image;

        if ($request->has('image')) {
            if ($result->image && Storage::disk('public')->exists($result->image)) {
                Storage::disk('public')->delete($result->image);
            }
            $filename = $request->file('image')->store('result', 'public');
        }

        $result->update([
            'category_id' => $request->category_id,
            'post_id' => $request->post_id,
            'level' => $request->level,
            'min_score' => $minScore,
            'max_score' => $maxScore,
            'title' => $request->title,
            'image' => $filename,
            'desc' => $request->desc,
        ]);

        return redirect()->route('admin.result.display')->with('success', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = Result::findOrFail($id);

        try{
            $result->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Result delete Successfully',
            ]);
        } catch (\Throwable $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
