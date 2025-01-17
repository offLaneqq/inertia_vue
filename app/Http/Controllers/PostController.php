<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

    public function show(Request $request)
    {

        $users = User::with('posts')->get();

        $isAuth = $request->user()->id ?? null;

        return Inertia::render('Posts', [
            'users' => $users,
            'isAuth' => $isAuth,
        ]);

    }

    public function create(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        Post::create([
            'content' => $request->content,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->intended('posts');
    }


}
