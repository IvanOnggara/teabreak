        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Laporan Pengeluaran Stan</h1>
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
                            <strong class="card-title">Tambah Data Pengeluaran</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Tanggal</label>
                                        <input type="text" id="tanggal" placeholder="Masukkan Tanggal" class="form-control">

                                    </div>
                                    <p id="process" class="teal" ><i class="fa fa-spin fa-refresh"></i> <b>Loading...</b></p>
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Keterangan</label>
                                        <input type="text" id="keterangan" placeholder="Masukkan Keterangan" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Biaya</label>
                                        <input type="text" id="biaya" placeholder="Masukkan Biaya" class="form-control numeric">

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label"> </label>
                                        <button id="buttontopup" onclick="adddata('addcode')" class="btn btn-success form-control">Tambah Data</button>

                                    </div>   

                                    
                                    
                                </div>
                            </div>
                            
                        <!-- <div class="card-footer">
                            <h2 id="total_harga_akhir">Total Penjualan Rp ,-</h2>
                        </div> -->
                    </div> <!-- .card -->

                    

                  </div><!--/.col-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Laporan Pengeluaran Stan</strong>
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
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Tanggal Awal</label>
                                        <input type="text" id="tanggal_awal" placeholder="Masukkan Tanggal" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Tanggal Akhir</label>
                                        <input type="text" id="tanggal_akhir" placeholder="Masukkan Tanggal" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                                <table id="mytable" class="table table-striped table-bordered" style="width: 100%" width="100%">
                                    <thead class="">
                                      <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah Pengeluaran</th>
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
        // alert($("#tanggal_awal").val());
        //TAMBAH DATA
        $('#tanggal_awal').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false
        });

        $('#tanggal_akhir').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false
        });

        $('#tanggal').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false
        });

        $("#tanggal_awal").on("dp.change", function(e) {
            reload_table();
            // $('#tanggal_akhir').data("DateTimePicker").minDate(e.date);
        });

        $("#tanggal_akhir").on("dp.change", function(e) {
            reload_table();
            // $('#tanggal_akhir').data("DateTimePicker").minDate(e.date);
        });

        var tanggalfull = new Date();
          var tanggal = tanggalfull.getDate();
          var bulan = tanggalfull.getMonth()+1;
          var tahun = tanggalfull.getFullYear();
          var jam = tanggalfull.getHours();
          var menit = tanggalfull.getMinutes();

          if (parseInt(tanggal)<10) {
            tanggal = "0"+tanggal;
          }

          if (parseInt(bulan)<10) {
            bulan = "0"+bulan;
          }

          if (parseInt(jam)<10) {
            jam = "0"+jam;
          }

          if (parseInt(menit)<10) {
            menit = "0"+menit;
          }

        // $('#tanggal_awal').val(tanggal+"/"+bulan+"/"+tahun);

        $('.numeric').on('input', function (event) { 

            this.value = this.value.replace(/[^0-9]/g, '');
            if ($(this).val().indexOf('.') == 0) {
              $(this).val($(this).val().substring(1));
            }
            if ($(this).val().length > 1) {
                if ($(this).val().charAt(0) == '0') {
                    if ($(this).val().charAt(1) != '.') {
                        this.value = $(this).val().charAt(1);
                    }else{
                        // this.value = $(this).val().charAt(1);
                    }
                }
            }

            if ($(this).val().split(".").length > 2) {
                this.value = this.value.slice(0,-1);
            }

            if ($(this).val()=='') {
                this.value = 0;
            }
        });
        $("#process").hide();
        
        var tabeldata;

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
                $("#select_stan").html(htmlinsideselect);

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
                    "url"    : "<?php echo base_url('superadminfranchise/pengeluaranstan');?>",
                    "data": function(d){
                        var datt = $('#tanggal_awal').val();
                        datt = datt.split("/");
                        var dattakhir = $('#tanggal_akhir').val();
                        dattakhir = dattakhir.split("/");
                        d.tanggalawal = datt[2]+"-"+datt[1]+"-"+datt[0];
                        d.tanggalakhir = dattakhir[2]+"-"+dattakhir[1]+"-"+dattakhir[0];
                        d.stan = $("#select_stan").val();
                    },
                    "dataSrc": function (json) {
                      var return_data = new Array();
                      for(var i=0;i< json.data.length; i++){
                        return_data.push({
                          'id_bahan_jadi': json.data[i].id_bahan_jadi,
                          'nama_bahan_jadi'  : json.data[i].nama_bahan_jadi,
                          'stok_sisa' : json.data[i].stok_sisa,
                          'harga_bahan_jadi' : json.data[i].harga_bahan_jadi,
                          'total_nominal' : 'Rp. '+(json.data[i].stok_sisa*json.data[i].harga_bahan_jadi)+' ,-',
                        })
                      }
                      return return_data;
                    }
                  },
                  columns: [
                    {'data': 'id_bahan_jadi'},
                    {'data': 'nama_bahan_jadi'},
                    {'data': 'stok_sisa'},
                    {'data': 'harga_bahan_jadi'},
                    {'data': 'total_nominal'}
                  ]
                });
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                alert(errorThrown);
              }
          }
        );

        // tabeldata = $("#mytable").DataTable({
        //   initComplete: function() {
        //     var api = this.api();
        //     $('#mytable_filter input')
        //     .on('.DT')
        //     .on('keyup.DT', function(e) {
        //       if (e.keyCode == 13) {
        //         api.search(this.value).draw();
        //       }
        //     });
        //   },
        //   oLanguage: {
        //     sProcessing: "loading..."
        //   },
        //   responsive: true,
        //   ajax: {
        //     "type"   : "POST",
        //     "url"    : "<?php echo base_url('superadminfranchise/getpengeluaranlain');?>",
        //     "data"   : function(data) {
        //           data.tanggal = $("#tanggal_awal").val();
        //         },
        //     "dataSrc": function (json) {
        //       var return_data = new Array();
        //       var shift;
        //       for(var i=0;i< json.data.length; i++){
        //         return_data.push({
        //           'tanggal': uidate(json.data[i].tanggal),
        //           'keterangan': json.data[i].keterangan,
        //           'pengeluaran'  : "Rp. "+currency(json.data[i].pengeluaran)+",-"
        //         })
        //       }
        //       return return_data;
        //     }
        //   },
        //     dom: 'Bfrtlip',
        //     buttons: [
        //         {
        //             extend: 'copyHtml5',
        //             text: 'Copy',
        //             filename: 'Pengeluaran Lain Gudang',
        //             exportOptions: {
        //               columns:[0,1,2]
        //             }
        //         },{
        //             extend: 'excelHtml5',
        //             text: 'Excel',
        //             className: 'exportExcel',
        //             filename: 'Pengeluaran Lain Gudang',
        //             exportOptions: {
        //               columns:[0,1,2]
        //             }
        //         },{
        //             extend: 'csvHtml5',
        //             filename: 'Pengeluaran Lain Gudang',
        //             exportOptions: {
        //               columns:[0,1,2]
        //             }
        //         },{
        //             extend: 'pdfHtml5',
        //             filename: 'Pengeluaran Lain Gudang',
        //             exportOptions: {
        //               columns:[0,1,2]
        //             }
        //         },{
        //             extend: 'print',
        //             filename: 'Pengeluaran Lain Gudang',
        //             exportOptions: {
        //               columns:[0,1,2]
        //             }
        //         }
        //     ],
        //     "lengthChange": true,
        //       columns: [
        //         {'data': 'tanggal','orderable':false},
        //         {'data': 'keterangan','orderable':false},
        //         {'data': 'pengeluaran','orderable':false}
        //       ],
        // });

        function reload_table(){

          tabeldata.ajax.reload();
        }

        function gettanggal() {
            return $("#tanggal_awal").val()
        }
    </script>
</body>
</html>
