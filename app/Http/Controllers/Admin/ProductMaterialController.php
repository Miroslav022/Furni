<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\User\Controller;
use App\Models\ProductMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try {
            $data = $request->input();
            //Delete all materials for specific product
            $all =  DB::table('product_material')->where('product_id', $data['product_id'])->delete();

            $dataToInsert = $data['materials'];

            foreach ($dataToInsert as $material){
                $product_material = new ProductMaterial();
                $product_material->product_id = $data['product_id'];
                $product_material->material_id = $material;
                $product_material->save();
            }
            return redirect()->back()->with('success', "You have successfully added materials for products");
        } catch (\Exception $e){
            dd($e);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
