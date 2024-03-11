<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UserActivityLogger;
use App\Http\Controllers\User\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Mockery\Exception;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::where('is_deleted', 0)->paginate(5);
        return view("admin.cities.cities", ['cities'=> $cities]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::where('is_deleted', 0)->get();
        return view("admin.cities.newCity", ['countries'=>$countries]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        try {
            $newCity = new City();
            $newCity->city = $request->input('city');
            $newCity->country_id = $request->input('country');
            $newCity->save();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Add new city");

            return redirect()->back()->with("success", "You have successfully added new city");
        }catch (Exception){
            return redirect()->back()->with("error", "Something is wrong");
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
        $city=City::find($id);
        $countries = Country::where('is_deleted', 0)->get();
        return view("admin.cities.editCity",['city'=>$city, "countries"=>$countries]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, string $id)
    {
        try {
            $cityToEdit = City::find($id);
            $cityToEdit->city=$request->input('city');
            $cityToEdit->country_id=$request->input('country');
            $cityToEdit->save();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Updated city");

            return redirect()->back()->with('success', "Updated successfully");
        } catch (\Exception){
            return redirect()->back()->with('error', "Something is wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $city = City::find($id);
            $city->is_deleted = 1;
            $city->save();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Deleted city");

            return redirect()->back()->with('success', 'You have successfully deleted city');
        }catch (\Exception $e){
            dd($e);
        }
    }
}
