<?php

namespace App\Http\Controllers\User;

use App\Models\City;

class CityController extends Controller
{
    public function cities(string $id){
        if(!isset($id)) return response()->json([], 500);

        $cityModel = new City();
        $allCountryCities = $cityModel->getCountryCities($id);

        return response()->json(['cities'=>$allCountryCities], 200);

    }
}
