<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "comment" => 'required|string'
        ]);
        $comment = new Comment;
        $user_id = Auth::user()->id;
        $post_id = $request->route('id');
        $data = [
            "name" => $request['comment'],
            "user_id" => $user_id,
            "post_id" => $post_id
        ];
        $comment->create($data);
        return redirect()->route('posts.home')->with('sucsess', 'added comment');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $this->authorize('edit', $comment);
        return view('editComment')->with('comment', $comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        $request->validate([
            'name' => 'string'
        ]);
        $data = [
            'name' => $request['commentUpdate']
        ];

        $comment->update($data);
        return redirect()->route('posts.home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('posts.home')->with('success', 'comment deleted');
    }
}
