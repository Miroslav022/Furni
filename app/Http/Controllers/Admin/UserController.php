<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\User\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Location;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('is_deleted', 0)->paginate(5);
        return view('admin.users.users', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('is_deleted', 0)->get();
        $countries = Country::where('is_deleted', 0)->get();
        return view('admin.users.newUser', ['roles'=>$roles, "countries"=>$countries]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->input();
        try {
            $locationExist = false;
//            dd($request->input('address'));
            if($request->input('address')!==null) $locationExist = true;

            //Add location if exist
            $locationId = null;
            if($locationExist){
                $newLocation = new Location();
                $newLocation->address = $data['address'];
                $newLocation->city_id = $data['city'];
                $newLocation->save();
                $locationId = $newLocation->id;
            }

            //adding new user
            $newUser = new User();
            $newUser->first_name = $data['first_name'];
            $newUser->last_name = $data['last_name'];
            $newUser->username = $data['username'];
            $newUser->email = $data['email'];
            $newUser->password = md5($data['password']);
            $newUser->role_id = $data['role'];
            $newUser->location_id = $locationId;
            $newUser->save();

            return redirect()->back()->with('success', 'You have successfully added new user');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'something is wrong');
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
        $user = User::find($id);
        $roles = Role::all();
        $countries = Country::where('is_deleted',0)->get();
        $cities = City::where('is_deleted',0)->where('country_id',$user->location->city->country_id)->get();
        return view('admin.users.editUser',['user'=>$user, "roles"=>$roles, "countries"=>$countries, 'cities'=>$cities]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
            $user->role_id = $data['role'] ?? $user->role;
            $user->location_id = $user->location_id;
            $user->save();

            return redirect()->back()->with('success', 'You have successfully updated user');
        } catch (\Exception $e) {
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
            $user = User::find($id);
            $user->is_deleted = 1;
            $user->save();
            return redirect()->back()->with('success', 'You have successfully deleted user');
        }catch (\Exception $e){
            dd($e);
        }
    }
}
