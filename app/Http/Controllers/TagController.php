<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manageUsers', User::class);
        $tag = Tag::all();
        return view('addTagsAndCategory.Tag')->with('tags', $tag);
    }


    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $this->authorize('manageUsers', User::class);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manageUsers', User::class);

        $tag = new Tag;

        $tag->create(
            [
                "name" => $request['title']
            ]
        );

        return redirect()->route('add.tags')->with("success", "tag add");
    }

    /**
     * Display the specified resource.
     */
    // public function show(Tag $tag)
    // {
        
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Tag $tag)
    // {
        
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Tag $tag)
    // {
    //     $this->authorize('manageUsers', User::class);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('manageUsers', User::class);

        $tag->delete();
        return redirect()->route('add.tags')->with("success", "tag deleted");
    }
}
