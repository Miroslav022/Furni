<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\User\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Mockery\Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('is_deleted', 0)->paginate(5);
        return view('admin.categories.categories', ['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.newCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $newCategory = new Category();
            $newCategory->category= $request->input('category');
            $newCategory->save();
            return redirect()->back()->with('success', 'You have successfully added new category');
        }catch (Exception){
            return redirect()->back()->with('error', 'Something is wrong.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('admin.categories.editCategory',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $categoryToEdit = Category::find($id);
            $categoryToEdit->category = $request->input('category');
            $categoryToEdit->save();
            return redirect()->back()->with('success', "Updated successfully");
        } catch (Exception){
            return redirect()->back()->with('error', "Something is wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::find($id);
            $category->is_deleted = 1;
            $category->save();
            return redirect()->back()->with('success', 'You have successfully deleted category');
        }catch (\Exception $e){
            dd($e);
        }

    }
}
