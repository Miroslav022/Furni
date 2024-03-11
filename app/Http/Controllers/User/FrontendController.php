<?php

namespace App\Http\Controllers\User;

use App\Helpers\UserActivityLogger;
use App\Models\Category;
use App\Models\Material;
use App\Models\Order;
use App\Models\Product;
use App\Models\Specification;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontendController extends OsnovniController
{
    public function home(){
        $this->data['products'] = Product::where('is_deleted', 0)->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $testimonials = Testimonial::all();
        return view('users.Home.home', ['data' => $this->data, 'testimonials'=>$testimonials]);
    }

    public function shop(Request $request){
        $productsModel = new Product();
        $products = $productsModel->getProducts($request);

        $checkedCategories = $request->get('categories');
        $checkedSpecifications = $request->get('specifications');
        $search = $request->get('search');
        $sort = $request->get('sort');
        $checkedMaterials = $request->get('materials');


        $categories = Category::all();
        $specifications = Specification::all();
        $materials = Material::all();

        return view("users.shop.shop", ['data'=>$this->data,"materials"=>$materials, "checkedMaterials"=>$checkedMaterials, "products"=>$products, "specifications"=>$specifications, "categories"=>$categories, 'checkedCat'=>$checkedCategories, 'search'=>$search]);
    }

    public function about(){
        $testimonials = Testimonial::all();

        return view('users.about.index', ['data' => $this->data, 'testimonials'=>$testimonials]);

    }

    public function orders(){
        $orders = Order::where('user_id', session()->get('user')->id)->get();
        return view('users.myorders.orders', ['data' => $this->data, "orders"=>$orders]);
    }


    public function contact(){
        return view('users.contact.index', ['data' => $this->data]);
    }
    public function notFound(){
        return view('notfound');
    }
}
