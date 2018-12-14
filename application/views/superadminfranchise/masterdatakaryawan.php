        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Master Data Karyawan</h1>
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
                            <strong class="card-title">Data Karyawan</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Tempat Kerja</label>
                                        <select name="select" id="select_stan" class="form-control" onchange="reload_table()">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                                <table id="mytable" class="table table-striped table-bordered" style="width: 100%" width="100%">
                                    <thead class="">
                                      <tr>
                                        <th width="20%">ID Karyawan</th>
                                        <th width="40%">Nama</th>
                                        <th width="30%">Gaji Tetap</th>
                                        <th width="10%">Edit</th>
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
                  <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="editid" class=" form-control-label">Nama</label>
                            <input type="text" id="editnama" placeholder="Masukkan Nama Baru" class="form-control">
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editid" class=" form-control-label">Gaji Tetap</label>
                            <input type="hidden" name="id_lama" id="id_lama">
                            <input type="text" id="editgaji" placeholder="Masukkan Gaji Tetap Baru" class="form-control numeric">
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

        $('#tanggal_awal').val(tanggal+"/"+bulan+"/"+tahun);

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
            htmlinsideselect = htmlinsideselect + '<option value="warehouse">WareHouse</option>';
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
                    "data": function(data) {
                      data.id_stan = $('#select_stan').val();
                    },
                    "url"    : "<?php echo base_url('superadminfranchise/datapegawai');?>",
                    "dataSrc": function (json) {
                      var return_data = new Array();
                      var total_harga_akhir = 0;
                      for(var i=0;i< json.length; i++){
                        return_data.push({
                          'pin': json[i].pin,
                          'nama'  : json[i].nama,
                          'gaji_tetap' : json[i].gaji_tetap,
                          'edit' : '<button onclick="editpegawai(\''+json[i].pin+'\',\''+json[i].gaji_tetap+'\')" class="btn btn-warning" >Edit</button> '
                        });
                      }
                      return return_data;
                    }
                  },
                    "lengthChange": true,
                      columns: [
                        {'data': 'pin'},
                        {'data': 'nama'},
                        {'data': 'gaji_tetap'},
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

        function editpegawai(pin,gaji) {
          $('#modal_edit').modal('toggle');
          $('#editgaji').val(gaji);
          // $('#editnama').val(nama);
          $('#id_lama').val(pin);
        }

        function simpanedit() {
          var gajibaru = $('#editgaji').val();
          var pin = $('#id_lama').val();
          var stan = $("#select_stan").val();

          if (gajibaru == '') {
            if (gajibaru == '') {
              $('#editgaji').addClass('is-invalid');
            }else{
              $("#editgaji").removeClass('is-invalid');
            }

            alert('Periksa Kembali inputan anda');
          }else{
            // console.log(id_pengeluaran);
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('superadminfranchise/edit_pegawai')?>/",
                    data:{ gajibaru:gajibaru,pin:pin,stan:stan},
                    success:function(response)
                    {
                      reload_table();

                      if(response == 'Berhasil Diupdate'){

                        if($('#editgaji').has("is-invalid")){
                          $('#editgaji').removeClass("is-invalid");
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
