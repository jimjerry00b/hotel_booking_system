<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequestFrontend;
use App\Http\Requests\SearchRequest;
use App\Models\RoomModel;
use App\Models\User;
use App\Services\FrontRegistrationServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{

    protected FrontRegistrationServices $service;

    function __construct(FrontRegistrationServices $service)
    {
        $this->service = $service;
    }


    public function home(){
        return view('frontend.home');
    }

    public function registration(RegistrationRequestFrontend $request){
        try{
            $this->service->add($request->validated());
            return redirect()->route('home')->with('message', 'Registration completed');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function user_registration(){
        return view('frontend.user-registration');
    }

    public function getInfo(SearchRequest $request){
        try{
            $request->session()->put('check_in', $request->check_in);
            $request->session()->put('check_out', $request->check_out);
            $request->session()->put('room_id', $request->room_id);

            $request->validated();
            $results = RoomModel::where('is_available', 1)
            ->where('capacity', $request['guest'])
            ->get();

            return view('frontend.search', compact('results'));
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
