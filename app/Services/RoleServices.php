<?php

namespace App\Services;

use App\Models\Role;
use Exception;

class RoleServices
{

    public function add($request){
        Role::create([
            'name' => $request['name'],
        ]);
    }

    function update($data, $role){
        $role = Role::find($role);
        $role->update($data);
    }

    function delete($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();
        } catch (Exception $e) {
            throw new Exception("Something was wrong.", 500);
        }
    }
}
