        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Manajemen Shift Karyawan</h1>
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
                            <strong class="card-title">Tambah Shift Baru</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                              <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Nama Stan</label>
                                        <select name="select" id="stan" class="form-control" onchange="reload_table()">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Nama Shift</label>
                                        <input type="text" id="shift" placeholder="Masukkan Nama Shift" class="form-control">

                                    </div>
                                    
                                    
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Jam Awal</label>
                                        <input type="text" id="jam_awal" placeholder="Masukkan Jam" class="form-control">

                                    </div>
                                    
                                    
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Jam Akhir</label>
                                        <input type="text" id="jam_akhir" placeholder="Masukkan Jam" class="form-control">

                                    </div>
                                    
                                </div>
                                
                                
                            </div>
                            <!-- <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Pinalti Terlambat</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp. </div>
                                            <input type="text" id="pinalti_terlambat" placeholder="ex: 25000" class="form-control numeric">
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Pinalti Bolos</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp. </div>
                                            <input type="text" id="pinalti_bolos" placeholder="ex: 25000" class="form-control numeric">
                                        </div>

                                    </div>
                                    
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Uang Makan</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp. </div>
                                            <input type="text" id="uang_makan" placeholder="ex: 25000" class="form-control numeric">
                                        </div>

                                    </div>
                                    
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Batas Datang Cepat</label>
                                        
                                        <div class="input-group">
                                            
                                            <input type="text" id="batasdatangcepat" placeholder="ex: 2" class="form-control numeric_hour">
                                            <div class="input-group-addon"> Jam</div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label"> Waktu Minimal Lembur</label>
                                        
                                        <div class="input-group">
                                            
                                            <input type="text" id="batastelatlembur" placeholder="ex: 2" class="form-control numeric_hour">
                                            <div class="input-group-addon"> Jam</div>
                                        </div>

                                    </div>
                                    
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label"> Standard Lembur</label>
                                        
                                        <div class="input-group">
                                            
                                            <input type="text" id="standarlembur" placeholder="ex: 2" class="form-control numeric_hour">
                                            <div class="input-group-addon"> Jam</div>
                                        </div>

                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                        <button id="buttontoadd" onclick="adddata('addcode')" class="btn btn-success">Tambah Data</button> 
                                        <p id="process" class="teal" ><i class="fa fa-spin fa-refresh"></i> <b>Loading...</b></p>
                                </div>
                              <div class="col-lg-10">
                                
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
                            <strong class="card-title">Semua Shift</strong>
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
                                </div>
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
                                </div> -->
                            </div>
                            <br>
                                <table id="mytable" class="table table-striped table-bordered" style="width: 100%" width="100%">
                                    <thead class="">
                                      <tr>
                                        <th width="29%">Nama Shift</th>
                                        <th width="15%">Jam Awal</th>
                                        <th width="15%">Jam Akhir</th>
                                        <th width="11%">Batas Datang cepat</th>
                                        <th width="11%">Minimal Lembur</th>
                                        <th width="11%">Standar Lembur</th>
                                        <th width="8%">Edit</th>
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
                    
                    <input type="hidden" name="id_lama" id="id_lama">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="id" class=" form-control-label">Nama Shift</label>
                            <input type="text" id="editshift" placeholder="Masukkan Nama Shift" class="form-control">

                        </div>
                        
                        
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="id" class=" form-control-label">Jam Awal</label>
                            <input type="text" id="editjam_awal" placeholder="Masukkan Jam" class="form-control">

                        </div>
                        
                        
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="id" class=" form-control-label">Jam Akhir</label>
                            <input type="text" id="editjam_akhir" placeholder="Masukkan Jam" class="form-control">

                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="id" class=" form-control-label">Batas Datang Cepat</label>
                            
                            <div class="input-group">
                                
                                <input type="text" id="editbatasdatangcepat" placeholder="ex: 2" class="form-control numeric_hour">
                                <div class="input-group-addon"> Jam</div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="id" class=" form-control-label"> Waktu Minimal Lembur</label>
                            
                            <div class="input-group">
                                
                                <input type="text" id="editbatastelatlembur" placeholder="ex: 2" class="form-control numeric_hour">
                                <div class="input-group-addon"> Jam</div>
                            </div>

                        </div>
                        
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="id" class=" form-control-label"> Waktu Standard Lembur</label>
                            
                            <div class="input-group">
                                
                                <input type="text" id="editstandarlembur" placeholder="ex: 2" class="form-control numeric_hour">
                                <div class="input-group-addon"> Jam</div>
                            </div>

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
        // alert($("#tanggal_awal").val());
        //TAMBAH DATA
        // $('#tanggal_awal').datetimepicker({
        //     format: 'DD/MM/YYYY',
        //     useCurrent: false
        // });

        // $('#tanggal_akhir').datetimepicker({
        //     format: 'DD/MM/YYYY',
        //     useCurrent: false
        // });

        $('#jam_awal').datetimepicker({
            format: 'HH:mm',
            useCurrent: false
        });

        $('#jam_akhir').datetimepicker({
            format: 'HH:mm',
            useCurrent: false
        });

        $('#editjam_awal').datetimepicker({
            format: 'HH:mm',
            useCurrent: false
        });

        $('#editjam_akhir').datetimepicker({
            format: 'HH:mm',
            useCurrent: false
        });

        // $("#tanggal2").on("dp.change", function(e) {
            
        //     reload_table();
        // });

        // $("#tanggal_akhir").on("dp.change", function(e) {
            
        //     $('#tanggal_awal').data("DateTimePicker").maxDate(e.date);
        //     reload_table();
        // });

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

        $('.numeric_hour').on('input', function (event) { 

            this.value = this.value.replace(/[^0-9]/g, '');
            
            if ($(this).val().length > 1) {
                if ($(this).val().charAt(0) == '0') {
                    if ($(this).val().charAt(1) != '.') {
                        this.value = $(this).val().charAt(1);
                    }else{
                        // this.value = $(this).val().charAt(1);
                    }
                }
            }

            if ($(this).val() > 24) {
                this.value = 24;
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
                    "url"    : "<?php echo base_url('superadminfranchise/datamanajemenshift');?>",
                    "data": function(d){
                        var id_stan = $('#select_stan').val();
                        d.id_stan = id_stan;
                    },
                    "dataSrc": function (json) {
                      var return_data = new Array();
                      for(var i=0;i< json.length; i++){
                        return_data.push({
                            // 'id_stan':json[i].id_stan,
                            'nama_shift':json[i].nama_shift,
                            'jam_awal':json[i].jam_awal,
                            'jam_akhir':json[i].jam_akhir,
                            'batas_datang_cepat':json[i].batas_datang_cepat,
                            'batas_telat_lembur':json[i].batas_telat_lembur,
                            'standar_lembur':json[i].standar_lembur,
                          'edit' : '<button onclick="editpenjualan(\''+json[i].id_manajemen_shift+'\',\''+json[i].nama_shift+'\',\''+json[i].jam_awal+'\',\''+json[i].jam_akhir+'\',\''+json[i].batas_datang_cepat+'\',\''+json[i].batas_telat_lembur+'\',\''+json[i].standar_lembur+'\')" class="btn btn-warning" >Edit</button> '
                        });
                      }
                      return return_data;
                    }
                  },
                  columns: [
                    // {'data': 'id_stan'},
                    {'data': 'nama_shift'},
                    {'data': 'jam_awal'},
                    {'data': 'jam_akhir'},
                    {'data': 'batas_datang_cepat'},
                    {'data': 'batas_telat_lembur'},
                    {'data': 'standar_lembur'},
                    {'data': 'edit'}
                  ]
                });

              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                alert(errorThrown);
              }
          }
        );



        function reload_table(){

          tabeldata.ajax.reload();
        }

        function gettanggal() {
            return $("#tanggal_awal").val()
        }

        function adddata(argument) {
          $("#process").show();
            if (argument == 'addcode') {
                $("#process").addClass('teal');
                $("#process").removeClass('red');
                $("#process").removeClass('green');
                $("#process").html('<i class="fa fa-spin fa-refresh"></i> <b>Loading...</b>');
                var id_stan = $("#stan").val();
                var nama_shift = $("#shift").val();
                var jam_awal = $("#jam_awal").val();
                var jam_akhir = $("#jam_akhir").val();
                var batasdatangcepat = $("#batasdatangcepat").val();
                var batastelatlembur = $("#batastelatlembur").val();
                var standarlembur = $("#standarlembur").val();

                if (nama_shift.replace(/\s/g, '').length>0&&jam_awal.replace(/\s/g, '').length>0&&jam_akhir.replace(/\s/g, '').length>0&&batasdatangcepat.replace(/\s/g, '').length>0&&batastelatlembur.replace(/\s/g, '').length>0&&standarlembur.replace(/\s/g, '').length>0) {

                    $.ajax({
                      type:"post",
                      url: "<?php echo base_url('superadminfranchise/adddatashift')?>/",
                      data:{id_stan:id_stan,nama_shift:nama_shift,jam_awal:jam_awal,jam_akhir:jam_akhir,batasdatangcepat:batasdatangcepat,batastelatlembur:batastelatlembur,standarlembur:standarlembur},
                      success:function(response)
                      {
                        if(response == 'Berhasil Ditambahkan'){

                            if($('#shift').has("is-invalid")){
                                $('#shift').removeClass("is-invalid");
                            }

                            if($('#jam_awal').has("is-invalid")){
                              $('#jam_awal').removeClass("is-invalid");
                            }

                            if($('#jam_akhir').has("is-invalid")){
                              $('#jam_akhir').removeClass("is-invalid");
                            }

                            if($('#batasdatangcepat').has("is-invalid")){
                              $('#batasdatangcepat').removeClass("is-invalid");
                            }

                            if($('#batastelatlembur').has("is-invalid")){
                              $('#batastelatlembur').removeClass("is-invalid");
                            }

                            if($('#standarlembur').has("is-invalid")){
                              $('#standarlembur').removeClass("is-invalid");
                            }

                            $("#shift").val('');
                            $("#jam_awal").val('');
                            $("#jam_akhir").val('');
                            $("#batasdatangcepat").val('');
                            $("#batastelatlembur").val('');
                            $("#standarlembur").val('');

                            $('#shift').focus();

                            $("#process").html('<i class="fa fa-check"></i> <b>Sukses Ditambahkan</b>');
                            $("#process").addClass('green');
                            $("#process").removeClass('teal');
                            $("#process").removeClass('red');

                          reload_table();
                        }else{
                    
                          $("#process").html('<i class="fa fa-times"></i> <b>Gagal Ditambahkan. Refresh halaman dan coba lagi</b>');
                          $("#process").addClass('red');
                          $("#process").removeClass('teal');
                          $("#process").removeClass('green');
                        }
                        // alert(response);
                      },
                      error: function (jqXHR, textStatus, errorThrown)
                      {
                        alert(errorThrown);
                        $("#process").html('<i class="fa fa-times"></i> <b>'+errorThrown+'</b>');
                          $("#process").addClass('red');
                          $("#process").removeClass('teal');
                          $("#process").removeClass('green');
                      }
                  });
                }else{
                  $("#process").html('<i class="fa fa-times"></i> <b>Isi Semua Data!</b>');
                  $("#process").addClass('red');
                  $("#process").removeClass('teal');
                  $("#process").removeClass('green');

                  if (nama_shift.replace(/\s/g, '').length<=0) {
                    $('#shift').addClass("is-invalid");
                  }else{
                    if($('#shift').has("is-invalid")){
                      $('#shift').removeClass("is-invalid");
                    }
                  }
                  if (jam_awal.replace(/\s/g, '').length<=0) {
                    $('#jam_awal').addClass("is-invalid");
                  }else{
                    if($('#jam_awal').has("is-invalid")){
                      $('#jam_awal').removeClass("is-invalid");
                    }
                  }
                  if (jam_akhir.replace(/\s/g, '').length<=0) {
                    $('#jam_akhir').addClass("is-invalid");
                  }else{
                    if($('#jam_akhir').has("is-invalid")){
                      $('#jam_akhir').removeClass("is-invalid");
                    }
                  }
                  if (batasdatangcepat.replace(/\s/g, '').length<=0) {
                    $('#batasdatangcepat').addClass("is-invalid");
                  }else{
                    if($('#batasdatangcepat').has("is-invalid")){
                      $('#batasdatangcepat').removeClass("is-invalid");
                    }
                  }
                  if (batastelatlembur.replace(/\s/g, '').length<=0) {
                    $('#batastelatlembur').addClass("is-invalid");
                  }else{
                    if($('#batastelatlembur').has("is-invalid")){
                      $('#batastelatlembur').removeClass("is-invalid");
                    }
                  }
                  if (standarlembur.replace(/\s/g, '').length<=0) {
                    $('#standarlembur').addClass("is-invalid");
                  }else{
                    if($('#standarlembur').has("is-invalid")){
                      $('#standarlembur').removeClass("is-invalid");
                    }
                  }

                  alert("Silahkan periksa kembali inputan anda!");
                }
            }else{
                // #error
            }
        }

        function editpenjualan(id,shift,jam_awal,jam_akhir,batasdatangcepat,batastelatlembur,standarlembur) {
          $('#modal_edit').modal('toggle');
            $('#editshift').val(shift);
            $('#editjam_awal').val(jam_awal);
            $('#editjam_akhir').val(jam_akhir);
            $('#editbatasdatangcepat').val(batasdatangcepat);
            $('#editbatastelatlembur').val(batastelatlembur);
            $('#editstandarlembur').val(standarlembur);
          $('#id_lama').val(id);
        }

        function simpanedit() {
          var nama_shift = $('#editshift').val();
          var jam_awal = $('#editjam_awal').val();
          var jam_akhir = $('#editjam_akhir').val();
          var batasdatangcepat = $('#editbatasdatangcepat').val();
          var batastelatlembur = $('#editbatastelatlembur').val();
          var standarlembur = $('#editstandarlembur').val();
          var id_manajemen_shift = $('#id_lama').val();

          if (nama_shift.replace(/\s/g, '').length>0&&jam_awal.replace(/\s/g, '').length>0&&jam_akhir.replace(/\s/g, '').length>0&&batasdatangcepat.replace(/\s/g, '').length>0&&batastelatlembur.replace(/\s/g, '').length>0&&standarlembur.replace(/\s/g, '').length>0) {
      // &&jumlahpegawai.replace(/\s/g, '').length>0
            $.ajax({
                  type:"post",
                  url: "<?php echo base_url('superadminfranchise/edit_manajemenshift')?>/",
                  data:{ nama_shift:nama_shift,jam_awal:jam_awal,jam_akhir:jam_akhir,batasdatangcepat:batasdatangcepat,batastelatlembur:batastelatlembur,standarlembur:standarlembur,id_manajemen_shift:id_manajemen_shift},
                  success:function(response)
                  {
                    if(response == 'Berhasil Diupdate'){
                      $("#modal_edit").modal('hide');
                      if($('#editshift').has("error")){
                        $('#editshift').removeClass("error");
                      }
                      if($('#editjam_awal').has("error")){
                        $('#editjam_awal').removeClass("error");
                      }
                      if($('#editjam_akhir').has("error")){
                        $('#editjam_akhir').removeClass("error");
                      }
                      if($('#editbatasdatangcepat').has("error")){
                        $('#editbatasdatangcepat').removeClass("error");
                      }

                      if($('#editbatastelatlembur').has("error")){
                        $('#editbatastelatlembur').removeClass("error");
                      }
                      if($('#editstandarlembur').has("error")){
                        $('#editstandarlembur').removeClass("error");
                      }
                      // if($('#editjumlahpgw').has("error")){
                      //   $('#editjumlahpgw').removeClass("error");
                      // }
                      reload_table();
                    }else{
                        alert('error, coba lagi.');
                      // $('#editid').addClass("error");
                    }
                    alert(response);
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                    alert(errorThrown);
                  }
              });
            }else{
              if (nama_shift.replace(/\s/g, '').length<=0) {
                $('#editshift').addClass("error");
              }else{
                if($('#editshift').has("error")){
                  $('#editshift').removeClass("error");
                }
              }
              if (jam_awal.replace(/\s/g, '').length<=0) {
                $('#editjam_awal').addClass("error");
              }else{
                if($('#editjam_awal').has("error")){
                  $('#editjam_awal').removeClass("error");
                }
              }
            
              if (jam_akhir.replace(/\s/g, '').length<=0) {
                $('#editjam_akhir').addClass("error");
              }else{
                if($('#editjam_akhir').has("error")){
                  $('#editjam_akhir').removeClass("error");
                }
              }
              if (batasdatangcepat.replace(/\s/g, '').length<=0) {
                $('#editbatasdatangcepat').addClass("error");
              }else{
                if($('#editbatasdatangcepat').has("error")){
                  $('#editbatasdatangcepat').removeClass("error");
                }
              }
              if (batastelatlembur.replace(/\s/g, '').length<=0) {
                $('#editbatastelatlembur').addClass("error");
              }else{
                if($('#editbatastelatlembur').has("error")){
                  $('#editbatastelatlembur').removeClass("error");
                }
              }
              if (standarlembur.replace(/\s/g, '').length<=0) {
                $('#editstandarlembur').addClass("error");
              }else{
                if($('#editstandarlembur').has("error")){
                  $('#editstandarlembur').removeClass("error");
                }
              }
              alert("Silahkan periksa kembali inputan anda!");
            }

        }
        
    </script>
</body>
</html>
