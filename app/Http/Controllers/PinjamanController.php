<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use App\Models\PengajuanPinjamanLog;
use App\Models\Angsuran;
use Auth;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listPengajuan = PengajuanPinjaman::where('user_id', Auth::user()->id)->where('status_pinjaman', '>=', 3)->where('status_pinjaman', '<=', 5)->get();
        return view('pinjaman', compact(
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
        $pengajuan = PengajuanPinjaman::where('id', $id)->first();
        $approvalDoc = PengajuanPinjamanLog::where('pengajuan_id', $pengajuan->id)->where('title', 'Approve dan Pencairan Pinjaman')->first();
        $angsuran = Angsuran::where('pinjaman_id', $id)->get();
        $sisaAngsuran = Angsuran::where('pinjaman_id', $id)->where('status', '2')->orderBy('id', 'DESC')->first() ?? Angsuran::where('pinjaman_id', $id)->orderBy('id', 'DESC')->first() ;
        if ($pengajuan->user_id != Auth::user()->id) {
            return "Error 403";
        }
        return view('pinjaman-detail', compact(
            'pengajuan',
            'approvalDoc',
            'angsuran',
            'sisaAngsuran'
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
        if ($request->type == 'all') {
            $angsuran = Angsuran::where('pinjaman_id', $id)->update([
                'status' => 1
            ]);
        }else {
            $angsuran = Angsuran::where('id', $id)->update([
                'status' => 1
            ]);
        }
        return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Konfirmasi pembayaran berhasil, pembayaran akan diverifikasi oleh finance!'});</script>");

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
