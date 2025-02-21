<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\User;
use App\Services\AdminServices;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected AdminServices $service;

    function __construct(AdminServices $service)
    {
        $this->service = $service;
    }

    public function index(AdminRequest $request){

        $result = $this->service->login($request);

        if($result){
            $user = Auth::user();
            return $user->createToken('mytoken')->accessToken;
        }

        return response()->json([
            'status' => false,
            'message'  => "Credentials not matched"
        ], 500);
    }


    public function list(){
        $all = User::all();

        if($all){
            return response()->json([
                'status' => true,
                'message'  => $all
            ], 500);
        }


        return response()->json([
            'status' => false,
            'message'  => "Not found"
        ], 500);
    }
}
