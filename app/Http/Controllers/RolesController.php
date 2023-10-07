<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPermissions($role_id){
        $rolesPermissions = DB::table('role_has_permissions')
            ->where('role_id', $role_id)->get('permission_id');
        $permissionsList = "";
        foreach ($rolesPermissions as $key) {
            $permissionsList.=$key->permission_id.',';
        }
        $permissionsList = substr($permissionsList,0,-1);
        $permissionsList = "[".$permissionsList."]";
        $getPermissions = DB::table('permissions')
            ->whereIn('id', json_decode($permissionsList))->get();

        return $getPermissions;
    }
    public function index()
    {
        $roles = DB::table('roles')
            ->get();
        $permissions = new RolesController;
        return view('configuration.roles', compact(
            'roles', 'permissions'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = DB::table('permissions')
            ->get();
        return view('configuration.role-create', compact(
            'permissions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roles = DB::table('roles')->insert([
            'name' => $request->roles,
            'guard_name' => 'web'
        ]);
        $rolesId = DB::table('roles')->where('name', $request->roles)->first();
        foreach ($request->permissions as $permission) {
            $rolesPermissionsRelation = DB::table('role_has_permissions')->insert([
                'permission_id' => $permission,
                'role_id' => $rolesId->id
            ]);
        }
        return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Role berhasil ditambahkan!'});</script>");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roles = DB::table('model_has_roles')->where('role_id', $id)->count();
        if ($roles > 0) {
            return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'danger', icon: 'fa fa-check me-1', message: 'Role tidak dapat dihapus, karena sedang dipakai !'});</script>");
        }else{
            DB::table('roles')->where('id', $id)->delete();
            return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Role berhasil dihapus!'});</script>");
        }
    }
}
