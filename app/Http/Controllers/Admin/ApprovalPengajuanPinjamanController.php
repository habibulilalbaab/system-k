<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use App\Models\PengajuanPinjamanLog;
use Auth;

class ApprovalPengajuanPinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listPengajuan = PengajuanPinjaman::where('status_pinjaman', '>=', 1)->get();
        return view('admin.approval-pengajuan', compact(
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
        if ($request->type == "ketua") {
            $file = $request->file('filedoc-first-upload');
            $tujuan_upload = 'document/';
            $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($tujuan_upload,$filename);

            PengajuanPinjamanLog::where('id', $request->id)->update([
                'doc_path' => $tujuan_upload.$filename,
                'doc_label' => 'Dokumen Approval Ketua Koperasi',
            ]);
            PengajuanPinjamanLog::create([
                'pengajuan_id' => $request->pengajuan_id,
                'title' => "Menunggu Verifikasi Finance",
                'icon' => "si si-notebook",
                'description' => "Menunggu dokumen di tandatangani oleh bagian finance koperasi",
                'is_doc' => 0,
                'is_url' => 0,
            ]);
            PengajuanPinjamanLog::create([
                'pengajuan_id' => $request->pengajuan_id,
                'title' => "Verifikasi Bag. Finance Koperasi",
                'icon' => "si si-notebook",
                'description' => "Silahkan unduh dan tanda tangani form pengajuan pinjaman dan upload kembali dalam bentuk pdf dari dokumen hasil approval bagian finance koperasi",
                'is_doc' => 1,
                'is_url' => 1,
                'url_path' => $tujuan_upload.$filename,
                'url_label' => 'Download Dokumen',
                'for_admin' => 1
            ]);
            PengajuanPinjaman::where('id', $request->pengajuan_id)->update([
                'status_pinjaman' => 3,
            ]);
            return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Upload dokumen verifikasi ketua koperasi berhasil!'});</script>");
        }elseif ($request->type == "finance") {
            
            $file = $request->file('filedoc-first-upload');
            $tujuan_upload = 'document/';
            $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($tujuan_upload,$filename);

            PengajuanPinjamanLog::where('id', $request->id)->update([
                'doc_path' => $tujuan_upload.$filename,
                'doc_label' => 'Dokumen Approval Finance Koperasi',
            ]);
            PengajuanPinjamanLog::create([
                'pengajuan_id' => $request->pengajuan_id,
                'title' => "Approve dan Pencairan Pinjaman",
                'icon' => "si si-notebook",
                'description' => "Selamat, pinjaman telah diterima dan sudah dicairkan kedalam rekening !",
                'is_doc' => 0,
                'is_url' => 1,
                'url_path' => $tujuan_upload.$filename,
                'url_label' => 'Dokumen Approval Finance Koperasi',
            ]);
            PengajuanPinjaman::where('id', $request->pengajuan_id)->update([
                'status_pinjaman' => 4,
            ]);
            return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Upload dokumen verifikasi ketua koperasi berhasil!'});</script>");
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
        $pengajuanlog = PengajuanPinjamanLog::where('pengajuan_id', $pengajuan->id)->orderBy('id', 'DESC')->get();
        if ($pengajuan->user_id != Auth::user()->id) {
            return "Error 403";
        }
        return view('admin.approval-dokumen', compact(
            'pengajuan',
            'pengajuanlog'
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
        //tolak pengajuan
        PengajuanPinjamanLog::create([
            'pengajuan_id' => $id,
            'title' => "Pinjaman Ditolak",
            'icon' => "si si-notebook",
            'description' => "Pinjaman saat ini tidak bisa diproses karena ada alasan tertentu, silahkan hubungi admin koperasi !",
            'is_doc' => 0,
            'is_url' => 0,
        ]);
        PengajuanPinjaman::where('id', $id)->update([
            'status_pinjaman' => 6,
        ]);
        return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Berhasil ditolak!'});</script>");
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
