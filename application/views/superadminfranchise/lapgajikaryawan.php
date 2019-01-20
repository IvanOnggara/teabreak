        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Gaji Karyawan</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Laporan Gaji Karyawan</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Nama Stan</label>
                                        <select name="select" id="select_stan" class="form-control" onchange="reload_table()">

                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Tanggal Awal</label>
                                        <input type="text" id="tanggal_awal" placeholder="Masukkan Tanggal" class="form-control">
                                    </div>
                                </div> -->
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Bulan Tahun</label>
                                        <input type="text" id="tanggal2" placeholder="Masukkan Bulan Tahun" class="form-control">
                                    </div>
                                </div>
                                <!-- <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label"> </label>
                                        <button class="form-control btn btn-success" disabled="" onclick="downloadexcel()"><i class="fa fa-save"></i> Download Excel</button>
                                    </div>
                                </div> -->
                            </div>
                            <br>
                                <table id="mytable" class="table table-striped table-bordered" style="width: 100%" width="100%">
                                    <thead class="">
                                      <tr>
                                        <th width="14%">ID Karyawan</th>
                                        <th width="15%">Nama</th>
                                        <th width="9%">Masuk</th>
                                        <th width="9%">Lembur</th>
                                        <th width="10%">Terlambat</th>
                                        <th width="11%">Terlambat Lembur</th>
                                        <th width="14%">Tidak Masuk</th>
                                        <th width="10%">Gaji Akhir</th>
                                        <th width="8%">Detail</th>
                                      </tr>
                                    </thead>
                                </table>
                                <br>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->
    <!-- Right Panel -->

    <div class="modal fade" id="modal_edit" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="header modal-header">
                <h4 class="modal-title">Detail and Edit</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 class="pb-2 display-5" id="datakaryawan" style="font-weight: bold;">ID : 0000 - Name Here</h4>
                <h6 class="pb-2 display-5" id="bulantahun"></h6>
                <h6 class="pb-2 display-5" id="tempatkerja"></h6>

                <div class="row" style="margin-top: 20px">
                    <div class="col-md-8">
                        <h5 style="font-weight: bold">Data Absen Karyawan</h5>
                        <hr>
                       <!--  <div class="form-group">
                            <label for="editid" class=" form-control-label">Penjualan</label>
                            <input type="hidden" name="id_lama" id="id_lama">
                            <input type="text" id="editpen" placeholder="Masukkan Pengeluaran" class="form-control numeric">
                        </div> -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <h5>
                            <span class="badge badge-success" id="masukkerja">Masuk : - Hari</span>
                        </h5>
                        
                    </div>
                    <div class="col-lg-4">
                        <h5>
                            <span class="badge badge-danger" id="tidakmasukkerja">Tidak Masuk : - Hari</span>
                        </h5>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4">
                        <h5>
                            <span class="badge badge-warning" id="terlambat">Terlambat : - Hari</span>
                        </h5>
                    </div>
                    
                    <div class="col-lg-4">
                        <h5>
                            <span class="badge badge-warning" id="lembur">Lembur : - Hari</span>
                        </h5>
                    </div>
                    <!-- <div class="col-lg-43">
                        <h5>
                            <span class="badge badge-warning" id="terlambatlembur">Lembur Terlambat : - Hari</span>
                        </h5>
                    </div> -->
                </div>
                
                <div class="row" style="margin-top: 20px">
                    <div class="col-md-8">
                        <h5 style="font-weight: bold">Potongan Gaji Karyawan</h5>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="pb-2 display-5" id="potongantidakmasuk">Tidak Masuk : -</h6>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-lg-4">
                         <div class="form-group">
                            <label for="editid" class=" form-control-label">Potongan Lain</label>
                            <input type="hidden" name="id_lama" id="id_gaji">
                            <input type="hidden" name="id_lama" id="editpotonganlainawal">
                            <input type="text" id="editpotonganlain" placeholder="Masukkan Potongan Lain" class="form-control numeric">
                        </div>
                    </div>
                    <div class="col-lg-8">
                         <div class="form-group">
                            <label for="editid" class=" form-control-label">Keterangan</label>
                            <input type="text" id="editketpotonganlain" placeholder="Masukkan Keterangan" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px">
                    <div class="col-md-8">
                        <h5 style="font-weight: bold">Total Gaji Karyawan</h5>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="pb-2 display-5" id="gajipokok">Gaji Pokok : -</h6>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="pb-2 display-5" id="uangmakan">Uang Makan : -</h6>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="pb-2 display-5" id="bonusomset">Bonus Omset : -</h6>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="pb-2 display-5" id="uanglembur">Uang Lembur : -</h6>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-lg-4">
                         <div class="form-group">
                            <label for="editid" class=" form-control-label">Gaji Tambahan</label>
                            <input type="hidden" name="id_lama" id="editgajitambahanawal">
                            <input type="text" id="editgajitambahan" placeholder="Masukkan Gaji Tambahan" class="form-control numeric">
                        </div>
                    </div>
                    <div class="col-lg-8">
                         <div class="form-group">
                            <label for="editid" class=" form-control-label">Keterangan</label>
                            <input type="text" id="editketgajitambahan" placeholder="Masukkan Keterangan" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h6 style="font-weight: bold" class="pb-2 display-5" id="gajiakhir">Gaji Akhir : -</h6>
                        <input type="hidden" name="" id="gajiakhirdata">
                    </div>
                    
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                <button type="button" onclick="simpanedit()" class="btn add_field_button btn-info">Simpan</button>
            </div>
        </div>
    </div>
</div>
 
    <script src=<?php echo base_url("assets/js/lib/vector-map/jquery.vmap.js")?>></script>
    <script src=<?php echo base_url("assets/js/lib/vector-map/jquery.vmap.min.js")?>></script>
    <script src=<?php echo base_url("assets/js/lib/vector-map/jquery.vmap.sampledata.js")?>></script>
    <script src=<?php echo base_url("assets/js/lib/vector-map/country/jquery.vmap.world.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/datatables.js")?>></script>
    <script src=<?php echo base_url("assets/js/popper.min.js"); ?>></script>
    <script src=<?php echo base_url("assets/js/plugins.js"); ?>></script>
    <script src=<?php echo base_url("assets/js/teabreak.js"); ?>></script>
    <script src=<?php echo base_url("assets/js/lib/chosen/chosen.jquery.min.js"); ?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/dataTables.buttons.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/buttons.print.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/buttons.html5.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/buttons.flash.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/JSZip-2.5.0/jszip.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/pdfmake-0.1.36/pdfmake.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/pdfmake-0.1.36/vfs_fonts.js")?>></script>

    <script src=<?php echo base_url("assets/vendors/bootstrap-4.1.3-dist/js/bootstrap.min.js")?>></script>
    <!-- <script src=></script> -->
    <!-- echo base_url("assets/js/main.js")?> -->

    <!-- bootstrap-daterangepicker -->
    <script src=<?php echo base_url("assets/vendors/moment/min/moment.min.js")?>></script>
    <script src=<?php echo base_url("assets/vendors/bootstrap-daterangepicker/daterangepicker.js")?>></script>
    <!-- bootstrap-datetimepicker -->    
    <script src=<?php echo base_url("assets/vendors/Date-Time-Picker-Bootstrap-4/build/js/bootstrap-datetimepicker.min.js")?>></script>
    <script type="text/javascript">
        var howmuch = 0;
        $('#tanggal2').datetimepicker({
            format: 'MM/YYYY',
            useCurrent: false,
            defaultDate: moment(new Date()).subtract(1,'months')
        });

        $("#tanggal2").on("dp.change", function(e) {
            reload_table();
        });

        var tabeldata;

        function reload_table(){

          tabeldata.ajax.reload();
        }

        $.ajax({
          type:"post",
          url: "<?php echo base_url('superadminfranchise/get_list_stan')?>/",
          data:{},
          dataType:"json",
              success:function(response)
              {
                var htmlinsideselect = '';
                for (var j = response.length - 1; j >= 0; j--) {
                    if (j==response.length-1) {
                        htmlinsideselect = htmlinsideselect + '<option selected="selected" value="'+response[j].id_stan+'">'+response[j].nama_stan +' ( '+response[j].alamat+' )' +'</option>';
                    }else{
                        htmlinsideselect = htmlinsideselect + '<option value="'+response[j].id_stan+'">'+response[j].nama_stan +' ( '+response[j].alamat+' )' +'</option>';
                    }
                    
                }
                htmlinsideselect = htmlinsideselect + '<option value="warehouse">Warehouse</option>';
                $("#select_stan").html(htmlinsideselect);
                $("#stan").html(htmlinsideselect);

                tabeldata = $("#mytable").DataTable({
                      initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                        .on('.DT')
                        .on('keyup.DT', function(e) {
                          if (e.keyCode == 13) {
                            api.search(this.value).draw();
                          }
                        });
                      },
                      oLanguage: {
                        sProcessing: "loading..."
                      },
                      responsive: true,
                      ajax: {
                    "type"   : "POST",
                    "url"    : "<?php echo base_url('superadminfranchise/datalaporangaji');?>",
                    "data": function(d){
                        var id_stan = $('#select_stan').val();
                        d.id_stan = id_stan;
                        d.bulan_tahun = $('#tanggal2').val();
                    },
                    "dataSrc": function (json) {
                      var return_data = new Array();
                      howmuch = 0;
                      for(var i=0;i< json.data.length; i++){
                        howmuch++;
                        return_data.push({
                            // 'id_stan':json[i].id_stan,
                            'pin':json.data[i].pin,
                            'nama':json.data[i].nama,
                            'masuk':json.data[i].masuk,
                            'lembur':json.data[i].lembur,
                            'terlambat':json.data[i].terlambat,
                            'terlambatlembur':json.data[i].terlambatlembur,
                            'tidak_masuk':json.data[i].tidak_masuk,
                            'gaji_akhir':json.data[i].gaji_akhir,
                          'detail' : '<button onclick="detailgaji(\''+json.data[i].id_gaji+'\',\''+json.data[i].pin+'\',\''+json.data[i].id_stan+'\',\''+json.data[i].nama+'\',\''+json.data[i].masuk+'\',\''+json.data[i].lembur+'\',\''+json.data[i].terlambat+'\',\''+json.data[i].terlambatlembur+'\',\''+json.data[i].tidak_masuk+'\',\''+json.data[i].gaji_akhir+'\',\''+json.data[i].gaji_tetap+'\',\''+json.data[i].bonus_omset+'\',\''+json.data[i].potongan_lain+'\',\''+json.data[i].keterangan_potongan_lain+'\',\''+json.data[i].gaji_tambahan+'\',\''+json.data[i].keterangan_gaji_tambahan+'\')" class="btn btn-primary" >Detail</button> '
                        });
                      }
                      return return_data;
                    }
                  },
                dom: 'Bfrtlip',
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            title:function(argument) {
                                return 'Data Gaji Karyawan '+$("#select_stan option:selected").text();
                            } ,
                            messageTop: function (argument) {
                                return $("#tanggal2").val();
                            },
                            customize: function ( xlsx ){
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];

                                // jQuery selector to add a border
                                $('row c[r*="3"]', sheet).attr( 's', '27' );

                                for (var i = 0; i < howmuch; i++) {
                                  var row = i + 4;
                                  $('row c[r*="'+row+'"]', sheet).attr( 's', '25' );
                                }

                            },
                            text: '<i class="fa fa-download"></i> Download Excel',
                            className: 'exportExcel',
                            filename: function (argument) {
                                  var tanggall = $("#tanggal2").val();
                                  var stan = $("#select_stan option:selected").text();

                                  return 'Gaji Karyawan '+stan+" bulantahun "+tanggall ;
                            } ,
                            exportOptions: {
                              columns:[0,1,2,3,4,5,6,7]
                            }
                        }
                    ],
                    "lengthChange": true,
                  columns: [
                    // {'data': 'id_stan'},
                    {'data': 'pin'},
                    {'data': 'nama'},
                    {'data': 'masuk'},
                    {'data': 'lembur'},
                    {'data': 'terlambat'},
                    {'data': 'terlambatlembur'},
                    {'data': 'tidak_masuk'},
                    {'data': 'gaji_akhir'},
                    {'data': 'detail'}
                  ]
                });

              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                alert(errorThrown);
              }
          }
        );

        function detailgaji(id_gaji,pin,id_stan,nama,masuk,lembur,terlambat,terlambatlembur,tidakmasuk,gajiakhir,gajitetap,bonusomset,potongan_lain,keterangan_potongan_lain,gaji_tambahan,keterangan_gaji_tambahan) {
            $('#modal_edit').modal('toggle');
            $("#datakaryawan").text("ID : "+pin+" - "+nama);
            var blnthn = $("#tanggal2").val().split("/");
            var bln = blnthn[0];
            var thn = blnthn[1];
            terlambat =parseInt(terlambat) +parseInt(terlambatlembur);
            lembur = parseInt(lembur)+parseInt(terlambatlembur);

            bln = strtobln(bln);
            $("#bulantahun").text(bln+" "+thn);
            $("#tempatkerja").text("Tempat Kerja : "+$("#select_stan option:selected").text());

            $("#masukkerja").text("Masuk : "+parseInt(masuk) +" Hari");
            $("#tidakmasukkerja").text("Tidak Masuk : "+parseInt(tidakmasuk) +" Hari");
            $("#terlambat").text("Terlambat : "+parseInt(terlambat) +" Hari");
            $("#lembur").text("Lembur : "+ parseInt(lembur)+" Hari");
            $("#id_gaji").val(id_gaji);
            // $("#terlambatlembur").text("Lembur Terlambat : "+ +" Hari");

            $.post({
                url: "<?php echo base_url('superadminfranchise/getdetailstan')?>/",
                data:{
                    id_stan : id_stan 
                },
                success:function(response) {
                    response = JSON.parse(response);
                    console.log(response);
                    var potongantidakmasuk = tidakmasuk*response[0].pinalti_bolos;
                    var uangmakan = (masuk-terlambat)*response[0].uang_makan;
                    var uanglembur = lembur*response[0].uang_lembur;
                    $("#potongantidakmasuk").text("Tidak Masuk : Rp. "+currency(potongantidakmasuk)+" ( "+ tidakmasuk+" * "+response[0].pinalti_bolos+" )");
                    $("#uangmakan").text("Uang Makan : Rp. "+currency(uangmakan) +" ( "+ (masuk-terlambat)+" * "+response[0].uang_makan+" )");
                    $("#uanglembur").text("Uang Lembur : Rp. "+currency(uanglembur) +" ( "+ lembur+" * "+response[0].uang_lembur+" )");
                    $("#potongantidakmasuk").css("color", "black");
                    $("#uangmakan").css("color", "black");
                    $("#uanglembur").css("color", "black");
                },
                error:function(argument) {
                    $("#potongantidakmasuk").text("Jaringan Bermasalah! Coba Lagi");
                    $("#uangmakan").text("Jaringan Bermasalah! Coba Lagi");
                    $("#uanglembur").text("Jaringan Bermasalah! Coba Lagi");
                    $("#potongantidakmasuk").css("color", "red");
                    $("#uangmakan").css("color", "red");
                    $("#uanglembur").css("color", "red");
                }
            });

            $("#editpotonganlain").val(potongan_lain);
            $("#editpotonganlainawal").val(potongan_lain);

            $("#editketpotonganlain").val(keterangan_potongan_lain);
            $("#gajipokok").text("Gaji Pokok : Rp. "+ currency(gajitetap)+"");
            
            $("#bonusomset").text("Bonus Omset : Rp. "+currency(bonusomset) +"");
            
            $("#editgajitambahan").val(gaji_tambahan);
            $("#editgajitambahanawal").val(gaji_tambahan);
            $("#editketgajitambahan").val(keterangan_gaji_tambahan);
            $("#gajiakhir").text("Gaji Akhir : Rp. "+currency(gajiakhir) );
            $("#gajiakhirdata").val(gajiakhir);
        }

        function simpanedit() {
            var potonganlain = $("#editpotonganlain").val();
            var gaji_tambahan = $("#editgajitambahan").val();
            var keterangan_potongan_lain = $("#editketpotonganlain").val();
            var keterangan_gaji_tambahan = $("#editketgajitambahan").val();
            var id_gaji = $("#id_gaji").val();
            var potongan_lainawal = $("#editpotonganlainawal").val();
            var gaji_tambahanawal = $("#editgajitambahanawal").val();
            var gaji_akhir = $("#gajiakhirdata").val();

            if (potonganlain != '' && gaji_tambahan != '') {
                $("#editpotonganlain").removeClass('is-invalid');
                $("#editgajitambahan").removeClass('is-invalid');
                //ajax save

                $.ajax({
                  type:"post",
                  url: "<?php echo base_url('superadminfranchise/edit_gaji_karyawan')?>/",
                  data:{ potonganlain:potonganlain,keterangan_potongan_lain:keterangan_potongan_lain,gaji_tambahan:gaji_tambahan,keterangan_gaji_tambahan:keterangan_gaji_tambahan,id_gaji:id_gaji,potongan_lainawal:potongan_lainawal,gaji_tambahanawal:gaji_tambahanawal,gaji_akhir:gaji_akhir},
                  success:function(response)
                  {
                    $("#modal_edit").modal('hide');
                    if(response == 'Berhasil Diupdate'){
                      reload_table();
                    }
                    alert(response);
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                    alert(errorThrown);
                  }
                });
            }else{
                $("#editpotonganlain").addClass('is-invalid');
                $("#editgajitambahan").addClass('is-invalid');
            }
        }
    </script>