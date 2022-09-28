<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\RoleHasPermission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $data = Role::with('permissions')->get();
        return jsonFormat(200,$data,'List of Roles and Permission');
//        return view('roles.index',compact('roles'))
//            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function listOfPermissionWithRoleId(Request $request,$id){
        $role= Role::with('permissions')->where('id',$id)->first();
        $permissions = Permission::get();
        $data=[];
        $arry=[];
        $roleSelected = $role->permissions->pluck('id')->toArray();
        foreach($permissions as $permission){
            $data[]=[
                'id'=>$permission->id,
                'name'=>$permission->name,
                'selected'=>in_array($permission->id, (array)$roleSelected,true),
            ];
        }
        $arry['permission']=$data;
        $arry['role']=$role;
        return jsonFormat(200,$arry,'List of Roles and Permission');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return JsonResponse
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create(
            [
                'name' => $request->get('name'),
                "guard_name"=>"api",
            ]
        );
        $dataPermissionList=$request->get('permission');
        foreach ($dataPermissionList as $permission ){
            RoleHasPermission::create([
                "role_id"=>$role->id,
                "permission_id"=>$permission,
            ]);
        }
        return jsonFormat(200,[],'Role created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleUpdateRequest $request
     * @param Role $role
     * @return JsonResponse
     */
    public function update(RoleUpdateRequest $request,Role $role)
    {
        $role->update(["name"=>$request->get('name')]);
        RoleHasPermission::where('role_id',$role->id)->delete();

        $dataPermissionList=$request->get('permission');
        foreach ($dataPermissionList as $permission ){
            RoleHasPermission::create([
                "role_id"=>$role->id,
                "permission_id"=>$permission,
            ]);
        }
        return jsonFormat(200,'','update role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success','Role deleted successfully');
    }
}
