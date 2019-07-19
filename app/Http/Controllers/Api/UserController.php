<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function store(Request $request)
    {
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->post_code = $request->post_code;
        $user->contact_phone_number = $request->contact_phone_number;
        $user->password = $request->password;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return response( $user, 200)
            ->header('Content-Type', 'text/plain');
    }
}
