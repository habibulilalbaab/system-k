<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use App\Models\PengajuanPinjamanLog;
use App\Models\Angsuran;
use Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listPengajuan = PengajuanPinjaman::where('status_pinjaman', '>=', 3)->where('status_pinjaman', '<=', 5)->get();
        return view('admin.pembayaran', compact(
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
        $sisaAngsuran = Angsuran::where('pinjaman_id', $id)->where('status', '2')->orderBy('id', 'DESC')->first() ?? Angsuran::where('pinjaman_id', $id)->orderBy('id', 'DESC')->first();
        return view('admin.catat-pembayaran', compact(
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
        if ($request->markUnpaid == 1) {
            $angsuran = Angsuran::where('id', $id)->update([
                'status' => 0
            ]);
            return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Status berhasil diubah menjadi unpaid!'});</script>");
        }

        $data = Angsuran::where('pinjaman_id', $id)->where('status', '2')->orderBy('id', 'DESC')->first();
        if ($request->markPaid == 1) {
            if (!empty($data)) {
                // dd($data);
                $angsuran_id = $data->id + 1;
                try {
                    $sisa_pinjaman = $data->sisa_pinjaman - ($data->jumlah + $data->bunga);
                } catch (\Throwable $th) {
                    //throw $th;
                    $data = Angsuran::where('id', $id)->orderBy('id', 'DESC')->first();
                    $sisa_pinjaman = $data->sisa_pinjaman - ($data->jumlah + $data->bunga);
                }
                $angsuran = Angsuran::where('id', $angsuran_id)->update([
                    'status' => 2,
                    'paid_date' => date('Y-m-d'),
                    'sisa_pinjaman' => $sisa_pinjaman,
                    'resi' => $request->resi
                ]);
                if (Angsuran::where('pinjaman_id', Angsuran::where('id', $id)->first()->pinjaman_id)->where('status', '0')->orWhere('status', '1')->count() == 0) {
                    PengajuanPinjaman::where('id', Angsuran::where('id', $id)->first()->pinjaman_id)->update([
                        'status_pinjaman' => 5,
                    ]);
                }
            }else{
                $data = Angsuran::where('pinjaman_id', $id)->orderBy('id', 'ASC')->first();
                $sisa_pinjaman = $data->sisa_pinjaman - ($data->jumlah + $data->bunga);
                $angsuran = Angsuran::where('id', $data->id)->update([
                    'status' => 2,
                    'paid_date' => date('Y-m-d'),
                    'sisa_pinjaman' => $sisa_pinjaman,
                    'resi' => $request->resi
                ]);
                // dd($data);

            }
           
            return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Verifikasi pembayaran berhasil!'});</script>");
        }
        if ($request->markPaidAll == 1) {
            $angsuran = Angsuran::where('pinjaman_id', $id)->update([
                'status' => 2,
                'sisa_pinjaman' => 0,
                'paid_date' => date('Y-m-d'),
                'resi' => $request->resi
            ]);
            PengajuanPinjaman::where('id', $id)->update([
                'status_pinjaman' => 5,
            ]);
            return redirect()->back()->with('result', "<script type='text/javascript'>window.onload=One.helpers('jq-notify', {type: 'success', icon: 'fa fa-check me-1', message: 'Pembayarn berhasil dikonfirmasi!'});</script>");
        }
        
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
