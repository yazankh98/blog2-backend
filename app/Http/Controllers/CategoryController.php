<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manageUsers', User::class);
        $Category = Category::all();
        return view('addTagsAndCategory.Category')->with('Categories', $Category);
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

        $this->authorize('manageUsers', User::class);

        $request->validate([
            'title' => 'required | string',
            'image' => 'nullable |image | mimes:jpeg,jpg,png,gif'
        ]);
        $Category = new Category;
        if ($request->has('image')) {
            $image = $request['image'];
            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = "";
        }
        $Category->create(
            [
                "name" => $request['title'],
                "post_id" => null,
                'image' => $imageName
            ]
        );

        return redirect()->route('add.category')->with("success", "Category add");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('manageUsers', User::class);
        return view('addTagsAndCategory.CategoryEdit', compact(['category']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required | string',
            'image' => 'nullable |image | mimes:jpeg,jpg,png,gif'
        ]);
        $imageName = $category->image;
        if ($request->hasFile('image')) {
            $image = $request['image'];
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }
        $categoryData = ([
            "name" => $request['title'],
            "post_id" => null,
            'image' => $imageName
        ]);
        $category->update($categoryData);
        return redirect()->route('add.category')->with("success", "category update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('add.category')->with("success", "category deleted");
    }
}
