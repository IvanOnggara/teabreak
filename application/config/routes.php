<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'superadminfranchise/dashboard';
$route['dashboardsuperadmin'] = 'superadminfranchise/dashboard';
$route['404_override'] = '';

$route['masterdataproduk'] = 'superadminfranchise/masterdataproduk';
$route['masterbahanjadi'] = 'superadminfranchise/masterbahanjadi';
$route['masterdatastan'] = 'superadminfranchise/masterdatastan';
$route['datastan'] = 'superadminfranchise/datastan';
$route['gajibonusstan'] = 'superadminfranchise/gajibonusstan';
$route['rekapharianstan'] = 'superadminfranchise/rekapharianstan';
$route['rekappengeluaranstan'] = 'superadminfranchise/rekappengeluaranstan';
$route['skemapromo'] = 'superadminfranchise/skemapromo';
$route['masterdatakaryawan'] = 'superadminfranchise/masterdatakaryawan';
$route['lappenjstan'] = 'superadminfranchise/lappenjstan';
$route['login'] = 'superadminfranchise/login';
$route['gantipassword'] = 'superadminfranchise/gantipassword';
$route['logout'] = 'superadminfranchise/logout';

$route['getDataStan'] = 'superadminfranchise/sendDataStan';
$route['getDataProduk'] = 'superadminfranchise/sendDataProduk';
$route['getDataDiskon'] = 'superadminfranchise/sendDataDiskon';
$route['getDataDetailDiskonProduk'] = 'superadminfranchise/sendDataDetailDiskonProduk';
$route['getDataBahanJadi'] = 'superadminfranchise/sendDataBahanJadi';
$route['getDataOrder'] = 'superadminfranchise/sendDataOrder';
$route['getUpdateOrder'] = 'superadminfranchise/sendUpdateOrder';


$route['insertDataNota'] = 'superadminfranchise/insertDataNota';
$route['insertDataStok']= 'superadminfranchise/insertDataStok';
$route['insertDataPengeluaran']= 'superadminfranchise/insertDataPengeluaran';
$route['insertDataKas']= 'superadminfranchise/insertDataKas';
$route['insertDataKaryawanFingerspot']= 'superadminfranchise/insertDataKaryawanFingerspot';
$route['insertDataPresensiKaryawan']= 'superadminfranchise/insertDataPresensiKaryawan';
$route['insertDataOrder']= 'superadminfranchise/insertDataOrder';


$route['deleteDataPengeluaran'] = 'superadminfranchise/deleteDataPengeluaran';

$route['lapdist'] = 'superadminfranchise/lapdist';
$route['lapgaji'] = 'superadminfranchise/lapgaji';
$route['lapkeuntunganglobal'] = 'superadminfranchise/lapkeuntunganglobal';
$route['lapkeuntunganstan'] = 'superadminfranchise/lapkeuntunganstan';
$route['lappembelian'] = 'superadminfranchise/lappembelian';
$route['lappengeluaranstok'] = 'superadminfranchise/lappengeluaranstok';
$route['lapsisastok'] = 'superadminfranchise/lapsisastok';
$route['presensi'] = 'superadminfranchise/presensi';
$route['masterdataprodukkemasan'] = 'superadminfranchise/masterdataprodukkemasan';
$route['lappengeluaranwh'] = 'superadminfranchise/lappengeluaranwh';
$route['lapasetstokwh'] = 'superadminfranchise/lapasetstokwh';
$route['lapasetstokstan'] = 'superadminfranchise/lapasetstokstan';
$route['lapasetstokglobal'] = 'superadminfranchise/lapasetstokglobal';
$route['lapsisastokwh'] = 'superadminfranchise/lapsisastokwh';
$route['pengeluaranstan'] = 'superadminfranchise/pengeluaranstan';
$route['inputpenjualanstan'] = 'superadminfranchise/inputpenjualanstan';
$route['manajemenshift'] = 'superadminfranchise/manajemenshift';
$route['lapgajikaryawan'] = 'superadminfranchise/lapgajikaryawan';
$route['lapkeuntunganstan'] = 'superadminfranchise/lapkeuntunganstan';
$route['notapembelian'] = 'superadminfranchise/notapembelian';





//ADMIN WAREHOUSE (FRANCHISE)
$route['dashboardadmin'] = 'adminfranchise/dashboardadmin';
$route['stokproduk'] = 'adminfranchise/stokproduk';
$route['pembelian'] = 'adminfranchise/pembelian';
$route['pengeluaranlain'] = 'adminfranchise/pengeluaranlain';
$route['distribusi'] = 'adminfranchise/distribusi';
$route['stokkeluar'] = 'adminfranchise/stokkeluar';
$route['orderstan'] = 'adminfranchise/orderstan';
$route['supply'] = 'adminfranchise/orderstan';
$route['sinkronisasidata'] = 'adminfranchise/sinkronisasidata';

$route['json'] = 'superadminfranchise/json';
$route['translate_uri_dashes'] = FALSE;



//try
$route['downloadexcel'] = 'superadminfranchise/downloadexcel1';
$route['downloadexcelstan'] = 'superadminfranchise/downloadexcelstan';
$route['downloadexcelwarehouse'] = 'superadminfranchise/downloadexcelwarehouse';