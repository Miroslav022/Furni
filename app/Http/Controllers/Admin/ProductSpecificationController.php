<?php

namespace App\Http\Controllers\admin;


use App\Helpers\UserActivityLogger;
use App\Http\Controllers\User\Controller;
use App\Models\ProductSpecification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
                UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Added new product specification");

            }
            return redirect()->back()->with('success', 'You have successfully applied new specifications');
        } catch (\Exception $e){
            Log::error($e);
            return redirect()->back()->with('error', 'Something is wrond');

        }
    }
    public function destroy($id)
    {
        try {
            $prod_spec_toDelete = ProductSpecification::find($id);
            $prod_spec_toDelete->delete();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Deleted product specification");

            return response()->json([], 204);

        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([], 500);
        }
    }
}
