<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\PermissionRoleModel;
use App\Models\PermissionRouteModel;
use Exception;
use Illuminate\Support\Carbon;

class PermissionServices
{
    /**
     * Create a new class instance.
     */
    public function add($request){
        Permission::create([
            'name' => $request['name'],
        ]);
    }

    function update($data, $role){
        $role = Permission::find($role);
        $role->update($data);
    }

    function delete($id)
    {
        try {
            $role = Permission::findOrFail($id);
            $role->delete();
        } catch (Exception $e) {
            throw new Exception("Something was wrong.", 500);
        }
    }

    function assignNewPermissionRole($request){

        PermissionRoleModel::create([
            'role_id' => $request['role'],
            'permission_id' => $request['permission'],
        ]);
    }


    function PermissionToRoleDeleteAndInsert($id, $roles){

        try{
            PermissionRoleModel::where('permission_id', $id)->delete();

            foreach($roles as $role){
                PermissionRoleModel::insert([
                    'permission_id' => $id,
                    'role_id' => $role,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

        }catch(Exception $e){
            throw new Exception($e->getMessage(),500);
        }

    }


    function permissionToRoleDeleteAndDelete($id){

        try {
            PermissionRoleModel::where('permission_id', $id)->delete();
        }catch(Exception $e){
            throw new Exception($e->getMessage(), 500);
        }

    }


    function permissionToRouteAdd($request){
        PermissionRouteModel::create([
            'permission_id' => $request['permission'],
            'router' => $request['route'],
        ]);
    }

    function editPermissionToRoute($permission_id, $route, $id){
        try{
            $permission_route = PermissionRouteModel::find($id);

            $permission_route->update([
                'permission_id' => $permission_id,
                'router' => $route,
            ]);



        }catch(Exception $e){
            throw new Exception($e->getMessage(),500);
        }
    }


    function permissionToRouteDelete($id){

        try {
            PermissionRouteModel::where('id', $id)->delete();
        }catch(Exception $e){
            throw new Exception($e->getMessage(), 500);
        }

    }
}
