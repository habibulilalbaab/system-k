<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ApprovedUser;
use App\Models\UserDetail;
use DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roleOfUser($id){
        $getRole = DB::table('model_has_roles')
        ->whereIn('model_id', User::where('id', $id)->first())
        ->first();
        $userRole = DB::table('roles')
        ->where('id', $getRole->role_id)
        ->first(); 
        return $userRole;
    }
    public function statusUser($id){
        $getStatus = ApprovedUser::where('user_id', $id)->first();
        return $getStatus;
    }
    public function approvedUser($id){
        $approve = ApprovedUser::where('user_id', $id)->updateOrCreate([
            'user_id' => $id,
        ],
        [
           'approved' => 1
        ]);
        $user = User::where('id', $id)->first();
        return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Success approve ".$user->name." !'});</script>");
    }
    public function rejectUser($id){
        $approve = ApprovedUser::where('user_id', $id)->updateOrCreate([
            'user_id' => $id,
        ],
        [
           'approved' => 0
        ]);
        $user = User::where('id', $id)->first();
        return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Success reject ".$user->name." !'});</script>");
    }
    public function userDetail($id){
        $userDetail = UserDetail::where('user_id', $id)->first();
        return $userDetail;
    }
    public function index()
    {
        $users = User::all();
        $roles = new UsersController;
        $userController = new UsersController;
        $rolesList = DB::table('roles')
        ->get(); 
        return view('configuration.users', compact(
            'users','roles','userController','rolesList'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = DB::table('roles')
        ->get(); 
        return view('configuration.users-create', compact(
            'roles'
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
        if (User::where('email', $request->email)->count() == 1) {
            return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'danger', icon: 'fa fa-check me-1', message: 'User sudah terdaftar!'});</script>");
        }
        if ($request->password == $request->password_confirm) {    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            UserDetail::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
                'payroll' => $request->payroll,
                'address' => $request->address,
                'jabatan_id' => $request->jabatan_id,
                'status_karyawan' => $request->status_karyawan,
                'phone' => $request->phone,
            ]);
            $roles = DB::table('model_has_roles')->insert([
                'role_id' => $request->roles,
                'model_type' => 'App\Models\User',
                'model_id' => $user->id
            ]);
            return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'User sukses ditambahkan!'});</script>");
        }else {
            return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'danger', icon: 'fa fa-check me-1', message: 'Password tidak cocok!'});</script>");
        }
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
        if($request->password != NULL AND $request->password_confirmation != NULL){
            if($request->password == $request->password_confirmation){
                $user = User::where('id', $id)->update([
                    'password' => bcrypt($request->password)
                ]);
            }
        }
        $user = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        UserDetail::where('user_id', $id)->update([
            'nip' => $request->nip,
            'payroll' => $request->payroll,
            'address' => $request->address,
            'jabatan_id' => $request->jabatan_id,
            'status_karyawan' => $request->status_karyawan,
            'phone' => $request->phone,
        ]);
        $roles = DB::table('model_has_roles')->where('model_id', $id)->update([
            'role_id' => $request->roles,
        ]);
        return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'User sukses di update!'});</script>");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
