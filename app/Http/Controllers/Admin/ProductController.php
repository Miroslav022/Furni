<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\User\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Inventory;
use App\Models\Material;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ProductMaterial;
use App\Models\ProductSpecification;
use App\Models\Specification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('is_deleted', 0)->paginate(5);
        return view('admin.products.products', ['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where("is_deleted", 0)->get();
        $materials = Material::where('is_deleted', 0)->get();
        $inventories = Inventory::where('is_deleted', 0)->get();
        $specifications = Specification::where('is_deleted',0)->get();
        return view("admin.products.newProduct", ['categories'=>$categories, 'materials'=>$materials, 'specifications'=>$specifications, 'inventories'=>$inventories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->input();
//        dd($request->all());
            $bg_img = $request->file("bg_image");

            $fileName = uniqid() . "_" . time() . "." . $bg_img->extension();

            $bg_img->storeAs("public/products", $fileName);

            $dataForProductsTable = [];
            $dataForProductsTable['product_name'] = $data['product_name'];
            $dataForProductsTable['description']= $data['description'];
            $dataForProductsTable['category_id']= $data['category'];
            $dataForProductsTable['bg_image']= $fileName;
            $newProduct = Product::create($dataForProductsTable);
            $product_id = $newProduct->id;

            //prices
            $price = new Price();
            $price->price = $data['price'];
            $price->is_active = 1;
            $price->product_id = $product_id;
            $price->save();

            //images
            $images = $request->file('images');
            $sources = [];
            foreach ($images as $image){
                $imgName = uniqid() . "_" . time() . "_" . $image->extension();
                $image->store("public/products", $imgName);
                $sources[] = [
                    'src'=>$imgName,
                    'product_id'=>$product_id,
                    'created_at' => now(),
                    'updated_at' => now()

                ];

            }
            Image::insert($sources);


            //inventory product
            $invProduct = new ProductInventory();
            $invProduct->product_id = $product_id;
            $invProduct->quantity= $data['quantity'];
            $invProduct->inventory_id = $data['inventory'];
            $invProduct->save();

            //Materials
            $materials = $data['materials'];
            $materialsData = [];
            foreach ($materials as $material){
                $materialsData[] = [
                    'material_id' =>$material,
                    'product_id'=>$product_id,
                    'created_at' => now(),
                    'updated_at' => now()];
            }
            ProductMaterial::insert($materialsData);

            //Specifications
            $specifications = $data['specifications'];
            foreach ($specifications as $specification){
                $product_spec = new ProductSpecification();
                $product_spec->product_id = $product_id;
                $product_spec->specification_id = $specification['id'];
                $product_spec->value = $specification['value'];
                $product_spec->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'You have successfully added new product');


        } catch (\Exception $e){
            DB::rollBack();

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
        $product = Product::find($id);
        $categories = Category::where('is_deleted', 0)->get();
        $inventories = Inventory::where('is_deleted', 0)->get();
        $materials = Material::where('is_deleted', 0)->get();
        $specifications = Specification::where('is_deleted', 0)->get();

        $checkedMaterials = [];
        foreach ($product->materials->toArray() as $material){
            $checkedMaterials[] = $material['id'];
        }
        return view('admin.products.editProduct', ['product'=>$product, 'categories'=>$categories, 'inventories'=>$inventories, 'materials'=>$materials, 'specifications'=>$specifications, 'checkedMaterials'=>$checkedMaterials]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $product = Product::find($id);

            //bg image handling
            if($request->file('bg_image')){
                $bg_img = $request->file("bg_image");
                $fileName = uniqid() . "_" . time() . "." . $bg_img->extension();
                $bg_img->move("products", $fileName);
            }


            DB::beginTransaction();
            $product->product_name = $request->input('product_name') ?? $product->product_name;
            $product->category_id = $request->input('category_id') ?? $product->category_id;
            $product->description = $request->input('description') ?? $product->description;
            $product->bg_image = $fileName ?? $product->bg_image;
            $product->save();

            if($request->file('images')){
                foreach ($request->file('images') as $image) {
                    $imgName = uniqid() . "_" . time() . "_" . $image->extension();
                    $image->move("products", $imgName);
                    $sources[] = [
                        'src'=>$imgName,
                        'product_id'=>$id,
                        'created_at' => now(),
                        'updated_at' => now()

                    ];
                }
                Image::insert($sources);
            }

            if($request->input('price') && $request->input('price')!==$product->prices->first()->price){
                $price = new Price();
                $price->price = $request->input('price');
                $price->product_id = $id;
                $price->is_active = 1;
                $price->save();
            }
            DB::commit();
            return redirect()->back()->with("success", "Updated successfully");

        }catch (\Exception $e){
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);
            $product->is_deleted = 1;
            $product->save();
            return redirect()->back()->with('success', 'You have successfully deleted product');
        }catch (\Exception $e){
            dd($e);
        }
    }
}
