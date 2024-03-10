<?php

namespace App\Http\Controllers\User;

class OsnovniController extends Controller
{
    public $data;

    public function __construct()
    {
        $this->data["menu"] = [
            [
                "name" => "Home",
                'route' => 'home'
            ],
            [
            "name" => "Shop",
            'route' => 'shop'
            ],
            [
                "name" => "About",
                'route' => 'about'
            ],
            [
                "name" => "Services",
                'route' => 'services'
            ],
//            [
//                "name" => "Blog",
//                'route' => 'blog'
//            ],
            [
                "name" => "Contact",
                'route' => 'contact'
            ],

        ];
    }


}
