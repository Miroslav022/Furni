<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\UserActivityLogger;
use App\Http\Controllers\User\Controller;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.orders', ['orders'=>$orders]);
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
        $statuses = Status::all();
        $order = Order::find($id);
        return view('admin.orders.editOrder',['statuses'=>$statuses, 'order'=>$order]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'status'=>'required|exists:statuses,id'
            ]);
            $order = Order::find($id);
            $order->status_id = $request->input('status');
            $order->save();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Updated order status");

            return redirect()->back()->with('success', 'Updated successfully');

        } catch (Exception $e){
            Log::error($e);
            return redirect()->back()->with('error', 'something is wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
