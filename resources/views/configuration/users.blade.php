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
$title = 'Users';
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
                  Daftar pengguna {{env('APP_NAME')}}
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
                <a href="{{route('users.create')}}" class="btn btn-primary float-right">Tambah User</a>
            </div>
        </div>
          <!-- Dynamic Table Full Pagination -->
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">Semua Pengguna</h3>
            </div>
            <div class="block-content block-content-full">
              <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
              <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 80px;">ID</th>
                    <th>Name</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Role</th>
                    <th style="width: 15%;">Registered</th>
                    <th style="d-none d-sm-table-cell width: 15%;">Status</th>
                    <th class="d-none d-sm-table-cell" style="width: 20%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                  <input type="text" id="value4-{{$user->id}}" hidden value="{{$userController->userDetail($user->id)->nip ?? ''}}">
                  <input type="text" id="value5-{{$user->id}}" hidden value="{{$userController->userDetail($user->id)->payroll ?? ''}}">
                  <input type="text" id="value6-{{$user->id}}" hidden value="{{$userController->userDetail($user->id)->address ?? ''}}">
                  <input type="text" id="value7-{{$user->id}}" hidden value="{{$userController->userDetail($user->id)->phone ?? ''}}">
                  <input type="text" id="value8-{{$user->id}}" hidden value="{{\App\Models\Jabatan::where('id', $userController->userDetail($user->id)->jabatan_id ?? 0)->first()->jabatan ?? ''}}">
                  <input type="text" id="value9-{{$user->id}}" hidden value="{{$userController->userDetail($user->id)->status_karyawan ?? ''}}">
                  <tr>
                    <td class="text-center fs-sm">{{$user->id}}</td>
                    <td class="fw-semibold fs-sm" id="value1-{{$user->id}}">{{$user->name}}</td>
                    <td class="d-none d-sm-table-cell fs-sm">
                      <span class="text-muted" id="value2-{{$user->id}}">{{$user->email}}</span>
                    </td>
                    <td class="d-none d-sm-table-cell">
                      <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success" id="value3-{{$user->id}}">{{$roles->roleOfUser($user->id)->name}}</span>
                    </td>
                    <td>
                      <span class="text-muted fs-sm">{{$user->created_at}}</span>
                    </td>
                    <td class="d-none d-sm-table-cell">
                        @php try{ @endphp
                          @if($userController->statusUser($user->id)->approved == 1)
                          <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success mt-1">Active</span>
                          @elseif($userController->statusUser($user->id)->approved == 0)
                          <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger mt-1">Rejected</span>
                          @endif
                        @php }catch (Exception $e) { @endphp
                          <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning mt-1">Pending</span>
                        @php } @endphp
                    </td>
                    <td class="fw-semibold fs-sm">
                      <button onclick="editUser({{$user->id}})" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modal-edit-user">Edit</button>
                        @php try{ @endphp
                          @if($userController->statusUser($user->id)->approved == 1)
                          @elseif($userController->statusUser($user->id)->approved == 0)
                          <a href="{{route('approvedUser',[$user->id])}}" class="btn btn-sm btn-outline-success">Approve</a>
                          @endif
                        @php }catch (Exception $e) { @endphp
                          <a href="{{route('approvedUser',[$user->id])}}" class="btn btn-sm btn-outline-success">Approve</a>
                          <a href="{{route('rejectUser',[$user->id])}}" class="btn btn-sm btn-outline-danger">Reject</a>
                        @php } @endphp
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
      <div class="modal" id="modal-edit-user" tabindex="-1" role="dialog" aria-labelledby="modal-edit-user" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
              <div class="block-header block-header-default">
                <h3 class="block-title">Edit User</h3>
              </div>
              <div class="block-content fs-sm">
              <form method="POST" id="formUpdateUser" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="mb-4">
                  <input type="text" required class="form-control form-control-lg form-control-alt py-2 @error('name') is-invalid @enderror" id="edit-name" name="name" placeholder="Name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                  <input type="number" required class="form-control form-control-lg form-control-alt py-2 @error('nip') is-invalid @enderror" id="edit-nip" name="nip" placeholder="NIP">
                    @error('nip')
                        <span class="invalid-feedback" role="alert">
                            <strong>NIP Harus Diisi dengan benar</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                  <input type="number" required class="form-control form-control-lg form-control-alt py-2 @error('payroll') is-invalid @enderror" id="edit-payroll" name="payroll" placeholder="Payroll">
                    @error('payroll')
                        <span class="invalid-feedback" role="alert">
                            <strong>Payroll Harus Diisi dengan benar</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                  <select name="jabatan_id" required class="form-control form-control-lg form-control-alt py-2 " id="edit-jabatan">
                    <option selected disabled>Pilih Jabatan</option>
                    @php $jabatan = \App\Models\Jabatan::all(); @endphp
                    @foreach($jabatan as $jabatan)
                    <option value="{{$jabatan->id}}">{{$jabatan->jabatan}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-4">
                  <select name="status_karyawan" required class="form-control form-control-lg form-control-alt py-2 " id="edit-status_karyawan">
                    <option selected disabled>Pilih Status Karyawan</option>
                    <option value="Tetap">Tetap</option>
                    <option value="TAD Admin">TAD Admin</option>
                    <option value="TAD Non Admin">TAD Non Admin</option>
                  </select>
                </div>
                <div class="mb-4">
                  <input type="number" required class="form-control form-control-lg form-control-alt py-2 @error('phone') is-invalid @enderror" id="edit-phone" name="phone" placeholder="Nomor HP">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>Nomor HP Harus Diisi dengan benar</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                  <input type="text" required class="form-control form-control-lg form-control-alt py-2 @error('alamat') is-invalid @enderror" id="edit-alamat" name="address" placeholder="Alamat Lengkap">
                    @error('alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>Alamat Harus Diisi dengan benar</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                  <input type="email" required class="form-control form-control-lg form-control-alt py-2 @error('email') is-invalid @enderror" id="edit-email" name="email" placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                  <input type="password" class="form-control form-control-lg form-control-alt py-2 @error('password') is-invalid @enderror" id="signup-password" name="password" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                  <input type="password" class="form-control form-control-lg form-control-alt py-2" id="signup-password-confirm" name="password_confirmation" placeholder="Confirm Password">
                </div>
                <div class="form-floating mb-4">
                  <select class="form-select" id="edit-roles" name="roles" aria-label="Floating label select role" required>
                    @foreach($rolesList as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                  </select>
                  <label for="roles">Roles</label>
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
      <script>
        function editUser(id){
          document.getElementById("formUpdateUser").action = "{{route('users.index')}}/"+id;
          name = document.getElementById("value1-"+id).innerHTML;
          email = document.getElementById("value2-"+id).innerHTML;
          role = document.getElementById("value3-"+id).innerHTML;
          nip = document.getElementById("value4-"+id).value;
          payroll = document.getElementById("value5-"+id).value;
          address = document.getElementById("value6-"+id).value;
          phone = document.getElementById("value7-"+id).value;
          jabatan = document.getElementById("value8-"+id).value;
          statusKaryawan = document.getElementById("value9-"+id).value;
          
          document.getElementById("edit-name").value = name;
          document.getElementById("edit-email").value = email;
          document.getElementById("edit-nip").value = nip;
          document.getElementById("edit-payroll").value = payroll;
          document.getElementById("edit-alamat").value = address;
          document.getElementById("edit-phone").value = phone;
          var roleDropdown = document.getElementById("edit-roles");
          for (var i = 0; i < roleDropdown.options.length; i++) {
              if (roleDropdown.options[i].text === role) {
                roleDropdown.selectedIndex = i;
                  break;
              }
          }
          var jabatanDropdown = document.getElementById("edit-jabatan");
          for (var i = 0; i < jabatanDropdown.options.length; i++) {
              if (jabatanDropdown.options[i].text === jabatan) {
                jabatanDropdown.selectedIndex = i;
                  break;
              }
          }
          var statusKaryawanDropdown = document.getElementById("edit-status_karyawan");
          for (var i = 0; i < statusKaryawanDropdown.options.length; i++) {
              if (statusKaryawanDropdown.options[i].text === statusKaryawan) {
                statusKaryawanDropdown.selectedIndex = i;
                  break;
              }
          }
        }
      </script>
@endsection