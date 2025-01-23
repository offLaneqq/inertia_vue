<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{

    public function create(Request $request)
    {
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

    public function update(Request $request, $post_id)
    {

        
        $request->validate([
            'content' => 'required|string|max:200',
            'comment_id' => 'required|integer'
        ]);

        $comment = Comment::where('post_id', $post_id)->findOrFail($request->comment_id);

        if ($request->user()->can('update', $comment)) {
            $comment->update([
                'content' => $request->content
            ]);
        }

        return redirect()->route('open_post', ['post_id' => $post_id]);
    }

    public function destroy(Request $request, $post_id)
    {
        $request->validate([
            'comment_id' => 'required|integer'
        ]);

        $comment = Comment::where('post_id', $post_id)->findOrFail($request->comment_id);

        if ($request->user()->can('delete', $comment)) {
            $comment->delete();
        }

        return redirect()->route('open_post', ['post_id' => $post_id])->with('greet', 'Comment was deleted.');
    }
}