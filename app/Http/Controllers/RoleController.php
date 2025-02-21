<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\RoleServices;
use Exception;
use App\Models\Role;

class RoleController extends Controller
{

    protected RoleServices $service;

    function __construct(RoleServices $service)
    {
        $this->service = $service;
    }

    public function manageRole(){
        $roles = Role::paginate(10);
        return view('role.manage-role', compact('roles'));
    }

    public function createRole(){
        return view('role.create-role');
    }

    public function storeRole(RoleRequest $request){
        try{
            $this->service->add($request->validated());
            return redirect()->route('manage-role')->with('message', 'Role added');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editRole($id){
        $role = Role::find($id);
        return view('role.edit-role', compact('role'));
    }

    public function updateRole(RoleRequest $request, $role){
        try{
            $this->service->update($request->validated(), $role);
            return redirect()->route('manage-role')->with('message', 'Role updated');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteRole($id){
        try{
            $this->service->delete($id);
            return redirect()->route('manage-role')->with('message', 'Role deleted');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
