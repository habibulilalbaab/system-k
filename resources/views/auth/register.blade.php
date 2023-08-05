<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>Register - {{env('APP_NAME')}}</title>

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

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="/assets/css/themes/amethyst.min.css"> -->
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
    <div id="page-container">

      <!-- Main Container -->
      <main id="main-container">
        <!-- Page Content -->
        <div class="bg-image" style="background-image: url('/assets/media/photos/photo28@2x.jpg');">
          <div class="row g-0 bg-primary-dark-op">
            <!-- Meta Info Section -->
            <div class="hero-static col-lg-4 d-none d-lg-flex flex-column justify-content-center">
              <div class="p-4 p-xl-5 flex-grow-1 d-flex align-items-center">
                <div class="w-100">
                  <a class="link-fx fw-semibold fs-2 text-white" href="/">
                  {{env('APP_NAME')}}
                  </a>
                  <p class="text-white-75 me-xl-8 mt-2">
                    Buat akun anda dan dapatkan akses ke {{env('APP_NAME')}} untuk management layanan secara efisien.
                  </p>
                </div>
              </div>
              <div class="p-4 p-xl-5 d-xl-flex justify-content-between align-items-center fs-sm">
                <p class="fw-medium text-white-50 mb-0">
                  <strong>{{env('APP_NAME')}} 1.0</strong> &copy; <span data-toggle="year-copy"></span>
                </p>
              </div>
            </div>
            <!-- END Meta Info Section -->

            <!-- Main Section -->
            <div class="hero-static col-lg-8 d-flex flex-column align-items-center bg-body-extra-light">
              <div class="p-3 w-100 d-lg-none text-center">
                <a class="link-fx fw-semibold fs-3 text-dark" href="/">
                {{env('APP_NAME')}}
                </a>
              </div>
              <div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
                <div class="w-100">
                  <!-- Header -->
                  <div class="text-center mb-5">
                    <p class="mb-3">
                      <i class="fa fa-2x fa-circle-notch text-primary-light"></i>
                    </p>
                    <h1 class="fw-bold mb-2">
                      Create Account
                    </h1>
                    <p class="fw-medium text-muted">
                      Get your access today in one easy step
                    </p>
                  </div>
                  <!-- END Header -->

                  <!-- Sign Up Form -->
                  <!-- jQuery Validation (.js-validation-signup class is initialized in js/pages/op_auth_signup.min.js which was auto compiled from _js/pages/op_auth_signup.js) -->
                  <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                  <div class="row g-0 justify-content-center">
                    <div class="col-sm-8 col-xl-4">
                      <form class="js-validation-signup" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                          <input type="text" required class="form-control form-control-lg form-control-alt py-3 @error('name') is-invalid @enderror" id="signup-username" name="name" placeholder="Name" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                          <input type="email" required class="form-control form-control-lg form-control-alt py-3 @error('email') is-invalid @enderror" id="signup-email" name="email" placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                          <input type="password" required class="form-control form-control-lg form-control-alt py-3 @error('password') is-invalid @enderror" id="signup-password" name="password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                          <input type="password" required class="form-control form-control-lg form-control-alt py-3" id="signup-password-confirm" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                        <div class="mb-4">
                          <div class="d-md-flex align-items-md-center justify-content-md-between">
                            <div class="form-check">
                              <input class="form-check-input" required type="checkbox" value="" id="signup-terms" name="signup-terms">
                              <label class="form-check-label" for="signup-terms">I agree to Terms &amp; Conditions</label>
                            </div>
                            <div class="py-2">
                              <a class="fs-sm fw-medium" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#one-signup-terms">View Terms</a>
                            </div>
                          </div>
                        </div>
                        <div class="text-center">
                          <button type="submit" class="btn btn-lg btn-alt-success">
                            <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Sign Up
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- END Sign Up Form -->
                </div>
              </div>
              <div class="px-4 py-3 w-100 d-lg-none d-flex flex-column flex-sm-row justify-content-between fs-sm text-center text-sm-start">
                <p class="fw-medium text-black-50 py-2 mb-0">
                  <strong>{{env('APP_NAME')}} 1.0</strong> &copy; <span data-toggle="year-copy"></span>
                </p>
              </div>
            </div>
            <!-- END Main Section -->
          </div>

          <!-- Terms Modal -->
          <div class="modal fade" id="one-signup-terms" tabindex="-1" role="dialog" aria-labelledby="one-signup-terms" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-popout" role="document">
              <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                  <div class="block-header block-header-default">
                    <h3 class="block-title">Terms &amp; Conditions</h3>
                    <div class="block-options">
                      <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="block-content">
                    <p>Gunakan layanan sesuai prosedur yang telah diberikan !</p>
                  </div>
                  <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">I Agree</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END Terms Modal -->
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->
    </div>
    <!-- END Page Container -->

    <!--
        OneUI JS

        Core libraries and functionality
        webpack is putting everything together at assets/_js/main/app.js
    -->
    <script src="/assets/js/oneui.app.min.js"></script>

    <!-- jQuery (required for jQuery Validation plugin) -->
    <script src="/assets/js/lib/jquery.min.js"></script>

    <!-- Page JS Plugins -->
    <script src="/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>

    <!-- Page JS Code -->
    <script src="/assets/js/pages/op_auth_signup.min.js"></script>
  </body>
</html>
