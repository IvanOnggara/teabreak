<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Sinkronisasi Data</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <!-- <li class="active">Semua Data Produk</li> -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                
                <div class="row">
                    <div class="col-lg-6">
                        <!-- <h1><span class="badge badge-warning">Fitur dalam tahap Pengembangan!</span></h1> -->
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Sinkronisasi List Karyawan</strong>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-success btn-lg btn-block" onclick="sinkronlist()"><i id="sinkronlist" class="fa fa-refresh"></i> Sinkronisasi</button>
                                <p id="process1" class="teal">Loading...</p>
                            </div>
                        </div> <!-- .card -->
                    </div>
                    <div class="col-lg-6">
                        <!-- <h1><span class="badge badge-warning">Fitur dalam tahap Pengembangan!</span></h1> -->
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Sinkronisasi Presensi Karyawan</strong>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-success btn-lg btn-block" onclick="sinkronpresensi()"><i id="sinkronpresensi" class="fa fa-refresh"></i> Sinkronisasi</button>
                                <p id="process2" class="teal">Loading...</p>
                            </div>
                        </div> <!-- .card -->
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <script src=<?php echo base_url("assets/js/lib/vector-map/jquery.vmap.js")?>></script>
    <script src=<?php echo base_url("assets/js/lib/vector-map/jquery.vmap.min.js")?>></script>
    <script src=<?php echo base_url("assets/js/lib/vector-map/jquery.vmap.sampledata.js")?>></script>
    <script src=<?php echo base_url("assets/js/lib/vector-map/country/jquery.vmap.world.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/datatables.js")?>></script>
    <script src=<?php echo base_url("assets/js/popper.min.js"); ?>></script>
    <script src=<?php echo base_url("assets/js/plugins.js"); ?>></script>
    <script src=<?php echo base_url("assets/js/lib/chosen/chosen.jquery.min.js"); ?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/dataTables.buttons.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/buttons.print.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/buttons.html5.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/buttons.flash.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/JSZip-2.5.0/jszip.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/pdfmake-0.1.36/pdfmake.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/pdfmake-0.1.36/vfs_fonts.js")?>></script>
    <script src=<?php echo base_url("assets/vendors/moment/min/moment.min.js")?>></script>
    <script src=<?php echo base_url("assets/vendors/bootstrap-daterangepicker/daterangepicker.js")?>></script>
    <script src=<?php echo base_url("assets/vendors/Date-Time-Picker-Bootstrap-4/build/js/bootstrap-datetimepicker.min.js")?>></script>
    

    <script src=<?php echo base_url("assets/js/jquery.easy-autocomplete.js")?>></script>
    <script type="text/javascript">
        $("#process1").hide();
        $("#process2").hide();

        function sinkronlist() {
            $("#process1").show();
            $("#sinkronlist").addClass('fa-spin');

            $.ajax({
                  type:"post",
                  url: "<?php echo base_url('adminfranchise/sinkronlistpegawai')?>/",
                  data:{ sst:"sinkron"},
                  dataType:"text",
                  success:function(response)
                  {
                    $('#process1').removeClass('teal');
                    if (response == 'CANTCONNECT') {
                        $('#process1').html('KONEKSI ERROR!');
                        $('#process1').addClass('red');
                    }else if (response == 'SUCCESSSAVE') {
                        $('#process1').html('SINKRONISASI PRESENSI SUKSES!');
                        $('#process1').addClass('green');
                    }else{
                        $('#process1').html('TIDAK ADA PERUBAHAN DATA!');
                        $('#process1').addClass('red');
                    }
                    console.log(response);
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                    alert(errorThrown);
                  },
                  complete: function(){
                    $('#sinkronlist').removeClass('fa-spin');
                  }
              }
            );

        }

        function sinkronpresensi() {
            $("#process2").show();
            $("#sinkronpresensi").addClass('fa-spin');

            $.ajax({
                  type:"post",
                  url: "<?php echo base_url('adminstand/sinkronpresensi')?>/",
                  data:{ sst:"sinkron"},
                  dataType:"text",
                  success:function(response)
                  {
                    $('#labelsinkronpresensi').removeClass('orange');
                    if (response == 'CANTCONNECT') {
                        $('#labelsinkronpresensi').html('KONEKSI ERROR!');
                        $('#labelsinkronpresensi').addClass('red');
                    }else if (response == 'SUCCESSSAVE') {
                        $('#labelsinkronpresensi').html('SINKRONISASI SUKSES!');
                        $('#labelsinkronpresensi').addClass('green');
                    }else{
                        $('#labelsinkronpresensi').html('TIDAK ADA PERUBAHAN DATA!');
                        $('#labelsinkronpresensi').addClass('red');
                    }
                    console.log(response);
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                    alert(errorThrown);
                  },
                  complete: function(){
                    $('#sinkronpresensi').removeClass('fa-spin');
                  }
              }
            );
        }
    </script>

</body>
</html>