<?php

namespace App\Http\Controllers;

use App\Services\AdminServices;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    protected AdminServices $service;

    function __construct(AdminServices $service)
    {
        $this->service = $service;
    }

    public function login(){
        return view('admin.login');
    }

    public function admin_login_post(AdminRequest $request){
        $result = $this->service->login($request);

        if($result){
            return redirect()->route('dashboard')->with('message', 'Login successfully');
        }

        return redirect()->route('login')->with('error', 'Credentials not matched');
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function users(){
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    }

    public function add_new(){
        return view('admin.add_new');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('message', 'Login out successful');
    }

    public function add_new_post(RegistrationRequest $request){
        try {
            $this->service->add_new($request->validated());
            return redirect()->route('users')->with('message', 'Successfully added.');
        } catch (Exception $e){
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

