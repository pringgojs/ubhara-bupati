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
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              @if(session('error_message'))
                {{ session('error_message') }}
              @endif
              <form class="pt-3" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                  <input name="username" type="username" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                </div>
                <div class="form-group">
                  <input name="password" type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="SIGN IN">SIGN IN</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
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
        $('.select2').select2();
      });
    }
  </script>
  @yield('scripts')
</body>
</html>

