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
$title = 'Jabatan';
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
                    <a class="link-fx" href="javascript:void(0)">Configuration</a>
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
                <a data-bs-toggle="modal" data-bs-target="#modal-add-jabatan" class="btn btn-primary float-right">Tambah Jabatan</a>
            </div>
        </div>
          <!-- Dynamic Table Full Pagination -->
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">Semua Jabatan</h3>
            </div>
            <div class="block-content block-content-full">
              <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
              <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 80px;">ID</th>
                    <th>Jabatan</th>
                    <th class="d-none d-sm-table-cell" style="width: 20%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($jabatan as $jabatan)
                    <tr>
                        <td>{{$jabatan->id}}</td>
                        <td>{{$jabatan->jabatan}}</td>
                        <td>
                            <form action="{{route('jabatan.destroy', [$jabatan->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
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
                <h3 class="block-title">Tambah Jabatan</h3>
              </div>
              <div class="block-content fs-sm">
              <form method="POST" action="{{route('jabatan.index')}}">
                @csrf
                <div class="mb-4">
                  <input type="text" required class="form-control form-control-lg form-control-alt py-3 @error('jabatan') is-invalid @enderror" name="jabatan" placeholder="Jabatan">
                    @error('jabatan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="block-content block-content-full text-end bg-body">
                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Batalkan</button>
                <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Simpan</button>
              </div>
                </form>
            </div>
          </div>
        </div>
      </div>
      <!-- END Large Block Modal -->
@endsection