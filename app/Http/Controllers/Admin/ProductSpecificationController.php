<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\User\Controller;
use App\Models\ProductSpecification;
use Illuminate\Http\Request;

class ProductSpecificationController extends Controller
{
    public function store(Request $request){
        $data = $request->input();
        try {
            //delete all specifications
            ProductSpecification::where('product_id',$data['product_id'])->delete();

            foreach ($data['specifications'] as $spec){
                $newProdSpec = new ProductSpecification();
                $newProdSpec->product_id = $data['product_id'];
                $newProdSpec->specification_id = $spec['id'];
                $newProdSpec->value = $spec['value'];
                $newProdSpec->save();
            }
            return redirect()->back()->with('success', 'You have successfully applied new specifications');
        } catch (\Exception $e){
            dd($e);
            return redirect()->back()->with('error', 'Something is wrond');

        }
    }
    public function destroy($id)
    {
        try {
            $prod_spec_toDelete = ProductSpecification::find($id);
            $prod_spec_toDelete->delete();
            return response()->json([], 204);

        } catch (\Exception $e) {
            dd($e);
            return response()->json([], 500);
        }
    }
}
