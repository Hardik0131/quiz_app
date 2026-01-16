<?php

// use App\Http\Controllers\quiz_controller;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;

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

Route::get('quiz/category/create', [CategoryController::class, 'create'])->name('category.create');


Route::get('quiz/post/create', [PostController::class, 'create'])->name('post.create');
// Route::get('home', [PostController::class, 'index'])->name('posts.index');

Route::get('quiz/question/create', [QuestionController::class, 'create'])->name('question.create');
Route::post('quiz/question/store', [QuestionController::class, 'store'])->name('question.store');

Route::get('quiz/option/add', [OptionController::class, 'create'])->name('option.create');
Route::post('quiz/option/store', [OptionController::class, 'store'])->name('option.store');

Route::get('create/result', [PostController::class, 'index'])->name('result.index');
Route::post('store/result', [ResultController::class, 'store'])->name('result.store');

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