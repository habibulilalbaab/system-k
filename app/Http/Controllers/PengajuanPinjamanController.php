<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use App\Models\System;
use Auth;

class PengajuanPinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listPengajuan = PengajuanPinjaman::where('user_id', Auth::user()->id)->get();
        return view('pinjaman.pengajuan', compact(
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
        if ($request->jumlah_pinjaman >= System::first()->minimum_pinjaman) {
            $data = PengajuanPinjaman::create([
                'user_id' => Auth::user()->id,
                'jumlah_pinjaman' => $request->jumlah_pinjaman,
                'tenor_pinjaman' => $request->tenor_pinjaman,
                'status_pinjaman' => 0,
            ]);
            return redirect()->route('pengajuan.show', $data->id)->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Pengajuan berhasil dilakukan silahkan lengkapi dokumen pengajuan!'});</script>");
        }else {
            return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'danger', icon: 'fa fa-check me-1', message: 'Pengajuan gagal, minimum pengajuan sebesar ".number_format(System::first()->minimum_pinjaman,2,',','.')."!'});</script>");
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
        $pengajuan = PengajuanPinjaman::where('id', $id)->first();
        if ($pengajuan->user_id != Auth::user()->id) {
            return "Error 403";
        }
        return view('pinjaman.pengajuan-dokumen', compact(
            'pengajuan'
        ));
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
