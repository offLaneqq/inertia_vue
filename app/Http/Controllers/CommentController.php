<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{
//     private function getUsers() {
//         return User::with('comments')->get();
//     }

    public function create(Request $request) {
        $request->validate([
            'content' => 'required|string|max:200'
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' => $request->user()->id,
            'post_id' => $request->post_id,
        ]);

        return redirect()->back();
    }
}