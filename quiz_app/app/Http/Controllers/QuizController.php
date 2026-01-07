<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'answers' => 'required|array',
            'post_id' => 'required|integer',
        ]);

        $postId = $request->post_id;
        $total = array_sum($request->answers);

        session([
            'total_score' => $total,
            'post_id' => $postId,
        ]);

        return redirect()->route('quiz.result');
    }
}
