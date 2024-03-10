<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\User\Controller;
use App\Models\ProductInventory;
use Illuminate\Http\Request;
use Mockery\Exception;

class ProductInventoryController extends Controller
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
            $data = $request->all()['formData'];

            //Delete all data

            ProductInventory::where('product_id', $data[0]['product_id'])->delete();

//            dd($data);

            foreach ($data as $key=>$item){
                $prod_inv = new ProductInventory();
                $prod_inv->inventory_id = $item['inventory_id'];
                $prod_inv->product_id = $item['product_id'];
                $prod_inv->quantity = $item['quantity'];
                $prod_inv->save();
            }

//            ProductInventory::insert($data);
            return response()->json([], 201);
        } catch (Exception $e){
            dd($e);
            return response()->json([], 500);

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
        try {
            $inventory = ProductInventory::find($id);
            if($inventory){
                $inventory->delete();
                return response()->json([], 204);
            }
        } catch (\Exception $e){
            return response()->json([], 500);
        }
    }
}
