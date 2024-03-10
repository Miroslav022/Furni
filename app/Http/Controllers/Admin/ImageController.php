<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\UserActivityLogger;
use App\Http\Controllers\User\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Mockery\Exception;

class ImageController extends Controller
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
            $image = Image::find($id);
            $image->delete();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Deleted product image");

            return response()->json([], 204);
        } catch (Exception $e){
            return response()->json([], 500);
        }
    }
}
