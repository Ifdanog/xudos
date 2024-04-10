<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link
      id="dashboard-stylesheet"
      rel="stylesheet"
      href="{{asset('assets/view/css/dashboard.css')}}"
    />
  </head>
<body>
    <div class="container-scroller">
        @include('superuser.layouts.partials.header')

                    @yield('content')
                @include('superuser.layouts.partials.footer')
            </div>
        </div>
    </div>
    <!-- base:js -->

    <script src="{{ asset('assets') }}/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{ asset('assets') }}/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('assets')}}/js/off-canvas.js"></script>
    <script src="{{ asset('assets')}}/js/hoverable-collapse.js"></script>
    <script src="{{ asset('assets')}}/js/template.js"></script>
    <script src="{{ asset('assets')}}/js/settings.js"></script>
    <script src="{{ asset('assets')}}/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets')}}/js/dashboard.js"></script>
</body>
