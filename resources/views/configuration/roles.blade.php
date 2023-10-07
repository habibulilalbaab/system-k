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
$title = 'Roles';
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
                  Daftar role pengguna {{env('APP_NAME')}}
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
                <a href="{{route('roles.create')}}" class="btn btn-primary float-right">Tambah Role</a>
            </div>
        </div>
          <!-- Dynamic Table Full Pagination -->
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">Roles</h3>
            </div>
            <div class="block-content block-content-full">
              <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
              <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 80px;">ID</th>
                    <th>Name</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Guard</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Permissions</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                  <tr>
                    <td class="text-center fs-sm">{{$role->id}}</td>
                    <td class="fw-semibold fs-sm">{{$role->name}}</td>
                    <td class="d-none d-sm-table-cell fs-sm">
                      <span class="text-muted">{{$role->guard_name}}</span>
                    </td>
                    <td class="d-none d-sm-table-cell">
                        @foreach($permissions->getPermissions($role->id) as $permission)
                        <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success mt-1">{{$permission->name}}</span>
                        @endforeach
                    </td>
                    <td class="fw-semibold fs-sm">
                      @if($role->name != "super-admin")
                      <form action="{{route('roles.destroy', [$role->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                      </form>
                      @endif
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
@endsection