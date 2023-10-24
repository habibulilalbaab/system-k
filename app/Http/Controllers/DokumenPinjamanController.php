<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use App\Models\PengajuanPinjamanLog;
use App\Models\UserDetail;
use App\Models\System;
use App\Models\User;
use Auth;
use PDF;

class DokumenPinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $file = $request->file('filedoc-first-upload');
        $tujuan_upload = 'document/';
        $filename = uniqid().'.'.$file->getClientOriginalExtension();
        $file->move($tujuan_upload,$filename);

        PengajuanPinjamanLog::where('id', $request->id)->update([
            'doc_path' => $tujuan_upload.$filename,
            'doc_label' => 'Dokumen Kelengkapan Pengajuan Pinjaman',
        ]);
        PengajuanPinjaman::where('id', $request->pengajuan_id)->update([
            'status_pinjaman' => 1,
        ]);
        PengajuanPinjamanLog::create([
            'pengajuan_id' => $request->pengajuan_id,
            'title' => "Menunggu Verifikasi",
            'icon' => "si si-notebook",
            'description' => "Menunggu dokumen di tandatangani oleh ketua koperasi",
            'is_doc' => 0,
            'is_url' => 0,
        ]);
        PengajuanPinjamanLog::create([
            'pengajuan_id' => $request->pengajuan_id,
            'title' => "Verifikasi Ketua Koperasi",
            'icon' => "si si-notebook",
            'description' => "Silahkan unduh dan tanda tangani form pengajuan pinjaman dari ".Auth::user()->name." dan upload kembali dalam bentuk pdf dari dokumen hasil approval ketua koperasi",
            'is_doc' => 1,
            'is_url' => 1,
            'url_path' => $tujuan_upload.$filename,
            'url_label' => 'Download Dokumen',
            'for_admin' => 1
        ]);
        PengajuanPinjaman::where('id', $request->pengajuan_id)->update([
            'status_pinjaman' => 2,
        ]);
        return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Upload dokumen kelengkapan pengajuan pinjaman berhasil!'});</script>");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //create document
        $pinjaman = PengajuanPinjaman::where('id', $id)->first();
        $userDetail = UserDetail::where('user_id', $pinjaman->user_id)->first();
        $user = User::where('id', $pinjaman->user_id)->first();
        $system = System::first();
        $data = 0;
        $pdf = PDF::loadview('layouts.dokumen_pangajuan_pinjaman',
            [
                'pinjaman' => $pinjaman,
                'userDetail' => $userDetail,
                'user' => $user,
                'system' => $system
            ]
        )->setPaper('a4', 'portrait');;
    	return $pdf->download('dokumen_pangajuan_pinjaman');
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
