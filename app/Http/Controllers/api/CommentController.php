<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::all();
        return response()->json(['comments' => $comments]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "comment" => 'required|string|max:255'
        ]);
        $user = User::where('remember_token', $request->bearerToken())->first();
        $post_id = $request->id;
        $comment = new Comment();
        $comment->name = $request['comment'];
        $comment->user_id = $user->id;
        $comment->post_id = $post_id;
        $comment->save();
        return response()->json(['message' => 'comment created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        $request->validate([
            "comment" => 'string|max:255'
        ]);
        $comment->name = $request['comment'];
        $comment->save();
        return response()->json(['message'=>'the comment update']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(['message'=>'the comment deleted']);
    }
}
