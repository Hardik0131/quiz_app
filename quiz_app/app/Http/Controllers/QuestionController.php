<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ViewErrorBag;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Post::all();
        return view('question', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function addQuestion(Request $request)
    {
        $posts = Post::all();
        $categories = Category::all();

        if ($request->ajax()) {
            return view('admin.question.addQuestion', compact('posts', 'categories'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.question.addQuestion', compact('posts', 'categories')),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'post_id' => 'required|exists:posts,id',
            'question' => 'required',
            'image' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'desc' => 'nullable',
        ]);

        $filename = null;

        if ($request->has('image')) {
            $filename = $request->file('image')->store('question', 'public');
        }

        Question::create([
            'question' => $request->question,
            'category_id' => $request->category_id,
            'post_id' => $request->post_id,
            'image' => $filename,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'desc' => $request->desc,
        ]);

        return back()->with('success', 'Question Created Succesfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    public function displayQuestion(Request $request)
    {
        $categories = Category::all();
        $posts = Post::all();
        $allQuestion = Question::all();

        $questions = Question::query()
            ->when($request->search, function ($q) use ($request) {
                $q->where('question', 'like', "%{$request->search}%")
                    ->orWhere('desc', 'like', "%{$request->search}%");
            })->orderBy('id', 'desc')->paginate(5);

        if ($request->ajax() && $request->has('page')) {
            return view('admin.layout.row', compact('questions', 'categories', 'posts', 'allQuestion'))->render();
        }

        if ($request->ajax()) {
            return view('admin.question.question', compact('questions', 'categories', 'posts', 'allQuestion'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.question.question', compact('questions', 'categories', 'posts', 'allQuestion')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Question $question)
    {
        $categories = Category::orderBy('name')->get();
        $posts = Post::where('category_id', $request->category_id)
                    ->select('id', 'post_name')
                    ->get();

        if ($request->ajax()) {
            return view('admin.question.edit', compact('posts', 'question', 'categories'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.question.edit', compact('posts', 'question', 'categories')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question' => 'required',
            'post_id' => 'required|exists:posts,id',
            'image' => 'nullable',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'desc' => 'nullable',
        ]);

        $filename = $question->image;

        if ($request->has('image')) {
            if ($question->image && Storage::disk('public')->exists($question->image)) {
                Storage::disk('public')->delete($question->image);
            }

            $filename = $request->file('image')->store('question', 'public');
        }

        $question->update([
            'question' => $request->question,
            'post_id' => $request->post_id,
            'image' => $filename,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'desc' => $request->desc,
        ]);

        return redirect()->route('admin.question.display')->with('success', 'Question update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question = Question::findOrFail($question->id);

        try {
            $question->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Question Delete Successfully',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    // public function getQuestionByCategoryAndPost(Request $request){
    //     return Question::whereHas('post', function ($q) use ($request){
    //         $q->where('id', $request->post_id)
    //             ->orWhere('category_id', $request->category_id);
    //     })->select('id', 'question')->get();
    // }

    public function getQuestionByCategory(Request $request){
        if($request->category_id){
            return Question::where('category_id', $request->category_id)
                        ->select('id', 'question')
                        ->orderBy('question')
                        ->get();
        }

        return Question::select('id', 'question')->get();
    }
    
    public function getQuestionByPost(Request $request){
        if($request->post_id){
            return Question::where('post_id', $request->post_id)
                        ->select('id', 'question')
                        ->orderBy('question')
                        ->get();
        }

        return Question::select('id', 'question')->get();
    }
}
