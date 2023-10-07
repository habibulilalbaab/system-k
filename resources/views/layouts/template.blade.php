<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>{{$title}} - {{env('APP_NAME')}}</title>

    <meta name="author" content="PT Intprism Computing Technology">
    <meta name="robots" content="noindex, nofollow">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="/assets/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/media/favicons/apple-touch-icon-180x180.png">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- OneUI framework -->
    <link rel="stylesheet" id="css-main" href="/assets/css/oneui.min.css">
    <script src="/assets/js/oneui.app.min.js"></script>
    <script src="/assets/js/lib/jquery.min.js"></script>
    <!-- Page JS Plugins -->
    <script src="/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="/assets/css/themes/amethyst.min.css"> -->
    @yield('header-assets')
    <!-- END Stylesheets -->
  </head>

  <body>
    <!-- Page Container -->
    <!--
      Available classes for #page-container:

      GENERIC

        'remember-theme'                            Remembers active color theme and dark mode between pages using localStorage when set through
                                                    - Theme helper buttons [data-toggle="theme"],
                                                    - Layout helper buttons [data-toggle="layout" data-action="dark_mode_[on/off/toggle]"]
                                                    - ..and/or One.layout('dark_mode_[on/off/toggle]')

      SIDEBAR & SIDE OVERLAY

        'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
        'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
        'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
        'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
        'sidebar-dark'                              Dark themed sidebar

        'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
        'side-overlay-o'                            Visible Side Overlay by default

        'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

        'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

      HEADER

        ''                                          Static Header if no class is added
        'page-header-fixed'                         Fixed Header

      HEADER STYLE

        ''                                          Light themed Header
        'page-header-dark'                          Dark themed Header

      MAIN CONTENT LAYOUT

        ''                                          Full width Main Content if no class is added
        'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
        'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)

      DARK MODE

        'sidebar-dark page-header-dark dark-mode'   Enable dark mode (light sidebar/header is not supported with dark mode)
    -->
    <style>
      .float-right{
        float: right;
      }
    </style>
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed main-content-narrow">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
      
      <!-- Sidebar -->
      <!--
          Sidebar Mini Mode is not supported with mini navigation
      -->
      <nav id="sidebar" class="with-mini-nav" aria-label="Main Navigation">
        <!-- Sidebar Mini Nav -->
        <div class="sidebar-mini-nav">
          <!-- Logo -->
          <a href="/" class="mini-nav-item h-header">
            <i class="fa fa-circle-notch text-primary"></i>
          </a>
          <!-- END Logo -->

          <!-- Mini Main Nav -->
          <nav class="flex-grow-1 space-y-1">
            <a class="mini-nav-item" href="javascript:void(0)">
              <i class="si si-briefcase fs-sm"></i>
            </a>
            <a class="mini-nav-item" href="javascript:void(0)">
              <i class="si si-pie-chart fs-sm"></i>
            </a>
            <a class="mini-nav-item" href="javascript:void(0)">
              <i class="si si-users fs-sm"></i>
            </a>
          </nav>
          <!-- END Mini Main Nav -->

          <!-- Mini User Nav -->
          <nav class="space-y-1 pb-2">
            <a class="mini-nav-item" href="be_pages_generic_profile.html">
              <i class="si si-settings fs-sm"></i>
            </a>
            <a class="mini-nav-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              <i class="si si-logout fs-sm"></i>
            </a>
          </nav>
          <!-- END Mini User Nav -->
        </div>
        <!-- END Sidebar Mini Nav -->

        <!-- Sidebar Scrolling -->
        <div class="js-sidebar-scroll full-height">
          <!-- Side Header -->
          <div class="content-header">
            <!-- Logo -->
            <a class="fw-semibold text-dual" href="/">
              <span class="smini-visible">
                <i class="fa fa-circle-notch text-primary"></i>
              </span>
              <span class="smini-hide fs-6 tracking-wider">{{env('APP_NAME')}}</span>
            </a>
            <!-- END Logo -->

            <!-- Extra -->
            <div>
              <!-- Dark Mode -->
              <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
              <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle">
                <i class="far fa-moon"></i>
              </button>
              <!-- END Dark Mode -->

              <!-- Close Sidebar, Visible only on mobile screens -->
              <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
              <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
              </a>
              <!-- END Close Sidebar -->
            </div>
            <!-- END Extra -->
          </div>
          <!-- END Side Header -->

          <!-- Side Navigation -->
          <div class="content-side">
            @include('layouts.navigation')
          </div>
          <!-- END Side Navigation -->
        </div>
        <!-- END Sidebar Scrolling -->
      </nav>
      <!-- END Sidebar -->

      <!-- Header -->
      <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
          <!-- Left Section -->
          <div class="d-flex align-items-center">
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" class="btn btn-sm btn-alt-secondary me-2" data-toggle="layout" data-action="sidebar_toggle">
              <i class="fa fa-fw fa-bars"></i>
            </button>
            <!-- END Toggle Sidebar -->

            <!-- Open Search Section (visible on smaller screens) -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-sm btn-alt-secondary d-md-none" data-toggle="layout" data-action="header_search_on">
              <i class="fa fa-fw fa-search"></i>
            </button>
            <!-- END Open Search Section -->

            <!-- Search Form (visible on larger screens) -->
            <form class="d-none d-md-inline-block" action="be_pages_generic_search.html" method="POST">
              <div class="input-group input-group-sm">
                <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="page-header-search-input2">
                <span class="input-group-text border-0">
                  <i class="fa fa-fw fa-search"></i>
                </span>
              </div>
            </form>
            <!-- END Search Form -->
          </div>
          <!-- END Left Section -->

          <!-- Right Section -->
          <div class="d-flex align-items-center">
            <!-- User Dropdown -->
            <div class="dropdown d-inline-block ms-2">
              <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle" src="/assets/media/avatars/avatar10.jpg" alt="Header Avatar" style="width: 21px;">
                <span class="d-none d-sm-inline-block ms-2">{{Auth::user()->name ?? null}}</span>
                <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block opacity-50 ms-1 mt-1"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0" aria-labelledby="page-header-user-dropdown">
                <div class="p-2">
                  <a class="dropdown-item d-flex align-items-center justify-content-between"  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <span class="fs-sm fw-medium">Log Out</span>
                  </a>
                </div>
              </div>
            </div>
            <!-- END User Dropdown -->
          </div>
          <!-- END Right Section -->
        </div>
        <!-- END Header Content -->

        <!-- Header Search -->
        <div id="page-header-search" class="overlay-header bg-body-extra-light">
          <div class="content-header">
            <form class="w-100" action="be_pages_generic_search.html" method="POST">
              <div class="input-group">
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-alt-danger" data-toggle="layout" data-action="header_search_off">
                  <i class="fa fa-fw fa-times-circle"></i>
                </button>
                <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
              </div>
            </form>
          </div>
        </div>
        <!-- END Header Search -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-body-extra-light">
          <div class="content-header">
            <div class="w-100 text-center">
              <i class="fa fa-fw fa-circle-notch fa-spin"></i>
            </div>
          </div>
        </div>
        <!-- END Header Loader -->
      </header>
      <!-- END Header -->
      @if ($message = Session::get('result'))
        {!! $message !!}
      @endif
      @php 
        $approved = \App\Models\ApprovedUser::where('user_id', Auth::user()->id)->first()->approved ?? '';
      @endphp
      @if($approved == NULL OR $approved == 0 )
      @include('unauthorized')
      @else
      @yield('content')
      @endif
      <!-- Footer -->
      <footer id="page-footer" class="bg-body-light">
        <div class="content py-3">
          <div class="row fs-sm">
            <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
              Crafted with <i class="fa fa-heart text-danger"></i>
            </div>
            <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
              <a class="fw-semibold" href="/" target="_blank">{{env('APP_NAME')}} {{env('APP_VERSION')}}</a> &copy; <span data-toggle="year-copy"></span>
            </div>
          </div>
        </div>
      </footer>
      <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    <!--
        OneUI JS

        Core libraries and functionality
        webpack is putting everything together at assets/_js/main/app.js
    -->

    @yield('footer-assets')
  </body>
</html>
