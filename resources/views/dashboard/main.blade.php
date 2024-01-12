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
  <style>
    table.datatable thead td{
      font-weight: bolder;
      border-bottom: solid 0.2px #eee;
      padding-bottom: 6px;
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
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
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
    <div class="container-fluid">
      <!-- partial:partials/_sidebar.html -->

      <!-- partial -->
      <div class="">
        <div class="content-wrapper"  style="height: 90vh">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome Aamir</h3>
                        <h6 class="font-weight-normal mb-0">All systems are running smoothly! </h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                        <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                            <a class="dropdown-item" href="#">January - March</a>
                            <a class="dropdown-item" href="#">March - June</a>
                            <a class="dropdown-item" href="#">June - August</a>
                            <a class="dropdown-item" href="#">August - November</a>
                        </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3 grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                        <p class="card-title">Pilih User</p>
                        <p class="font-weight-500">Pilih tampilan dashboard untuk masing-masing tipe user yang berbeda</p>
                        <div class="row">
                            <a href="{{ url('edm/infrastruktur-jalan') }}" class="btn btn-primary col-sm-3 offset-sm-2">Eksekutif</a>
                            <a href="{{ url('operator/kecamatan') }}" class="btn btn-primary col-sm-3 offset-sm-2">Operator</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
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
  <!-- End custom js for this page-->
  <script>
    var table = $('.datatable').DataTable();
    $('.select2').select2();

    function openAjaxModal(e){
      var href = $(e).attr('href');
      $.get(href, function(data){
        document.getElementById('ajaxModalTitle').innerHTML = data.title;
        document.getElementById('ajaxModalBody').innerHTML = data.body;

      });
    }
  </script>
  @yield('scripts')
</body>
</html>

