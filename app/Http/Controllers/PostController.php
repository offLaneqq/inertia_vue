<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

    private function getUsers() {
        return User::with('posts')->get();
    }

    public function show(Request $request)
    {

        $users = $this->getUsers();

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

    public function open_post(Request $request) {

        $post_id = $request->post_id;

        $idAuth = $request->user()->id ?? null;

        $post = Post::with('user', 'comments.user')->findOrFail($post_id);

        return Inertia::render('Post', [
            'post' => $post,
            'user' => $post->user,
            'comments' => $post->comments,
            'idAuth' => $idAuth,
        ]);

    }

}
