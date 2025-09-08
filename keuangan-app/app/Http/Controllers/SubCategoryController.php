<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::all();
        return view('sub_categories.index', compact('subCategories'));
    }

    public function create()
    {
        return view('sub_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:sub_categories']);
        SubCategory::create($request->all());
        return redirect()->route('sub-categories.index')->with('success', 'SubCategory created successfully.');
    }

    public function edit(SubCategory $subCategory)
    {
        return view('sub_categories.edit', compact('subCategory'));
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate(['name' => 'required|string|max:255|unique:sub_categories,name,' . $subCategory->id]);
        $subCategory->update($request->all());
        return redirect()->route('sub-categories.index')->with('success', 'SubCategory updated successfully.');
    }

    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->route('sub-categories.index')->with('success', 'SubCategory deleted successfully.');
    }
}