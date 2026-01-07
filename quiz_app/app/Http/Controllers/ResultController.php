<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function result()
    {
        if(!session()->has('total_score') || !session()->has('post_id')){
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
        $request->validate([
            'post_id' => 'required',
            'min_score' => 'required',
            'max_score' => 'required',
            'title' => 'required',
            'desc' => 'nullable',
        ]);

        Result::create([
            'post_id' => $request->post_id,
            'min_score' => $request->min_score,
            'max_score' => $request->max_score,
            'title' => $request->title,
            'desc' => $request->desc,
        ]);

        return back()->with('success', 'Score Added Succesfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        //
    }
}
