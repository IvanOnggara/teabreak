        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Laporan Penjualan Stan dari Super Admin</h1>
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
                            <strong class="card-title">Tambah Data Penjualan</strong>
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
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Bulan, Tahun</label>
                                        <input type="text" id="tanggal" placeholder="Masukkan Bulan Tahun" class="form-control">

                                    </div>
                                    
                                    
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Total Penjualan</label>
                                        <input type="text" id="penjualan" placeholder="Masukkan Penjualan" class="form-control numeric">

                                    </div>
                                    
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label"> </label>
                                        <button id="buttontoadd" onclick="adddata('addcode')" class="btn btn-success form-control">Tambah Data</button>

                                    </div>   

                                    
                                    
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-12">
                                <p id="process" class="teal" ><i class="fa fa-spin fa-refresh"></i> <b>Loading...</b></p>
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
                            <strong class="card-title">Data Laporan Penjualan Stan</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- <div class="col-lg-3">
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
                                        <th>Tanggal</th>
                                        <th>Nama Stan</th>
                                        <th>Penjualan</th>
                                        <th>Edit</th>
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

        $('#tanggal').datetimepicker({
            format: 'MM/YYYY',
            useCurrent: false
        });

        $('#tanggal2').datetimepicker({
            format: 'MM/YYYY',
            useCurrent: false
        });

        $("#tanggal2").on("dp.change", function(e) {
            
            reload_table();
        });

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
        $("#process").hide();
        
        var tabeldata;


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
            "url"    : "<?php echo base_url('superadminfranchise/datapenjualanstan');?>",
            "data": function(d){
                var datt = $('#tanggal2').val();
                d.tanggal = datt;
            },
            "dataSrc": function (json) {
              var return_data = new Array();
              for(var i=0;i< json.length; i++){
                var tahun_bulan = json[i].bulan_tahun.split("/");
                tahun_bulan = tahun_bulan[1]+"/"+tahun_bulan[0];
                return_data.push({
                  'bulan_tahun'  : {
                    "display" : json[i].bulan_tahun,
                    "real" : tahun_bulan
                  },

                  'nama_stan'  : json[i].nama_stan,
                  'penjualan' : json[i].penjualan,
                  'edit' : '<button onclick="editpenjualan(\''+json[i].id_penjualan+'\',\''+json[i].penjualan+'\')" class="btn btn-warning" >Edit</button> '
                })
              }
              return return_data;
            }
          },
          columns: [
            {'data': 'bulan_tahun',render: {_: 'display',sort: 'real'}},
            {'data': 'nama_stan'},
            {'data': 'penjualan'},
            {'data': 'edit'}
          ]
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
                $("#stan").html(htmlinsideselect);

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
                var tanggal = $("#tanggal").val();
                var stan = $("#stan").val();
                var penjualan = $("#penjualan").val();

                if (tanggal.replace(/\s/g, '').length>0&&penjualan.replace(/\s/g, '').length>0) {

                    $.ajax({
                      type:"post",
                      url: "<?php echo base_url('superadminfranchise/adddatapenjualanstan')?>/",
                      data:{stan:stan, tanggal:tanggal,penjualan:penjualan},
                      success:function(response)
                      {
                        if(response == 'Berhasil Ditambahkan'){

                          if($('#tanggal').has("error")){
                            $('#tanggal').removeClass("error");
                          }
                          if($('#penjualan').has("error")){
                            $('#penjualan').removeClass("error");
                          }

                            $("#tanggal").val('');
                            $("#penjualan").val('');
                            $('#stan').focus();

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

                  if (tanggal.replace(/\s/g, '').length<=0) {
                    $('#tanggal').addClass("error");
                  }else{
                    if($('#tanggal').has("error")){
                      $('#tanggal').removeClass("error");
                    }
                  }
                  if (penjualan.replace(/\s/g, '').length<=0) {
                    $('#penjualan').addClass("error");
                  }else{
                    if($('#penjualan').has("error")){
                      $('#penjualan').removeClass("error");
                    }
                  }
                  alert("Silahkan periksa kembali inputan anda!");
                }
            }else{
                // #error
            }
        }

        function editpenjualan(id,penjualan) {
          $('#modal_edit').modal('toggle');
          $('#editpen').val(penjualan);
          $('#id_lama').val(id);
        }

        function simpanedit() {
          var penjualanbaru = $('#editpen').val();
          var id_penjualan = $('#id_lama').val();

          if (penjualanbaru == '') {
            if (penjualanbaru == '') {
              $('#editpen').addClass('is-invalid');
            }else{
              $("#editpen").removeClass('is-invalid');
            }

            alert('Periksa Kembali inputan anda');
          }else{
            // console.log(id_pengeluaran);
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('superadminfranchise/edit_penjualan_stan')?>/",
                    data:{ penjualanbaru:penjualanbaru,id_penjualan:id_penjualan},
                    success:function(response)
                    {
                      reload_table();

                      if(response == 'Berhasil Diupdate'){

                        if($('#editpen').has("is-invalid")){
                          $('#editpen').removeClass("is-invalid");
                        }

                        $('#modal_edit').modal('toggle');

                        alert(response);
                      }else{
                        alert('unknown error is happen! try again.');
                      }
                      
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                      alert(errorThrown);
                    }
                }
            );
          }

        }
        
    </script>
</body>
</html>
