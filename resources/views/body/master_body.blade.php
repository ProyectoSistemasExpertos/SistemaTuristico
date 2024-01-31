<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema Turístico</title>

  <!-- COLOCAR EL ICONO EN LA PESTAÑA DE LA APP -->
  <link rel="icon" type="image/png" href="/favicon.ico" />

 

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- TOASTR PLUGING -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

  <!-- PARA JAVASCRIPT  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

  <!-- Agrega el CSS de Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>


<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">

    <!-- Preloader
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('backend/assets/dist/img/logo.gif') }}" alt="AdminLTELogo" height="90" width="90">
  </div>-->

    <!-- Navbar -->
    @include('body.navbar')
    <div>
      <!-- /.navbar -->

      <!-- Main Sidebar Container --> <!-- /.sidebar -->
    </div>

    <!-- Main Sidebar Container -->
    @include('body.sidebar')
    <!-- /.sidebar -->


    <!-- Content Wrapper. Contains page content -->
    @yield('body')
    <!-- /.content-wrapper -->




  </div>
  @if(session('success'))
  <script>
    toastr.success("{{ session('success') }}");
  </script>
  @endif

  <!-- ./wrapper -->
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- jQuery UI 1.11.4 -->
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>

  <!-- ChartJS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>


  <!-- JQVMap -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jquery.vmap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/maps/jquery.vmap.usa.js"></script>

  <!-- jQuery Knob Chart -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>

  <!-- daterangepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-daterangepicker@3.1.0/daterangepicker.min.js"></script>


  <!-- Tempusdominus Bootstrap 4 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- Summernote -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

  <!-- overlayScrollbars -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.0/js/jquery.overlayScrollbars.min.js"></script>

  <!-- AdminLTE App -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

  <!-- Agrega el JavaScript de Toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

  <!-- DataTables Responsive -->
  <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>



  <script type="text/javascript">
    $(document).ready(function() {
      $('#datatable').DataTable({
        responsive: true
      });
    });
  </script>


</body>

</html>