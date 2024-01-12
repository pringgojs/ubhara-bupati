<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Executive Dashboard - Ponorogo</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('skydash/template/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('skydash/template/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('skydash/template/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('skydash/template/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('skydash/template/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('skydash/template/js/select.dataTables.min.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('skydash/template/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('skydash/template/images/favicon.png') }}"/>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
  {{-- Sweet Alert --}}
  <style>
    table.datatable thead td{
      font-weight: bolder;
      border-bottom: solid 0.2px #eee;
      padding-bottom: 6px;
    }
    table tr td{
      padding: 6px;
      border: solid 0.2px #ccc;
    }
    .card-caption{
      text-align: justify;
    }
    .caption-with-link{
      margin-top: 36px;
    }
    .caption-with-link a, a.caption-with-link{
      color: black;
    }
    .caption-with-link a:hover, a.caption-with-link:hover{
      color: black;
      text-decoration-line: underline;
    }
    .wisata-top{
      margin-top: 12px;
      margin-bottom: 12px;
    }
    .card-data{
      text-align: right;
    }
    .card-image{
      margin-top: 25%;
    }
    .region-link{
      margin-bottom: 12px;
    }
    div.autoscroll {
      height: 400px;
      overflow: hidden;
    }

    div.autoscroll:hover {
      overflow: auto;
      padding-right: 1px;
    }
    .datatable{
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="{{ asset('skydash/template/images/logo.svg') }}" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('skydash/template/images/logo-mini.svg') }}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{ url('logout') }}">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        @include('layouts.sidebar')
        
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ajaxModalTitle">Loading ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="ajaxModalBody">
                Loading ...
              </div>
            </div>
          </div>
        </div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            Pemerintah Kab. Ponorogo
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('skydash/template/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('skydash/template/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('skydash/template/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('skydash/template/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('skydash/template/js/dataTables.select.min.js') }}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('skydash/template/js/off-canvas.js') }}"></script>
  <script src="{{ asset('skydash/template/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('skydash/template/js/template.js') }}"></script>
  <script src="{{ asset('skydash/template/js/settings.js') }}"></script>
  <script src="{{ asset('skydash/template/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  {{-- <script src="{{ asset('skydash/template/js/dashboard.js') }}"></script> --}}
  <script src="{{ asset('skydash/template/js/Chart.roundedBarCharts.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  {{-- Sweet Alert 2 --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

  <script src="{{ asset('mgl-codes.js') }}"></script>

  <!-- End custom js for this page-->
  <script>
    var table = $('.datatable').DataTable();
    $('.select2').select2();

    function openAjaxModal(e){
      var href = $(e).attr('href');
      $.get(href, function(data){
        document.getElementById('ajaxModalTitle').innerHTML = data.title;
        document.getElementById('ajaxModalBody').innerHTML = data.body;
        $('.select2').select2();
      });
    }
    @if(Session::has('success_message'))
    Swal.fire({
      position: "top-end",
      icon: "success",
      title: "{{Session::get('success_message')}}",
      showConfirmButton: false,
      timer: 3000
    });
    @endif
    @if(Session::has('error_message'))
    Swal.fire({
      position: "top-end",
      icon: "error",
      title: "{{Session::get('error_message')}}",
      showConfirmButton: false,
      timer: 3000
    });
    @endif
    
  </script>
  @yield('scripts')
</body>
</html>

