<?php

namespace App\Http\Controllers\User;

use App\Helpers\UserActivityLogger;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends OsnovniController
{
    /**
     * Display a listing of the resource.
     */
    public function getCart()
    {

        $userId = session()->get('user')->id;
        $activeCart = Cart::where(["user_id" => $userId, "is_purchased" => 0])->first();

        if (isset($activeCart)) {

            $cartProductsDB = CartItem::join('products', 'products.id', '=', 'cart_item.product_id')->join('prices', 'prices.id', '=', 'cart_item.price_id')->where("cart_id", $activeCart->id)->select('cart_item.*', 'cart_item.id as cart_item_id', 'products.*', 'prices.*')->get();
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

    public function index(Request $request)
    {
        $this->getCart();
        if($request->ajax()){
        return response()->json(['products'=>session()->get('cart')], 200);
        }
        return view("users.cart.cart", ['data' => $this->data]);
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
        $product_id = $request->input('product_id');
        if (!isset($product_id)) {
            return response()->json([], '500');
        }

        $userId = session()->get('user')->id;
        $activeCart = Cart::where(["user_id" => $userId, "is_purchased" => 0])->first();

        $product = Product::findOrFail($product_id);
        $cart_id = '';
        //Load cart from DB if exists
        if (isset($activeCart)) {
            $cart_id = $activeCart->id;
            $cartProductsDB = CartItem::join('products', 'products.id', '=', 'cart_item.product_id')->join('prices', 'prices.id', '=', 'cart_item.price_id')->where("cart_id",$activeCart->id)->get();
            $cart = [];
            foreach ($cartProductsDB as $item) {
                $cartItem = new \stdClass();
                $cartItem->product = $item;
                $cartItem->quantity = $item->quantity;
                $cartItem->inventory_id = $item->inventory_id;
                $cartItem->cart_id = $cart_id;
                array_push($cart, $cartItem);
            }
            session()->put('cart', $cart);
        } else {
            //If not create new one
            $newCart = Cart::create([
                "user_id" => $userId
            ]);
            $cart_id = $newCart->id;

        }

        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [];
        }

        $existInCart = null;
        foreach ($cart as $index => $item) {
            if ($item->product->product_id == $product_id) {
                $existInCart = $index;
                break;
            }
        }

        if ($existInCart !== null) {
            //update database
            $productToUpdate = CartItem::where('product_id', $product_id)->first();
            $productToUpdate->update([
                'quantity' => $cart[$existInCart]->quantity + 1,
            ]);

        } else {
            //Insert into database
            $cartItem = new \stdClass();
            $cartItem->quantity = $request->input('quantity') ?? 1;
            $cartItem->product = $product;
            $cartItem->cart_id = $cart_id;
            $cartItem->inventory_id = $request->input('inventory_id') ?? $product->inventories->first()->pivot->id;

            array_push($cart, $cartItem);
            $newItem = new CartItem();
            $newItem->cart_id = $cart_id;
            $newItem->product_id = $product_id;
            $newItem->price_id = $product->prices->first()->id;
            $newItem->inventory_id = $request->input('inventory_id') ?? $request->input('inventory_id') ?? $product->inventories->first()->id;
            $newItem->quantity = $request->input('quantity') ?? 1;
            $newItem->save();
        }

        UserActivityLogger::logActivity(__METHOD__, __CLASS__, "added product to cart");
        session()->put('cart', $cart);
        return response()->json([], 200);


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
        $itemToUpdate = CartItem::find($id);
        $itemToUpdate->update([
            'quantity' => $request->input('quantity')
        ]);

        UserActivityLogger::logActivity(__METHOD__, __CLASS__, "updated cart");

        return response()->json([], 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

//        session()->forget('cart');
        if (!isset($id)) {
            return response()->json([], 500);
        }

        $cart = session()->get('cart') ?? [];
        $itemToDelete = null;

        foreach ($cart as $index => $item) {
            if ($item->product->cart_item_id == $id) {
                $itemToDelete = $index;
                break;
            }
        }

        if ($itemToDelete !== null) {
            unset($cart[$itemToDelete]);
            session()->put('cart', $cart);
            $productToDelete = CartItem::where('id', $id)->first();
            $productToDelete->delete();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "deleted product from cart");
            return response()->json([], 204);
        }

        return response()->json([], 409);
    }
}
