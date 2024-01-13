@extends('layouts.template')

@section('header-assets')
@endsection

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('footer-assets')
@endsection
<style>
	.nunito {
    font-family: 'Nunito', sans-serif;
}

.infobox-3 {
    position: relative;
    border: 1px solid #e0e6ed;
    /*width: 50%;*/
    margin: 25px 0px 17px 0px;
    padding: 20px 25px 20px 35px;
    border-radius: 6px;
    -webkit-box-shadow: 0px 2px 10px 1px rgba(31, 45, 61, 0.1);
    box-shadow: 0px 2px 10px 1px rgba(31, 45, 61, 0.1);
    margin-right: auto;
    margin-left: auto;
    background-color: #fff;
    /*background: url(https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/svg/shapes/abstract-1.svg) #fff;
  background-blend-mode: multiply;
  background-repeat: no-repeat;
  background-position: right top;
  background-size: 30% auto;*/
}

.infobox-3 .info-heading-count {
    font-weight: 700;
    font-size: 55px;
    color: #333333;
    letter-spacing: 2px;
}

.infobox-3 .info-plus {
    font-weight: 700;
    font-size: 27px;
    color: #1e9dfc;
}



.infobox-3 .info-icon svg {
    width: 45px;
    height: 45px;
    stroke-width: 1px;
    color: #fff;
}

.infobox-3 .info-heading {
    font-weight: 600;
    font-size: 2rem;
    letter-spacing: 2px;
}

.infobox-3 .info-text {
    font-size: 14px;
    color: #888888;
    font-weight: 700;
    letter-spacing: 1px;
}

.infobox-3 .info-link {
    color: #1b55e2;
    font-size: 12.3px !important;
    font-weight: 600;
}

.infobox-3 .info-link svg {
    width: 15px;
    height: 15px;
}



.container-dashboard {
    padding: 10px;
    margin-top: -125px;
}

*::-webkit-scrollbar {
    width: 6px;
    /* width of the entire scrollbar */
}

*::-webkit-scrollbar-track {
    background: transparent;
    /* color of the tracking area */
}

*::-webkit-scrollbar-thumb {
    background-color: #c1c1c1;
    /* color of the scroll thumb */
    border-radius: 20px;
    /* roundness of the scroll thumb */
    border: 1px solid #c1c1c1;
    /* creates padding around scroll thumb */
}

table.scrollable tbody {
    height: 226px;
    overflow-y: auto;
    width: 100%;
}

table.scrollable tbody.depart {
    height: 382px;
}

table.scrollable thead,
table.scrollable tbody,
table.scrollable tr,
table.scrollable td,
table.scrollable th {
    display: inline-block;
    width: 100%;
}

table.scrollable tbody td,
table.scrollable tbody th,
table.scrollable thead>tr>th {
    width: 33.3%;
    float: left;
    /*position: relative;*/

    &::after {
        content: '';
        clear: both;
        display: block;
    }
}

.card-header-actions {
    height: 3.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 0.5625rem;
    padding-bottom: 0.5625rem;
}

.infobox-2 {
    position: relative;
    border: 1px solid #e0e6ed;
    /*width: 50%;*/
    /* margin: 25px 0px 17px 0px; */
    padding: 10px 25px 10px 25px;
    border-radius: 6px;
    -webkit-box-shadow: 0px 2px 10px 1px rgba(31, 45, 61, 0.1);
    box-shadow: 0px 2px 10px 1px rgba(31, 45, 61, 0.1);
    margin-right: auto;
    margin-left: auto;
    background-color: #fff;
    /*background: url(https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/svg/shapes/abstract-1.svg) #fff;
  background-blend-mode: multiply;
  background-repeat: no-repeat;
  background-position: right top;
  background-size: 30% auto;*/
}

.card {
    -webkit-box-shadow: 0px 2px 10px 1px rgba(31, 45, 61, 0.1);
    box-shadow: 0px 2px 10px 1px rgba(31, 45, 61, 0.1);
}

.min-20 {
    margin-top: -20px;
}

@media (max-width: 575px) {
    .infobox-3 {
        width: auto;
        margin: 72px 0px 27px 0px;
    }

    .infobox-3 .info-text {
        font-size: 12px;
        letter-spacing: normal;
    }

    
}

</style>

@php 
$title = 'Dashboard';
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
                  Dashboard {{env('APP_NAME')}}
                </h2>
              </div>
              <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                  <li class="breadcrumb-item">
                    <a class="link-fx" href="javascript:void(0)">Generic</a>
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
          @can('view dashboard')
      @if ($role == 1)
			<div class="container-dashboard pl-4 pr-4">
				<div class="row mt-7">
					<div class="col-md-6 col-sm-12 col-lg-3">
						<div class="infobox-3 nunito">
							<h5 class="info-heading text-right mb-0">{{ $debitur }}</h5>
							<p class="info-text text-right mb-3">Total Debitur Diterima<br><br><br></p>
							<a class="info-link mb-0 text-xs" href="">Lihat Semua Data <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
						</div>
					</div>
					<div class="col-md-6 col-sm-12 col-lg-3">
						<div class="infobox-3 nunito">
							<h5 class="info-heading text-right mb-0">{{ $approval_ketua }}</h5>
							<p class="info-text text-right mb-3">Total Debitur Menunggu Approval Ketua Koperasi</p>
							<a class="info-link mb-0 text-xs" href="">Lihat Semua Data <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
						</div>
					</div>
					<div class="col-md-6 col-sm-12 col-lg-3">
						<div class="infobox-3 nunito">
							<h5 class="info-heading text-right mb-0">{{ $approval_ketua }}</h5>
							<p class="info-text text-right mb-3">Total Debitur Menunggu Approval Ketua Finance</p>
							<a class="info-link mb-0 text-xs" href="">Lihat Semua Data <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
						</div>
					</div>
					<div class="col-md-6 col-sm-12 col-lg-3">
						<div class="infobox-3 nunito">
							<h5 class="info-heading text-right mb-0">{{ $angsuran }}</h5>
							<p class="info-text text-right mb-3">Total Angsuran Menunggu Approval <br><br></p>
							<a class="info-link mb-0 text-xs" href="">Lihat Semua Data <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
						</div>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-md-6 col-sm-12 col-lg-3">
						<div class="infobox-3 nunito">
							<h5 class="info-heading text-right mb-0">{{ $user }}</h5>
							<p class="info-text text-right mb-3">Total User Menunggu Approval</p>
							<a class="info-link mb-0 text-xs" href="">Lihat Semua Data <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
						</div>
					</div>
					
				</div>
			</div>
      @endif
		@endcan
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->
@endsection