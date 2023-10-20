@extends('layouts.template')

@section('header-assets')
@endsection

@section('footer-assets')
@endsection

@php 
$title = 'System';
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
                  Pengaturan Aplikasi
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
        <!-- Floating Labels -->
        <div class="block block-rounded col-ld-6">
            <div class="block-header block-header-default">
              <h3 class="block-title">Form Pengaturan Aplikasi</h3>
            </div>
            <div class="block-content block-content-full">
              <form action="{{route('system.update', 1)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-l12">
                    <div class="form-floating mb-4">
                      <textarea class="form-control" name="nama_koperasi" id="nama_koperasi" style="height: 100px" required>{{$system->nama_koperasi ?? ''}}</textarea>
                      <label for="Koperasi">Nama Koperasi</label>
                    </div>
                    <div class="form-floating mb-4">
                      <select name="ketua_koperasi" id="ketua_koperasi" class="form-control">
                        <option disabled>Pilih Ketua Koperasi</option>
                        @foreach($users as $user)
                        <option @if($user->id == $system->ketua_koperasi) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                      </select>
                      <label for="ketua_koperasi">Ketua Koperasi</label>
                    </div>
                    <div class="form-floating mb-4">
                      <select name="finance_koperasi" id="finance_koperasi" class="form-control">
                        <option disabled>Pilih Finance Koperasi</option>
                        @foreach($users as $user)
                        <option @if($user->id == $system->finance_koperasi) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                      </select>
                      <label for="finance_koperasi">Bagian Finance Koperasi</label>
                    </div>
                    <div class="form-floating mb-4">
                      <input type="number" class="form-control" id="minimum_pinjaman" name="minimum_pinjaman" value="{{$system->minimum_pinjaman ?? ''}}" required>
                      <label for="minimum_pinjaman">Minimum Pinjaman Rp.</label>
                    </div>
                    <div class="form-floating mb-4">
                      <input type="number" class="form-control" id="bunga_pinjaman" name="bunga_pinjaman" value="{{$system->bunga_pinjaman ?? ''}}" required>
                      <label for="bunga_pinjaman">Bunga Pinjaman %</label>
                    </div>
                    <div class="form-floating mb-4">
                      <textarea class="form-control" name="alamat_koperasi" id="alamat_koperasi" style="height: 200px" required>{{$system->alamat_koperasi ?? ''}}</textarea>
                      <label for="alamat_koperasi">Alamat Koperasi</label>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Simpan Pengaturan</a>
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