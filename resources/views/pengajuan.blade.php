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
$title = 'Pengajuan Pinjaman';
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
        <div class="row mb-3">
            <div class="col-12">
                <a data-bs-toggle="modal" data-bs-target="#modal-add-jabatan" class="btn btn-primary float-right">Ajukan Pinjaman</a>
            </div>
        </div>
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
                      <a href="{{route('pengajuan.show', $listPengajuan->id)}}" class="btn btn-sm btn-outline-primary">Detail Pengajuan</a>
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
      <!-- Large Block Modal -->
      <div class="modal" id="modal-add-jabatan" tabindex="-1" role="dialog" aria-labelledby="modal-add-jabatan" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
              <div class="block-header block-header-default">
                <h3 class="block-title">Tambah Pengajuan</h3>
              </div>
              <div class="block-content fs-sm">
              <form method="POST" action="{{route('pengajuan.store')}}">
                @csrf
                <div class="mb-3">
                  <label for="jumlah_pinjaman">Jumlah Pinjaman (angka)</label>
                  <input type="number" required class="form-control form-control-lg" name="jumlah_pinjaman" id="jumlah_pinjaman" placeholder="min (Rp. {{number_format(\App\Models\System::first()->minimum_pinjaman,2,',','.')}})">
                </div>
                <div class="mb-3">
                  <label for="jumlah_pinjaman">Tenor Pinjaman (bulan)</label>
                  <input type="number" required class="form-control form-control-lg" name="tenor_pinjaman" id="tenor_pinjaman" placeholder="12">
                </div>
                <div class="mb-3">
                  <button type="button" onclick="simulasiCicilan()" class="btn btn-sm btn-warning" id="simulasi_cicilan">Hitung Simulasi Cicilan</button> 
                  <span class="text-success" id="hasil_simulasi_cicilan" style="float: right;margin-right: 20px;"></span>
                </div>
              </div>
              <div class="block-content block-content-full text-end bg-body">
                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Batalkan</button>
                <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Ajukan Pinjaman</button>
              </div>
                </form>
              <script>
                function simulasiCicilan(){
                  jumlah_pinjaman = document.getElementById("jumlah_pinjaman").value;
                  tenor_pinjaman = document.getElementById("tenor_pinjaman").value;
                  bunga = {{\App\Models\System::first()->bunga_pinjaman}};
                  var simulasi = (jumlah_pinjaman*bunga)/tenor_pinjaman

                  document.getElementById("hasil_simulasi_cicilan").innerHTML = "Cicilan: Rp. "+simulasi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')+" /bulan";
                }
              </script>
            </div>
          </div>
        </div>
      </div>
      <!-- END Large Block Modal -->
@endsection