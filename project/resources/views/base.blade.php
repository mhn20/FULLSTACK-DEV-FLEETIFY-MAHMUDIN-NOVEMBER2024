
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $datawebsite['title'] }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link
            rel="stylesheet"
            href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link
            rel="stylesheet"
            href="<?= asset('assets/panel') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/plugins/jqvmap/jqvmap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/plugins/summernote/summernote-bs4.min.css">

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

        <meta name="csrf-token" content="{{ csrf_token() }}">

        @yield('css')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img
                    class="animation__shake"
                    src="<?= asset('assets/panel') ?>/dist/img/AdminLTELogo.png"
                    alt="AdminLTELogo"
                    height="60"
                    width="60">
            </div>

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                            <i class="fas fa-bars"></i>
                        </a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                   
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>

                    
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a class="brand-link">
                    <img
                        src="<?= asset('assets/panel') ?>/dist/img/AdminLTELogo.png"
                        alt="Fleetifly"
                        class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">Fleetifly</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img
                                src="<?= asset('assets/panel') ?>/dist/img/user2-160x160.jpg"
                                class="img-circle elevation-2"
                                alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">MAHMUD</a>
                        </div>
                    </div>


                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul
                            class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview"
                            role="menu"
                            data-accordion="false">

                            <li class="nav-item">
                                <a href="{{ route('karyawan.dokumentasi') }}" class="nav-link {{ request()->segment(1)==''?'active':'' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Dokumentasi
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('karyawan') }}" class="nav-link {{ request()->segment(1)=='karyawan'?'active':'' }}">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        Data Karyawan
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('departement') }}" class="nav-link {{ request()->segment(1)=='departement'?'active':'' }}">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        Data Departement
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('attendance') }}" class="nav-link {{ request()->segment(1)=='attendance'?'active':'' }}">
                                    <table>
                                        <tr>
                                            <td>
                                                <i class="nav-icon fas fa-table"></i>
                                            </td>
                                            <td>
                                                Data Log Absensi Karyawan
                                            </td>
                                        </tr>
                                    </table>
                                </a>
                            </li>
                            
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                

                <!-- Main content -->
                @yield('contents')
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>{{ $datawebsite['footer'] }}</strong>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="<?= asset('assets/panel') ?>/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?= asset('assets/panel') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="<?= asset('assets/panel') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="<?= asset('assets/panel') ?>/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="<?= asset('assets/panel') ?>/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="<?= asset('assets/panel') ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="<?= asset('assets/panel') ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?= asset('assets/panel') ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="<?= asset('assets/panel') ?>/plugins/moment/moment.min.js"></script>
        <script src="<?= asset('assets/panel') ?>/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script
            src="<?= asset('assets/panel') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="<?= asset('assets/panel') ?>/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="<?= asset('assets/panel') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= asset('assets/panel') ?>/dist/js/adminlte.js"></script>
        <!-- AdminLTE for demo purposes -->
        <!-- <script src="<?= asset('assets/panel') ?>/dist/js/demo.js"></script> -->
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?= asset('assets/panel') ?>/dist/js/pages/dashboard.js"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        
        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>




        @yield('js')

        <script>
            function alertToatstr(status,messages){
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                if(status == 200){
                    toastr.success(messages);
                }else{
                    toastr.error(messages);
                }
            }

            function convertToAmPm(time) {
                // Memisahkan jam dan menit dari string input
                let [hours, minutes] = time.split(':');
                hours = parseInt(hours); // Konversi ke angka
                
                // Menentukan AM atau PM
                const amPm = hours >= 12 ? 'PM' : 'AM';

                // Mengubah jam ke format 12-jam
                hours = hours % 12 || 12;

                // Mengembalikan waktu dalam format AM/PM
                return `${hours}:${minutes} ${amPm}`;
            }

            
        </script>
    </body>
</html>