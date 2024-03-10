<?php

namespace App\Http\Controllers\User;

use App\Helpers\UserActivityLogger;
use App\Http\Requests\RegistrationRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Country;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends OsnovniController
{
    public function getCart()
    {

        $userId = session()->get('user')->id;
        $activeCart = Cart::where(["user_id" => $userId, "is_purchased" => 0])->first();

        if (isset($activeCart)) {

            $cartProductsDB = CartItem::join('products', 'products.id', '=', 'cart_item.product_id')->join('prices', 'prices.id', '=', 'cart_item.price_id')->select('cart_item.*', 'cart_item.id as cart_item_id', 'products.*', 'prices.*')->get();
//            dd($cartProductsDB);
            $cart = [];
            foreach ($cartProductsDB as $item) {
                $cartItem = new \stdClass();
                $cartItem->product = $item;
                $cartItem->quantity = $item->quantity;
                $cartItem->inventory_id = $item->inventory_id;
                $cartItem->cart_id = $activeCart->id;
                array_push($cart, $cartItem);
            }
            session()->put('cart', $cart);
        }
    }
    public function login(){
        return view('users.authentication.login', ['data'=>$this->data]);
    }

    public function registration(){
        $countries = Country::all();
        return view('users.authentication.registration', ['data'=>$this->data, 'countries'=>$countries]);
    }

    public function createUser(RegistrationRequest $request){
        $data = $request->all();
//        dd($data);
        $user = new User();
        $location = new Location();


        try {
            DB::beginTransaction();

//            dd($request->input());

            $location->city_id = $data['city'];
            $location->address = $data['address'];
            $location->save();
            $locationId = $location->id;


            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->username = $data['username'];
            $user->email = $data['email'];
            $user->location_id = $locationId;
            $user->role_id = 2;
            $user->password = md5($data['password']);
            $user->save();

            DB::commit();

            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "created account");
            return redirect()->route('login')->with('success', 'You have successfully created an account. Please log in!');


        }catch (\Exception $e){
            DB::rollBack();
            Log::error($e);
            return redirect()->back()->with('error', 'An error occurred while creating the account. Please try again.');
        }

    }

    public function loginUser(Request $request){
        $userData = $request->input();
        try {
            if($userData['email']===null || $userData['password'] === null) {
                return redirect()->back()->with("error", "Please populate all fields.");
            };

            $user = DB::table('users')->where('email', $userData['email'])->first();
            if(!$user) {
                return redirect()->back()->with("error", "Wrong credentials.");
            }
            if($user->password !== md5($userData['password'])) {
                return redirect()->back()->with("error", "Wrong credentials.");
            }
            $request->session()->put('user',$user);
            $user->isAdmin = $user->role_id ==1;

            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "logged in");


            $this->getCart();
            if($user->isAdmin){
                return redirect()->route('adminpage');
            }else{
                return redirect()->route('home');
            }
        }catch (\Exception $e){
            Log::error($e);
        }

    }

    public function logout(){
        if(session()->has("user")) {
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "logged out");
            session()->remove('user');
            session()->remove('cart');
            return redirect()->route('home');
        } else {
            return redirect()->back();
        }
    }
}
