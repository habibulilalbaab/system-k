<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TopUpPinjaman;
use Auth;

class TopUpPinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listPengajuan = TopUpPinjaman::where('user_id', Auth::user()->id)->get();
        return view('topup-pinjaman', compact(
            'listPengajuan'
        ));
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
        TopUpPinjaman::create([
            'pinjaman_id' => $request->pinjaman_id,
            'user_id' => $request->user_id,
            'topup_type' => 'tenor',
            'reason' => $request->reason,
            'sisa_pinjaman' => $request->sisa_pinjaman,
            'tenor' => $request->new_tenor,
            'status' => 0,
        ]);
        return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'TopUp berhasil diajukan, cek status di menu TopUp !'});</script>");
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
