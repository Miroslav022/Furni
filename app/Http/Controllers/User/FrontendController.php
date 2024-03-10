<?php

namespace App\Http\Controllers\User;

use App\Helpers\UserActivityLogger;
use App\Models\Category;
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
        UserActivityLogger::logActivity(__METHOD__, __CLASS__);

        return view('users.Home.home', ['data' => $this->data, 'testimonials'=>$testimonials]);
    }

    public function shop(Request $request){
        $productsModel = new Product();
        $products = $productsModel->getProducts($request);

        $checkedCategories = $request->get('categories');
        $checkedSpecifications = $request->get('specifications');
        $search = $request->get('search');
        $sort = $request->get('sort');


        $categories = Category::all();
        $specifications = Specification::all();
        return view("users.shop.shop", ['data'=>$this->data, "products"=>$products, "specifications"=>$specifications, "categories"=>$categories, 'checkedCat'=>$checkedCategories,'checkedSpec'=>$checkedSpecifications, 'search'=>$search]);
    }

    public function about(){
        return view('users.about.index', ['data' => $this->data]);

    }

    public function services(){
        return view('users.services.index', ['data' => $this->data]);

    }

    public function contact(){
        return view('users.contact.index', ['data' => $this->data]);
    }
    public function notFound(){
        return view('notfound');
    }
}
