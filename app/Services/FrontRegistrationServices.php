<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FrontRegistrationServices
{
    function add($request){
        $r = User::create([
            'name'          => $request['name'],
            'email'         => $request['email'],
            'password'      => bcrypt($request['password']),
            'role_id'       =>  3,
            'is_deletable'  =>  0,
        ]);

        Auth::logout();
        $user = User::find($r->id);
        Auth::login($user);

    }
}
