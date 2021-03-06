<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tea Break Super Admin Franchise</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href=<?php echo base_url("apple-icon.png")?>>
    <link rel="shortcut icon" href=<?php echo base_url("assets/logo.ico")?>>

    <link rel="stylesheet" href=<?php echo base_url("assets/css/normalize.css")?>>

    <link rel="stylesheet" href=<?php echo base_url("assets/vendors/bootstrap-4.1.3-dist/css/bootstrap.css")?>>

    <link rel="stylesheet" href=<?php echo base_url("assets/css/font-awesome.min.css")?>>

    <link rel="stylesheet" href=<?php echo base_url("assets/css/themify-icons.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/flag-icon.min.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/teabreak.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/cs-skin-elastic.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/datatable/datatables.css") ?>>
    <!-- bootstrap-daterangepicker -->
    <link rel="stylesheet" href=<?php echo base_url("assets/vendors/bootstrap-daterangepicker/daterangepicker.css")?> >

    <!-- bootstrap-datetimepicker -->
    <link rel="stylesheet" href=<?php echo base_url("assets/vendors/Date-Time-Picker-Bootstrap-4/build/css/bootstrap-datetimepicker.min.css")?>>
    <!-- <link rel="stylesheet" href=<echo base_url("assets/css/bootstrap-select.less")?>> -->
    <link rel="stylesheet" href=<?php echo base_url("assets/scss/style.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/cs-skin-elastic.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/lib/chosen/chosen.min.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/easy-autocomplete.min.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/easy-autocomplete.themes.css")?>>
    <link href=<?php echo base_url("assets/css/lib/vector-map/jqvmap.min.css")?> rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src=<echo base_url("https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js")?>></script> -->
    <script src=<?php echo base_url("assets/js/jquery.min.js")?>></script>
    <script type="text/javascript">

        $(document).ready(function(){
            $('#'+location.pathname.split("/")[2]).addClass('active');
            // alert(location.pathname.split("/")[2]);
            $('#menuToggle').on('click', function(event) {
                $('body').toggleClass('open');
            });

            // window.onresize = function(event) {

            //     if ($(window).width()>575 && $(window).width()<701) {
            //         $("#bignav").addClass('hidden');
            //         $("#littlenav").removeClass('hidden');
            //     }

            //     console.log($(window).width());
            // };

        });
    </script>


</head>
<style type="text/css">
    .error{
    border: 2px solid red!important;
}
.easy-autocomplete{
    width: auto!important;
}
.red{
    color: red !important;
}
</style>
<body>


        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a id= "bignav" class="navbar-brand" href="./">Tea Break</a>
                <a id= "littlenav" class="navbar-brand hidden" href="./">T</a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li id="dashboardsuperadmin">
                        <a href="dashboardsuperadmin"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">PRODUK</h3><!-- /.menu-title -->
                    <li id="masterdataproduk">
                        <a href="masterdataproduk"> <i class="menu-icon fa fa-glass"></i>Master Data Produk </a>
                    </li>

                    <h3 class="menu-title">BAHAN JADI</h3><!-- /.menu-title -->
                    <li id="masterbahanjadi">
                        <a href="masterbahanjadi"> <i class="menu-icon ti-search"></i>Master Bahan Jadi </a>
                    </li>
                    <h3 class="menu-title">STAN</h3><!-- /.menu-title -->
                    <li id="masterdatastan">
                        <a href="masterdatastan"> <i class="menu-icon ti-home"></i>Master Data Stan </a>
                    </li>
                    <li id="gajibonusstan">
                        <a href="gajibonusstan"> <i class="menu-icon ti-money"></i>Gaji Bonus Stan </a>
                    </li>
                    <li id="pengeluaranstan">
                        <a href="pengeluaranstan"> <i class="menu-icon fa fa-money"></i>Pengeluaran Stan </a>
                    </li>
                    <li id="inputpenjualanstan">
                        <a href="inputpenjualanstan"> <i class="menu-icon fa fa-tasks"></i>Input Hasil Penjualan Stan</a>
                    </li>
                    <li id="rekappengeluaranstan">
                        <a href="rekappengeluaranstan"> <i class="menu-icon ti-book"></i>Rekap Pengeluaran Stan (Kasir) </a>
                    </li>
                    <!-- <li id="rekapharianstan">
                        <a href="rekapharianstan"> <i class="menu-icon ti-book"></i>Rekap Harian Stan </a>
                    </li> -->
                    <!-- <h3 class="menu-title">PROMO</h3> --><!-- /.menu-title -->
                    <!-- <li id="skemapromo">
                        <a href="skemapromo"> <i class="menu-icon fa fa-percent"></i>Skema Promo </a>
                    </li> -->

                    <h3 class="menu-title">KARYAWAN</h3><!-- /.menu-title -->
                    <li id="masterdatakaryawan">
                        <a href="masterdatakaryawan"> <i class="menu-icon fa fa-users"></i>Data Karyawan </a>
                    </li>
                    <li id="manajemenshift">
                        <a href="manajemenshift"> <i class="menu-icon ti-layers-alt"></i>Manajemen Shift </a>
                    </li>

                    <h3 class="menu-title">WAREHOUSE</h3><!-- /.menu-title -->
                    <li id="notapembelian">
                        <a href="notapembelian"> <i class="menu-icon ti-shopping-cart"></i>Nota Pembelian Warehouse </a>
                    </li>

                    <h3 class="menu-title">LAPORAN</h3><!-- /.menu-title -->
                    <li id="lappengeluaranwh">
                        <a href="lappengeluaranwh"> <i class="menu-icon ti-agenda"></i>Laporan Pengeluaran WareHouse</a>
                    </li>
                    <li id="lapasetstokstan">
                        <a href="lapasetstokstan"> <i class="menu-icon ti-agenda"></i>Laporan Aset Stan</a>
                    </li>
                    <li id="lapasetstokwh">
                        <a href="lapasetstokwh"> <i class="menu-icon ti-agenda"></i>Laporan Aset Warehouse</a>
                    </li>
                    <li id="lapasetstokglobal">
                        <a href="lapasetstokglobal"> <i class="menu-icon ti-agenda"></i>Laporan Aset Global</a>
                    </li>
                    <!-- <li id="lappenjstan">
                        <a href="lappenjstan"> <i class="menu-icon ti-agenda"></i>Laporan Penjualan Stand</a>
                    </li> -->
                    <li id="lapsisastok">
                        <a href="lapsisastok"> <i class="menu-icon ti-agenda"></i>Laporan Sisa Stock Stan</a>
                    </li>
                    <li id="lapsisastokwh">
                        <a href="lapsisastokwh"> <i class="menu-icon ti-agenda"></i>Laporan Sisa Stock Warehouse</a>
                    </li>
                    <li id="lapgajikaryawan">
                        <a href="lapgajikaryawan"> <i class="menu-icon ti-agenda"></i>Laporan Gaji Karyawan</a>
                    </li>
                    <li id="lapkeuntunganstan">
                        <a  href="lapkeuntunganstan"> <i class="menu-icon ti-agenda"></i>Keuntungan Stand</a>
                    </li>
                    <li id="lapkeuntunganglobal">
                        <a  href="lapkeuntunganglobal"> <i class="menu-icon ti-agenda"></i>Keuntungan Global</a>
                    </li>


                    <!-- //not use -->
                    <!-- <li id="">
                        <a style="pointer-events: none;" href="#"> <i class="menu-icon ti-agenda"></i>Laporan Pembelian</a>
                    </li>
                    <li id="">
                        <a style="pointer-events: none;" href="#"> <i class="menu-icon ti-agenda"></i>Laporan Dist Warehouse</a>
                    </li>
                    <li id="">
                        <a style="pointer-events: none;" href="#"> <i class="menu-icon ti-agenda"></i>Laporan Gaji Karyawan</a>
                    </li>
                    <li id="">
                        <a style="pointer-events: none;" href="#"> <i class="menu-icon ti-agenda"></i>Laporan Keuntungan Stand</a>
                    </li> -->
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">

                        <!-- <div class="dropdown for-notification">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="count bg-danger">3</span>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="notification">
                            <p class="red">Pesanan Masuk</p>
                            <a class="dropdown-item media bg-flat-color-1" href="#">
                                <i class="fa fa-info"></i>
                                <p style="color: black">Stan GM meminta order</p>
                            </a>
                            <a class="dropdown-item media bg-flat-color-1" href="#">
                                <i class="fa fa-info"></i>
                                <p style="color: black">Stan GM meminta order</p>
                            </a>
                            <a class="dropdown-item media bg-flat-color-1" href="#">
                                <i class="fa fa-info"></i>
                                <p style="color: black">Stan GM meminta order</p>
                            </a>
                          </div>
                        </div> -->
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="gantipassword"><i class="fa fa -cog"></i>Ganti Password</a>

                                <a class="nav-link" href="logout"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->