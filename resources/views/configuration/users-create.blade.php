@extends('layouts.template')

@section('header-assets')
@endsection

@section('footer-assets')
@endsection

@php 
$title = 'Tambahkan User';
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
                  Tambahkan pengguna baru
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
                <a href="{{route('users.index')}}" class="btn btn-danger">Cancel</a>
            </div>
        </div>
        <!-- Floating Labels -->
        <div class="block block-rounded col-ld-6">
            <div class="block-header block-header-default">
              <h3 class="block-title">Tambah Pengguna</h3>
            </div>
            <div class="block-content block-content-full">
              <form action="{{route('users.store')}}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-l12">
                    <div class="mb-4">
                      <input type="text" required class="form-control form-control-lg form-control-alt py-2 @error('name') is-invalid @enderror" id="signup-user" name="name" placeholder="Name" value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                      <input type="number" required class="form-control form-control-lg form-control-alt py-2 @error('nip') is-invalid @enderror" id="signup-nip" name="nip" placeholder="NIP" value="{{ old('nip') }}">
                        @error('nip')
                            <span class="invalid-feedback" role="alert">
                                <strong>NIP Harus Diisi dengan benar</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                      <input type="number" required class="form-control form-control-lg form-control-alt py-2 @error('payroll') is-invalid @enderror" id="signup-payroll" name="payroll" placeholder="Payroll" value="{{ old('payroll') }}">
                        @error('payroll')
                            <span class="invalid-feedback" role="alert">
                                <strong>Payroll Harus Diisi dengan benar</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                      <select name="jabatan_id" required class="form-control form-control-lg form-control-alt py-2 " id="signup-jabatan">
                        <option selected disabled>Pilih Jabatan</option>
                        @php $jabatan = \App\Models\Jabatan::all(); @endphp
                        @foreach($jabatan as $jabatan)
                        <option value="{{$jabatan->id}}">{{$jabatan->jabatan}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-4">
                      <select name="status_karyawan" required class="form-control form-control-lg form-control-alt py-2 " id="signup-status_karyawan">
                        <option selected disabled>Pilih Status Karyawan</option>
                        <option value="Tetap">Tetap</option>
                        <option value="TAD Admin">TAD Admin</option>
                        <option value="TAD Non Admin">TAD Non Admin</option>
                      </select>
                    </div>
                    <div class="mb-4">
                      <input type="number" required class="form-control form-control-lg form-control-alt py-2 @error('phone') is-invalid @enderror" id="signup-phone" name="phone" placeholder="Nomor HP" value="{{ old('phone') }}">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>Nomor HP Harus Diisi dengan benar</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                      <input type="text" required class="form-control form-control-lg form-control-alt py-2 @error('alamat') is-invalid @enderror" id="signup-alamat" name="address" placeholder="Alamat Lengkap" value="{{ old('alamat') }}">
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>Alamat Harus Diisi dengan benar</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                      <input type="email" required class="form-control form-control-lg form-control-alt py-2 @error('email') is-invalid @enderror" id="signup-email" name="email" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                      <input type="password" required class="form-control form-control-lg form-control-alt py-2 @error('password') is-invalid @enderror" id="signup-password" name="password" placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                      <input type="password" required class="form-control form-control-lg form-control-alt py-2" id="signup-password-confirm" name="password_confirm" placeholder="Confirm Password">
                    </div>
                    <div class="mb-4">
                      <p>Select Role</p>
                      <select class="form-select form-control-lg form-control-alt py-2" id="roles" name="roles" aria-label="Floating label select role" required>
                      @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Create</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- END Floating Labels -->
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->
@endsection