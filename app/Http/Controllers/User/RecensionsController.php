<?php

namespace App\Http\Controllers\User;


use App\Helpers\UserActivityLogger;
use App\Models\Recension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class RecensionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try {
            $recension = new Recension();
            $recension->user_id = session()->get('user')->id;
            $recension->product_id = $request->input('product_id');
            $recension->recension = $request->input('rewiew');
            $recension->title = $request->input('title');
            $recension->save();

            $recensionId = $recension->id;
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "write recension for product");

            return response()->json(['name'=>session()->get('user')->first_name .' '. session()->get('user')->last_name, "recension_id"=>$recensionId], 201);
        }catch (\Exception $e){
            Log::error($e);
            return response()->json([], 500);
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
        try {
            $recension = Recension::find($id);
            $recension->delete();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "deleted recension");

            return response()->json([], '204');

        }catch (Exception $e){
            Log::error($e);
            return response()->json([], '500');
        }
    }
}
