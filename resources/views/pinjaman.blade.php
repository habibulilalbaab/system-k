@extends('layouts.template')

@section('header-assets')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="/assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="/assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
@endsection

@section('footer-assets')
    <!-- Page JS Plugins -->
    <script src="/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="/assets/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
    <script src="/assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="/assets/js/plugins/datatables-buttons-jszip/jszip.min.js"></script>
    <!-- Page JS Code -->
    <script src="/assets/js/pages/be_tables_datatables.min.js"></script>
@endsection

@php 
$title = 'Pinjaman Saya';
@endphp
@section('content')
      <!-- Main Container -->
      <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
          <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
              <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-1">
                  {{$title}}
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                  {{$title}} {{env('APP_NAME')}}
                </h2>
              </div>
              <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                  <li class="breadcrumb-item">
                    <a class="link-fx" href="javascript:void(0)">Generic</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a class="link-fx" href="javascript:void(0)">Pinjaman</a>
                  </li>
                  <li class="breadcrumb-item" aria-current="page">
                    {{$title}}
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
          <!-- Dynamic Table Full Pagination -->
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">Semua Pengajuan</h3>
            </div>
            <div class="block-content block-content-full">
              <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
              <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive" id="list-pengajuan">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 80px;">ID</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                    <th>Nominal</th>
                    <th>Tenor Pinjaman</th>
                    <th class="d-none d-sm-table-cell" style="width: 20%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($listPengajuan as $listPengajuan)
                  <tr>
                    <td>{{$listPengajuan->id}}</td>
                    <td>{{$listPengajuan->created_at}}</td>
                    @if($listPengajuan->status_pinjaman == 0)
                    <td><span class="text-warning">Draft</span></td>
                    @elseif($listPengajuan->status_pinjaman == 1)
                    <td><span class="text-info">Sudah Upload Dokumen</span></td>
                    @elseif($listPengajuan->status_pinjaman == 2)
                    <td><span class="text-warning">Menunggu Approval Ketua Koperasi</span></td>
                    @elseif($listPengajuan->status_pinjaman == 3)
                    <td><span class="text-warning">Menunggu Approval Finance</span></td>
                    @elseif($listPengajuan->status_pinjaman == 4)
                    <td><span class="text-success">Approved</span></td>
                    @elseif($listPengajuan->status_pinjaman == 5)
                    <td><span class="text-success">Lunas</span></td>
                    @elseif($listPengajuan->status_pinjaman == 6)
                    <td><span class="text-danger">Ditolak</span></td>
                    @endif
                    <td>Rp. {{number_format($listPengajuan->jumlah_pinjaman,2,',','.')}}</td>
                    <td>{{$listPengajuan->tenor_pinjaman}} bulan</td>
                    <td>
                      <a href="{{route('pinjaman.show', $listPengajuan->id)}}" class="btn btn-sm btn-outline-success">Angsuran</a>
                      <a data-bs-toggle="modal" data-bs-target="#topup" class="btn btn-sm btn-outline-warning">TopUp</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- END Dynamic Table Full Pagination -->
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->
      <!-- Normal Block Modal -->
      <div class="modal" id="topup" tabindex="-1" role="dialog" aria-labelledby="topup" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="block block-rounded block-transparent mb-0">
              <form action="{{route('pembayaran.update', 0)}}" method="post" id="mark-paid-form">
              @csrf
              @method('PUT')
              <div class="block-header block-header-default">
                  <h3 class="block-title">TopUp Pinjaman</h3>
                  <div class="block-options">
                  <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                      <i class="fa fa-fw fa-times"></i>
                  </button>
                  </div>
              </div>
              <div class="block-content fs-sm">
                  <label> Jumlah Pinjaman: </label>
                  <input type="text" disabled class="form-control mb-3" value="test">
                  <label> Tenor Lama (bulan): </label>
                  <input type="text" disabled class="form-control mb-3" value="test">
                  <label> Tenor Baru (bulan): </label>
                  <input type="number" name="new_tenor" class="form-control mb-3">
                  <label> Alasan TopUp Perpanjang Tenor Pinjaman: </label>
                  <textarea name="resi" id="" cols="30" rows="5" class="form-control mb-3" required></textarea>
              </div>
              <div class="block-content block-content-full text-end bg-body">
                  <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-sm btn-primary">Ajukan</button>
              </div>
              </form>
              </div>
          </div>
          </div>
      </div>
      <!-- END Normal Block Modal -->
@endsection