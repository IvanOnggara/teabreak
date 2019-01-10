        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Laporan Sisa Stok Stan</h1>
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
                            <strong class="card-title">Data Laporan Sisa Stok Stan</strong>
                        </div>
                        <div class="card-body">
                            <form method="post" action="downloadexcelstan" >
                                
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Stan</label>
                                        <select name="select" name="select_stan" required="" id="select_stan" class="form-control" onchange="refreshTable()">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Tanggal</label>
                                        <input type="text" name="tanggal_awal" id="tanggal_awal" placeholder="Masukkan Tanggal" class="form-control" required="true">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label"> </label>
                                        <button type="submit" class="form-control btn btn-success"><i class="fa fa-save"></i> Download Excel</button>
                                    </div>
                                </div>
                                <!-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Tanggal Akhir</label>
                                        <input type="text" id="tanggal_akhir" placeholder="Masukkan Tanggal Akhir" class="form-control">
                                    </div>
                                </div> -->
                            </div>
                            </form>
                            <br>
                                <table id="mytable" class="table table-striped table-bordered" style="width: 100%" width="100%">
                                    <thead class="">
                                      <tr>
                                        <th>Tanggal</th>
                                        <th>ID Bahan Jadi</th>
                                        <th>Nama Bahan Jadi</th>
                                        <th>Stok Masuk</th>
                                        <th>Stok Keluar</th>
                                        <th>Sisa Stok</th>
                                      </tr>
                                    </thead>
                                </table>
                                <br>
                        </div>
                        <!-- <div class="card-footer">
                            <h2 id="total_harga_akhir">Total Penjualan Rp ,-</h2>
                        </div> -->
                    </div> <!-- .card -->

                  </div><!--/.col-->
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

        // $('#tanggal_akhir').datetimepicker({
        //     format: 'DD/MM/YYYY',
        //     useCurrent: false
        // });

        $("#tanggal_awal").on("dp.change", function(e) {
            refreshTable();
            // $('#tanggal_akhir').data("DateTimePicker").minDate(e.date);
        });

        // $("#tanggal_akhir").on("dp.change", function(e) {
        //     refreshTable();
        //     $('#tanggal_awal').data("DateTimePicker").maxDate(e.date);
        // });

        // $("#tanggal_awal").click(function () {
        //     if ($("#tanggal_akhir").val()!='') {
        //         $('#tanggal_awal').data("DateTimePicker").maxDate($('#tanggal_akhir').data('date'));
        //     }
        // });

        // $('#tanggal_akhir').click(function () {
        //     if ($("#tanggal_awal").val()!='') {
        //         $('#tanggal_akhir').data("DateTimePicker").minDate($('#tanggal_awal').data('date'));
        //     }
        // });

        function downloadexcel() {
            alert('Development Process');

            $.post(
              "downloadexcelstan",
              {
                tanggal: function (argument) {
                    return $("#tanggal_awal").val();
                },
                idstan : function (argument) {
                    return $("#select_stan").val();
                }
              },
              function(data, status){
                // alert("Data: " + data + "\nStatus: " + status);
              }
            );
        }

    </script>
</body>
</html>
