<?php

// use App\Http\Controllers\quiz_controller;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResultController;
use App\Models\Question;
use Illuminate\Support\Facades\Route;
use PHPUnit\Metadata\PostCondition;

// Route::get('/', function () {
//     return view('front/quiz');
// })->name('front.quiz');

// Route::get('/result', function(){
//     return view('result');
// })->name('result.page');

Route::prefix('v1')->group(function () {
    Route::get('category/search', [CategoryController::class, 'search'])->name('admin.category.search');
});

Route::post('quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::get('quiz/result', [ResultController::class, 'result'])->name('quiz.result');

// Route::get('/home', function(){
//     return view('front/home');
// });

Route::get('/home', [CategoryController::class, 'index'])->name('category.index');
Route::get('/home/{name}', [CategoryController::class, 'categoryPost'])->name('category.post');

Route::get('category/{category_name}/post/{post_name}', [CategoryController::class, 'postQuestion'])->name('post.questions');


Route::get('/admin/category', [CategoryController::class, 'display'])->name('admin.category.display');
Route::get('admin/addcategory', [CategoryController::class, 'addCategory'])->name('admin.category.addCategory');
Route::post('admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
Route::get('/admin/category/edit/{category}', [CategoryController::class, 'edit'])->name('admin.category.edit');
Route::put('admin/category/update/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
Route::delete('admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.delete');


// for a Posts 

Route::get('admin/posts', [PostController::class, 'displayPost'])->name('admin.post.display');
Route::get('admin/addpost', [PostController::class, 'addPost'])->name('admin.post.addPost');
Route::post('admin/posts/store', [PostController::class, 'store'])->name('admin.post.store');
Route::get('admin/posts/edit/{post}', [PostController::class, 'edit'])->name('admin.post.edit');
Route::put('admin/posts/update/{post}', [PostController::class, 'update'])->name('admin.post.update');
Route::delete('admin/posts/delete/{post}', [PostController::class, 'destroy'])->name('admin.post.delete');

// for a questions

Route::get('admin/questions', [QuestionController::class, 'displayQuestion'])->name('admin.question.display');
Route::get('admin/addQuestion', [QuestionController::class, 'addQuestion'])->name('admin.question.addQuestion');
Route::post('admin/questions/store', [QuestionController::class, 'store'])->name('admin.question.store');
Route::get('admin/questions/edit/{question}', [QuestionController::class, 'edit'])->name('admin.question.edit');
Route::put('admin/questions/update/{question}', [QuestionController::class, 'update'])->name('admin.question.update');
Route::delete('admin/questions/delete/{question}', [QuestionController::class, 'destroy'])->name('admin.question.delete');

Route::get('admin/getPostByCategory', [PostController::class, 'getPostByCategory'])->name('admin.getPostByCategory');