<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manageUsers', User::class);
        $categories = Category::all();
        return response()->json(["data" => $categories], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manageUsers', User::class);
        $request->validate([
            'name' => 'required | string',
        ]);
        $tag = new Tag();

        $tag->name = $request['name'];
        $tag->save();
        return response()->json(['message' => 'the tag added'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $this->authorize('manageUsers', User::class);

        $request->validate([
            'name' => 'required | string',
        ]);
        
        $tag->name = $request['name'];
        $tag->save();
        return response()->json(['message' => 'the tag updated'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('manageUsers', User::class);
        $tag->delete();
        return response()->json(['message' => 'the tag deleted'], 201);
    }
}
