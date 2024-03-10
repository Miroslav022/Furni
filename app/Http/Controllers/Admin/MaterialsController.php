<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\User\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::where('is_deleted', 0)->paginate(5);
        return view('admin.materials.materials', ['materials'=>$materials]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.materials.newMaterial");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $material = new Material();
            $material->material = $request->input('material');
            $material->save();

            return redirect()->back()->with("success", "New material has been added successfully");
        } catch (\Exception $e){
            dd($e);
            return redirect()->back()->with("error", "Something is wrong");
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
        $material = Material::where('id',$id)->where('is_deleted',0)->first();
        return view('admin.materials.editMaterial',['material'=>$material]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $material = Material::find($id);
            $material->material = $request->input('material');
            $material->save();
            return redirect()->back()->with("success", "New material has been updated successfully");
        } catch (\Exception $e){
            dd($e);
            return redirect()->back()->with("error", "Something is wrong");

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $material = Material::find($id);
            $material->is_deleted = 1;
            $material->save();
            return redirect()->back()->with("success", "Material has been deleted successfully");
        } catch (\Exception $e){
            dd($e);
            return redirect()->back()->with("error", "Something is wrong");
        }
    }
}
