<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\User;
use App\Models\ApprovedUser;
use App\Models\PengajuanPinjaman;
use Illuminate\Http\Request;
use Auth;
use DB;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view dashboard', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user_id = Auth()->user()->id;
        $id = Auth()->user()->id;
        $getRole = DB::table('model_has_roles')->where('model_id', $id)->first();
        $role = $getRole->role_id;
        $debitur = PengajuanPinjaman::where('status_pinjaman',4)->count();
        $approval_ketua = PengajuanPinjaman::where('status_pinjaman', 2)->count();
        $approval_finance = PengajuanPinjaman::where('status_pinjaman', 3)->count();
        $angsuran = Angsuran::where('status', 1)->count();
        $user_id = ApprovedUser::pluck('user_id')->all();
        $user = User::whereNotIn('id',$user_id)->count();
        if($role !=1){
            $pinjaman = PengajuanPinjaman::select('tenor_pinjaman','id')->where('user_id', $id)->first();
            $tenor_pinjaman = $pinjaman->tenor_pinjaman;
            $bayar = Angsuran::where('pinjaman_id',$pinjaman->id)->where('status',2)->count();
            $kurang = $tenor_pinjaman-$bayar;
        }else{
            $pinjaman = 0;
            $tenor_pinjaman = 0;
            $bayar = 0;
            $kurang = 0;
        }
        // dd($bayar);
        return view('dashboard', compact('debitur', 'approval_ketua','approval_finance', 'user','angsuran','role','tenor_pinjaman','bayar','kurang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
