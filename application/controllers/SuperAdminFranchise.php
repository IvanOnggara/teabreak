<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class SuperAdminFranchise extends CI_Controller {

	public function __construct(){
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->helper('site_helper');
	    $this->load->model('Post');
	    $this->load->model('Produk');
	    $this->load->library('session');
  	}

  	public function login()
  	{
  		$adminId = $this->session->userdata('aksessupadmin');
  		$admin = $this->session->userdata('aksesadmin');
        if(empty($adminId) && empty($admin)){
            $this->load->view('superadminfranchise/login');
        }else{
        	if (!empty($adminId)) {
        		redirect('dashboardsuperadmin');
        	}else{
        		redirect('dashboardadmin');
        	}
            
        }
  	}

  	public function gantipassword()
  	{
  		$akses = $this->session->userdata('aksessupadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('superadminfranchise/navigationbar');
            $this->load->view('superadminfranchise/gantipassword');
        }
  		
  	}

  	public function prosesgantipassword()
  	{
  		$passlama = $this->input->post('passlama');
  		$passlama = md5($passlama);
  		$passbaru = $this->input->post('passbaru');
  		$passbaru = md5($passbaru);
  		$konfirmasipassbaru = $this->input->post('konfirmasipassbaru');
  		$username = $this->input->post('username');
  		$usertype = $this->input->post('usertype');

  		$where = array('username' => $username,'password' => $passlama,'usertype' => $usertype );
  		
  		if ($this->Produk->getRowCount('alluser',$where) > 0) {
  			$data = array(
				'username' => $username,
	        	'password' => $passbaru,
	        	'usertype' => $usertype
	        );
			$success = $this->Post->Update('alluser',$data,$where);
			if ($success) {
				echo 'true';
			}else{
				echo "servererror";
			}
  		 	
  		}else{
  			echo "false";
  		} 

  	}

  	public function logout()
  	{
  		$this->session->unset_userdata('aksesadmin');
  		$this->session->unset_userdata('aksessupadmin');
  		$this->session->unset_userdata('username');
  		redirect('login');
  	}

  	public function prosesLogin()
  	{
  		$username = $this->input->post('username');
  		$password = $this->input->post('password');
  		$password = md5($password);
  		$where = array('username' => $username,'password' => $password);
  		$data = $this->Produk->getData($where,'alluser');
  		
  		if ($this->Produk->getRowCount('alluser',$where) > 0) {
  			if ($data[0]->usertype == 'superadminfranchise') {
  				$this->session->set_userdata('aksessupadmin', 'granted');

  			}else if ($data[0]->usertype == 'adminfranchise') {
  				$this->session->set_userdata('aksesadmin', 'granted');
  			}
  			$this->session->set_userdata('username', $username);
  		 	echo 'true';
  		}else{
  			echo "false";
  			
  		} 
  	}
  	
	public function dashboard()
	{
		$akses = $this->session->userdata('aksessupadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$countlapgaji = $this->Produk->getRowCountAll('laporan_gaji_karyawan');
        	$bulantahunlalu = date("n-Y", strtotime("-1 months"));
    		$bulantahunlaluarray = explode('-', $bulantahunlalu);
    		$bulanlalu = $bulantahunlaluarray[0];
    		$tahunlalu = $bulantahunlaluarray[1];

        	$where = array('bulan_tahun' => $bulanlalu."-".$tahunlalu);
        	$countlapgajiwithcase = $this->Produk->getRowCount('laporan_gaji_karyawan',$where);
        	
        	if ($countlapgajiwithcase <= 0) {
        		

        		$haribulanitu = cal_days_in_month(CAL_GREGORIAN, intval($bulanlalu),intval($tahunlalu) );

        		$alldatakaryawan = $this->Produk->getAllData('karyawan_fingerspot');

				foreach ($alldatakaryawan as $perkaryawan) {

					$where1 = array('id_stan' => $perkaryawan->id_stan );
					$data_detail_stan = $this->Produk->getData($where1,'data_detail_stan');

					$where = array(
	        			'id_stan' => $perkaryawan->id_stan,
						'pin' => $perkaryawan->pin,
						'MONTH(scan_date)' => $bulanlalu,
						'YEAR(scan_date)' => $tahunlalu
					);
					$allpresensikaryawan = $this->Produk->getData($where,'presensi_karyawan');
					// if ($perkaryawan->pin == '1') {
					// 	var_dump($allpresensikaryawan);
					// }
					$masuk = 0;
					$lembur = 0;
					$terlambat = 0;
					$terlambatlembur = 0;

					//count masuk, lembur, telat
					$datapertama = true;

					$whr = array(
						'id_stan' => $perkaryawan->id_stan
					);
					$kolomto = 'jam_awal DESC';
					$allshift = $this->Produk->getDataWhereDesc2column('manajemen_shift',$whr,$kolomto);
					$done = true;
					// date_modify($date,"+1 hour");

					foreach ($allpresensikaryawan as $perpresensikaryawan) {

						if ($datapertama) {
							$tanggalget = new DateTime($perpresensikaryawan->scan_date);
							$hari = date_format($tanggalget,'j');
							$jam = date_format($tanggalget,'H:i:s');
							$datapertama = false;
							$done = false;
							$masuk++;
							// if ($perkaryawan->pin == '1') {
							// 	var_dump($masuk);

							// }

						}else{
							$tanggalget2 = new DateTime($perpresensikaryawan->scan_date);
							$hari2 = date_format($tanggalget2,'j');
							$jam2 = date_format($tanggalget2,'H:i:s');

							if ($hari == $hari2 && $jam < $jam2 && !$done) {
								$lamakerja = $tanggalget->diff($tanggalget2);
								$lamakerja = $lamakerja->format('%h');

								if ($lamakerja >= $data_detail_stan[0]->standar_lembur ) {
									# lemburfull
									$lembur++;
								}else if ($lamakerja >= $data_detail_stan[0]->batas_telat_lembur) {
									# telatlembur
									$terlambatlembur++;
								}else{
									# shift biasa
									foreach ($allshift as $pershift) {
										$jam_akhir = new DateTime($pershift->jam_akhir);
										$jam_akhir = date_format($jam_akhir, 'H:i:s');

										$jam_awal = new DateTime($pershift->jam_awal);
										$jam_awal_asli = date_format($jam_awal, 'H:i:s');
										$jam_awal = date_modify($jam_awal,"-".$pershift->batas_datang_cepat." hour");
										$jam_awal = date_format($jam_awal, 'H:i:s');

										if ($jam <= $jam_akhir && $jam>= $jam_awal) {
											$shift = $pershift;

											if ($jam>=$jam_awal && $jam<=$jam_awal_asli) {
												// $telat = false;
											}else{
												$terlambat++;
											}
											break;
										}
									}
								}
								$done = true;
							}else{

								if (!$done) {
									foreach ($allshift as $pershift) {
										$jam_akhir = new DateTime($pershift->jam_akhir);
										$jam_akhir = date_format($jam_akhir, 'H:i:s');

										$jam_awal = new DateTime($pershift->jam_awal);
										$jam_awal_asli = date_format($jam_awal, 'H:i:s');
										$jam_awal = date_modify($jam_awal,"-".$pershift->batas_datang_cepat." hour");
										$jam_awal = date_format($jam_awal, 'H:i:s');

										if ($jam <= $jam_akhir && $jam>= $jam_awal) {
											$shift = $pershift;

											if ($jam>=$jam_awal && $jam<=$jam_awal_asli) {
												// $telat = false;
											}else{
												$terlambat++;
											}
											break;
										}
									}
								}

								$tanggalget = $tanggalget2;
								if ($hari != $hari2) {
									$masuk++;

								}

								$hari = $hari2;
								$jam = $jam2;
								$done = false;
								
							}
						}
					}

					if (!$done) {
						foreach ($allshift as $pershift) {
							$jam_akhir = new DateTime($pershift->jam_akhir);
							$jam_akhir = date_format($jam_akhir, 'H:i:s');

							$jam_awal = new DateTime($pershift->jam_awal);
							$jam_awal_asli = date_format($jam_awal, 'H:i:s');
							$jam_awal = date_modify($jam_awal,"-".$pershift->batas_datang_cepat." hour");
							$jam_awal = date_format($jam_awal, 'H:i:s');

							if ($jam <= $jam_akhir && $jam>= $jam_awal) {
								$shift = $pershift;

								if ($jam>=$jam_awal && $jam<=$jam_awal_asli) {
									// $telat = false;
								}else{
									$terlambat++;
								}
								break;
							}
						}
					}




					$tidak_masuk = $haribulanitu - $masuk;
					

					$where3 = array(
						'id_stan' => $perkaryawan->id_stan,
						'bulan_tahun' => $bulanlalu."/".$tahunlalu
					);

					$data_omset = $this->Produk->getData($where3,'penjualan_stan_by_superadmin');

					if ($this->Produk->getRowCount('penjualan_stan_by_superadmin',$where3)<=0) {
						$data_omset = 0;
					}else{
						$data_omset = $data_omset[0]->penjualan;
					}

					$where2 = array(
						'id_stan' => $perkaryawan->id_stan,
						'status' => 'active',
						'omset_minimal <=' => $data_omset
					);
					$data_gaji_bonus =  $this->Produk->getDataWhereDesc2column('gaji_bonus_stan',$where2,'omset_minimal DESC');

					if ($this->Produk->getRowCount('gaji_bonus_stan',$where2)<=0) {
						$data_gaji_bonus = 0;
					}else{
						$whereforbonus = array(
							'id_stan' => $perkaryawan->id_stan,
							'status' => 'active'
						);

						$banyakpegawai = $this->Produk->getRowCount('karyawan_fingerspot',$whereforbonus);
						$data_gaji_bonus = (($data_gaji_bonus[0]->persentase_bonus/100)*$data_omset)/$banyakpegawai;
					}

					$uang_makan_akhir = ($masuk-$terlambat)*$data_detail_stan[0]->uang_makan;
					$uang_lembur_akhir = $lembur*$data_detail_stan[0]->uang_lembur;
					$potongan_cuti_akhir = $tidak_masuk*$data_detail_stan[0]->pinalti_bolos;
					$bonus_omset = $data_gaji_bonus;


					$gaji_akhir = $perkaryawan->gaji_tetap+$uang_makan_akhir+$uang_lembur_akhir+$bonus_omset-$potongan_cuti_akhir;

					$datatosave = array(
						'id_stan' => $perkaryawan->id_stan,
        				'pin' => $perkaryawan->pin,
        				'nama' => $perkaryawan->nama,
        				'bulan_tahun' => $bulanlalu."-".$tahunlalu,
        				'masuk' => $masuk,
        				'lembur' => $lembur,
        				'terlambat' => $terlambat,
        				'terlambatlembur' => $terlambatlembur,
        				'tidak_masuk' => $tidak_masuk,
        				'potongan_lain' => 0,
        				'keterangan_potongan_lain' => "",
        				'gaji_tambahan' => 0,
        				'keterangan_gaji_tambahan' => "",
        				'bonus_omset' => $bonus_omset,
        				'uang_makan' => $uang_makan_akhir,
        				'uang_lembur' => $uang_lembur_akhir,
        				// 'potongan_terlambat' => 0,
        				'potongan_cuti' => $potongan_cuti_akhir,
        				'gaji_akhir' => $gaji_akhir,
        			);

        			//save data

        			if ($perkaryawan->status == 'active') {
        				$insert_lap_gaji = $this->Produk->insert('laporan_gaji_karyawan',$datatosave);
        			}
        			

        			// if ($perkaryawan->pin == '1') {
        				// var_dump($datatosave);
        			// }
				}

				//KEUNTUNGAN STAN GAJI KARYAWAN
				
        		// CREATE LAPORAN GAJI BULAN TAHUN SEBELUMNYA
        	}

        	$where = array(
        		'bulan_tahun' => $bulanlalu."-".$tahunlalu,
        		'keterangan' => 'Pengeluaran Stan (Kasir)'

        	);
        	$checkkeuntunganstanbulanlalu = $this->Produk->getRowCount('keuntungan_stan',$where);
        	$alldatastan = $this->Produk->getAllData('stan');

        	if ($checkkeuntunganstanbulanlalu<=0) {
        		foreach ($alldatastan as $perstan) {
        			$where2 = array(
	        			'tanggal LIKE' => $tahunlalu."-".$bulanlalu.'-%',
	        			'id_stan' => $perstan->id_stan
	        		);
	        		$allpengeluaranstanblnlalu = $this->Produk->getData($where2,'pengeluaran_lain');
	        		$total = 0;

	        		foreach ($allpengeluaranstanblnlalu as $perpengeluaran) {
	        			$total = $total+$perpengeluaran->pengeluaran;
	        		}

	        		$datatosave = array(
	        			'id_stan' => $perstan->id_stan,
	        			'bulan_tahun' => $bulanlalu."-".$tahunlalu,
	        			'keterangan' => 'Pengeluaran Stan (Kasir)',
	        			'total' => $total,
	        			'tipe' => 'Kredit'
	        		);

	        		$insert = $this->Produk->insert('keuntungan_stan',$datatosave);
        		}
        	}

        	$where = array(
        		'bulan_tahun' => $bulanlalu."-".$tahunlalu,
        		'keterangan' => 'Stock Keluar (Kasir)'

        	);
        	$checkkeuntunganstanbulanlalu = $this->Produk->getRowCount('keuntungan_stan',$where);

        	if ($checkkeuntunganstanbulanlalu<=0) {
        		foreach ($alldatastan as $perstan) {
        			$where2 = array(
	        			'tanggal LIKE' => $tahunlalu."-".$bulanlalu.'-%',
	        			'id_stan' => $perstan->id_stan
	        		);
	        		$allstokkeluarstanblnlalu = $this->Produk->getData($where2,'stok_bahan_jadi');
	        		$total = 0;

	        		foreach ($allstokkeluarstanblnlalu as $perstokkeluar) {
	        			$whereharga = array(
	        				'id_bahan_jadi' => $perstokkeluar->id_bahan_jadi
	        			);
	        			$getharga = $this->Produk->getData($whereharga,'bahan_jadi');

	        			if ($this->Produk->getRowCount('bahan_jadi',$whereharga) <= 0) {
	        				$harga = 0;
	        			}else{
	        				$harga = $getharga[0]->harga_bahan_jadi;
	        			}

	        			$total = $total + ( $harga * $perstokkeluar->stok_keluar );
	        		}

	        		$datatosave = array(
	        			'id_stan' => $perstan->id_stan,
	        			'bulan_tahun' => $bulanlalu."-".$tahunlalu,
	        			'keterangan' => 'Stock Keluar (Kasir)',
	        			'total' => $total,
	        			'tipe' => 'Kredit'
	        		);

	        		$insert = $this->Produk->insert('keuntungan_stan',$datatosave);

        		}
        	}

        	//GAJI KARYAWAN DI KEUNTUNGAN STAN
        	$where = array(
        		'bulan_tahun' => $bulanlalu."-".$tahunlalu,
        		'keterangan' => 'Gaji Karyawan'

        	);
        	$checkkeuntunganstanbulanlalu = $this->Produk->getRowCount('keuntungan_stan',$where);

        	if ($checkkeuntunganstanbulanlalu<=0) {
        		foreach ($alldatastan as $perstan) {
        			$where2 = array(
	        			'bulan_tahun LIKE' => $bulanlalu.'-'.$tahunlalu,
	        			'id_stan' => $perstan->id_stan
	        		);
	        		$allgajiblnlalu = $this->Produk->getData($where2,'laporan_gaji_karyawan');
	        		$total = 0;

	        		foreach ($allgajiblnlalu as $pergaji) {
	        			$total = $total + $pergaji->gaji_akhir;
	        		}

	        		$datatosave = array(
	        			'id_stan' => $perstan->id_stan,
	        			'bulan_tahun' => $bulanlalu."-".$tahunlalu,
	        			'keterangan' => 'Gaji Karyawan',
	        			'total' => $total,
	        			'tipe' => 'Kredit'
	        		);

	        		$insert = $this->Produk->insert('keuntungan_stan',$datatosave);

        		}
        	}


        	//keuntungan global

        	$alldatastan = $this->Produk->getAllData('stan');

        	foreach ($alldatastan as $perstan) {
        		$where = array(
	        		'bulan_tahun' => $bulanlalu."-".$tahunlalu,
	        		'keterangan' => 'Keuntungan Stan '.$perstan->nama_stan
	        	);

	        	$checkkeuntunganglobal = $this->Produk->getRowCount('keuntungan_global',$where);

	        	if ($checkkeuntunganglobal<=0) {
	        		$where2 = array(
	        			'bulan_tahun' => $bulanlalu."-".$tahunlalu,
	        			'id_stan' => $perstan->id_stan
	        		);
	        		$allkeuntunganstan = $this->Produk->getData($where2,'keuntungan_stan');
	        		$total = 0;
	        		foreach ($allkeuntunganstan as $perkeuntungan) {
	        			if ($perkeuntungan->tipe == 'Kredit') {
	        				$total = $total - $perkeuntungan->total;
	        			}else{
	        				$total = $total + $perkeuntungan->total;
	        			}
	        		}

	        		$datatosave = array(
	        			'bulan_tahun' => $bulanlalu."-".$tahunlalu,
	        			'keterangan' => 'Keuntungan Stan '.$perstan->nama_stan,
	        			'total' => $total,
	        			'tipe' => 'Debit'
	        		);

	        		$insert = $this->Produk->insert('keuntungan_global',$datatosave);
	        	}
        	}

        	$where = array(
        		'bulan_tahun' => $bulanlalu."-".$tahunlalu,
        		'keterangan' => 'Pengeluaran Warehouse'

        	);
        	$checkkeuntunganglobal = $this->Produk->getRowCount('keuntungan_global',$where);

        	if ($checkkeuntunganglobal<=0) {
        		$where = array(
	        		'tanggal LIKE' => $tahunlalu."-".$bulanlalu."-%"
	        	);

	        	$allpengeluarangudang = $this->Produk->getData($where,'pengeluaran_lain_gudang');
	        	$totalpengeluaran = 0;

	        	foreach ($allpengeluarangudang as $perpengeluaran) {
	        		$totalpengeluaran+=$perpengeluaran->pengeluaran;
	        	}

	        	$datatosave = array(
        			'bulan_tahun' => $bulanlalu."-".$tahunlalu,
        			'keterangan' => 'Pengeluaran Warehouse',
        			'total' => $totalpengeluaran,
        			'tipe' => 'Kredit'
        		);

        		$insert = $this->Produk->insert('keuntungan_global',$datatosave);
        	}

        	$where = array(
        		'bulan_tahun' => $bulanlalu."-".$tahunlalu,
        		'keterangan' => 'Gaji Karyawan Warehouse'

        	);
        	$checkkeuntunganglobal = $this->Produk->getRowCount('keuntungan_global',$where);

        	if ($checkkeuntunganglobal<=0) {
        		$where = array(
        			'id_stan' => 'warehouse',
	        		'bulan_tahun' => $bulanlalu."-".$tahunlalu,
	        	);

	        	$allgajiwarehouse = $this->Produk->getData($where,'laporan_gaji_karyawan');
	        	$total = 0;

	        	foreach ($allgajiwarehouse as $pergaji) {
	        		$total+=$pergaji->gaji_akhir;
	        	}

	        	$datatosave = array(
        			'bulan_tahun' => $bulanlalu."-".$tahunlalu,
        			'keterangan' => 'Gaji Karyawan Warehouse',
        			'total' => $total,
        			'tipe' => 'Kredit'
        		);

        		$insert = $this->Produk->insert('keuntungan_global',$datatosave);
        	}

        	//1,2,12hitung keuntungan global

        	

        	$this->load->view('superadminfranchise/navigationbar');
            $this->load->view('superadminfranchise/dashboard');
        }
		
	}

	public function masterdataproduk()
	{
		$akses = $this->session->userdata('aksessupadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('superadminfranchise/navigationbar');
            $this->load->view('superadminfranchise/masterdataproduk');
			$this->load->view('superadminfranchise/datatable_produk');
        }
		
	}

	public function tambah_produk(){
		$id = $this->input->post('id');
		$where = array('id_produk' => $id);
		$count = $this->Produk->getRowCount('produk',$where);

		if ($count>0) {
			echo "ID Data Sudah ada di dalam database";
		}else{
			$data = array(
	        'id_produk' => $this->input->post('id'),
	        'nama_produk' => $this->input->post('nama'),
	        'kategori' => $this->input->post('kategori'),
	        'harga_jual' => $this->input->post('harga')
	         );
			$this->Produk->insert('produk',$data);
			echo "Berhasil Ditambahkan";
		}
		
		
	}

	public function data_kategori(){
		$data = $this->db->distinct()->select('kategori')->from('produk')->get();
		echo json_encode($data->result());
	}

	public function promo_data(){
		$this->load->library('datatables');
		$this->datatables->select('id_diskon,nama_diskon,jenis_diskon,tanggal_mulai,tanggal_akhir,hari,jam_mulai,jam_akhir,status');
		$this->datatables->from('diskon');
		echo $this->datatables->generate();
	}

	//SHOW DATATABLE DETAIL DISKON - STAN

	public function promo_detail_stan(){
		$this->load->library('datatables');
		$this->datatables->select('id_stan');
		$this->datatables->from('detail_stan_diskon');
		$this->datatables->where('id_diskon',"".$this->input->post('id_diskon'));
		echo $this->datatables->generate();
	}

	//SHOW DATATABLE DETAIL DISKON - PRODUK

	public function promo_detail_produk(){
		$this->load->library('datatables');
		$this->datatables->select('id_produk');
		$this->datatables->from('detail_barang_diskon');
		$this->datatables->where('id_diskon',"".$this->input->post('id_diskon'));
		echo $this->datatables->generate();
	}

    //FUNCTION FOR MASTER DATA PRODUK (HELPER)
	public function produk_data(){
		$this->load->library('datatables');
		$this->datatables->select('id_produk,nama_produk,kategori,harga_jual');
		$this->datatables->from('produk');
		
		echo $this->datatables->generate();

		// Datatables Variables (Cara Manual*)
		// $draw = intval($this->input->get("draw"));
		// $start = intval($this->input->get("start"));
		// $length = intval($this->input->get("length"));
		// $produk = $this->Produk->getProduk('produk');
		// $data = array();

		// foreach ($produk->result() as $d) {
		// 	$d->harga_jual = number_format($d->harga_jual,0,",",".");
		// 	$data[] = array(
		// 		$d->id_produk,
		// 		$d->nama_produk,
		// 		$d->kategori,
		// 		$d->harga_jual,
		// 	);
		// }

		// $output = array(
		// 	"draw" => $draw,
		// 	"recordsTotal" => $produk->num_rows(),
		// 	"recordsFiltered" => $produk->num_rows(),
		// 	"data" => $data,
		// );
		// echo json_encode($output);
		// exit();
	}

	public function select_edit_produk(){
		$id = $this->input->post('id');
		$data = $this->Produk->getData("id_produk='".$id."'",'produk');
		echo json_encode($data);
	}

	public function edit_produk(){
		$id = $this->input->post('idlama');
		$where = array('id_produk' => $id);

		$idbaru = $this->input->post('id');
		$wherebaru = array('id_produk' => $idbaru);
		$count = $this->Produk->getRowCount('produk',$wherebaru);

		if ($count>0 && $id != $idbaru) {
			echo "Update Error! ID Data Sudah ada di dalam database";
		}else{
			$data = array(
				'id_produk' => $this->input->post('id'),
		        'nama_produk' => $this->input->post('nama'),
		        'kategori' => $this->input->post('kategori'),
		        'harga_jual' => $this->input->post('harga')
	         );
			$this->Post->Update('produk',$data,$where);
			echo "Berhasil Diupdate";
		}
	}

	public function delete_produk(){
		$id = $this->input->post('id');
		$this->Produk->Delete('produk',$id);
	}

	public function masterdatastan(){
		// $data = [];
  //     $alldata = $this->Post->getAllData("stan");
  //     foreach ($alldata as $value) {
  //     	array_push($data, array($value["id_stan"],$value["nama_stan"],$value["alamat"],$value["password"],"<button class='btn btn-warning'>Edit</button>","<button class='btn btn-danger'>Delete</button>"));
  //     }
      // var_dump(json_encode($data));
		$akses = $this->session->userdata('aksessupadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('superadminfranchise/navigationbar');
            $this->load->view('superadminfranchise/masterdatastan');
			$this->load->view('superadminfranchise/datatable_stan');
        }
		
	}

	public function datastan(){
		$this->load->library('datatables');
		$this->datatables->select('stan.id_stan,nama_stan,alamat,password,uang_makan,uang_lembur,pinalti_bolos,batas_telat_lembur,standar_lembur');
		$this->datatables->from('stan');
		$this->datatables->join('data_detail_stan','stan.id_stan = data_detail_stan.id_stan');
		echo$this->datatables->generate();
	}

	public function tambah_stan(){
		$id = $this->input->post('id');
		$where = array('id_stan' => $id);
		$count = $this->Produk->getRowCount('stan',$where);

		if ($count>0) {
			echo "ID Data Sudah ada di dalam database";
		}else{
			$data = array(
		        'id_stan' => $this->input->post('id'),
		        'nama_stan' => $this->input->post('nama'),
		        'alamat' => $this->input->post('alamat'),
		        'password' => $this->input->post('password')
		    );

			$this->Produk->insert('stan',$data);

			$data = array(
				'id_stan' => $this->input->post('id'),
				'uang_makan' => $this->input->post('uang_makan'),
		        'uang_lembur' => $this->input->post('uang_lembur'),
		        'pinalti_bolos' => $this->input->post('pinalti_bolos'),
		        'batas_telat_lembur' => $this->input->post('batas_telat_lembur'),
		        'standar_lembur' => $this->input->post('standar_lembur')
		    );

		    $this->Produk->insert('data_detail_stan',$data);
			echo "Berhasil Ditambahkan";
		}
	}

	public function delete_stan(){
		$id = $this->input->post('id');
		$this->Produk->delete('stan',$id);
	}

	public function select_edit_stan(){
		$id = $this->input->post('id');
		$data = $this->Produk->getDataJoin("stan.id_stan='".$id."'",'stan','data_detail_stan','id_stan','id_stan');
		echo json_encode($data);
	}

	public function edit_stan(){

		$id = $this->input->post('id_lama');
		$where = array('id_stan' => $id);

		$idbaru = $this->input->post('id');
		$wherebaru = array('id_stan' => $idbaru);
		$count = $this->Produk->getRowCount('stan',$wherebaru);

		if ($count>0 && $id != $idbaru) {
			echo "Update Error! ID Data Sudah ada di dalam database";
		}else{
			$data = array(
				'id_stan' => $idbaru,
		        'nama_stan' => $this->input->post('nama'),
		        'alamat' => $this->input->post('alamat'),
		        'password' => $this->input->post('password')
		    );
			$this->Post->Update('stan',$data,$where);

			$data = array(
				'uang_makan' => $this->input->post('uang_makan'),
		        'uang_lembur' => $this->input->post('uang_lembur'),
		        'pinalti_bolos' => $this->input->post('pinalti_bolos'),
		        'batas_telat_lembur' => $this->input->post('batas_telat_lembur'),
		        'standar_lembur' => $this->input->post('standar_lembur')
		    );
			$this->Post->Update('data_detail_stan',$data,$where);
			echo "Berhasil Diupdate";
		}
	}

	public function gajibonusstan(){
		$akses = $this->session->userdata('aksessupadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('superadminfranchise/navigationbar');
            $this->load->view('superadminfranchise/gajibonusstan');
			// $this->load->view('superadminfranchise/datatable_promo');
        }
	}

	public function skemapromo(){
		$akses = $this->session->userdata('aksessupadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	// $this->updateDiskon();
        	$this->load->view('superadminfranchise/navigationbar');
            $this->load->view('superadminfranchise/skemapromo');
			$this->load->view('superadminfranchise/datatable_promo');
        }
		
	}

	//GET DATA PROMO YANG AKAN DIEDIT
	public function select_edit_promo(){
		$id = $this->input->post('id');
		$data = $this->Produk->getData("id_diskon='".$id."'",'diskon');
		echo json_encode($data);
	}

	public function select_edit_datatable_produk_promo()
	{
		$id = $this->input->post('id');
		$data = $this->Produk->getData("id_diskon='".$id."'",'detail_barang_diskon');
		echo json_encode($data);
	}

	public function select_edit_datatable_stan_promo()
	{
		$id = $this->input->post('id');
		$data = $this->Produk->getData("id_diskon='".$id."'",'detail_stan_diskon');
		echo json_encode($data);
	}

	//TAMBAH PROMO

	public function tambah_promo(){
		$statusalladd = false;
		$deleteall = false;
		//add to promo table
		$id = IDPromoGenerator();
		if ($this->input->post('jenis') == 'nominal' || $this->input->post('jenis') == 'persen') {
			$jenis = $this->input->post('jenis').$this->input->post('nilai_promo');
		}else{
			$jenis = $this->input->post('jenis');
		}

		$tanggal_mulai = $this->input->post('tanggal_mulai');
		$tanggal_akhir = $this->input->post('tanggal_akhir');

		// $parttanggalmulai = explode('/', $tanggal_mulai);
		// $parttanggalakhir = explode('/', $tanggal_akhir);
		// $tanggal_mulai = $parttanggalmulai[2].'/'.$parttanggalmulai[1].'/'.$parttanggalmulai[0];
		// $tanggal_akhir = $parttanggalakhir[2].'/'.$parttanggalakhir[1].'/'.$parttanggalakhir[0];

		$tanggal_mulai = strtotime($tanggal_mulai);
		$tanggal_mulai = date('Y-m-d',$tanggal_mulai);

		$tanggal_akhir = strtotime($tanggal_akhir);
		$tanggal_akhir = date('Y-m-d',$tanggal_akhir);
		
		// nama_promo:nama_promo,tanggal_mulai:tanggal_mulai,tanggal_akhir:tanggal_akhir,jam_mulai:jam_mulai,jam_akhir:jam_akhir,hariall:hariall,jenis:jenis,nilai_promo:nilai_promo,stanall:stanall,produkall:produkall
		$data = array(
	        'id_diskon' => $id,
	        'nama_diskon' => $this->input->post('nama_promo'),
	        'jenis_diskon' => $jenis,
	        'tanggal_mulai' => $tanggal_mulai,
	        'tanggal_akhir' => $tanggal_akhir,
	        'jam_mulai' => $this->input->post('jam_mulai'),
	        'jam_akhir' => $this->input->post('jam_akhir'),
	        'hari' => $this->input->post('hariall'),
	        'status' => "active"
        );
		$statusalladd = $this->Produk->insert('diskon',$data);

		if ($statusalladd == true) {
			$stanall = $this->input->post('stanall');
			$produkall = $this->input->post('produkall');

			$stan = explode(",",$stanall);
			$produk = explode(",",$produkall);
			//add to detail stan table
			foreach ($stan as $value) {
				$data = array(
			        'id_diskon' => $id,
			        'id_stan' => $value
		        );
				$statusalladd = $this->Produk->insert('detail_stan_diskon',$data);
				if ($statusalladd == false) {
					$deleteall = true;
				}
			}

			//add to detail product table

			foreach ($produk as $value) {
				$data = array(
			        'id_diskon' => $id,
			        'id_produk' => $value
		        );
				$statusalladd = $this->Produk->insert('detail_barang_diskon',$data);
				if ($statusalladd == false) {
					$deleteall = true;
				}
			}
		}else{
			$deleteall = true;
		}

		if ($deleteall == true) {
			$this->Produk->delete('diskon',$id);
			$this->Produk->delete('detail_barang_diskon',$id);
			$this->Produk->delete('detail_stan_diskon',$id);
		}
		if ($deleteall == true) {
			echo false;
		}else{
			echo true;
		}

	}

	public function edit_promo(){

		$statusalladd = false;
		$deleteall = false;
		//add to promo table
		$id = $this->input->post('id_simpaneditpromo');
		$where = array('id_diskon' => $id);

		if ($this->input->post('jenis_edit') == 'nominal' || $this->input->post('jenis_edit') == 'persen') {
			$jenis = $this->input->post('jenis_edit').$this->input->post('nilai_promo_edit');
		}else{
			$jenis = $this->input->post('jenis_edit');
		}

		$tanggal_mulai = $this->input->post('tanggal_mulai_edit');
		$tanggal_akhir = $this->input->post('tanggal_akhir_edit');

		$tanggal_mulai = strtotime($tanggal_mulai);
		$tanggal_mulai = date('Y-m-d',$tanggal_mulai);

		$tanggal_akhir = strtotime($tanggal_akhir);
		$tanggal_akhir = date('Y-m-d',$tanggal_akhir);
		
		// nama_promo:nama_promo,tanggal_mulai:tanggal_mulai,tanggal_akhir:tanggal_akhir,jam_mulai:jam_mulai,jam_akhir:jam_akhir,hariall:hariall,jenis:jenis,nilai_promo:nilai_promo,stanall:stanall,produkall:produkall
		$data = array(
	        'id_diskon' => $id,
	        'nama_diskon' => $this->input->post('nama_promo_edit'),
	        'jenis_diskon' => $jenis,
	        'tanggal_mulai' => $tanggal_mulai,
	        'tanggal_akhir' => $tanggal_akhir,
	        'jam_mulai' => $this->input->post('jam_mulai_edit'),
	        'jam_akhir' => $this->input->post('jam_akhir_edit'),
	        'hari' => $this->input->post('hariall_edit'),
	        'status' => $this->input->post('status_simpaneditpromo')
        );

		$statusalladd = $this->Produk->update('diskon',$data,$where);

			$stanall = $this->input->post('stanall_edit');
			$produkall = $this->input->post('produkall_edit');

			$this->Produk->delete('detail_stan_diskon',$id);
			$this->Produk->delete('detail_barang_diskon',$id);

			$stan = explode(",",$stanall);
			$produk = explode(",",$produkall);
			//add to detail stan table
			foreach ($stan as $value) {
				$data = array(
			        'id_diskon' => $id,
			        'id_stan' => $value
		        );
				$statusalladd = $this->Produk->insert('detail_stan_diskon',$data);
				if ($statusalladd == false) {
					$deleteall = true;
				}
			}

			//add to detail product table

			foreach ($produk as $value) {
				$data = array(
			        'id_diskon' => $id,
			        'id_produk' => $value
		        );
				$statusalladd = $this->Produk->insert('detail_barang_diskon',$data);
				if ($statusalladd == false) {
					$deleteall = true;
				}
			}

		if ($deleteall == true) {
			echo false;
		}else{
			echo true;
		}
	}

	public function change_status_diskon()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		if ($status == 'active') {
			$status = 'inactive';
		}else{
			$status = 'active';
		}

		$where = array('id_diskon' => $id);

		$data = array('status' => $status);
		$this->Post->Update('diskon',$data,$where);
		echo "Berhasil Diupdate";
	}

	public function show_list_stan()
	{
		$this->load->library('datatables');
		$this->datatables->select('id_stan,nama_stan,alamat');
		$this->datatables->from('stan');
		
		echo $this->datatables->generate();
	}

	public function show_list_produk()
	{
		$this->load->library('datatables');
		$this->datatables->select('id_produk,nama_produk,harga_jual');
		$this->datatables->from('produk');
		
		echo $this->datatables->generate();
	}

	public function get_list_stan()
	{
		$data = $this->Produk->getAllData('stan');
		echo json_encode($data);
	}

	public function get_list_produk()
	{
		$data = $this->Produk->getAllData('produk');
		echo json_encode($data);
	}

	public function masterdatakaryawan(){
		$akses = $this->session->userdata('aksessupadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('superadminfranchise/navigationbar');
            $this->load->view('superadminfranchise/masterdatakaryawan');
			$this->load->view('superadminfranchise/datatable_karyawan');
        }
		
	}

	public function lappenjstan(){
		$akses = $this->session->userdata('aksessupadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('superadminfranchise/navigationbar');
            $this->load->view('superadminfranchise/lappenjstan');
			$this->load->view('superadminfranchise/datatable_lappenjstan');
        }
		
	}

	public function notaData(){
		$tanggal_awal = $this->input->post('tanggal_awal');
		$tanggal_akhir = $this->input->post('tanggal_akhir');
		$id_stan = $this->input->post('id_stan');
		$shift = $this->input->post('shift');

		if ($tanggal_awal =='') {
			$tanggal_awal = '01/01/1970';
		}

		if ($tanggal_akhir =='') {
			$tanggal_akhir = '01/01/1970';
		}

		$parttanggalawal = explode('/', $tanggal_awal);
		$parttanggalakhir = explode('/', $tanggal_akhir);

		$tanggal_awal = $parttanggalawal[2].'/'.$parttanggalawal[1].'/'.$parttanggalawal[0];
		$tanggal_akhir = $parttanggalakhir[2].'/'.$parttanggalakhir[1].'/'.$parttanggalakhir[0];
		$tanggal_akhir = strtotime($tanggal_akhir);
		$tanggal_akhir = date('Y-m-d',$tanggal_akhir);

		$tanggal_awal = strtotime($tanggal_awal);
		$tanggal_awal = date('Y-m-d',$tanggal_awal);

		// var_dump($tanggal_akhir);

		if ($shift == 'all') {
			$array = array('id_stan' => $id_stan, 'tanggal_nota >=' => $tanggal_awal, 'tanggal_nota <=' => $tanggal_akhir);
		}else{
			$array = array('id_stan' => $id_stan, 'tanggal_nota >=' => $tanggal_awal, 'tanggal_nota <=' => $tanggal_akhir, 'shift' => $shift);
		}
		

		$data = $this->Produk->getDataWhereDesc2column('nota',$array,"tanggal_nota DESC, waktu_nota DESC");
		// var_dump($data);
		echo json_encode($data);
	}

	public function detailNotaData()
	{
		$id_nota = $this->input->post('id_nota');
		$array = array('id_nota' => $id_nota);
		$data = $this->Produk->getData($array,'detail_nota');
		echo json_encode($data);

	}

	public function select_detail_nota()
	{
		$id = $this->input->post('id');
		$array = array('id_nota' => $id);
		$data = $this->Produk->getData($array,'nota');
		echo json_encode($data);
		//DETAIL
	}

	public function sendDataStan()
	{
		$data = $this->Produk->getAllData('stan');
		echo json_encode($data);
	}

	public function sendDataProduk()
	{
		$data = $this->Produk->getAllData('produk');
		echo json_encode($data);
	}

	public function sendDataDiskon()
	{
		// $this->updateDiskon();
		// $datenow = date("Y/m/d");
		// $daynow = date("w");
		// switch ($daynow) {
		// 	case 0:
		// 		$daynow = 'minggu';
		// 		break;
		// 	case 1:
		// 		$daynow = 'senin';
		// 		break;
		// 	case 2:
		// 		$daynow = 'selasa';
		// 		break;
		// 	case 3:
		// 		$daynow = 'rabu';
		// 		break;
		// 	case 4:
		// 		$daynow = 'kamis';
		// 		break;
		// 	case 5:
		// 		$daynow = 'jumat';
		// 		break;
		// 	case 6:
		// 		$daynow = 'sabtu';
		// 		break;
			
		// 	default:
		// 		break;
		// }

		$id = $this->input->post('id_stan');
		$where = array('id_stan' => $id);
		$listdiskon = array();
		$datas = $this->Produk->getData($where,'detail_stan_diskon');

		foreach ($datas as $data) {
			$where2 = array('id_diskon' => $data->id_diskon);
			$query = $this->Produk->getFirstRowData($where2,'diskon');
			if ($query->status == 'active') {
				// $days =  explode(",", $perdiskonaktif->hari);
				// $get = true;
				// if ($perdiskonaktif->tanggal_mulai > $datenow || $perdiskonaktif->tanggal_akhir < $datenow) {
				// 	$get = false;
				// }

				// if (!in_array($daynow, $days)) {
				// 	$get = false;
				// }

				// if ($get) {
					array_push($listdiskon, $data->id_diskon);
				// }
				
			}
			
		}

		if (count($listdiskon) == 0) {
			array_push($listdiskon, '');
		}

		$diskondata = $this->Produk->getDataIn('diskon',$listdiskon);
		echo json_encode($diskondata);
	}

	public function sendDataOrder()
	{
		$where = array('status' => 'done');
		$data = $this->Produk->getData($where,'order_bahan_jadi_stan');
		echo json_encode($data);
	}

	// public function updateDiskon()
	// {
	// 	$whereact = array('status' => 'active');
	// 	$alldiskonactive = $this->Produk->getData($whereact,'diskon');
	// 	$datenow = date("Y/m/d");
	// 	$daynow = date("w");
	// 	switch ($daynow) {
	// 		case 0:
	// 			$daynow = 'minggu';
	// 			break;
	// 		case 1:
	// 			$daynow = 'senin';
	// 			break;
	// 		case 2:
	// 			$daynow = 'selasa';
	// 			break;
	// 		case 3:
	// 			$daynow = 'rabu';
	// 			break;
	// 		case 4:
	// 			$daynow = 'kamis';
	// 			break;
	// 		case 5:
	// 			$daynow = 'jumat';
	// 			break;
	// 		case 6:
	// 			$daynow = 'sabtu';
	// 			break;
			
	// 		default:
	// 			break;
	// 	}

	// 	foreach ($alldiskonactive as $perdiskonaktif) {
	// 		$days =  explode(",", $perdiskonaktif->hari);
	// 		$update = false;
	// 		if ($perdiskonaktif->tanggal_mulai > $datenow || $perdiskonaktif->tanggal_akhir < $datenow) {
	// 			$update = true;
	// 		}

	// 		if (!in_array($daynow, $days)) {
	// 			$update = true;
	// 		}

	// 		if ($update) {
	// 			$wheretoinactive = array('id_diskon' => $perdiskonaktif->id_diskon);
	// 			$datatoinactive = array('status' => 'inactive');
	// 			$this->Produk->update('diskon', $datatoinactive, $wheretoinactive);
	// 		}
	// 	}
	// }

	public function sendDataDetailDiskonProduk()
	{

		$id = $this->input->post('id_stan');
		$where = array('id_stan' => $id);
		$listdiskon = array();
		$datas = $this->Produk->getData($where,'detail_stan_diskon');

		foreach ($datas as $data) {
			$where2 = array('id_diskon' => $data->id_diskon);
			$query = $this->Produk->getFirstRowData($where2,'diskon');
			if ($query->status == 'active') {
				// $days =  explode(",", $perdiskonaktif->hari);
				// $get = true;
				// if ($perdiskonaktif->tanggal_mulai > $datenow || $perdiskonaktif->tanggal_akhir < $datenow) {
				// 	$get = false;
				// }

				// if (!in_array($daynow, $days)) {
				// 	$get = false;
				// }

				// if ($get) {
					array_push($listdiskon, $data->id_diskon);
				// }
				
			}
			
		}

		if (count($listdiskon) == 0) {
			array_push($listdiskon, '');
		}

		$dataproduk = $this->Produk->getDataIn('detail_barang_diskon',$listdiskon);
		echo json_encode($dataproduk);
	}

	public function sendDataBahanJadi()
	{
		$data = $this->Produk->getAllData('bahan_jadi');
		echo json_encode($data);
	}

	public function insertDataNota()
	{
		$data_nota = json_decode($this->input->post('allnota'));
		$data_detail_nota = json_decode($this->input->post('detailnota'));
		$id_stan = $this->input->post('id_stan');
		$ress = true;

		foreach ($data_nota as $pernota) {
			$where = array('id_nota' => $pernota->id_nota);
			$newdata = array(
				'id_nota' => $pernota->id_nota,
				'id_stan' => $id_stan,
				'tanggal_nota' => $pernota->tanggal_nota,
				'waktu_nota' => $pernota->waktu_nota, 
				'nama_diskon' => $pernota->nama_diskon,
				'jenis_diskon' => $pernota->jenis_diskon,
				'status' => $pernota->status,
				'total_harga' => $pernota->total_harga,
				'pembayaran' => $pernota->pembayaran,
				'keterangan' => $pernota->keterangan,
				'keterangan_void' => $pernota->keterangan_void,
				'shift' => $pernota->shift
				// 'id_nota' => $pernota->id_nota,
				// 'nama_produk' => $pernota->nama_produk,
				// 'jumlah_produk' => $pernota->jumlah_produk,
				// 'kategori_produk' => $pernota->kategori_produk,
				// 'harga_produk' => $pernota->harga_produk,
				// 'total_harga_produk' => $pernota->total_harga_produk
			);

			// var_dump($newdata);
			if ($this->Produk->checkExist('nota',$where)) {
				$stat = $this->Produk->update('nota', $newdata, $where);
			}else{
				$stat = $this->Produk->insert('nota',$newdata);
			}
			
			if (!$stat) {
				$ress = false;
			}
			// var_dump($pernota);
		}

		foreach ($data_detail_nota as $perdetail) {
			$where = array('id_nota' => $perdetail->id_nota,'nama_produk' => $perdetail->nama_produk);
			$stat2 = true;
			// $newdetail = array(
			// 	'id_nota' => $perdetail->id_nota,
			// 	'nama_produk' => $perdetail->nama_produk,
			// 	'jumlah_produk' => $perdetail->jumlah_produk,
			// 	'kategori_produk' => $perdetail->kategori_produk,
			// 	'harga_produk' => $perdetail->harga_produk,
			// 	'total_harga_produk' => $perdetail->total_harga_produk
			// );
			if (!$this->Produk->checkExist('detail_nota',$where)) {
				$stat2 = $this->Produk->insert('detail_nota',$perdetail);
			}
			
			if (!$stat2) {
				$ress = false;
			}
		}

		// echo gettype($data_nota)." ".gettype($data_detail_nota);
		if ($ress) {
			echo 'true';
		}else{
			echo 'false';
		}
		
	}

	public function insertDataStok()
	{
		$data_stok = json_decode($this->input->post('allstok'));
		$id_stan = $this->input->post('id_stan');
		$ress = true;

		foreach ($data_stok as $perstok) {

			$where = array('id_bahan_jadi' => $perstok->id_bahan_jadi,'id_stan' => $id_stan,'tanggal' => $perstok->tanggal);
			$newdata = array(
				'id_bahan_jadi' => $perstok->id_bahan_jadi,
				'id_stan' => $id_stan,
				'nama_bahan_jadi' => $perstok->nama_bahan_jadi,
				'stok_masuk' => $perstok->stok_masuk, 
				'stok_keluar' => $perstok->stok_keluar,
				'stok_sisa' => $perstok->stok_sisa,
				'tanggal' => $perstok->tanggal
			);

			if ($this->Produk->checkExist('stok_bahan_jadi',$where)) {
				$stat = $this->Produk->update('stok_bahan_jadi', $newdata, $where);
			}else{
				$stat = $this->Produk->insert('stok_bahan_jadi',$newdata);
			}

			// if (!$this->Produk->checkExist('stok_bahan_jadi',$where)) {
			// 	$stat = $this->Produk->insert('stok_bahan_jadi',$newdata);
			// }
			
			// if (!$stat) {
			// 	$ress = false;
			// }
		}

		// echo gettype($data_nota)." ".gettype($data_detail_nota);
		if ($ress) {
			echo 'true';
		}else{
			echo 'false';
		}
		
	}

	public function masterbahanjadi()
	{
		$akses = $this->session->userdata('aksessupadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('superadminfranchise/navigationbar');
            $this->load->view('superadminfranchise/masterbahanjadi');
			// $this->load->view('superadminfranchise/datatable_produk');

        }
	}

	public function tambahbahanjadi()
	{
		$id = $this->input->post('id');
		$where = array('id_bahan_jadi' => $id);
		$count = $this->Produk->getRowCount('bahan_jadi',$where);

		if ($count>0) {
			echo "ID Data Sudah ada di dalam database";
		}else{
			$data = array(
		        'id_bahan_jadi' => $this->input->post('id'),
		        'nama_bahan_jadi' => $this->input->post('nama'),
		        'harga_bahan_jadi' => $this->input->post('hargabeli')
	         );
			$this->Produk->insert('bahan_jadi',$data);
			echo "Berhasil Ditambahkan";
		}
	}

	public function select_edit_bahanjadi()
	{
		$id = $this->input->post('id');
		$data = $this->Produk->getData("id_bahan_jadi='".$id."'",'bahan_jadi');
		echo json_encode($data);
	}

	public function delete_bahanjadi()
	{
		$id = $this->input->post('id');
		$this->Produk->Delete('bahan_jadi',$id);
	}

	public function edit_bahanjadi()
	{
		$id = $this->input->post('idlama');
		$where = array('id_bahan_jadi' => $id);

		$idbaru = $this->input->post('id');
		$wherebaru = array('id_bahan_jadi' => $idbaru);
		$count = $this->Produk->getRowCount('bahan_jadi',$wherebaru);

		if ($count>0 && $id != $idbaru) {
			echo "Update Error! ID Data Sudah ada di dalam database";
		}else{
			$data = array(
				'id_bahan_jadi' => $this->input->post('id'),
		        'nama_bahan_jadi' => $this->input->post('nama'),
		        'harga_bahan_jadi' => $this->input->post('hargabeli')
	         );
			$this->Post->Update('bahan_jadi',$data,$where);
			echo "Berhasil Diupdate";
		}
	}

	public function bahanjadi_data()
	{
		$this->load->library('datatables');
		$this->datatables->select('id_bahan_jadi,nama_bahan_jadi,harga_bahan_jadi');
		$this->datatables->from('bahan_jadi');
		
		echo $this->datatables->generate();
	}

	public function lapsisastok()
	{
		$akses = $this->session->userdata('aksessupadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('superadminfranchise/navigationbar');
            $this->load->view('superadminfranchise/lapsisastok');
			$this->load->view('superadminfranchise/datatable_lapsisastok');
        }
	}

	public function stokData(){
		$tanggal_awal = $this->input->post('tanggal_awal');
		$tanggal_akhir = $this->input->post('tanggal_akhir');
		$id_stan = $this->input->post('id_stan');

		if ($tanggal_awal =='') {
			$tanggal_awal = '01/01/1970';
		}

		if ($tanggal_akhir =='') {
			$tanggal_akhir = '01/01/1970';
		}

		$parttanggalawal = explode('/', $tanggal_awal);
		$parttanggalakhir = explode('/', $tanggal_akhir);

		$tanggal_awal = $parttanggalawal[2].'/'.$parttanggalawal[1].'/'.$parttanggalawal[0];
		$tanggal_akhir = $parttanggalakhir[2].'/'.$parttanggalakhir[1].'/'.$parttanggalakhir[0];
		$tanggal_akhir = strtotime($tanggal_akhir);
		$tanggal_akhir = date('Y-m-d',$tanggal_akhir);

		$tanggal_awal = strtotime($tanggal_awal);
		$tanggal_awal = date('Y-m-d',$tanggal_awal);

		// var_dump($tanggal_akhir);

		$array = array('id_stan' => $id_stan, 'tanggal >=' => $tanggal_awal, 'tanggal <=' => $tanggal_akhir);

		$data = $this->Produk->getData($array,'stok_bahan_jadi');
		// var_dump($data);
		echo json_encode($data);
	}

	public function insertDataPengeluaran()
	{
		$data_pengeluaran = json_decode($this->input->post('allpengeluaran'));
		$id_stan = $this->input->post('id_stan');
		$ress = true;

		foreach ($data_pengeluaran as $perpengeluaran) {
			$where = array('id_pengeluaran' => $perpengeluaran->id_pengeluaran, 'id_stan' => $id_stan);
			$newdata = array(
				'id_pengeluaran' => $perpengeluaran->id_pengeluaran,
				'id_stan' => $id_stan,
				'tanggal' => $perpengeluaran->tanggal,
				'keterangan' => $perpengeluaran->keterangan, 
				'pengeluaran' => $perpengeluaran->pengeluaran,
				'shift' => $perpengeluaran->shift
			);

			// var_dump($newdata);
			if ($this->Produk->checkExist('pengeluaran_lain',$where)) {
				$stat = $this->Produk->update('pengeluaran_lain', $newdata, $where);
			}else{
				$stat = $this->Produk->insert('pengeluaran_lain',$newdata);
			}
			
			if (!$stat) {
				$ress = false;
			}
		}

		// if ($ress) {
			echo 'true';
		// }else{
		// 	echo 'false';
		// }
			// var_dump($pernota);
	}

	public function insertDataKas()
	{
		$data_kas = json_decode($this->input->post('allkas'));
		$id_stan = $this->input->post('id_stan');
		$ress = true;

		foreach ($data_kas as $perkas) {
			$where = array('tanggal' => $perkas->tanggal, 'id_stan' => $id_stan, 'shift' => $perkas->shift);
			$newdata = array(
				'tanggal' => $perkas->tanggal,
				'id_stan' => $id_stan,
				'shift' => $perkas->shift,
				'kas_awal' => $perkas->kas_awal
			);

			// var_dump($newdata);
			if ($this->Produk->checkExist('kas',$where)) {
				$stat = $this->Produk->update('kas', $newdata, $where);
			}else{
				$stat = $this->Produk->insert('kas',$newdata);
			}
			
			if (!$stat) {
				$ress = false;
			}
		}

		// if ($ress) {
			echo 'true';
		// }else{
		// 	echo 'false';
		// }
			// var_dump($pernota);
	}

	public function deleteDataPengeluaran()
	{
		$pengeluaran_lain = $this->input->post('id_pengeluaran');
		$id_stan = $this->input->post('id_stan');
		$where = array('id_pengeluaran' => $pengeluaran_lain , 'id_stan' => $id_stan);

		$this->Produk->DeleteWhere('pengeluaran_lain',$where);
		echo "true";
	}

	public function insertDataKaryawanFingerspot()
	{
		$data_karyawan = json_decode($this->input->post('allkaryawan'));
		$id_stan = $this->input->post('id_stan');
		$ress = true;

		foreach ($data_karyawan as $perkaryawan) {
			$where = array('pin' => $perkaryawan->pin, 'id_stan' => $id_stan);
			$newdata = array(
				'pin' => $perkaryawan->pin,
				'id_stan' => $id_stan,
				'nama' => $perkaryawan->nama
			);

			// var_dump($newdata);
			if ($this->Produk->checkExist('karyawan_fingerspot',$where)) {
				$stat = $this->Produk->update('karyawan_fingerspot', $newdata, $where);
			}else{
				$stat = $this->Produk->insert('karyawan_fingerspot',$newdata);
			}
			
			if (!$stat) {
				$ress = false;
			}
		}
			echo 'true';
	}

	public function insertDataPresensiKaryawan()
	{
		$data_presensi = json_decode($this->input->post('allpresensi'));
		$id_stan = $this->input->post('id_stan');
		$ress = true;

		foreach ($data_presensi as $perpresensi) {
			$where = array('scan_date' => $perpresensi->scan_date, 'id_stan' => $id_stan, 'pin' => $perpresensi->pin);
			$newdata = array(
				'scan_date' => $perpresensi->scan_date,
				'id_stan' => $id_stan,
				'pin' => $perpresensi->pin,
				'verify_mode' => $perpresensi->verify_mode,
				'io_mode' => $perpresensi->io_mode,
				'work_code' => $perpresensi->work_code
			);

			// var_dump($newdata);
			if ($this->Produk->checkExist('presensi_karyawan',$where)) {
				$stat = $this->Produk->update('presensi_karyawan', $newdata, $where);
			}else{
				$stat = $this->Produk->insert('presensi_karyawan',$newdata);
			}
			
			if (!$stat) {
				$ress = false;
			}
		}
		echo 'true';
	}

	public function insertDataOrder()
	{
		$data_order = json_decode($this->input->post('allorder'));
		$data_detail_order = json_decode($this->input->post('detailorder'));
		$id_stan = $this->input->post('id_stan');
		$ress = true;

		foreach ($data_order as $perorder) {
			$where = array('id_order' => $perorder->id_order);
			$newdata = array(
				'id_order' => $perorder->id_order,
				'tanggal_order' => $perorder->tanggal_order,
				'status' => $perorder->status
			);
			if ($this->Produk->checkExist('order_bahan_jadi_stan',$where)) {
				$stat = $this->Produk->update('order_bahan_jadi_stan', $newdata, $where);
			}else{
				$stat = $this->Produk->insert('order_bahan_jadi_stan',$newdata);
			}
			
			if (!$stat) {
				$ress = false;
			}
		}

		foreach ($data_detail_order as $perdetail) {
			$where = array('id_detail_order' => $perdetail->id_detail_order);
			if (!$this->Produk->checkExist('detail_order_bahan_jadi_stan',$where)) {
				$stat2 = $this->Produk->insert('detail_order_bahan_jadi_stan',$perdetail);
			}
			
			if (!$stat2) {
				$ress = false;
			}
		}
		if ($ress) {
			echo 'true';
		}else{
			echo 'false';
		}
	}

	public function sendUpdateOrder()
	{
		$list_data = $this->input->post('list_id_not_done');
		$id_stan = $this->input->post('id_stan');
		$where = array('status' => 'done');

		$alldatanotdone = $this->Produk->getDataInTableAndSpecificWhere('order_bahan_jadi_stan',$list_data,'id_order',$where);

		$data = array();

		foreach ($alldatanotdone as $perdatanotdone) {
			array_push($data, $perdatanotdone->id_order);
		}

		$stringfromdata = implode(",",$data);

		echo $stringfromdata;
	}

	public function get_list_bahan_jadi()
	{
		$data = $this->Produk->getAllData('bahan_jadi');
		echo json_encode($data);
	}

	public function rekapharianstan()
	{
		$akses = $this->session->userdata('aksessupadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('superadminfranchise/navigationbar');
            $this->load->view('superadminfranchise/rekapdataharian');
        }
	}

	public function rekappengeluaranstan()
	{
		$akses = $this->session->userdata('aksessupadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('superadminfranchise/navigationbar');
            $this->load->view('superadminfranchise/rekappengeluaranstanharian');
        }
	}

	public function getdetailpengeluaranrekap()
	{
	    $id_stan = $this->input->post('id_stan');
	    $tanggal_rekap = $this->input->post('tanggal_rekap');
	    $tanggal_rekap = explode("/", $tanggal_rekap);
	    $tanggal_rekap = $tanggal_rekap[2]."-".$tanggal_rekap[1]."-".$tanggal_rekap[0];

	    $where = array(
	    	'id_stan' => $id_stan,
	    	'tanggal' => $tanggal_rekap
	    );

	    $datalist = $this->Produk->getData($where,'pengeluaran_lain');

	    echo json_encode($datalist);
	}

	public function getrekapdata()
  {
    date_default_timezone_set("Asia/Bangkok");
    $datenow = date("Y-m-d");
    $id_stan = $this->input->post('id_stan');
    $shift = $this->input->post('shift');
    $tanggal_rekap = $this->input->post('tanggal_rekap');
    $tanggal_rekap = explode("/", $tanggal_rekap);
    $tanggal_rekap = $tanggal_rekap[2]."-".$tanggal_rekap[1]."-".$tanggal_rekap[0];

    if ($shift == 'all') {
    	$where = array('id_stan' => $id_stan, 'tanggal' => $tanggal_rekap);
    	$wherenota = array('id_stan' => $id_stan, 'tanggal_nota' => $tanggal_rekap);
    }else{
    	$where = array('id_stan' => $id_stan, 'tanggal' => $tanggal_rekap, 'shift' => $shift);
    	$wherenota = array('id_stan' => $id_stan, 'tanggal_nota' => $tanggal_rekap, 'shift' => $shift);
    }

    $datapengeluaran = $this->Produk->getData($where,'pengeluaran_lain');
    $datakas = $this->Produk->getData($where,'kas');
    $datapenjualan = $this->Produk->getData($wherenota,'nota');

    $kasawal = 0;
    $kaspagi = 0;
      $kasmalam = 0;
    

    if (empty($datakas)) {
      
    }else{

      foreach ($datakas as $perkas) {
        if ($perkas->shift == 'pagi') {
          $kaspagi = $perkas->kas_awal;
        }else{
          $kasmalam = $perkas->kas_awal;
        }
        $kasawal = $perkas->kas_awal;
        //+
      }
    }

    if (empty($datapengeluaran)) {
      $pengeluaran = 0;
    }else{
      $pengeluaran = 0;
      foreach ($datapengeluaran as $perpengeluaran) {
        $pengeluaran+=$perpengeluaran->pengeluaran;
      }
    }

    $hasilpenjualan = 0;
    $cashdetail = 0;
    $ovodetail = 0;
    $debitdetail = 0;
    $totalkasir = 0;

    if (!empty($datapenjualan)) {
      foreach ($datapenjualan as $perpenjualan) {
        if ($perpenjualan->pembayaran == 'cash') {
          $cashdetail += $perpenjualan->total_harga;
        }else if ($perpenjualan->pembayaran == 'debit') {
          $debitdetail += $perpenjualan->total_harga;
        }else if ($perpenjualan->pembayaran == 'ovo') {
          $ovodetail += $perpenjualan->total_harga;
        }
      }

      $hasilpenjualan = $cashdetail+$debitdetail+$ovodetail;
    }

    $totalkasir = $kasawal+$cashdetail-$pengeluaran;
    $totalpemasukan = $hasilpenjualan-$pengeluaran;

    $lastarraysend = array(
      'kasawal' => $kasawal,
      'pengeluaran' => $pengeluaran,
      'hasilpenjualan' => $hasilpenjualan,
      'cashdetail' => $cashdetail,
      'ovodetail' => $ovodetail,
      'debitdetail' => $debitdetail,
      'totalkasir' => $totalkasir,
      'totalpemasukan' => $totalpemasukan,
      'kaspagi' => $kaspagi,
      'kasmalam' => $kasmalam
    );

    echo json_encode($lastarraysend);
  }

  public function savegajibonus()
  {
  	$persen = $this->input->post('persen');
  	$idstan = $this->input->post('idstan');
  	$omset = $this->input->post('omset');

  	$data = array(
  		'id_stan' => $idstan,
  		'omset_minimal' => $omset,
  		'persentase_bonus' => $persen,
  		'status' => 'active'
  	);

  	$ok = $this->Produk->insert('gaji_bonus_stan',$data);

  	echo "sukses";
  }

  public function lappembelian()
  {
  	$akses = $this->session->userdata('aksessupadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('superadminfranchise/navigationbar');
            $this->load->view('superadminfranchise/pembelian');
			// $this->load->view('superadminfranchise/datatable_produk');
        }
  }

  public function lappengeluaranwh()
  {
  	$akses = $this->session->userdata('aksessupadmin');
    if(empty($akses)){
        redirect('login');
    }else{
    	$this->load->view('superadminfranchise/navigationbar');
        $this->load->view('superadminfranchise/lappengeluaranwh');
		// $this->load->view('superadminfranchise/datatable_produk');
    }
  }

  public function topupmodal()
  {
  	$data = $this->input->post('jumlah');

  	if ($this->Produk->getRowCountAll('modal_gudang') <= 0) {

  		$datanew = array(
  			'id' => 'modaldata',
  			'jumlah_modal' => $data
  		);
  		$ok = $this->Produk->insert('modal_gudang',$datanew);
  	}else{
  		$datamodal = $this->Produk->getAllData('modal_gudang');
	    $modal = $datamodal[0]->jumlah_modal;
	    $data = array(
	      'jumlah_modal' => $modal+$data
	    );
	    $where = array(
	      'id' => 'modaldata'
	    );

	    $ok = $this->Produk->update('modal_gudang',$data, $where);
  	}

  	
    if ($ok) {
    	echo "sukses";
    }else{
    	echo "gagal";
    }
  }

  public function getpengeluaranlain()
  {
  	$tanggal = $this->input->post('tanggal');
  	$tanggal = explode("/", $tanggal);
  	$tanggal = $tanggal[1]."-".$tanggal[0]."-%";
  	$data = array('tanggal LIKE' => $tanggal);
  	// var_dump($tanggal);
  	$this->load->library('datatables');
    $this->datatables->select('id_pengeluaran,tanggal,keterangan,pengeluaran');
    $this->datatables->from('pengeluaran_lain_gudang');
    $this->datatables->where($data);
    echo $this->datatables->generate();
    
  }

  public function lapasetstokstan()
  {
  	$akses = $this->session->userdata('aksessupadmin');
    if(empty($akses)){
        redirect('login');
    }else{
    	$this->load->view('superadminfranchise/navigationbar');
        $this->load->view('superadminfranchise/lapasetstokstan');
		// $this->load->view('superadminfranchise/datatable_produk');
    }
  }

  public function lapasetstokwh()
  {
  	$akses = $this->session->userdata('aksessupadmin');
    if(empty($akses)){
        redirect('login');
    }else{
    	$this->load->view('superadminfranchise/navigationbar');
        $this->load->view('superadminfranchise/lapasetstokwh');
		// $this->load->view('superadminfranchise/datatable_produk');
    }
  }

  public function dataSisaStok()
  {
  	$tanggal = $this->input->post('tanggal');
  	$stan = $this->input->post('stan');

  	$where1 = array(
		'tanggal<=' => $tanggal
	);
	$getlasttanggal = $this->Produk->getLastDateWithWhere('MAX(tanggal) as tanggal','stok_bahan_jadi',$where1);
	// var_dump($getlasttanggal);
	if ($getlasttanggal[0]->tanggal === NULL) {
		$getlasttanggal[0]->tanggal = '';
	}
		
	if ($tanggal == '') {
		$where = array('tanggal' => '','id_stan' => $stan);
		$this->load->library('datatables');
		$this->datatables->select('stok_bahan_jadi.id_bahan_jadi,stok_bahan_jadi.nama_bahan_jadi,stok_bahan_jadi.stok_sisa,bahan_jadi.harga_bahan_jadi');
		$this->datatables->from('stok_bahan_jadi');
		$this->datatables->join('bahan_jadi','stok_bahan_jadi.id_bahan_jadi = bahan_jadi.id_bahan_jadi');
		$this->datatables->where($where);
		
		echo $this->datatables->generate();
	}else{
		$tanggal = strtotime($tanggal);
		$tanggal = date('Y-m-d',$tanggal);

		$where = array('tanggal' => $getlasttanggal[0]->tanggal,'id_stan' => $stan);
		// $alldata = $this->ModelKasir->getData($where,'stok_bahan_jadi');

		// return json_encode($alldata);

		$this->load->library('datatables');
		$this->datatables->select('stok_bahan_jadi.id_bahan_jadi,stok_bahan_jadi.nama_bahan_jadi,stok_bahan_jadi.stok_sisa,bahan_jadi.harga_bahan_jadi');
		$this->datatables->from('stok_bahan_jadi');
		$this->datatables->join('bahan_jadi','stok_bahan_jadi.id_bahan_jadi = bahan_jadi.id_bahan_jadi');
		$this->datatables->where($where);
		
		echo $this->datatables->generate();
	}
  }

  public function dataSisaStokwh()
  {
  	$tanggal = $this->input->post('tanggal');

  	$where1 = array(
		'tanggal<=' => $tanggal
	);
	$getlasttanggal = $this->Produk->getLastDateWithWhere('MAX(tanggal) as tanggal','stok_bahan_jadi_gudang',$where1);
	// var_dump($getlasttanggal);
	if ($getlasttanggal[0]->tanggal === NULL) {
		$getlasttanggal[0]->tanggal = '';
	}
		
	if ($tanggal == '') {
		$where = array('tanggal' => '');
		$this->load->library('datatables');
		$this->datatables->select('stok_bahan_jadi_gudang.id_bahan_jadi,stok_bahan_jadi_gudang.nama_bahan_jadi,stok_bahan_jadi_gudang.stok_sisa,bahan_jadi.harga_bahan_jadi');
		$this->datatables->from('stok_bahan_jadi_gudang');
		$this->datatables->join('bahan_jadi','stok_bahan_jadi.id_bahan_jadi = bahan_jadi.id_bahan_jadi');
		$this->datatables->where($where);
		
		echo $this->datatables->generate();
	}else{
		$tanggal = strtotime($tanggal);
		$tanggal = date('Y-m-d',$tanggal);

		$where = array('tanggal' => $getlasttanggal[0]->tanggal);
		// $alldata = $this->ModelKasir->getData($where,'stok_bahan_jadi');

		// return json_encode($alldata);

		$this->load->library('datatables');
		$this->datatables->select('stok_bahan_jadi_gudang.id_bahan_jadi,stok_bahan_jadi_gudang.nama_bahan_jadi,stok_bahan_jadi_gudang.stok_sisa,bahan_jadi.harga_bahan_jadi');
		$this->datatables->from('stok_bahan_jadi_gudang');
		$this->datatables->join('bahan_jadi','stok_bahan_jadi_gudang.id_bahan_jadi = bahan_jadi.id_bahan_jadi');
		$this->datatables->where($where);
		
		echo $this->datatables->generate();
	}
  }

  public function lapasetstokglobal()
  {
  	$akses = $this->session->userdata('aksessupadmin');
    if(empty($akses)){
        redirect('login');
    }else{
    	$this->load->view('superadminfranchise/navigationbar');
        $this->load->view('superadminfranchise/lapasetstokglobal');
		// $this->load->view('superadminfranchise/datatable_produk');
    }
  }

  public function lapsisastokwh()
  {
  	$akses = $this->session->userdata('aksessupadmin');
    if(empty($akses)){
        redirect('login');
    }else{
    	$this->load->view('superadminfranchise/navigationbar');
        $this->load->view('superadminfranchise/lapsisastokwh');
		// $this->load->view('superadminfranchise/datatable_produk');
    }
  }

  public function dataAsetGlobal()
  {
  	$allstan = $this->Produk->getSpecificColumn('stan','id_stan,nama_stan,alamat');
  	$tanggal = $this->input->post('tanggal');
  	// $tanggal = '2018-11-20';
  	$array = array();

  	// var_dump($allstan);

  	foreach ($allstan as $value) {
  		$where1 = array(
  			'id_stan' => $value->id_stan,
  			'tanggal<=' => $tanggal
  		);
  		$getlasttanggal = $this->Produk->getLastDateWithWhere('MAX(tanggal) as tanggal','stok_bahan_jadi',$where1);
  		// var_dump($getlasttanggal);
  		if ($getlasttanggal[0]->tanggal === NULL) {
  			$getlasttanggal[0]->tanggal = '';
  		}

  		$where = array(
  			'id_stan' => $value->id_stan,
  			'tanggal' => $getlasttanggal[0]->tanggal
  		);
  		// var_dump($where);

  		$laststokstan = $this->Produk->getDataJoin($where,'stok_bahan_jadi','bahan_jadi','id_bahan_jadi','id_bahan_jadi');
  		$totalaset = 0;
  		
  		foreach ($laststokstan as $value1) {
  			$totalaset = $totalaset + ($value1->stok_sisa*$value1->harga_bahan_jadi);
  		}
  		$obj = array();
  		$obj['keterangan'] = $value->nama_stan." ( ".$value->alamat." ) ";
  		$obj['total_nominal_aset'] = $totalaset;

  		// var_dump($obj);

  		array_push($array, $obj);
  	}

  	#UNTUK WAREHOUSE
  	$where1 = array(
		'tanggal<=' => $tanggal
	);
	$getlasttanggal = $this->Produk->getLastDateWithWhere('MAX(tanggal) as tanggal','stok_bahan_jadi_gudang',$where1);
	// var_dump($getlasttanggal);
	if ($getlasttanggal[0]->tanggal === NULL) {
		$getlasttanggal[0]->tanggal = '';
	}

	$where = array(
		'tanggal' => $getlasttanggal[0]->tanggal
	);

  	$laststokstan = $this->Produk->getDataJoin($where,'stok_bahan_jadi_gudang','bahan_jadi','id_bahan_jadi','id_bahan_jadi');
	$totalaset = 0;
	
	foreach ($laststokstan as $value1) {
		$totalaset = $totalaset + ($value1->stok_sisa*$value1->harga_bahan_jadi);
	}
  	$gudang = array(
  		'keterangan' => 'Warehouse Teabreak',
  		'total_nominal_aset' => $totalaset
  	);

  	array_push($array, $gudang);

  	echo json_encode($array);

  }

  public function pengeluaranstan()
  {
  	$akses = $this->session->userdata('aksessupadmin');
    if(empty($akses)){
        redirect('login');
    }else{
    	$this->load->view('superadminfranchise/navigationbar');
        $this->load->view('superadminfranchise/pengeluaranstan');
		// $this->load->view('superadminfranchise/datatable_produk');
    }
  }

  public function datapengeluaranstan()
  {
  	$stan = $this->input->post('stan');
  	$tanggalawal = $this->input->post('tanggalawal');
  	$tanggalakhir = $this->input->post('tanggalakhir');

  	if ($tanggalawal == '') {
  		$tanggalawal = '1970-01-01';
  	}

  	if ($tanggalakhir == '') {
  		$tanggalakhir = '1970-01-01';
  	}

  	$where = array(
  		'id_stan' => $stan,
  		'tanggal>=' => $tanggalawal,
  		'tanggal<=' => $tanggalakhir
  	);

  	$datapengeluaranstan = $this->Produk->getData($where,'pengeluaran_lain_stan_superadmin');

  	echo json_encode($datapengeluaranstan);
  }

  public function adddatapengeluaranstan()
  {
  	$stan = $this->input->post('stan');
  	$tanggal = $this->input->post('tanggal');
  	$keterangan = $this->input->post('keterangan');
  	$biaya = $this->input->post('biaya');

  	$tanggal1 = explode('/', $tanggal);
  	$tanggal = $tanggal1[2]."-".$tanggal1[1]."-".$tanggal1[0];

  	$data = array(
  		'id_stan' => $stan,
  		'tanggal' => $tanggal,
  		'keterangan' => $keterangan,
  		'pengeluaran' => $biaya
  	);

  	$insert = $this->Produk->insert('pengeluaran_lain_stan_superadmin',$data);

  	if ($insert) {
  		$where1 = array(
  			'id_stan' => $stan,
  			'bulan_tahun' => $tanggal1[1]."-".$tanggal1[2],
  			'keterangan' => 'Pengeluaran Stan (Super Admin)'
  		);
  		$check = $this->Produk->checkExist('keuntungan_stan',$where1);
  		
  		if ($check) {
  			$datalappengeluaran = $this->Produk->getData($where1,'keuntungan_stan');
  			$data = array(
  				'total' => ($datalappengeluaran[0]->total)+$biaya, 
  			);

  			$update = $this->Produk->update('keuntungan_stan', $data, $where1);

  		}else{
  			$where12 = array(
  				'id_stan' => $stan,
  				'tanggal LIKE' => $tanggal1[2].'-'.$tanggal1[1].'-%'
  			);
  			$alldatapengeluaran = $this->Produk->getData($where12,'pengeluaran_lain_stan_superadmin');

  			$total = 0;
  			foreach ($alldatapengeluaran as $perpengeluaran) {
  				$total = $total + $perpengeluaran->pengeluaran;
  			}

  			$datatosave = array(
				'id_stan' => $stan,
				'bulan_tahun' => $tanggal1[1]."-".$tanggal1[2],
				'keterangan' => 'Pengeluaran Stan (Super Admin)',
				'total' => $total,
				'tipe' => 'Kredit'
			);

			$insert = $this->Produk->insert('keuntungan_stan',$datatosave);
  		}

  		$this->sinkronkeuntunganglobalstan($tanggal1[1]."-".$tanggal1[2],$stan);

  		//7dan3 hitung keuntungan global
  		
  		echo "Berhasil Ditambahkan";
  	}else{
  		echo "Gagal Ditambahkan";
  	}
  }

  public function delete_pengeluaran_stan()
  {
  	$id = $this->input->post('id');
  	$where = array('id_pengeluaran' => $id);
  	$databeforedelete = $this->Produk->getData($where,'pengeluaran_lain_stan_superadmin');
  	$tanggal = $databeforedelete[0]->tanggal;
  	$tanggalpart = explode('-', $tanggal);
 	$newfortanggal = $tanggalpart[1]."-".$tanggalpart[0];

  	$biaya = $databeforedelete[0]->pengeluaran;

  	$del = $this->Produk->DeleteWhere('pengeluaran_lain_stan_superadmin',$where);

  	if ($del) {
  		$where1 = array(
  			'id_stan' => $databeforedelete[0]->id_stan,
  			'bulan_tahun' => $newfortanggal,
  			'keterangan' => 'Pengeluaran Stan (Super Admin)'
  		);
  		$check = $this->Produk->checkExist('keuntungan_stan',$where1);
  		
  		if ($check) {
  			$datalappengeluaran = $this->Produk->getData($where1,'keuntungan_stan');
  			$data = array(
  				'total' => ($datalappengeluaran[0]->total)-$biaya, 
  			);

  			$update = $this->Produk->update('keuntungan_stan', $data, $where1);

  		}else{
  			$where12 = array(
  				'id_stan' => $databeforedelete[0]->id_stan,
  				'tanggal LIKE' => $tanggalpart[0].'-'.$tanggalpart[1].'-%'
  			);
  			$alldatapengeluaran = $this->Produk->getData($where12,'pengeluaran_lain_stan_superadmin');

  			$total = 0;
  			foreach ($alldatapengeluaran as $perpengeluaran) {
  				$total = $total + $perpengeluaran->pengeluaran;
  			}

  			$datatosave = array(
				'id_stan' => $databeforedelete[0]->id_stan,
				'bulan_tahun' => $newfortanggal,
				'keterangan' => 'Pengeluaran Stan (Super Admin)',
				'total' => $total,
				'tipe' => 'Kredit'
			);

			$insert = $this->Produk->insert('keuntungan_stan',$datatosave);
  		}


  		$this->sinkronkeuntunganglobalstan($newfortanggal,$databeforedelete[0]->id_stan);

  		//4 dan 8 hitung keuntungan global

  		echo "SUCCESSSAVE";
  	}else{
  		echo "CANTCONNECT";
  	}
  }


  public function edit_pengeluaran_lain_stan()
  {
  	$keteranganbaru = $this->input->post('keteranganbaru');
  	$pengeluaranbaru = $this->input->post('pengeluaranbaru');
  	$id_pengeluaran = $this->input->post('id_pengeluaran');
  	$tanggalbaru = $this->input->post('tanggalbaru');
  	$tanggalpart = explode('-', $tanggalbaru);
 	$newfortanggal = $tanggalpart[1]."-".$tanggalpart[0];

  	$databaru = array(
  		'tanggal' => $tanggalbaru,
  		'pengeluaran' => $pengeluaranbaru,
  		'keterangan' => $keteranganbaru 
  	);

  	$where = array('id_pengeluaran' => $id_pengeluaran);

  	$getbeforeupdate = $this->Produk->getData($where,'pengeluaran_lain_stan_superadmin');
  	$biayabefore = $getbeforeupdate[0]->pengeluaran;

  	$update = $this->Produk->update('pengeluaran_lain_stan_superadmin', $databaru, $where);

  	if ($update) {
  		$where1 = array(
  			'id_stan' => $getbeforeupdate[0]->id_stan,
  			'bulan_tahun' => $newfortanggal,
  			'keterangan' => 'Pengeluaran Stan (Super Admin)'
  		);
  		$check = $this->Produk->checkExist('keuntungan_stan',$where1);
  		
  		if ($check) {
  			$datalappengeluaran = $this->Produk->getData($where1,'keuntungan_stan');
  			$data = array(
  				'total' => (($datalappengeluaran[0]->total)-$biayabefore)+$pengeluaranbaru, 
  			);

  			$update = $this->Produk->update('keuntungan_stan', $data, $where1);
  			
  		}else{
  			$where12 = array(
  				'id_stan' => $getbeforeupdate[0]->id_stan,
  				'tanggal LIKE' => $tanggalpart[0]."-".$tanggalpart[1].'-%'
  			);
  			$alldatapengeluaran = $this->Produk->getData($where12,'pengeluaran_lain_stan_superadmin');

  			$total = 0;
  			foreach ($alldatapengeluaran as $perpengeluaran) {
  				$total = $total + $perpengeluaran->pengeluaran;
  			}

  			$datatosave = array(
				'id_stan' => $getbeforeupdate[0]->id_stan,
				'bulan_tahun' => $newfortanggal,
				'keterangan' => 'Pengeluaran Stan (Super Admin)',
				'total' => $total,
				'tipe' => 'Kredit'
			);

			$insert = $this->Produk->insert('keuntungan_stan',$datatosave);
  		}

  		$this->sinkronkeuntunganglobalstan($newfortanggal,$getbeforeupdate[0]->id_stan);

  		//9 dan 5 hitung keuntungan global
  		echo "Berhasil Diupdate";
  	}else{
  		echo "Gagal Diupdate";
  	}
  }

  public function inputpenjualanstan()
  {
  	$akses = $this->session->userdata('aksessupadmin');
    if(empty($akses)){
        redirect('login');
    }else{
    	$this->load->view('superadminfranchise/navigationbar');
        $this->load->view('superadminfranchise/inputpenjualanstan');
		// $this->load->view('superadminfranchise/datatable_produk');
    }
  }

  public function adddatapenjualanstan()
  {
  	$stan = $this->input->post('stan');
  	$tanggal = $this->input->post('tanggal');
  	$penjualan = $this->input->post('penjualan');
  	$insert = false;
  	$update = false;

  	// $tanggal = explode('/', $tanggal);
  	// $tanggal = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];

  	$where = array('id_stan' => $stan);
  	$nama_stan = $this->Produk->getData($where,'stan');
  	$tanggalstrip = explode('/', $tanggal);
  		$tanggalstrip = $tanggalstrip[0]."-".$tanggalstrip[1];

  	$where1 = array(
  		'id_stan' => $stan,
  		'bulan_tahun' => $tanggal
  	);

  	$where12 = array(
  		'id_stan' => $stan,
  		'bulan_tahun' => $tanggalstrip,
  		'keterangan' => 'Penjualan Stan'
  	);
  	$cek = $this->Produk->checkExist('penjualan_stan_by_superadmin',$where1);

  	if ($cek) {
  		$data = array(
	  		'nama_stan' => $nama_stan[0]->nama_stan,
	  		'penjualan' => $penjualan
	  	);

	  	$datatosave = array(
			'total' => $penjualan
		);


	  	$getdataupdate = $this->Produk->getData($where1,'penjualan_stan_by_superadmin');
	  	// var_dump($getdataupdate);

	  	if ($getdataupdate[0]->penjualan == $penjualan && $getdataupdate[0]->nama_stan == $nama_stan[0]->nama_stan ) {
	  		$update = true;
	  		$update2 = true;

	  	}else{
	  		$update = $this->Produk->update('penjualan_stan_by_superadmin', $data, $where1);
	  		$update2 = $this->Produk->update('keuntungan_stan',$datatosave, $where12);
	  		
	  	}

  		
  	}else{
  		$data = array(
	  		'id_stan' => $stan,
	  		'nama_stan' => $nama_stan[0]->nama_stan,
	  		'bulan_tahun' => $tanggal,
	  		'penjualan' => $penjualan
	  	);

  		$insert2 = $this->Produk->insert('penjualan_stan_by_superadmin',$data);
  		$tanggalstrip = explode('/', $tanggal);
  		$tanggalstrip = $tanggalstrip[0]."-".$tanggalstrip[1];

  		$datatosave = array(
			'id_stan' => $stan,
			'bulan_tahun' => $tanggalstrip,
			'keterangan' => 'Penjualan Stan',
			'total' => $penjualan,
			'tipe' => 'Debit'
		);

		$insert = $this->Produk->insert('keuntungan_stan',$datatosave);
  	}

  	if ($insert || $update) {
  		$where2 = array(
			'id_stan' => $stan,
			'status' => 'active',
			'omset_minimal <=' => $penjualan
		);
		$data_gaji_bonus =  $this->Produk->getDataWhereDesc2column('gaji_bonus_stan',$where2,'omset_minimal DESC');

		if ($this->Produk->getRowCount('gaji_bonus_stan',$where2)<=0) {
			$data_gaji_bonus = 0;
		}else{
			$whereforbonus = array(
				'id_stan' => $stan,
				'status' => 'active'
			);

			$banyakpegawai = $this->Produk->getRowCount('karyawan_fingerspot',$whereforbonus);
			$data_gaji_bonus = (($data_gaji_bonus[0]->persentase_bonus/100)*$penjualan)/$banyakpegawai;
		}

		$wheregaji = array(
			'id_stan' => $stan,
			'bulan_tahun' => $tanggalstrip,
		);
		
		// $getgajidata = $this->Produk->update('laporan_gaji_karyawan', $datatoupdate, $wheregaji);

		$allgajibulanitu = $this->Produk->getData($wheregaji,'laporan_gaji_karyawan');
		foreach ($allgajibulanitu as $pergajibulanitu) {
			$datatoupdate = array(
				'bonus_omset' => $data_gaji_bonus,
				'gaji_akhir' => ((($pergajibulanitu->gaji_akhir) - ($pergajibulanitu->bonus_omset))+$data_gaji_bonus) 
			);

			$wheregajitoup = array(
				'id_stan' => $stan,
				'bulan_tahun' => $tanggalstrip,
				'pin' => $pergajibulanitu->pin
			);

			$update = $this->Produk->update('laporan_gaji_karyawan', $datatoupdate, $wheregajitoup);

		}

		$allgajibulanitu = $this->Produk->getData($wheregaji,'laporan_gaji_karyawan');
		$total = 0;
		foreach ($allgajibulanitu as $pergajibulanitu) {
			$total = $total + $pergajibulanitu->gaji_akhir;

		}

		$where = array(
        		'bulan_tahun' => $tanggalstrip,
        		'keterangan' => 'Gaji Karyawan',
        		'id_stan' => $stan
		);
		$datatosave = array(
			'total' => $total
		);

		$update = $this->Produk->update('keuntungan_stan', $datatosave, $where);

		$this->sinkronkeuntunganglobalstan($tanggalstrip,$stan);
		//10,6,15 hitung keuntungan global

  		echo "Berhasil Ditambahkan";
  	}else{
  		echo "Gagal Ditambahkan";
  	}
  }

  public function datapenjualanstan()
  {
  	$tanggal = $this->input->post('tanggal');

  	if ($tanggal == '') {
  		$tanggal = '01/1970';
  	}

  	$where = array(
  		'bulan_tahun' => $tanggal
  	);

  	$datapenjualanstan = $this->Produk->getData($where,'penjualan_stan_by_superadmin');

  	echo json_encode($datapenjualanstan);
  }

  public function edit_penjualan_stan()
  {
  	$penjualanbaru = $this->input->post('penjualanbaru');
  	$id_penjualan = $this->input->post('id_penjualan');

  	$databaru = array(
  		'penjualan' => $penjualanbaru
  	);

	$datatosave = array(
		'total' => $penjualanbaru
	);

  	$where = array('id_penjualan' => $id_penjualan);

  	$datatoup = $this->Produk->getData($where,'penjualan_stan_by_superadmin');

  	$tanggalstrip = explode('/', $datatoup[0]->bulan_tahun);
  	$tanggalstrip = $tanggalstrip[0]."-".$tanggalstrip[1];

  	$where12 = array(
  		'id_stan' => $datatoup[0]->id_stan,
  		'bulan_tahun' => $tanggalstrip,
  		'keterangan' => 'Penjualan Stan'
  	);

  	$update = $this->Produk->update('penjualan_stan_by_superadmin', $databaru, $where);
  	$update2 = $this->Produk->update('keuntungan_stan',$datatosave, $where12);
  	

  	if ($datatoup[0]->penjualan == $penjualanbaru) {
  		$update = true;
  		$update2 = true;
  	}

  	if ($update && $update2) {
  		$where2 = array(
			'id_stan' => $datatoup[0]->id_stan,
			'status' => 'active',
			'omset_minimal <=' => $penjualanbaru
		);
		$data_gaji_bonus =  $this->Produk->getDataWhereDesc2column('gaji_bonus_stan',$where2,'omset_minimal DESC');

		if ($this->Produk->getRowCount('gaji_bonus_stan',$where2)<=0) {
			$data_gaji_bonus = 0;
		}else{
			$whereforbonus = array(
				'id_stan' => $datatoup[0]->id_stan,
				'status' => 'active'
			);

			$banyakpegawai = $this->Produk->getRowCount('karyawan_fingerspot',$whereforbonus);
			$data_gaji_bonus = (($data_gaji_bonus[0]->persentase_bonus/100)*$penjualanbaru)/$banyakpegawai;
		}

		$wheregaji = array(
			'id_stan' => $datatoup[0]->id_stan,
			'bulan_tahun' => $tanggalstrip,
		);
		
		// $getgajidata = $this->Produk->update('laporan_gaji_karyawan', $datatoupdate, $wheregaji);

		$allgajibulanitu = $this->Produk->getData($wheregaji,'laporan_gaji_karyawan');
		foreach ($allgajibulanitu as $pergajibulanitu) {
			$datatoupdate = array(
				'bonus_omset' => $data_gaji_bonus,
				'gaji_akhir' => ((($pergajibulanitu->gaji_akhir) - ($pergajibulanitu->bonus_omset))+$data_gaji_bonus) 
			);

			$wheregajitoup = array(
				'id_stan' => $datatoup[0]->id_stan,
				'bulan_tahun' => $tanggalstrip,
				'pin' => $pergajibulanitu->pin
			);

			$update = $this->Produk->update('laporan_gaji_karyawan', $datatoupdate, $wheregajitoup);
		}

		$allgajibulanitu = $this->Produk->getData($wheregaji,'laporan_gaji_karyawan');
		$total = 0;
		foreach ($allgajibulanitu as $pergajibulanitu) {
			$total = $total + $pergajibulanitu->gaji_akhir;

		}

		$where = array(
        		'bulan_tahun' => $tanggalstrip,
        		'keterangan' => 'Gaji Karyawan',
        		'id_stan' => $datatoup[0]->id_stan
		);
		$datatosave = array(
			'total' => $total
		);

		$update = $this->Produk->update('keuntungan_stan', $datatosave, $where);

		$this->sinkronkeuntunganglobalstan($tanggalstrip,$datatoup[0]->id_stan);
		//11,13hitung keuntungan global

  		echo "Berhasil Diupdate";
  	}else{
  		echo "Gagal Diupdate";
  	}
  }

  public function datapegawai()
  {
  	$id_stan = $this->input->post('id_stan');

  	$where = array(
  		'id_stan' => $id_stan
  	);

  	$datapegawai = $this->Produk->getData($where,'karyawan_fingerspot');

  	echo json_encode($datapegawai);
  }

  public function edit_pegawai()
  {
  	$gajibaru = $this->input->post('gajibaru');
  	$pin = $this->input->post('pin');
  	$stan = $this->input->post('stan');

  	$databaru = array(
  		'gaji_tetap' => $gajibaru
  	);

  	$where = array('pin' => $pin,'id_stan' => $stan);
  	$datatoup = $this->Produk->getData($where,'karyawan_fingerspot');

  	$update = $this->Produk->update('karyawan_fingerspot', $databaru, $where);

  	if ($datatoup[0]->gaji_tetap == $gajibaru) {
  		$update = true;
  	}

  	if ($update) {
  		echo "Berhasil Diupdate";
  	}else{
  		echo "Gagal Diupdate";
  	}
  }

  public function manajemenshift()
  {
  	$akses = $this->session->userdata('aksessupadmin');
    if(empty($akses)){
        redirect('login');
    }else{
    	$this->load->view('superadminfranchise/navigationbar');
        $this->load->view('superadminfranchise/manajemenshift');
		// $this->load->view('superadminfranchise/datatable_produk');
    }
  }

  public function adddatashift()
  {
  	$id_stan = $this->input->post('id_stan');
  	$nama_shift = $this->input->post('nama_shift');
  	$jam_awal = $this->input->post('jam_awal');
  	$jam_akhir = $this->input->post('jam_akhir');
  	$batasdatangcepat = $this->input->post('batasdatangcepat');
  	// $batastelatlembur = $this->input->post('batastelatlembur');
  	// $standarlembur = $this->input->post('standarlembur');

  	$data = array(
  		'id_stan' => $id_stan,
  		'nama_shift' => $nama_shift,
  		'jam_awal' => $jam_awal,
  		'jam_akhir' => $jam_akhir,
  		'batas_datang_cepat' => $batasdatangcepat
  		// 'batas_telat_lembur' => $batastelatlembur,
  		// 'standar_lembur' => $standarlembur
  	);

  	$insert = $this->Produk->insert('manajemen_shift',$data);

  	if ($insert) {
  		echo "Berhasil Ditambahkan";
  	}else{
  		echo "Gagal Ditambahkan";
  	}
  }

  public function datamanajemenshift()
  {
  	$id_stan = $this->input->post('id_stan');

  	$where = array(
  		'id_stan' => $id_stan
  	);

  	$datashift = $this->Produk->getData($where,'manajemen_shift');
  	// $datashift = $this->Produk->getAllData('manajemen_shift');

  	echo json_encode($datashift);
  }

  public function lapgajikaryawan()
  {
  	$akses = $this->session->userdata('aksessupadmin');
    if(empty($akses)){
        redirect('login');
    }else{
    	$this->load->view('superadminfranchise/navigationbar');
        $this->load->view('superadminfranchise/lapgajikaryawan');
		// $this->load->view('superadminfranchise/datatable_produk');
    }
  }

  public function changestatuskaryawan()
  {
  	$pin = $this->input->post('pin');
  	$to = $this->input->post('to');
  	$id_stan = $this->input->post('id_stan');

  	if ($to == 'toactive') {
  		$data = array(
  			'status' => 'active' 
  		);
  	}else{
  		$data = array(
  			'status' => 'inactive' 
  		);
  	}

  	$where = array(
  		'id_stan' => $id_stan,
  		'pin' => $pin
  	);

  	$update = $this->Produk->update('karyawan_fingerspot',$data,$where);

  	if ($update) {
  		echo "success";
  	}else{
  		echo "fail";
  	}
  }

  public function edit_manajemenshift()
  {
  	$nama_shift = $this->input->post('nama_shift');
  	$jam_awal = $this->input->post('jam_awal');
  	$jam_akhir = $this->input->post('jam_akhir');
  	$batasdatangcepat = $this->input->post('batasdatangcepat');
  	// $batastelatlembur = $this->input->post('batastelatlembur');
  	// $standarlembur = $this->input->post('standarlembur');
  	$id_manajemen_shift = $this->input->post('id_manajemen_shift');

	$where = array('id_manajemen_shift' => $id_manajemen_shift);
 	 	 	 	 	 
	$data = array(
		'nama_shift' => $nama_shift,
        'jam_awal' => $jam_awal,
        'jam_akhir' => $jam_akhir,
        'batas_datang_cepat' => $batasdatangcepat
		// 'batas_telat_lembur' => $batastelatlembur,
		// 'standar_lembur' => $standarlembur
    );
	$this->Produk->update('manajemen_shift',$data,$where);
	echo "Berhasil Diupdate";
  }

  public function datalaporangaji()
  {
  	$id_stan = $this->input->post('id_stan');
  	$bulan_tahun = $this->input->post('bulan_tahun');
  	$bulan_tahun = str_replace("/","-",$bulan_tahun);

  	$where = array(
  		'karyawan_fingerspot.id_stan' => $id_stan,
  		'bulan_tahun' => $bulan_tahun
  	);

  	$this->load->library('datatables');
	$this->datatables->select('id_gaji,laporan_gaji_karyawan.pin,karyawan_fingerspot.nama,gaji_tetap,karyawan_fingerspot.id_stan,masuk,lembur,terlambat,terlambatlembur,tidak_masuk,gaji_akhir,bonus_omset,potongan_lain,keterangan_potongan_lain,gaji_tambahan,keterangan_gaji_tambahan');
	$this->datatables->from('laporan_gaji_karyawan');
	$this->datatables->join('karyawan_fingerspot','karyawan_fingerspot.pin = laporan_gaji_karyawan.pin');
	$this->datatables->where($where);
	
	echo $this->datatables->generate();
  }

  public function downloadexcel1()
  {
  	$this->load->library("DownloadExcel");
  	$this->downloadexcel->download('stan');
  }

  public function downloadexcelstan()
  {
  	$select_stan = $this->input->post('select');

  	$wherestan = array('id_stan' => $select_stan );

  	$namastan = $this->Produk->getData($wherestan,'stan');
  	$namastan = $namastan[0]->nama_stan." ( ".$namastan[0]->alamat." )";
  	$tanggal_awal = $this->input->post('tanggal_awal');

  	$bulan = explode('/', $tanggal_awal);
  	// $month = intval($bulan[1]);
  	$year = intval($bulan[2]);
  	$bulan = $bulan[1];

  	// $howmanydays = $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31); 

  	$alldataforstan = array();

  	$allproduk = $this->Produk->getAllData('bahan_jadi');

  	foreach ($allproduk as $perproduk) {
  		$where = array(
  			'tanggal LIKE' => '%-'.$bulan.'-%',
  			'id_stan' => $select_stan,
  			'id_bahan_jadi' => $perproduk->id_bahan_jadi
  		);
  		$dataprodukbulanitu = $this->Produk->getData($where,'stok_bahan_jadi');

  		
  		array_push($alldataforstan,$dataprodukbulanitu);
  	}

  	$this->load->library("DownloadExcel");
  	$this->downloadexcel->download('stan',$alldataforstan,$bulan,$year,$namastan);
  }

  public function downloadexcelwarehouse()
  {
  	$tanggal_awal = $this->input->post('tanggal');

  	$bulan = explode('/', $tanggal_awal);
  	$year = intval($bulan[2]);
  	$bulan = $bulan[1];

  	$alldataforwarehouse = array();

  	$allproduk = $this->Produk->getAllData('bahan_jadi');

  	foreach ($allproduk as $perproduk) {
  		$where = array(
  			'tanggal LIKE' => '%-'.$bulan.'-%',
  			'id_bahan_jadi' => $perproduk->id_bahan_jadi
  		);
  		$dataprodukbulanitu = $this->Produk->getData($where,'stok_bahan_jadi_gudang');
  		
  		array_push($alldataforwarehouse,$dataprodukbulanitu);
  	}

  	$this->load->library("DownloadExcel");
  	$this->downloadexcel->download('stan',$alldataforwarehouse,$bulan,$year,'Warehouse');
  }

  public function getdetailstan()
  {
  	$id_stan = $this->input->post('id_stan');
  	$where = array('id_stan' => $id_stan );

  	$detail = $this->Produk->getData($where,'data_detail_stan');

  	echo json_encode($detail);
  }

  public function edit_gaji_karyawan()
  {
  	$potongan_lain = $this->input->post('potonganlain');
  	$keterangan_potongan_lain = $this->input->post('keterangan_potongan_lain');
  	$gaji_tambahan = $this->input->post('gaji_tambahan');
  	$keterangan_gaji_tambahan = $this->input->post('keterangan_gaji_tambahan');
	$id_gaji = $this->input->post('id_gaji');
	$gaji_akhir = $this->input->post('gaji_akhir');
	$potongan_lainawal = $this->input->post('potongan_lainawal');
	$gaji_tambahanawal = $this->input->post('gaji_tambahanawal');

  	//save
  	$data = array(
  		'potongan_lain' => $potongan_lain,
  		'keterangan_potongan_lain' => $keterangan_potongan_lain,
  		'gaji_tambahan' => $gaji_tambahan,
  		'keterangan_gaji_tambahan' => $keterangan_gaji_tambahan,
  		'gaji_akhir' => (((($gaji_akhir+$potongan_lainawal)-$gaji_tambahanawal) - $potongan_lain) + $gaji_tambahan)
  	);

  	$where = array(
  		'id_gaji' => $id_gaji
  	);

  	$save = $this->Produk->update('laporan_gaji_karyawan',$data,$where);
  	$getgaji = $this->Produk->getData($where,'laporan_gaji_karyawan');

  	$wheregaji = array(
  		'bulan_tahun' => $getgaji[0]->bulan_tahun,
  		'id_stan' => $getgaji[0]->id_stan,

  	);

  	$allgajibulanitu = $this->Produk->getData($wheregaji,'laporan_gaji_karyawan');
		$total = 0;
		foreach ($allgajibulanitu as $pergajibulanitu) {
			$total = $total+$pergajibulanitu->gaji_akhir;

		}

		if ($getgaji[0]->id_stan == 'warehouse') {
			$this->sinkronkeuntunganglobalgajiwarehouse($getgaji[0]->bulan_tahun);
		}else{
			$where = array(
        		'bulan_tahun' => $getgaji[0]->bulan_tahun,
        		'keterangan' => 'Gaji Karyawan',
        		'id_stan' => $getgaji[0]->id_stan
			);
			$datatosave = array(
				'total' => $total
			);

			$update = $this->Produk->update('keuntungan_stan', $datatosave, $where);

			$this->sinkronkeuntunganglobalstan($getgaji[0]->bulan_tahun,$getgaji[0]->id_stan);
		}
  	//14hitung keuntungan global
  	echo "Berhasil Diupdate";
  }

  public function lapkeuntunganstan()
  {
  	$akses = $this->session->userdata('aksessupadmin');
    if(empty($akses)){
        redirect('login');
    }else{
    	$this->load->view('superadminfranchise/navigationbar');
        $this->load->view('superadminfranchise/lapkeuntunganstan');
		// $this->load->view('superadminfranchise/datatable_produk');
    }
  }

  public function lapkeuntunganglobal()
  {
  	$akses = $this->session->userdata('aksessupadmin');
    if(empty($akses)){
        redirect('login');
    }else{
    	$this->load->view('superadminfranchise/navigationbar');
        $this->load->view('superadminfranchise/lapkeuntunganglobal');
		// $this->load->view('superadminfranchise/datatable_produk');
    }
  }

  public function datalaporankeuntunganstan()
  {
  	$id_stan = $this->input->post('id_stan');
  	$bulan_tahun = $this->input->post('bulan_tahun');
  	$bulan_tahun = str_replace("/","-",$bulan_tahun);

  	$where = array(
  		'id_stan' => $id_stan,
  		'bulan_tahun' => $bulan_tahun
  	);

  	$data = $this->Produk->getDataWhereDesc2column('keuntungan_stan',$where,"tipe ASC");

 //  	$this->load->library('datatables');
	// $this->datatables->select('id_keuntungan_stan,id_stan,bulan_tahun,keterangan,total,tipe');
	// $this->datatables->from('keuntungan_stan');
	// $this->datatables->order_by('tipe');
	// $this->datatables->where($where);
	
	// echo $this->datatables->generate();
  	echo json_encode($data);
  }


  public function datalaporankeuntunganglobal()
  {
  	$bulan_tahun = $this->input->post('bulan_tahun');
  	$bulan_tahun = str_replace("/","-",$bulan_tahun);

  	$where = array(
  		'bulan_tahun' => $bulan_tahun
  	);

  	$data = $this->Produk->getDataWhereDesc2column('keuntungan_global',$where,"tipe ASC");

 //  	$this->load->library('datatables');
	// $this->datatables->select('id_keuntungan_global,bulan_tahun,keterangan,total,tipe');
	// $this->datatables->from('keuntungan_global');
	// $this->datatables->order_by('tipe');

	// $this->datatables->where($where);
	
	// echo $this->datatables->generate();
  	echo json_encode($data);
  }

  public function datatablegajibonus()
  {
  	// $tanggal = $this->input->post('tanggal');
  	// $tanggal = explode("/", $tanggal);
  	// $tanggal = $tanggal[1]."-".$tanggal[0]."-%";
  	// $data = array('tanggal LIKE' => $tanggal);
  	// var_dump($tanggal);
  	$this->load->library('datatables');
    $this->datatables->select('id_gaji_bonus,gaji_bonus_stan.id_stan,nama_stan,omset_minimal,persentase_bonus,status');
    $this->datatables->from('gaji_bonus_stan');
    $this->datatables->join('stan','gaji_bonus_stan.id_stan = stan.id_stan');
    // $this->datatables->where($data);
    echo $this->datatables->generate();
  }

  public function delete_gaji_bonus()
  {
  	$id = $this->input->post('id');
  	$where = array('id_gaji_bonus' => $id );
	$this->Produk->DeleteWhere('gaji_bonus_stan',$where);

	echo "SUCCESSSAVE";
  }

  public function edit_gaji_bonus_stan()
  {
  	$omset = $this->input->post('omsetbaru');
	$bonus = $this->input->post('bonusbaru');
	$id = $this->input->post('id_gaji_bonus');

  	$databaru = array(
  		'omset_minimal' => $omset,
  		'persentase_bonus' => $bonus
  	);

  	$where = array('id_gaji_bonus' => $id);
  	$datatoup = $this->Produk->getData($where,'gaji_bonus_stan');

  	$update = $this->Produk->update('gaji_bonus_stan', $databaru, $where);

  	if ($datatoup[0]->omset_minimal == $omset && $datatoup[0]->persentase_bonus == $bonus) {
  		$update = true;
  	}

  	if ($update) {
  		echo "Berhasil Diupdate";
  	}else{
  		echo "Gagal Diupdate";
  	}
  }

  public function notapembelian()
  {
  	$akses = $this->session->userdata('aksessupadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('superadminfranchise/navigationbar');
          $this->load->view('superadminfranchise/notapembelian');
        }
  }

  public function sinkronkeuntunganglobalstan($tanggal,$id_stan)
  {
  	$wherestan = array(
		'id_stan' => $id_stan
	);

	$datastan =  $this->Produk->getData($wherestan,'stan');

	$where = array(
		'bulan_tahun' => $tanggal,
		'keterangan' => 'Keuntungan Stan '.$datastan[0]->nama_stan
	);

	$checkkeuntunganglobal = $this->Produk->getRowCount('keuntungan_global',$where);
		
	$where2 = array(
		'bulan_tahun' => $tanggal,
		'id_stan' => $id_stan
	);
	$allkeuntunganstan = $this->Produk->getData($where2,'keuntungan_stan');
	$total = 0;
	foreach ($allkeuntunganstan as $perkeuntungan) {
		if ($perkeuntungan->tipe == 'Kredit') {
			$total = $total - $perkeuntungan->total;
		}else{
			$total = $total + $perkeuntungan->total;
		}
	}

	if ($checkkeuntunganglobal>0) {
		$datatosave = array(
			'total' => $total
		);

		$insert = $this->Produk->update('keuntungan_global',$datatosave,$where);
	}else{
		$datatosave = array(
			'bulan_tahun' => $tanggal,
			'keterangan' => 'Keuntungan Stan '.$datastan[0]->nama_stan,
			'total' => $total,
			'tipe' => 'Debit'
		);

		$insert = $this->Produk->insert('keuntungan_global',$datatosave);
	}
  }

  public function sinkronkeuntunganglobalgajiwarehouse($tanggal)
  {
  		$tanggalpart = explode('-', $tanggal);
    		$bulan = $tanggalpart[0];
    		$tahun = $tanggalpart[1];

  		$where = array(
    		'bulan_tahun' => $tanggal,
    		'keterangan' => 'Gaji Karyawan Warehouse'

    	);
    	$checkkeuntunganglobal = $this->Produk->getRowCount('keuntungan_global',$where);

    	$where1 = array(
    		'bulan_tahun' => $tanggal
    	);

    	$allgajiwarehouse = $this->Produk->getData($where1,'laporan_gaji_karyawan');
    	$totalgaji = 0;

    	foreach ($allgajiwarehouse as $pergaji) {
    		$totalgaji+=$pergaji->gaji_akhir;
    	}

    	if ($checkkeuntunganglobal<=0) {
    		
        	$datatosave = array(
    			'bulan_tahun' => $bulanlalu."-".$tahunlalu,
    			'keterangan' => 'Gaji Karyawan Warehouse',
    			'total' => $totalgaji,
    			'tipe' => 'Kredit'
    		);

    		$insert = $this->Produk->insert('keuntungan_global',$datatosave);
    	}else{

    		$datatosave = array(
    			'total' => $totalgaji
    		);

    		$update = $this->Produk->update('keuntungan_global',$datatosave,$where);
    	}
  }

  
  //2490
  //46167,7kwh 17.30
  //46173,2kwh 17.40

}