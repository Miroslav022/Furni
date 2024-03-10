<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_name', 'bg_image', 'description', 'category_id'];
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function prices(){
        return $this->hasMany(Price::class)->latest("created_at")->limit(1);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function inventories(){
        return $this->belongsToMany(Inventory::class, 'product_inventory')->withPivot('quantity', 'id');
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
    public function materials(){
        return $this->belongsToMany(Material::class,'product_material')->withPivot('material_id');
    }

    public function specifications(){
        return $this->belongsToMany(Specification::class, 'product_specification')->withPivot('value', 'id');
    }
    public function recensions(){
        return $this->hasMany(Recension::class);
    }
    public function getProducts($request){
        $checkedCategories = $request->get('categories');
        $checkedSpecifications = $request->get('specifications');
        $search = $request->get('search');
        $sort = $request->get('sort');

//        dd(array_values($filterOptions['categories']));
        $query = DB::table('products')->join('prices', 'products.id', '=', 'prices.product_id');
        $query = $query->join("product_specification", 'products.id', '=', 'product_specification.product_id');

        $query = $query->join("specifications", 'specifications.id', '=', 'product_specification.specification_id');
        $query = $query->select("products.*", "products.id as products_id", "product_specification.*", "specifications.*", 'prices.*');
        if(isset($checkedCategories)){
            $query =$query->whereIn('category_id', $checkedCategories);
        }

        if(isset($checkedSpecifications)){
            $query = $query->whereIn('product_specification.specification_id', $checkedSpecifications);
        }
        if(isset($search)){
            $query = $query->where('product_name',"like", "%".$search."%");
        }

        if(isset($sort)){
            $sortOption = explode('-', $sort);
            $table = $sortOption[0] == 'created_at' ? 'products.' : 'prices.';
            $query =  $query->orderBy($table.''.$sortOption[0], $sortOption[1]);
        }

        $query = $query->where("products.is_deleted", 0);
        $query = $query->orderBy('prices.created_at', 'desc');

        $query = $query->paginate(9);
        return $query;

    }
}
