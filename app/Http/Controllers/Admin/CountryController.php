<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UserActivityLogger;
use App\Http\Controllers\User\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Mockery\Exception;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::where('is_deleted', 0)->paginate(5);
        return view('admin.countries.countries', ['countries'=>$countries]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.countries.newCountry");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        try {
            $newCountry = new Country();
            $newCountry->country= $request->input('country');
            $newCountry->save();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Add new country");

            return redirect()->back()->with('success', 'You have successfully added new country');
        }catch (Exception){
            return redirect()->back()->with('error', 'Something is wrong.');
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
        $country = Country::find($id);
        return view('admin.countries.editCountry', ['country'=>$country]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, string $id)
    {
        try {
            $country = Country::find($id);
            $country->country = $request->input('country');
            $country->save();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Updated country");

            return redirect()->back()->with(['success' => 'Updated successfully']);
        }catch (Exception){
            return redirect()->back()->with(['error' => 'Something is wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $country = Country::find($id);
            $country->is_deleted = 1;
            $country->save();
            UserActivityLogger::logActivity(__METHOD__, __CLASS__, "Deleted country");

            return redirect()->back()->with('success', 'You have successfully deleted country');
        }catch (\Exception $e){
            dd($e);
        }
    }
}
