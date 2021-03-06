<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class AdminFranchise extends CI_Controller {

	public function __construct(){
    date_default_timezone_set("Asia/Bangkok");
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->helper('site_helper');
	    $this->load->model('Post');
	    $this->load->model('Produk');
	    $this->load->library('session');
  	}

  	public function dashboardadmin()
  	{
  		$akses = $this->session->userdata('aksesadmin');
        if(empty($akses)){
            redirect('login');
        }else{

          $list_bahan_jadi = $this->Produk->getAllData('bahan_jadi');
          date_default_timezone_set("Asia/Bangkok");
          $datenow = date("Y-m-d");

          foreach ($list_bahan_jadi as $perbahanjadi) {
            $where = array('id_bahan_jadi' => $perbahanjadi->id_bahan_jadi );

            $lastData = $this->Produk->getDataWhereDesc('stok_bahan_jadi_gudang',$where,'tanggal');
            $sisa = 0;
            if (!empty($lastData)) {
              if ($lastData[0]->tanggal != $datenow) {
                $sisa = $lastData[0]->stok_sisa;

                $data = array(
                  'id_bahan_jadi' => $perbahanjadi->id_bahan_jadi,
                  'nama_bahan_jadi' => $perbahanjadi->nama_bahan_jadi,
                  'stok_masuk' => 0,
                  'stok_keluar' => 0,
                  'stok_sisa' => $sisa,
                  'tanggal' => $datenow
                );

                $this->Produk->insert('stok_bahan_jadi_gudang',$data);
              }
            }else{
              $data = array(
                'id_bahan_jadi' => $perbahanjadi->id_bahan_jadi,
                'nama_bahan_jadi' => $perbahanjadi->nama_bahan_jadi,
                'stok_masuk' => 0,
                'stok_keluar' => 0,
                'stok_sisa' => 0,
                'tanggal' => $datenow
              );

              $this->Produk->insert('stok_bahan_jadi_gudang',$data);
            }

          }
        	$this->load->view('adminfranchise/navigationbar');
          $this->load->view('adminfranchise/dashboard');
        }
  	}

  	public function stokproduk(){
  		$akses = $this->session->userdata('aksesadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('adminfranchise/navigationbar');
          $this->load->view('adminfranchise/stokproduk');
        }
  	}

  	public function pembelian(){
  		$akses = $this->session->userdata('aksesadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('adminfranchise/navigationbar');
          $this->load->view('adminfranchise/pembelianproduk');
        }
  	}

  	public function pengeluaranlain(){
  		$akses = $this->session->userdata('aksesadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('adminfranchise/navigationbar');
          $this->load->view('adminfranchise/pengeluaranlain');
        }
  	}

	public function distribusi(){
  		$akses = $this->session->userdata('aksesadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('adminfranchise/navigationbar');
          $this->load->view('adminfranchise/distribusi');
        }
  	}

	public function stokkeluar(){
  		$akses = $this->session->userdata('aksesadmin');
        if(empty($akses)){
            redirect('login');
        }else{
        	$this->load->view('adminfranchise/navigationbar');
          $this->load->view('adminfranchise/stokkeluar');
        }
  }

  public function orderstan()
  {
    $akses = $this->session->userdata('aksesadmin');
        if(empty($akses)){
            redirect('login');
        }else{
          $this->load->view('adminfranchise/navigationbar');
          $this->load->view('adminfranchise/orderstan');
        }
  }

  public function getAllOrder()
  {
    $this->load->library('datatables');
    $this->datatables->select('id_order,tanggal_order,status');
    $this->datatables->from('order_bahan_jadi_stan');
    echo $this->datatables->generate();
  }

  public function getSpecificOrderDetail()
  {
    $id_order = $this->input->post('id_order');
    $where = array('id_order' => $id_order);

    $this->load->library('datatables');
    $this->datatables->select('nama_bahan_jadi,jumlah');
    $this->datatables->from('detail_order_bahan_jadi_stan');
    $this->datatables->where($where);
    echo $this->datatables->generate();
    
  }

  public function changeStatusOrderToDone()
  {
    $id_order = $this->input->post('id_order');
    $where = array('id_order' => $id_order);

    $data = array(
      'status' => 'done'
    );

    $this->Produk->Update('order_bahan_jadi_stan',$data,$where);
  }
  
  public function saveDistribusi()
  {
    $namastan = $this->input->post('namastan');
    $tanggal = $this->input->post('tanggal');
    $arrayDistribusi = json_decode($this->input->post('arrayDistribusi'));
    $stat = true;
    $datenow = date("Y-m-d");

    $id_distribusi = IDDistribusiGenerator();

    $data = array(
      'id_distribusi' => $id_distribusi, 
      'nama_stan' => $namastan,
      'tanggal' => $datenow
    );

    if ($this->Produk->insert('distribusi',$data)) {
      $stat = true;
    }else{
      $stat = false;
    }


    $angka = 0;
    foreach ($arrayDistribusi as $perdistribusi) {
      $angka++;
      $data = array(
        'id_detail_distribusi' => $id_distribusi."_".$angka,
        'id_distribusi' => $id_distribusi,
        'nama_bahan_jadi' => $perdistribusi->namabahanjadi,
        'jumlah' => $perdistribusi->jumlah
      );

      if ($this->Produk->insert('detail_distribusi',$data)) {

        $where = array(
          'tanggal' => $datenow,
          'id_bahan_jadi' => $perdistribusi->idbahanjadi
        );

        $StokDataToday = $this->Produk->getData($where,'stok_bahan_jadi_gudang');

        if (empty($StokDataToday)) {
            $where = array('id_bahan_jadi' => $perdistribusi->idbahanjadi );

            $lastData = $this->Produk->getDataWhereDesc('stok_bahan_jadi_gudang',$where,'tanggal');
            $sisa = 0;
            if (!empty($lastData)) {
              if ($lastData[0]->tanggal != $datenow) {
                $sisa = $lastData[0]->stok_sisa;

                $data = array(
                  'id_bahan_jadi' => $perdistribusi->idbahanjadi,
                  'nama_bahan_jadi' => $perdistribusi->namabahanjadi,
                  'stok_masuk' => 0,
                  'stok_keluar' => $perdistribusi->jumlah,
                  'stok_sisa' => $sisa - $perdistribusi->jumlah,
                  'tanggal' => $datenow
                );

                $this->Produk->insert('stok_bahan_jadi_gudang',$data);
              }
            }else{
              $data = array(
                'id_bahan_jadi' => $perdistribusi->idbahanjadi,
                'nama_bahan_jadi' => $perdistribusi->namabahanjadi,
                'stok_masuk' => 0,
                'stok_keluar' => $perdistribusi->jumlah,
                'stok_sisa' => 0- $perdistribusi->jumlah,
                'tanggal' => $datenow
              );

              $this->Produk->insert('stok_bahan_jadi_gudang',$data);
            }
        }else{
          $data = array(
            'stok_keluar' => $StokDataToday[0]->stok_keluar + $perdistribusi->jumlah,
            'stok_sisa' => $StokDataToday[0]->stok_sisa -$perdistribusi->jumlah
          );

          $this->Produk->update('stok_bahan_jadi_gudang',$data,$where);
        }
      }else{
        $stat = false;
      }


    }
    

    if ($stat) {

      echo "true";
    }else{
      echo "false";
    }
  }

  public function datatabledistribusi()
  {
    $this->load->library('datatables');
    $this->datatables->select('id_distribusi,nama_stan,tanggal');
    $this->datatables->from('distribusi');
    echo $this->datatables->generate();
  }

  public function delete_distribusi()
  {
    $id = $this->input->post('id');
    $where = array('id_distribusi' => $id);

    $this->Produk->DeleteWhere('distribusi',$where);
  }

  public function get_list_bahan_jadi_distribusi()
  {
    $id = $this->input->post('id_distribusi');
    $where = array('id_distribusi' => $id);

    // $datalist = $this->Produk->getData($where,'detail_distribusi');
    $this->load->library('datatables');
    $this->datatables->select('nama_bahan_jadi,jumlah');
    $this->datatables->from('detail_distribusi');
    $this->datatables->where($where);
    echo $this->datatables->generate();

    // echo json_encode($datalist);
  }

  public function get_list_bahan_jadi_distribusi_cetak()
  {
    $id = $this->input->post('id');
    $where = array('id_distribusi' => $id);

    $datalist = $this->Produk->getData($where,'detail_distribusi');

    echo json_encode($datalist);
  }

  public function saveUpdateDistribusi()
  {
    $namastan = $this->input->post('namastan');
    $tanggal = $this->input->post('tanggal');
    $editarrayDistribusi = json_decode($this->input->post('editarrayDistribusi'));
    $stat = true;

    $id_distribusi = $this->input->post('id_distribusi');

    $data = array(
      'nama_stan' => $namastan,
      'tanggal' => $tanggal
    );
    $where = array('id_distribusi' => $id_distribusi);

    if ($this->Produk->update('distribusi', $data, $where)) {
      $stat = true;
    }else{
      // $stat = false;
    }

    $this->Produk->DeleteWhere('detail_distribusi',$where);
    $angka = 0;
    foreach ($editarrayDistribusi as $perdistribusi) {
      $angka++;
      $data = array(
        'id_detail_distribusi' => $id_distribusi."_".$angka,
        'id_distribusi' => $id_distribusi,
        'nama_bahan_jadi' => $perdistribusi->namabahanjadi,
        'jumlah' => $perdistribusi->jumlah
      );

      if ($this->Produk->insert('detail_distribusi',$data)) {
        
      }else{
        $stat = false;
      }
    }
    

    if ($stat) {
      echo "true";
    }else{
      echo "false";
    }
  }

  public function tambah_pengeluaran_lain()
  {
    $keterangan = $this->input->post('keterangan');
    $jumlahpengeluaran = $this->input->post('jumlahpengeluaran');

    $datenow = date("Y-m-d");
    $datenow2 = date("m-Y");
    
    $data = array(
      'tanggal' => $datenow,
      'keterangan' => $keterangan,
      'pengeluaran' => $jumlahpengeluaran
     );

    $success = $this->Produk->insert('pengeluaran_lain_gudang',$data);

    if ($success) {
      $exist = $this->Produk->getRowCountAll('modal_gudang');

      if ($exist > 0) {
        $datamodal = $this->Produk->getAllData('modal_gudang');
        $modal = $datamodal[0]->jumlah_modal;
        $data = array(
          'jumlah_modal' => $modal-$jumlahpengeluaran
        );
        $where = array(
          'id' => 'modaldata'
        );

        $ok = $this->Produk->update('modal_gudang',$data, $where);
      }else{
        $data = array(
          'jumlah_modal' => 0-$jumlahpengeluaran
        );
        $ok = $this->Produk->insert('modal_gudang',$data);
      }

      $this->sinkronkeuntunganglobalpengeluaranwarehouse($datenow2);

      echo "Berhasil Ditambahkan";
    }
    
  }

  public function getpengeluaranlain()
  {
    $tanggal = $this->input->post('tanggal');
    $tanggal = explode("/", $tanggal);
    $tanggal = $tanggal[1]."-".$tanggal[0]."-%";
    $data = array('tanggal LIKE' => $tanggal);
    $this->load->library('datatables');
    $this->datatables->select('id_pengeluaran,tanggal,keterangan,pengeluaran');
    $this->datatables->from('pengeluaran_lain_gudang');
    $this->datatables->where($data);
    echo $this->datatables->generate();
  }

  public function delete_pengeluaran()
  {
    $id_pengeluaran = $this->input->post('id');

    $where = array('id_pengeluaran' => $id_pengeluaran);
    $realdata = $this->Produk->getData($where,'pengeluaran_lain_gudang');
    $dateall = $realdata[0]->tanggal;
      $dateall = explode('-', $dateall);
      $datenow2 = $dateall[1].'-'.$dateall[0];


    $wheredel = array('id_pengeluaran' => $id_pengeluaran);
    $sst = $this->Produk->deleteWhere('pengeluaran_lain_gudang',$wheredel);

    if ($sst) {
      $this->sinkronkeuntunganglobalpengeluaranwarehouse($datenow2);
      echo "SUCCESSSAVE";
    }else{
      echo "ERROR";
    }
  }

  public function edit_pengeluaran_lain()
  {
    $keteranganbaru = $this->input->post('keteranganbaru');
    $pengeluaranbaru = $this->input->post('pengeluaranbaru');
    $id_pengeluaran = $this->input->post('id_pengeluaran');

    $where = array('id_pengeluaran' => $id_pengeluaran);

    $data = array(
      'keterangan' => $keteranganbaru,
      'pengeluaran' => $pengeluaranbaru
     );

    $realdata = $this->Produk->getData($where,'pengeluaran_lain_gudang');

    if ($realdata[0]->keterangan != $keteranganbaru || $realdata[0]->pengeluaran != $pengeluaranbaru ) {
      $cek = $this->Produk->Update('pengeluaran_lain_gudang',$data,$where);
    }else{
      $cek = true;
    }

    if ($cek) {
      $exist = $this->Produk->getRowCountAll('modal_gudang');

      if ($exist > 0) {
        $datamodal = $this->Produk->getAllData('modal_gudang');
        $modal = $datamodal[0]->jumlah_modal;
        $data = array(
          'jumlah_modal' => $modal-$realdata[0]->pengeluaran+$pengeluaranbaru
        );
        $where = array(
          'id' => 'modaldata'
        );

        $ok = $this->Produk->update('modal_gudang',$data, $where);
      }else{
        $data = array(
          'jumlah_modal' => 0-$pengeluaranbaru
        );
        $ok = $this->Produk->insert('modal_gudang',$data);
      }

      $dateall = $realdata[0]->tanggal;
      $dateall = explode('-', $dateall);
      $datenow2 = $dateall[1].'-'.$dateall[0];

      $this->sinkronkeuntunganglobalpengeluaranwarehouse($datenow2);
      echo "Berhasil Diupdate";
    }else{
      echo "gagal";
    }
  }

  public function tambahstokkeluargudang()
  {
    // $tanggal = $this->input->post('tgl');
    date_default_timezone_set("Asia/Bangkok");
    $id_bahan_jadi = $this->input->post('id');
    $nama_bahan_jadi = $this->input->post('nama');
    $jumlah = $this->input->post('jumlah');
    $keterangan = $this->input->post('keterangan');

    $datenow = date("Y-m-d H:i:s");
    $justdate = date("Y-m-d");

    $data = array(
      'id_bahan_jadi' => $id_bahan_jadi,
      'nama_bahan_jadi' => $nama_bahan_jadi,
      'keterangan' => $keterangan,
      'jumlah'=> $jumlah,
      'tanggal_jam' => $datenow
    );

    $stat = $this->Produk->insert('detail_stok_keluar_bahan_jadi_gudang',$data);

    if ($stat) {
         $where = array(
          'tanggal' => $justdate,
          'id_bahan_jadi' => $id_bahan_jadi
        );

        $StokDataToday = $this->Produk->getData($where,'stok_bahan_jadi_gudang');

        if (empty($StokDataToday)) {
            $where = array('id_bahan_jadi' => $id_bahan_jadi );

            $lastData = $this->Produk->getDataWhereDesc('stok_bahan_jadi_gudang',$where,'tanggal');
            $sisa = 0;
            if (!empty($lastData)) {
              if ($lastData[0]->tanggal != $datenow) {
                $sisa = $lastData[0]->stok_sisa;

                $data = array(
                  'id_bahan_jadi' => $id_bahan_jadi,
                  'nama_bahan_jadi' => $nama_bahan_jadi,
                  'stok_masuk' => 0,
                  'stok_keluar' => $jumlah,
                  'stok_sisa' => $sisa - $jumlah,
                  'tanggal' => $datenow
                );

                $this->Produk->insert('stok_bahan_jadi_gudang',$data);
              }
            }else{
              $data = array(
                'id_bahan_jadi' => $id_bahan_jadi,
                'nama_bahan_jadi' => $nama_bahan_jadi,
                'stok_masuk' => 0,
                'stok_keluar' => $jumlah,
                'stok_sisa' => 0- $jumlah,
                'tanggal' => $datenow
              );

              $this->Produk->insert('stok_bahan_jadi_gudang',$data);
            }
        }else{
          $data = array(
            'stok_keluar' => $StokDataToday[0]->stok_keluar + $jumlah,
            'stok_sisa' => $StokDataToday[0]->stok_sisa -$jumlah
          );

          $this->Produk->update('stok_bahan_jadi_gudang',$data,$where);
        }
        echo "Berhasil Ditambahkan";
    }else{
      echo "error";
    }

  }

  public function datatablestokkeluar()
  {
    $this->load->library('datatables');
    $this->datatables->select('tanggal_jam,id_bahan_jadi,nama_bahan_jadi,keterangan,jumlah');
    $this->datatables->from('detail_stok_keluar_bahan_jadi_gudang');
    echo $this->datatables->generate();
  }

  public function datatablestokbahanjadigudang()
  {
    $tanggal = $this->input->post('tanggal');
    // var_dump($tanggal);
    
    if ($tanggal == '') {
      $where = array('tanggal' => '');
      $this->load->library('datatables');
      $this->datatables->select('id_bahan_jadi,nama_bahan_jadi,stok_masuk,stok_keluar,stok_sisa');


      $this->datatables->from('stok_bahan_jadi_gudang');
      $this->datatables->where($where);
      echo $this->datatables->generate();
    }else{
      $tanggal = strtotime($tanggal);
      $tanggal = date('Y-m-d',$tanggal);

      $where = array('tanggal' => $tanggal );
      $this->load->library('datatables');
      $this->datatables->select('tanggal,id_bahan_jadi,nama_bahan_jadi,stok_masuk,stok_keluar,stok_sisa');
      $this->datatables->from('stok_bahan_jadi_gudang');
      $this->datatables->where($where);
      echo $this->datatables->generate();
    }

    
  }

  public function savenotagudang()
  {
    $stat = true;
    date_default_timezone_set("Asia/Bangkok");
    $datenow = date("Y-m-d");
    $no_nota = $this->input->post('no_nota');
    $tgl = $this->input->post('tgl');
    $tgl = explode("/", $tgl);
    $tgl = $tgl[2]."-".$tgl[1]."-".$tgl[0];

    $metode = $this->input->post('metode');
    $jatuh_tempo = $this->input->post('jatuh_tempo');

    if (strlen($jatuh_tempo)>1) {
      $jatuh_tempo = explode("/", $jatuh_tempo);
      $jatuh_tempo = $jatuh_tempo[2]."-".$jatuh_tempo[1]."-".$jatuh_tempo[0];
    }else{
      $jatuh_tempo = "0000-00-00";
    }
    

    $keterangan = $this->input->post('keterangan');
    $arrProduk = json_decode($this->input->post('arrProduk'));

    $total_harga = 0;
    foreach ($arrProduk as $perbahanjadi) {
      $total_harga += $perbahanjadi->hargatotal;
    }

    $data = array(
      'no_nota' => $no_nota,
      'tanggal' => $tgl,
      'keterangan' => $keterangan,
      'total_harga' => $total_harga,
      'metode' => $metode,
      'tempo_tanggal' => $jatuh_tempo,
      'tanggal_add' => $datenow
    );

    if ($this->Produk->insert('nota_gudang',$data)) {
      $number = 1;
      foreach ($arrProduk as $perbahanjadi) {
        $datadetail = array(
          'id_detail_nota' => $no_nota."_".$number,
          'no_nota' => $no_nota,
          'id_bahan_jadi' => $perbahanjadi->kodebarang,
          'nama_bahan_jadi' => $perbahanjadi->namabarang,
          'stok_masuk' => $perbahanjadi->stokmasuk,
          'harga_satuan' => $perbahanjadi->hargasatuan,
          'harga_total' =>$perbahanjadi->hargatotal
        );

        $this->Produk->insert('detail_nota_gudang',$datadetail);

        $number++;


        //add to stok_bahan_jadi_gudang
        $where = array(
          'id_bahan_jadi' => $perbahanjadi->kodebarang, 
          'tanggal' => $datenow
        );

        $StokDataToday = $this->Produk->getData($where,'stok_bahan_jadi_gudang');

        if (empty($StokDataToday)) {
                $sisa = $StokDataToday[0]->stok_sisa;

                $data = array(
                  'id_bahan_jadi' => $perbahanjadi->$id_bahan_jadi,
                  'nama_bahan_jadi' => $perbahanjadi->$nama_bahan_jadi,
                  'stok_masuk' => $perbahanjadi->stokmasuk,
                  'stok_keluar' => 0,
                  'stok_sisa' => $sisa + $perbahanjadi->stokmasuk,
                  'tanggal' => $datenow
                );

                $this->Produk->insert('stok_bahan_jadi_gudang',$data);
        }else{
          $data = array(
            'stok_masuk' => $StokDataToday[0]->stok_masuk + $perbahanjadi->stokmasuk,
            'stok_sisa' => $StokDataToday[0]->stok_sisa +$perbahanjadi->stokmasuk
          );

          $this->Produk->update('stok_bahan_jadi_gudang',$data,$where);
        }

        // stok_masuk
      }

    }else{
      $stat = false;
    }

    if ($stat) {
      echo "sukses";
    }else{
      echo "error";
    }
  }

  public function datatablenotagudang()
  {
      $this->load->library('datatables');
      $this->datatables->select('no_nota,tanggal,keterangan,total_harga,metode,tempo_tanggal,tanggal_add');
      $this->datatables->from('nota_gudang');
      echo $this->datatables->generate();
  }

  public function datatabledetailnotagudang()
  {
    $no_nota = $this->input->post('no_nota');
    $where = array('no_nota' => $no_nota);
      $this->load->library('datatables');
      $this->datatables->select('id_detail_nota,no_nota,id_bahan_jadi,nama_bahan_jadi,stok_masuk,harga_satuan,harga_total');

      $this->datatables->from('detail_nota_gudang');
      $this->datatables->where($where);
      echo $this->datatables->generate();
  }

  public function getmodal()
  {
    $exist = $this->Produk->getRowCountAll('modal_gudang');

    if ($exist > 0) {
      $datamodal = $this->Produk->getAllData('modal_gudang');
      $modal = $datamodal[0]->jumlah_modal;
    }else{
      $data = array(
        'id' => 'modaldata',
        'jumlah_modal' => 0
      );
      $this->Produk->insert('modal_gudang',$data);
      $modal = 0;
    }

    echo $modal;

  }

  public function sinkronisasidata()
  {
    $akses = $this->session->userdata('aksesadmin');
    if(empty($akses)){
        redirect('login');
    }else{
      $this->load->view('adminfranchise/navigationbar');
      $this->load->view('adminfranchise/sinkronisasidata');
    }
  }

  public function sinkronpresensi()
  {
    $getdata = $this->Produk->getDataLimit('device_finger',1);
    $parameter = "sn=".$getdata[0]->sn."&limit=100";
    $port = $getdata[0]->port;
    $where = array('id_stan' => 'warehouse');

    if ($this->ModelKasir->getRowCount('presensi_karyawan',$where) > 0) {
      $urlscan = $getdata[0]->ip."/scanlog/new";
      // $alluserdatabase = $this->ModelKasir->getAllData('presensi_karyawan');
    }else{
      $urlscan1 = $getdata[0]->ip."/scanlog/new";
      $a = $this->webservice($port,$urlscan1,$parameter);

      $urlscan = $getdata[0]->ip."/scanlog/all/paging";
        
    }

    $server_output_scan = $this->webservice($port,$urlscan,$parameter);   
    $content_allnewscan = json_decode($server_output_scan);

    if ($content_allnewscan == NULL) {
      echo "CANTCONNECT";
    }else{
      if ($content_allnewscan->Result == false) {
        echo "string";
      }else{
        foreach ($content_allnewscan->Data as $scan) {
          $data = array(
            'scan_date'=>$scan->ScanDate,
            'id_stan' => 'warehouse',
            'pin' => $scan->PIN,
            'verify_mode' => $scan->VerifyMode,
            'io_mode' => $scan->IOMode,
            'work_code' => $scan->WorkCode
          );

          $this->ModelKasir->insert('presensi_karyawan',$data);
        }
        echo "SUCCESSSAVE";
      }
    }

    
  }

  public function sinkronlistpegawai()
  {
    
    $statkosong = true;
    $getdata = $this->Produk->getDataLimit('device_finger',1);
    $parameter = "sn=".$getdata[0]->sn."&limit=100";
    $port = $getdata[0]->port;
      
    $url = $getdata[0]->ip."/user/all/paging";
    $server_output = $this->webservice($port,$url,$parameter);    
    $content_alluser = json_decode($server_output);

    $where = array('id_stan' => 'warehouse');

    $alluserdatabase = $this->Produk->getData($where,'karyawan_fingerspot');

    if ($this->Produk->getRowCount('karyawan_fingerspot',$where) > 0) {
      $statkosong = false;
    }

    if ($content_alluser == NULL) {
      echo "CANTCONNECT";
    }else{
      if ($content_alluser->Result == false) {
        echo "NONEWDATA";
      }else{
        if ($statkosong) {
          foreach ($content_alluser->Data as $user) {
            $data = array(
              'id_stan' => 'warehouse',
              'pin' => $user->PIN,
              'nama' => $user->Name

            );

            $this->Produk->insert('karyawan_fingerspot',$data);
          }
        }else{
          $listdata_user_finger = array();
          $adauser = false;
          foreach ($content_alluser->Data as $user) {
            foreach ($alluserdatabase as $peruserdatabase) {
              if ($user->PIN == $peruserdatabase->pin) {
                if ($user->Name != $peruserdatabase->nama) {
                  $where = array(
                    'id_stan' => 'warehouse',
                    'pin' => $peruserdatabase->pin
                  );

                  $data = array(
                    'nama' => $user->Name
                  );

                  $this->Produk->update('karyawan_fingerspot', $data, $where);
                }
                $adauser = true;
              }
            }

            if (!$adauser) {
              $data = array(
                'id_stan' => 'warehouse',
                'pin' => $user->PIN,
                'nama' => $user->Name
              );

              $this->ModelKasir->insert('karyawan_fingerspot',$data);
            }
            array_push($listdata_user_finger,$user->PIN);
          }

          foreach ($alluserdatabase as $peruserdatabase) {
            if (!in_array($peruserdatabase->pin, $listdata_user_finger)) {
              $where = array('id_stan' => 'warehouse', 'pin' => $peruserdatabase->pin);
              $this->ModelKasir->deleteWhere('karyawan_fingerspot',$where);
            }
          }
        }
        echo "SUCCESSSAVE";
      }
    }
  }

  public function webservice($port,$url,$parameter){
    $curl = curl_init();
    set_time_limit(0);
    curl_setopt_array($curl, array(
      CURLOPT_PORT => $port,
      CURLOPT_URL => "http://".$url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $parameter,
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/x-www-form-urlencoded"
        ),
      )
    );
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      $response = ("Error #:" . $err);
    }
    else
    {
      $response;
    }
    return $response;
  }

  public function sinkronkeuntunganglobalpengeluaranwarehouse($tanggal)
  {
    $tanggalpart = explode('-', $tanggal);
          $bulan = $tanggalpart[0];
          $tahun = $tanggalpart[1];

        $where = array(
          'bulan_tahun' => $tanggal,
          'keterangan' => 'Pengeluaran Warehouse'

        );
        $checkkeuntunganglobal = $this->Produk->getRowCount('keuntungan_global',$where);

        $where1 = array(
          'tanggal LIKE' => $tahun."-".$bulan."-%"
        );

        $allpengeluarangudang = $this->Produk->getData($where1,'pengeluaran_lain_gudang');
        $totalpengeluaran = 0;

        foreach ($allpengeluarangudang as $perpengeluaran) {
          $totalpengeluaran+=$perpengeluaran->pengeluaran;
        }

        if ($checkkeuntunganglobal<=0) {
          
            $datatosave = array(
            'bulan_tahun' => $tanggal,
            'keterangan' => 'Pengeluaran Warehouse',
            'total' => $totalpengeluaran,
            'tipe' => 'Kredit'
          );

          $insert = $this->Produk->insert('keuntungan_global',$datatosave);
        }else{

          $datatosave = array(
            'total' => $totalpengeluaran
          );

          $update = $this->Produk->update('keuntungan_global',$datatosave,$where);
        }
  }
}


?>