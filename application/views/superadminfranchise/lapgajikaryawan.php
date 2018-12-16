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
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label"> </label>
                                        <button class="form-control btn btn-success" disabled="" onclick="downloadexcel()"><i class="fa fa-save"></i> Download Excel</button>
                                    </div>
                                </div>
                            </div>
                            <br>
                                <table id="mytable" class="table table-striped table-bordered" style="width: 100%" width="100%">
                                    <thead class="">
                                      <tr>
                                        <th width="10%">ID Karyawan</th>
                                        <th width="22%">Nama</th>
                                        <th width="11%">Masuk</th>
                                        <th width="11%">Lembur</th>
                                        <th width="11%">Terlambat</th>
                                        <th width="11%">Tidak Masuk</th>
                                        <th width="16%">Gaji Akhir</th>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="header modal-header">
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editid" class=" form-control-label">Penjualan</label>
                            <input type="hidden" name="id_lama" id="id_lama">
                            <input type="text" id="editpen" placeholder="Masukkan Pengeluaran" class="form-control numeric">
                        </div>
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
        $('#tanggal2').datetimepicker({
            format: 'MM/YYYY',
            useCurrent: false
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
                      for(var i=0;i< json.length; i++){
                        return_data.push({
                            // 'id_stan':json[i].id_stan,
                            'pin':json[i].pin,
                            'nama':json[i].nama,
                            'masuk':json[i].masuk,
                            'lembur':json[i].lembur,
                            'terlambat':json[i].terlambat,
                            'tidak_masuk':json[i].tidak_masuk,
                            'gaji_akhir':json[i].gaji_akhir,
                          'detail' : '<button onclick="detailgaji(\''+json[i].pin+'\')" class="btn btn-default" >Detail</button> '
                        });
                      }
                      return return_data;
                    }
                  },
                  columns: [
                    // {'data': 'id_stan'},
                    {'data': 'pin'},
                    {'data': 'nama'},
                    {'data': 'masuk'},
                    {'data': 'lembur'},
                    {'data': 'terlambat'},
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

        function detailgaji(pin) {
            // body...
        }
    </script>