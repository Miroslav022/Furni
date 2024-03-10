<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Country;
use App\Models\Location;
use App\Models\Order;
use App\Models\ProductInventory;
use App\Models\ProductOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends OsnovniController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::where('is_deleted', 0)->get();
        $userLocation = Location::find(session()->get('user')->location_id);
        return view('users.checkout.checkout', ['data'=>$this->data, 'countries'=>$countries, "location"=>$userLocation]);
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
        //
        if(!session()->has('cart')) return redirect()->back();
        $cart = session()->get('cart');
        $totalPrice = 0;
//        dd($cart);
        foreach ($cart as $item){
            $totalPrice = $totalPrice + $item->product->price * $item->quantity;
        }
        try {
            DB::beginTransaction();
            $order = new Order();
            $order->user_id = session()->get('user')->id;
            $order->location_id = session()->get('user')->location_id;
            $order->total = $totalPrice;
            $order->save();

            $order_id = $order->id;
            foreach ($cart as $item){
                $order_item = new ProductOrder();
                $order_item->price_id = $item->product->price_id;
                $order_item->order_id = $order_id;
                $order_item->inventory_id = $item->inventory_id;
                $order_item->quantity = $item->quantity;
                $order_item->save();


                //Decrease item quantity from inventory;
                $product_inventory = ProductInventory::where('product_id', $item->product->product_id)->where("inventory_id", $item->inventory_id)->first();
//                dd($product_inventory);
                $product_inventory->quantity = $product_inventory->quantity - $item->quantity;
                $product_inventory->save();
            }

            $deactiveCart = Cart::find($cart[0]->cart_id);
            $deactiveCart->is_purchased=1;
            $deactiveCart->save();
            session()->remove('cart');

            DB::commit();
            return redirect()->route('login')->with('success', 'You have successfully created order!');


        } catch (\Exception $e){
            DB::rollback();
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

    public function changeLocation(Request $request) {
        try {
            $location = new Location();
            $location->address = $request->input('address');
            $location->city_id = $request->input('city');
            $location->save();
            $location_id = $location->id;


            $user = User::find(session()->get('user')->id);
            $user->location_id = $location_id;
            $user->save();

            session()->put('user', $user);

            return redirect()->back()->with('success', "You have successfully added a new shipping location");
        } catch (\Exception $e){
            return redirect()->back()->with('error', "Something is wrong");
        }
    }
}
