<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function (Request $request) {
    return inertia('Home', [
        'users' => User::when($request->search, function ($query) use ($request) {
            $query
                ->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        })->paginate(5)->withQueryString(),

        'searchTerm' => $request->search,

        'can' => [
            'delete_user' => Auth::user() ? Auth::user()->can('delete', User::class) : null
        ]
    ]);
})->name('home');

Route::middleware('auth')->group(function () {
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/posts', [PostController::class, 'create'])->name('create');

    Route::post('/posts/{post_id}', [CommentController::class, 'create'])->name('add_comment');

    Route::put('/posts/{post_id}', [CommentController::class, 'update'])->name('update_comment');
    Route::delete('/posts/{post_id}', [CommentController::class, 'destroy'])->name('delete_comment');
});

Route::middleware('guest')->group(function () {
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
});

Route::get('/posts', [PostController::class, 'show'])->name('posts');

Route::get('/posts/{post_id}', [PostController::class, 'open_post'])->name('open_post');
