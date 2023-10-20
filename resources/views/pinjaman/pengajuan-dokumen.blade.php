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
                <a class="link-fx fs-3" href="javascript:void(0)">{{date('l, d F Y', strtotime($pengajuan->created_at))}}</a>
              </div>
              <div class="col-6 col-md-4">
                <div class="fs-sm fw-semibold text-muted text-uppercase">Status</div>
                <a class="link-fx fs-3" href="javascript:void(0)">
                    @if($pengajuan->status_pinjaman == 0)
                    <span class="text-warning">Draft</span>
                    @elseif($pengajuan->status_pinjaman == 1)
                    <span class="text-info">Sudah Upload Dokumen</span>
                    @elseif($pengajuan->status_pinjaman == 2)
                    <span class="text-warning">Menunggu Approval Ketua Koperasi</span>
                    @elseif($pengajuan->status_pinjaman == 3)
                    <span class="text-warning">Menunggu Approval Finance</span>
                    @elseif($pengajuan->status_pinjaman == 4)
                    <span class="text-success">Approved, Sudah Dicairkan</span>
                    @elseif($pengajuan->status_pinjaman == 5)
                    <span class="text-success">Lunas</span>
                    @elseif($pengajuan->status_pinjaman == 6)
                    <span class="text-danger">Ditolak</span>
                    @endif
                </a>
              </div>
              <div class="col-6 col-md-4">
                <div class="fs-sm fw-semibold text-muted text-uppercase">Jumlah</div>
                <a class="link-fx fs-3" href="javascript:void(0)">Rp. {{number_format($pengajuan->jumlah_pinjaman,2,',','.')}}</a>
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
                <!-- <li class="timeline-event">
                  <div class="timeline-event-icon bg-default">
                    <i class="fab fa-facebook-f"></i>
                  </div>
                  <div class="timeline-event-block block">
                    <div class="block-header">
                      <h3 class="block-title">Facebook</h3>
                      <div class="block-options">
                        <div class="timeline-event-time block-options-item fs-sm">
                          just now
                        </div>
                      </div>
                    </div>
                    <div class="block-content">
                      <p class="fw-semibold mb-2">
                        + 290 Page Likes
                      </p>
                      <p>
                        This is great, keep it up!
                      </p>
                    </div>
                  </div>
                </li>
                <li class="timeline-event">
                  <div class="timeline-event-icon bg-modern">
                    <i class="fa fa-briefcase"></i>
                  </div>
                  <div class="timeline-event-block block">
                    <div class="block-header">
                      <h3 class="block-title">Products</h3>
                      <div class="block-options">
                        <div class="timeline-event-time block-options-item fs-sm">
                          4 hrs ago
                        </div>
                      </div>
                    </div>
                    <div class="block-content block-content-full">
                      <p class="fw-semibold mb-2">
                        3 New Products were added!
                      </p>
                      <div class="d-flex">
                        <a class="item item-rounded bg-info me-2" href="javascript:void(0)">
                          <i class="si si-rocket fa-2x text-white-75"></i>
                        </a>
                        <a class="item item-rounded bg-amethyst me-2" href="javascript:void(0)">
                          <i class="si si-calendar fa-2x text-white-75"></i>
                        </a>
                        <a class="item item-rounded bg-city me-2" href="javascript:void(0)">
                          <i class="si si-speedometer fa-2x text-white-75"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="timeline-event">
                  <div class="timeline-event-icon bg-info">
                    <i class="fab fa-twitter"></i>
                  </div>
                  <div class="timeline-event-block block">
                    <div class="block-header">
                      <h3 class="block-title">Twitter</h3>
                      <div class="block-options">
                        <div class="timeline-event-time block-options-item fs-sm">
                          12 hrs ago
                        </div>
                      </div>
                    </div>
                    <div class="block-content">
                      <p class="fw-semibold mb-2">
                        + 1150 Followers
                      </p>
                      <p>
                        You’re getting more and more followers, keep it up!
                      </p>
                    </div>
                  </div>
                </li>
                <li class="timeline-event">
                  <div class="timeline-event-icon bg-smooth">
                    <i class="fa fa-database"></i>
                  </div>
                  <div class="timeline-event-block block">
                    <div class="block-header">
                      <h3 class="block-title">Backup</h3>
                      <div class="block-options">
                        <div class="timeline-event-time block-options-item fs-sm">
                          1 day ago
                        </div>
                      </div>
                    </div>
                    <div class="block-content">
                      <p class="fw-semibold mb-2">
                        Database backup completed!
                      </p>
                      <p>
                        Download the <a href="javascript:void(0)">latest backup</a>.
                      </p>
                    </div>
                  </div>
                </li>
                <li class="timeline-event">
                  <div class="timeline-event-icon bg-dark">
                    <i class="fa fa-cog"></i>
                  </div>
                  <div class="timeline-event-block block">
                    <div class="block-header">
                      <h3 class="block-title">System</h3>
                      <div class="block-options">
                        <div class="timeline-event-time block-options-item fs-sm">
                          1 week ago
                        </div>
                      </div>
                    </div>
                    <div class="block-content">
                      <p class="fw-semibold mb-2">
                        App updated to v2.02
                      </p>
                      <p>
                        Check the complete changelog at the <a href="javascript:void(0)">activity page</a>.
                      </p>
                    </div>
                  </div>
                </li> -->
                <li class="timeline-event">
                  <div class="timeline-event-icon bg-info">
                    <i class="si si-notebook"></i>
                  </div>
                  <div class="timeline-event-block block">
                    <div class="block-header">
                      <h3 class="block-title">Kelengkapan Dokumen</h3>
                      <div class="block-options">
                        <div class="timeline-event-time block-options-item fs-sm">
                        {{date('l, d F Y H:i:s', strtotime($pengajuan->created_at))}}
                        </div>
                      </div>
                    </div>
                    <div class="block-content block-content-full">
                      <p class="mb-2">
                        Silahkan unduh dokumen dibawah ini kemudian lakukan tanda tangan, selanjutnya silahkan scan dan upload kembali di form dibawah ini.
                      </p>
                      <a href="#" class="btn btn-sm btn-info">Download Dokumen</a>
                      <form action="#" method="post" class="mt-3 mb-5">
                        <input type="file" class="form-control">
                        <div class="float-right">
                            <button type="submit" class="btn btn-sm btn-info mt-2">Unggah Dokumen</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </li>
                <li class="timeline-event">
                  <div class="timeline-event-icon bg-warning">
                    <i class="si si-notebook"></i>
                  </div>
                  <div class="timeline-event-block block">
                    <div class="block-header">
                      <h3 class="block-title">Pengajuan Pinjaman</h3>
                      <div class="block-options">
                        <div class="timeline-event-time block-options-item fs-sm">
                        {{date('l, d F Y H:i:s', strtotime($pengajuan->created_at))}}
                        </div>
                      </div>
                    </div>
                    <div class="block-content block-content-full">
                      <p class="mb-2">
                        Kamu baru saja melakukan pengajuan pinjaman sebesar: Rp. {{number_format($pengajuan->jumlah_pinjaman,2,',','.')}} dalam jangka waktu {{$pengajuan->tenor_pinjaman}} bulan.
                      </p>
                    </div>
                  </div>
                </li>
              </ul>
              <!-- END Updates -->
            </div>
            <div class="col-md-5 col-xl-4">
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
                  <div class="text-center push">
                    <button type="button" class="btn btn-sm btn-alt-secondary">Pembayaran Angsuran</button>
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