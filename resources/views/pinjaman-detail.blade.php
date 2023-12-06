@extends('layouts.template')

@section('header-assets')
@endsection

@section('footer-assets')
@endsection

@php 
$title = 'Detail Pinjaman';
@endphp
@section('content')
    <main id="main-container">
        <!-- Stats -->
        <div class="bg-body-extra-light">
          <div class="content content-boxed">
            <div class="row items-push text-center">
              <div class="col-6 col-md-4">
                <div class="fs-sm fw-semibold text-muted text-uppercase">Tanggal</div>
                <a class="link-fx fs-4" href="javascript:void(0)">{{date('l, d F Y', strtotime($pengajuan->created_at))}}</a>
              </div>
              <div class="col-6 col-md-4">
                <div class="fs-sm fw-semibold text-muted text-uppercase">Status</div>
                <a class="link-fx fs-4" href="javascript:void(0)">
                    @if($pengajuan->status_pinjaman == 0)
                    <span class="text-warning">Draft</span>
                    @elseif($pengajuan->status_pinjaman == 1)
                    <span class="text-info">Sudah Upload Dokumen</span>
                    @elseif($pengajuan->status_pinjaman == 2)
                    <span class="text-warning">Menunggu Approval Ketua Koperasi</span>
                    @elseif($pengajuan->status_pinjaman == 3)
                    <span class="text-warning">Menunggu Approval Finance</span>
                    @elseif($pengajuan->status_pinjaman == 4)
                    <span class="text-success">Approved</span>
                    @elseif($pengajuan->status_pinjaman == 5)
                    <span class="text-success">Lunas</span>
                    @elseif($pengajuan->status_pinjaman == 6)
                    <span class="text-danger">Ditolak</span>
                    @endif
                </a>
              </div>
              <div class="col-6 col-md-4">
                <div class="fs-sm fw-semibold text-muted text-uppercase">Jumlah</div>
                <a class="link-fx fs-4" href="javascript:void(0)">Rp. {{number_format($pengajuan->jumlah_pinjaman,2,',','.')}}</a>
              </div>
            </div>
          </div>
        </div>
        <!-- END Stats -->

        <!-- Page Content -->
        <div class="content content-boxed">
          <div class="row">
            <div class="col-md-7 col-xl-8">
              <!-- table -->
              <!-- Striped Table -->
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Angsuran Pinjaman</h3>
                </div>
                <div class="block-content" style="font-size:11pt;">
                <form action="{{route('pinjaman.update', $pengajuan->id)}}" method="post">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="type" value="all">
                  <button type="submit" onclick="return confirm('Yakin ingin konfirmasi semua pembayaran ?');" class="btn btn-sm btn-outline-success mb-3" style="float:right;">Lunasi Semua</button>
                </form>  
                  <table class="table table-striped table-vcenter">
                    <thead>
                      <tr>
                        <th>Ke</th>
                        <th>Tanggal</th>
                        <th>Pokok</th>
                        <th>Bunga</th>
                        <th>Jumlah</th>
                        <th class="d-none d-sm-table-cell" style="width: 10%;">Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($angsuran as $angsuran)
                      <tr>
                        <td>{{$angsuran->periode}}</td>
                        <td>{{$angsuran->tanggal}}</td>
                        <td> Rp. {{number_format($angsuran->jumlah)}} </td>
                        <td> Rp. {{number_format($angsuran->bunga)}} </td>
                        <td> Rp. {{number_format($angsuran->jumlah+$angsuran->bunga)}} </td>
                        <td class="d-none d-sm-table-cell">
                          @if($angsuran->status == 0)
                          <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">Unpaid</span>
                          @elseif($angsuran->status == 1)
                          <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">Verifikasi</span>
                          @elseif($angsuran->status == 2)
                          <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">Paid</span>
                          @endif
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            @if($angsuran->status == 0)
                            <form action="{{route('pinjaman.update', $angsuran->id)}}" method="post">
                              @csrf
                              @method('PUT')
                              <button type="submit" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Konfirmasi Sudah Melakukan Pembayaran">
                                <i class="fa fa fa-check"></i>
                              </button>
                            </form>
                            @elseif($angsuran->status == 1)
                            <button type="button" class="btn btn-sm btn-alt-secondary disabled" data-bs-toggle="tooltip" title="Konfirmasi Sudah Melakukan Pembayaran">
                              <i class="fa fa fa-check"></i>
                            </button>
                            @elseif($angsuran->status == 2)
                            <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Unduh Bukti Pembayaran">
                              <i class="fa fa-fw fa-download"></i>
                            </button>
                            @endif
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- END Striped Table -->
            </div>
            <div class="col-md-5 col-xl-4">
              <!-- Products -->
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">
                    <i class="fa fa-briefcase text-muted me-1"></i> Data Peminjam
                  </h3>
                  <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                      <i class="si si-refresh"></i>
                    </button>
                  </div>
                </div>
                <div class="block-content">
                  <div class="d-flex align-items-center push">
                    <table>
                      @php
                      $userData = \App\Models\UserDetail::where('user_id', $pengajuan->user_id)->first();
                      @endphp
                      <tr>
                        <td class="fw-semibold">Nama</td>
                        <td>: {{\App\Models\User::where('id', $pengajuan->user_id)->first()->name}}</td>
                      </tr>
                      <tr>
                        <td class="fw-semibold">Email</td>
                        <td>: {{\App\Models\User::where('id', $pengajuan->user_id)->first()->email}}</td>
                      </tr>
                      <tr>
                        <td class="fw-semibold">Jabatan</td>
                        <td>: {{\App\Models\Jabatan::where('id', $userData->jabatan_id ?? 0)->first()->jabatan ?? '-'}}</td>
                      </tr>
                      <tr>
                        <td class="fw-semibold">Karyawan</td>
                        <td>: {{$userData->status_karyawan ?? '-'}}</td>
                      </tr>
                      <tr>
                        <td class="fw-semibold">Alamat</td>
                        <td>: {{$userData->address ?? '-'}}</td>
                      </tr>
                      <tr>
                        <td class="fw-semibold">Payroll</td>
                        <td>: Rp. {{number_format($userData->payroll ?? 0)}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <!-- END Products -->
              <!-- Products -->
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">
                    <i class="fa fa-briefcase text-muted me-1"></i> Angsuran
                  </h3>
                  <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                      <i class="si si-refresh"></i>
                    </button>
                  </div>
                </div>
                <div class="block-content">
                  <div class="d-flex align-items-center push">
                    <div class="flex-shrink-0 me-3">
                      <a class="item item-rounded bg-info" href="javascript:void(0)">
                        <i class="si si-rocket fa-2x text-white-75"></i>
                      </a>
                    </div>
                    <div class="flex-grow-1">
                      <div class="fw-semibold">Pokok</div>
                      <div class="fs-sm">Rp. {{number_format($pengajuan->jumlah_pinjaman,2,',','.')}}</div>
                    </div>
                  </div>
                  <div class="d-flex align-items-center push">
                    <div class="flex-shrink-0 me-3">
                      <a class="item item-rounded bg-amethyst" href="javascript:void(0)">
                        <i class="si si-calendar fa-2x text-white-75"></i>
                      </a>
                    </div>
                    <div class="flex-grow-1">
                      <div class="fw-semibold">Bunga</div>
                      <div class="fs-sm">{{\App\Models\System::first()->bunga_pinjaman}} %</div>
                    </div>
                  </div>
                  <div class="d-flex align-items-center push">
                    <div class="flex-shrink-0 me-3">
                      <a class="item item-rounded bg-city" href="javascript:void(0)">
                        <i class="si si-speedometer fa-2x text-white-75"></i>
                      </a>
                    </div>
                    <div class="flex-grow-1">
                      <div class="fw-semibold">Angsuran perbulan</div>
                      <div class="fs-sm">Rp. {{number_format(($cicilan),2,',','.')}}</div>
                    </div>
                  </div>
                  <div class="d-flex align-items-center push">
                    <div class="flex-shrink-0 me-3">
                      <a class="item item-rounded bg-primary" href="javascript:void(0)">
                        <i class="fa fa-hourglass-half fa-2x text-white-75"></i>
                      </a>
                    </div>
                    <div class="flex-grow-1">
                      <div class="fw-semibold">Sisa Angsuran</div>
                      <div class="fs-sm">Rp. {{number_format($sisaAngsuran->sisa_pinjaman,2,',','.')}}</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END Products -->

              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">
                    <i class="fa fa-briefcase text-muted me-1"></i> Action
                  </h3>
                  <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                      <i class="si si-refresh"></i>
                    </button>
                  </div>
                </div>
                <div class="block-content mb-3">
                    <a href="{{asset($approvalDoc->url_path)}}" class="btn btn-sm btn-outline-primary mb-3">{{$approvalDoc->url_label}}</a>
                    <a href="#" class="btn btn-sm btn-outline-warning mb-3">TopUp Pinjaman</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->
@endsection