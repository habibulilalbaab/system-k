@extends('layouts.template')

@section('header-assets')
@endsection

@section('footer-assets')
@endsection

@php 
$title = 'Tambahkan Role';
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
                  Tambahkan role baru
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
                <a href="{{route('roles.index')}}" class="btn btn-danger">Cancel</a>
            </div>
        </div>
        <!-- Floating Labels -->
        <div class="block block-rounded col-ld-6">
            <div class="block-header block-header-default">
              <h3 class="block-title">Tambah Role</h3>
            </div>
            <div class="block-content block-content-full">
              <form action="{{route('roles.store')}}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-l12">
                    <div class="form-floating mb-4">
                      <input type="text" class="form-control" id="role" name="roles" placeholder="Enter a role name" required>
                      <label for="roles">Nama Role</label>
                    </div>
                    <div class="mb-4">
                      <label class="form-label" for="permissions">Permissions (Multi Select)</label>
                      <select class="form-select" id="permissions" name="permissions[]" size="5" multiple required>
                        @foreach($permissions as $permission)
                        <option value="{{$permission->id}}">{{$permission->name}}</option>
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