<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminServices
{
    function login($request){

        $request->validated();
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)){
            return true;
        }
        return false;
    }

    function add_new($request){
        User::create([
            'name'          => $request['name'],
            'email'         => $request['email'],
            'password'      => bcrypt($request['password']),
            'role_id'       =>  $request['role_id'],
            'is_deletable'  =>  1,
        ]);

    }
}
