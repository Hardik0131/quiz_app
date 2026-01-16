<?php

namespace App\Http\Controllers;

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

        if ($request->ajax()) {
            return view('admin.post.addQuestion', compact('posts'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.question.addQuestion', compact('posts')),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'post_id' => 'required|exists:posts,id',
            'image' => 'required',
            'desc' => 'nullable',
        ]);

        $filename = null;

        if ($request->has('image')) {
            $filename = $request->file('image')->store('question', 'public');
        }

        Question::create([
            'question' => $request->question,
            'post_id' => $request->post_id,
            'image' => $filename,
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
        $questions = Question::query()
            ->when($request->search, function ($q) use ($request) {
                $q->where('question', 'like', "%{$request->search}%")
                    ->orWhere('desc', 'like', "%{$request->search}%");
            })->orderBy('id', 'desc')->paginate(5);

        if ($request->ajax() && $request->has('page')) {
            return view('admin.layout.row', compact('questions'))->render();
        }

        if ($request->ajax()) {
            return view('admin.question.question', compact('questions'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.question.question', compact('questions')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Question $question)
    {
        $posts = Post::all();

        if ($request->ajax()) {
            return view('admin.question.edit', compact('posts', 'question'));
        }

        return view('admin.layout.master', [
            'content' => view('admin.question.edit', compact('posts', 'question')),
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

        try{
            $question->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Question Delete Successfully',
            ]);
        }catch (\Throwable $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
