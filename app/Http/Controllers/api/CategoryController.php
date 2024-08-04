<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
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
            'image' => 'nullable |image | mimes:jpeg,jpg,png,gif'
        ]);
        $categoryData = new Category();
        if ($request->hasFile('image')) {
            $image = $request['image'];
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $categoryData->image = $imageName;
        } else {
            $categoryData->image = "";
        }
        $categoryData->name = $request['name'];
        $categoryData->save();
        return response()->json(['message' => 'the catgeory added'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('manageUsers', User::class);

        $request->validate([
            'name' => 'required | string',
            'image' => 'nullable |image | mimes:jpeg,jpg,png,gif'
        ]);
        if ($request->hasFile('image')) {
            $image = $request['image'];
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $category->image = $imageName;
        } else {
            $category->image = "";
        }
        $category->name = $request['name'];
        $category->save();
        return response()->json(['message' => 'the catgeory updated'], 201);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('manageUsers', User::class);
        $category->delete();
        return response()->json(['message' => 'the catgeory deleted'], 201);
    }
}
