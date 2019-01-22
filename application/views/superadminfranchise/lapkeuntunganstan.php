        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Laporan Keuntungan Stan</h1>
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
                            <strong class="card-title">Data Laporan Keuntungan Stan</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Stan</label>
                                        <select name="select" id="select_stan" class="form-control" onchange="refreshTable()">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Bulan/Tahun</label>
                                        <input type="text" id="tanggal_awal" placeholder="Masukkan Tanggal Awal" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                                <table style="width: 100%" width="100%"  id="mytable" class="table table-striped table-bordered">
                                    <col width="16%">
                                    <col width="36%">
                                    <col width="16%">
                                    <col width="16%">
                                    <col width="16%">
                                    <thead>
                                      <tr>

                                
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Debet</th>
                                        <th>Kredit</th>
                                        <th>Saldo</th>
                                      </tr>
                                    </thead>
                                </table>
                                <br>
                        </div>
                        <div class="card-footer">
                            <h2 id="total_keuntungan">Total Keuntungan Rp ,-</h2>
                        </div>
                    </div> <!-- .card -->

                  </div><!--/.col-->
                </div>
            </div>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->
    <!-- <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Detail Nota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label class=" form-control-label"><strong>Jenis Pembayaran</strong></label>
                                
                                <h4><span class="badge badge-primary" id="jenis_pembayaran">CASH</span></h4>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label class=" form-control-label"><strong>Status</strong></label>
                                
                                <h4><span class="badge badge-success" id="status">TIDAK VOID</span></h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class=" form-control-label"><strong>List Diskon</strong></label>
                                <div id="listdiskon">
                                    <h6>- diskon 1 (haha)</h6>
                                    <h6>- diskon 1 (haha)</h6>
                                    <h6>- diskon 1 (haha)</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label class=" form-control-label"><strong>Keterangan</strong></label>
                                
                                <h6 id="keterangan">Keterangan yang ditulis di bagian keterangan</h6>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class=" form-control-label"><strong>Nota Pembelian</strong></label>
                        <table id="detailnota" class="table table-striped table-bordered" style="width: 100%" width="100%">
                            <thead>
                              <tr>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Kategori</th>
                                <th>Harga Produk</th>
                                <th>Total Harga Produk</th>
                              </tr>
                            </thead>
                        </table>
                    </div>
                    <h5 class="text-right" id="totalhargapernota">Total Harga Nota : Rp. 0,-</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div> -->
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
        var tabeldata;
        $('#tanggal_awal').datetimepicker({
            format: 'MM/YYYY',
            useCurrent: false
        });

        $("#tanggal_awal").on("dp.change", function(e) {
            refreshTable();
        });


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
                // $("#stan").html(htmlinsideselect);

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
                    "url"    : "<?php echo base_url('superadminfranchise/datalaporankeuntunganstan');?>",
                    "data": function(d){
                        var id_stan = $('#select_stan').val();
                        d.id_stan = id_stan;
                        d.bulan_tahun = $('#tanggal_awal').val();
                    },
                    "dataSrc": function (json) {
                      var return_data = new Array();
                      howmuch = 0;
                      var debit;
                      var kredit;
                      var saldo = 0;
                      for(var i=0;i< json.length; i++){
                        howmuch++;

                        if (json[i].tipe == 'Debit' ) {
                            debit = json[i].total;
                            kredit = '-';
                            saldo = saldo+parseInt(json[i].total);
                        }else{
                            kredit = json[i].total;
                            debit = '-';
                            saldo = saldo-parseInt(json[i].total);
                        }
                        return_data.push({
                            // 'id_stan':json[i].id_stan,
                            'tanggal':json[i].bulan_tahun,
                            'keterangan':json[i].keterangan,
                            'debit':debit,
                            'kredit':kredit,
                            'saldo':saldo,
                          // 'detail' : '<button onclick="detailgaji(\''+json[i].id_gaji+'\',\''+json[i].pin+'\',\''+json[i].id_stan+'\',\''+json[i].nama+'\',\''+json[i].masuk+'\',\''+json[i].lembur+'\',\''+json[i].terlambat+'\',\''+json[i].terlambatlembur+'\',\''+json[i].tidak_masuk+'\',\''+json[i].gaji_akhir+'\',\''+json[i].gaji_tetap+'\',\''+json[i].bonus_omset+'\',\''+json[i].potongan_lain+'\',\''+json[i].keterangan_potongan_lain+'\',\''+json[i].gaji_tambahan+'\',\''+json[i].keterangan_gaji_tambahan+'\')" class="btn btn-primary" >Detail</button> '
                        });
                      }
                      $("#total_keuntungan").text('Total Keuntungan Rp '+currency(saldo));
                      return return_data;
                    }
                  },
                dom: 'Bfrtlip',
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            title:function(argument) {
                                return 'Data Keuntungan Stan '+$("#select_stan option:selected").text();
                            } ,
                            messageTop: function (argument) {
                                return $("#tanggal_awal").val();
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
                                  var tanggall = $("#tanggal_awal").val();
                                  var stan = $("#select_stan option:selected").text();

                                  return 'Keuntungan '+stan+" bulantahun "+tanggall ;
                            } ,
                            exportOptions: {
                              columns:[0,1,2,3,4]
                            }
                        }
                    ],
                    "lengthChange": true,
                  columns: [
                    // {'data': 'id_stan'},
                    {'data': 'tanggal'},
                    {'data': 'keterangan'},
                    {'data': 'debit'},
                    {'data': 'kredit'},
                    {'data': 'saldo'}
                  ]
                });

              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                alert(errorThrown);
              }
          }
        );

        function refreshTable() {
            tabeldata.ajax.reload();
        }
    </script>
</body>
</html>
