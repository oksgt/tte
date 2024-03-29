<!DOCTYPE html>
<html lang="en">
<script>
  var base_url = '<?php echo base_url() ?>';
</script>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tanda Tangan Elektronik</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/template/') ?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/sweetalert2/sweetalert2.css">


  <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>app.css">
  <style>
    .left-col {
      float: left;
      width: 25%;
    }

    .center-col {
      float: left;
      width: 50%;
    }

    .right-col {
      float: left;
      width: 25%;
    }
  </style>
</head>
<?php if($this->session->userdata('status') !== 'loggedin'){ 
    $view_ = "sidebar-closed sidebar-collapse";
  } else {
    $view_ = "";
  } ?>
<body class="hold-transition sidebar-mini layout-fixed <?= $view_ ?>">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?= base_url('assets/') ?>logopdam_bg.png" alt="Perumdam TS" height="221" width="300">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li> -->
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

        <?php if($this->session->userdata('status') == 'loggedin'){ ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('login/logout') ?>" role="button">
              <i class="fas fa-sign-out-alt text-danger"></i>
            </a>
          </li>
      <?php } ?>
        
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <a href="<?= base_url() ?>" class="brand-link">
        <img src="<?= base_url('assets/') ?>logopdam_bg.png" alt="Logo" class="brand-image" >
        <span class="brand-text font-weight-light">Digital Signature</span>
      </a>

      <?php if($this->session->userdata('status') == 'loggedin'){ ?>
        <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url('assets/') ?>user.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="<?= base_url('profile/') ?>" class="d-block"><?= ucwords($this->session->userdata('name')); ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php
              $menu_upload = "";
              $menu_doc = "";
              // if($this->session->userdata('active') == 'document'){
              //   $menu_doc = 'active';
              // } 
            ?>
            <li class="nav-item">
              <a href="<?= base_url() ?>" class="nav-link <?= $menu_upload ?>">
                <i class="nav-icon fa fa-upload"></i>
                <p>
                  Upload
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('document') ?>" class="nav-link <?= $menu_doc ?>">
                <i class="nav-icon far fa-file"></i>
                <p>
                  Documents
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->  
     <?php  } else { ?>
        <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url('assets/') ?>password.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="<?= base_url('login') ?>" class="d-block"> Login</a>
          </div>
        </div>

        
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    <?php } ?>

      
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php echo $contents; ?>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; <?= Date('Y'); ?> <a href="https://www.perumdamts.com/">Perumdam Tirta Satria Kab. Banyumas</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <!-- <b>Version</b> 3.2.0 -->
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= base_url('assets/template/') ?>plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url('assets/template/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('assets/template/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url('assets/template/') ?>plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?= base_url('assets/template/') ?>plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?= base_url('assets/template/') ?>plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= base_url('assets/template/') ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url('assets/template/') ?>plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url('assets/template/') ?>plugins/moment/moment.min.js"></script>
  <script src="<?= base_url('assets/template/') ?>plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url('assets/template/') ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?= base_url('assets/template/') ?>plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url('assets/template/') ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('assets/template/') ?>dist/js/adminlte.js"></script>

  <script src="<?= base_url('assets/template/') ?>plugins/sweetalert2/sweetalert2.min.js"></script>

  <script src="<?= base_url('assets/template/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/template/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/template/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('assets/template/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/template/') ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url('assets/template/') ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/template/') ?>plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url('assets/template/') ?>plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url('assets/template/') ?>plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url('assets/template/') ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url('assets/template/') ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url('assets/template/') ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <?php
  $uriSegment = $this->uri->segment(1);

  if ($uriSegment == "document") {
  ?>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js';
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.3.0/fabric.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>
    <script src="<?= site_url('node_modules/easyqrcodejs/dist') ?>/easy.qrcode.min.js" type="text/javascript" charset="utf-8"></script> -->
    <script src="<?= base_url('assets/js/') ?>document.js"></script>
  <?php
  } else if ($uriSegment == "") {
  ?> <script src="<?= base_url('assets/js/') ?>app.js"></script> <?php
                                                                  } else {
                                                                    ?> <script src="<?= base_url('assets/js/') ?>app.js"></script> <?php
                                                                  } ?>



</body>

</html>