<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\User\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Location;
use App\Models\ProductInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::where('is_deleted', 0)->paginate(5);
        return view('admin.inventories.inventory',['inventories'=>$inventories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::where('is_deleted', 0)->get();
        return view('admin.inventories.newInventory', ['countries'=>$countries]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->input();
            $newLocation = new Location();
            $newLocation->address = $data['address'];
            $newLocation->city_id = $data['city'];
            $newLocation->save();
            $locationId = $newLocation->id;

            $inventory = new Inventory();
            $inventory->location_id = $locationId;
            $inventory->save();

            DB::commit();
            return redirect()->back()->with('success', "Inventory has been successfully added");

        } catch (\Exception $e){
            DB::rollBack();
            dd($e);
            return redirect()->back()->with('error', "Something is wrong");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $countries = Country::where("is_deleted", 0)->get();
        $location = Location::find($id);
        $cities = City::where("is_deleted", 0)->where('country_id',$location->city->country->id)->get();
        return view("admin.inventories.editInventory", ['countries'=>$countries,'cities'=>$cities ,'location'=>$location]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $location = Location::find($id);
            $location->address = $request->input('address') ?? $location->address;
            $location->city_id = $request->input('city') ?? $location->city_id;
            $location->save();
            return redirect()->back()->with('success', "You have successfully updated inventory location");
        } catch (\Exception $e){
            dd($e);
            return redirect()->back()->with('error', 'something is wrong');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $inventory = Inventory::find($id);
            if($inventory){
                $inventory->is_deleted=1;
                $inventory->save();
                return redirect()->back()->with('success', 'Deleted successfully');
            }
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Something is wrong');
        }
    }
}
