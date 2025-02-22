<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Http\Requests\PermissionRoleRequest;
use App\Http\Requests\PermissionToRoleRequest;
use App\Http\Requests\PermissionToRouteRequest;
use App\Models\Permission;
use App\Models\PermissionRoleModel;
use App\Models\PermissionRouteModel;
use App\Models\Role;
use App\Services\PermissionServices;
use Exception;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class PermissionController extends Controller
{

    protected PermissionServices $service;

    function  __construct(PermissionServices $service){
        $this->service = $service;
    }

    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('permission.view', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permission.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        try{
            $this->service->add($request->validated());
            return redirect()->route('permission.index')->with('message', 'Added');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::find($id);
        return view('permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, $id)
    {
        try{
            $this->service->update($request->validated(), $id);
            return redirect()->route('permission.index')->with('message', 'Permission updated');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $this->service->delete($id);
            return redirect()->route('permission.index')->with('message', 'Permission deleted');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function assignPermissionRole(){

        $permissionsWithRoles = Permission::with('roles')->whereHas('roles')->get();
        return view('permission.assignPermissionRole', compact('permissionsWithRoles'));
    }

    public function assignNewPermissionRole(){
        $roles = Role::whereNotIn('id', [1])->get();
        $permissions = Permission::all();
        return view('permission.addNewPermissionToRole', compact('roles', 'permissions'));
    }

    public function assignNewPermissionRolePost(PermissionRoleRequest $request){

        $isExistance = PermissionRoleModel::where('role_id', $request['role'])->where('permission_id', $request['permission'])->get();

        if (count($isExistance) !== 0){
            return redirect()->back()->with('error', 'It is already exist');
        }

        try{
            $this->service->assignNewPermissionRole($request->validated());
            return redirect()->route('assignPermissionRole')->with('message', 'Added');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function editPermissionRole($id){
        $roles = Role::with('permissions')->whereNotIn('id', [1])->get();
        $permissions = Permission::all();
        $permissionsWithRoles = Permission::with('roles')->where('id', $id)->whereHas('roles')->get();

        $selected_roles = array();

        foreach($permissionsWithRoles as $permissionsWithRole){
            foreach($permissionsWithRole->roles as $role){
                array_push($selected_roles, $role->id);
            }
        }

        return view('permission.editPermissionRole', compact('id','roles', 'permissions', 'selected_roles'));
    }

    public function editAssignPermissionRolePost(PermissionToRoleRequest $request){
        try{
            $request->validated();
            $this->service->PermissionToRoleDeleteAndInsert($request->permission, $request->role);
            return redirect()->route('assignPermissionRole')->with('message', 'Modified');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deletePermissionToRole($id){
        try{
            $this->service->permissionToRoleDeleteAndDelete($id);
            return redirect()->route('assignPermissionRole')->with('message', 'Deleted');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function assignPermissionRoute(){

        $routerPermissions = PermissionRouteModel::with('permission')->get();
        return view('permission.assignPermissionRoute', compact('routerPermissions'));
    }

    public function assignNewPermissionRoute(){
        $routes = Route::getRoutes();
        $middlewaregroup = 'admin';
        $routeDetails = [];

        foreach($routes as $route){
            $middlewares = $route->gatherMiddleware();

            if(in_array($middlewaregroup, $middlewares)){

                if($route->getName() !== 'dashboard' && $route->getName() !== 'logout'){
                    $routeDetails [] = [
                        'name' => $route->getName(),
                        'uri'  => $route->uri()
                    ];
                }

            }
        }

        $permissions = Permission::all();

        return view('permission.assignNewPermissionRoute', compact('permissions', 'routeDetails'));
    }

    public function assignNewPermissionRoutePost(PermissionToRouteRequest $request){

        try{

            $isExist = PermissionRouteModel::where([
                'permission_id' => $request['permission'],
                'router' => $request['route'],
            ])->first();


            if($isExist){
                return redirect()->back()->with('error', 'Permission is already assigned');
            }


            $this->service->permissionToRouteAdd($request->validated());
            return redirect()->route('assignPermissionRoute')->with('message', 'Added');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

    }


    public function editPermissionRoute($id){
        try{
            $permissionRouter = PermissionRouteModel::where('id',$id)->first();
            $permissions = Permission::all();

            $routes = Route::getRoutes();
            $middlewaregroup = 'admin';
            $routeDetails = [];

            foreach($routes as $route){
                $middlewares = $route->gatherMiddleware();

                if(in_array($middlewaregroup, $middlewares)){

                    if($route->getName() !== 'dashboard' && $route->getName() !== 'logout'){
                        $routeDetails [] = [
                            'name' => $route->getName(),
                            'uri'  => $route->uri()
                        ];
                    }

                }
            }
            return view('permission.editPermissionRouter', compact('permissions', 'permissionRouter', 'routeDetails', 'id'));
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

    }


    public function editAssignPermissionRoutePost(PermissionToRouteRequest $request){

        try{
            $request->validated();
            $this->service->editPermissionToRoute($request->permission, $request->route, $request->id);
            return redirect()->route('assignPermissionRoute')->with('message', 'Modified');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function deletePermissionRouter($id){
        try{
            $this->service->permissionToRouteDelete($id);
            return redirect()->route('assignPermissionRoute')->with('message', 'Deleted');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
