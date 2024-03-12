<?php

namespace App\Http\Controllers\User;

use App\Helpers\UserActivityLogger;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Location;
use App\Models\Material;
use App\Models\Order;
use App\Models\Product;
use App\Models\Specification;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $products->appends(['categories' => $checkedCategories, 'materials' => $checkedMaterials, 'search' => $search, 'sort' => $sort]);
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

    public function editUserForm(){
        $countries = Country::where('is_deleted', 0)->get();
        $city = City::where('is_deleted', 0)->get();
        $user = User::find(session()->get('user')->id);
        return view('users.user.edit',['data'=>$this->data, "user"=>$user, 'countries'=>$countries, 'cities'=>$city]);
    }

    public function editUser(Request $request,string $id){
        $data = $request->input();
        $user = User::find($id);
        try {
            $locationExist = false;
//            dd($request->input('address'));
            if($request->input('address')!==null) $locationExist = true;

            //Add location if user wants
            $locationId = null;
            if($locationExist){
                $newLocation = Location::find($user->location_id);
                $newLocation->address = $data['address'] ?? $newLocation->address;
                $newLocation->city_id = $data['city'] ?? $newLocation->city_id;
                $newLocation->save();
            }

            //edit user
            $user->first_name = $data['first_name'] ?? $user->first_name;
            $user->last_name = $data['last_name'] ?? $user->last_name;
            $user->username = $data['username'] ?? $user->username;
            $user->email = $data['email'] ?? $user->email;
            $user->password = md5($data['password']) ?? $user->password;
            $user->location_id = $user->location_id;
            $user->save();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Updated user");

            return redirect()->back()->with('success', 'You have successfully updated user');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'something is wrong');
        }
    }
    public function notFound(){
        return view('notfound');
    }
}
