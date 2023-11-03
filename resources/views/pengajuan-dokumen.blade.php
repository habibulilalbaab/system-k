@extends('layouts.template')

@section('header-assets')
@endsection

@section('footer-assets')
@endsection

@php 
$title = 'Dokumen Pengajuan Pinjaman';
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
              <!-- Updates -->
              <ul class="timeline timeline-alt py-0">
                @foreach($pengajuanlog as $pengajuanlog)
                @if($pengajuanlog->for_admin != 1)
                <li class="timeline-event">
                  <div class="timeline-event-icon bg-success">
                    <i class="{{$pengajuanlog->icon}}"></i>
                  </div>
                  <div class="timeline-event-block block">
                    <div class="block-header">
                      <h3 class="block-title">{{$pengajuanlog->title}}</h3>
                      <div class="block-options">
                        <div class="timeline-event-time block-options-item fs-sm">
                        {{date('l, d F Y H:i:s', strtotime($pengajuanlog->created_at))}}
                        </div>
                      </div>
                    </div>
                    <div class="block-content block-content-full">
                      <p class="mb-2">
                        {{$pengajuanlog->description}}
                      </p>
                      @if($pengajuanlog->is_url == 1)
                      <a href="{{asset($pengajuanlog->url_path)}}" class="btn btn-sm btn-info" target="_blank">{{$pengajuanlog->url_label}}</a>
                      @endif
                      @if($pengajuanlog->doc_path != NULL)
                      <a href="{{asset($pengajuanlog->doc_path)}}" class="btn btn-sm btn-primary" target="_blank">{{$pengajuanlog->doc_label}}</a>
                      @elseif($pengajuanlog->is_doc == 1)
                      <form action="{{route('dokumen-pengajuan.store')}}" method="post" class="mt-3 mb-5" enctype="multipart/form-data">
                        @csrf
                        <input type="file" class="form-control" name="filedoc-first-upload" accept=".pdf" required>
                        <input type="hidden" name="id" value="{{$pengajuanlog->id}}">
                        <input type="hidden" name="pengajuan_id" value="{{$pengajuanlog->pengajuan_id}}">
                        <div class="float-right">
                            <button type="submit" class="btn btn-sm btn-info mt-2">Unggah Dokumen</button>
                        </div>
                      </form>
                      @endif
                    </div>
                  </div>
                </li>
                @endif
                @endforeach
              </ul>
              <!-- END Updates -->
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
                      <div class="fs-sm">Rp. {{number_format(($pengajuan->jumlah_pinjaman*\App\Models\System::first()->bunga_pinjaman)/$pengajuan->tenor_pinjaman,2,',','.')}}</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END Products -->
            </div>
          </div>
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->
@endsection