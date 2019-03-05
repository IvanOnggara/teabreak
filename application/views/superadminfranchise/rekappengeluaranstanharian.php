        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Rekap Pengeluaran Harian Stan (Kasir)</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <!-- <li class="active">Semua Data Stan</li> -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <b><label class=" form-control-label">Stan</label></b>
                            <select name="selectstan" id="stan" class="form-control" tabindex="1" onchange="refreshrekap()">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <b><label class=" form-control-label">Tanggal</label></b>
                            <input type="text" name="tanggal" id="tanggalrekap" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <b><label class=" form-control-label">Shift</label></b>
                            <select name="select" id="shift" class="form-control" onchange="refreshrekap()">
                                <option value="pagi">Pagi</option>
                                <option value="malam">Malam</option>
                                <option value="all">Semua Shift</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <table id="mytable" class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                  <tr>
                                    <th style="width: 70%;">Keterangan</th>
                                    <th style="width: 20%;">Pengeluaran</th>
                                    <th style="width: 10%;">Shift</th>
                                    <!-- <th style="width: 12.5%;">Edit</th> -->
                                  </tr>
                                </thead>
                                <tbody id="detailpengeluaran">
                                    
                                </tbody>
                            </table>
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
    <script src=<?php echo base_url("assets/js/lib/chosen/chosen.jquery.min.js"); ?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/dataTables.buttons.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/buttons.print.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/buttons.html5.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/Buttons-1.5.2/js/buttons.flash.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/JSZip-2.5.0/jszip.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/pdfmake-0.1.36/pdfmake.js")?>></script>
    <script src=<?php echo base_url("assets/datatable/pdfmake-0.1.36/vfs_fonts.js")?>></script>
    <script src=<?php echo base_url("assets/js/lib/chosen/chosen.jquery.min.js")?>></script>
    <!-- bootstrap-daterangepicker -->
    <script src=<?php echo base_url("assets/vendors/moment/min/moment.min.js")?>></script>
    <script src=<?php echo base_url("assets/vendors/bootstrap-daterangepicker/daterangepicker.js")?>></script>
    <!-- bootstrap-datetimepicker -->    
    <script src=<?php echo base_url("assets/vendors/Date-Time-Picker-Bootstrap-4/build/js/bootstrap-datetimepicker.min.js")?>></script>
    <script type="text/javascript">

        $(document).ready(function() {
            jQuery(document).ready(function() {
                jQuery("#stan").chosen({
                    disable_search_threshold: 10,
                    no_results_text: "Oops, nothing found!",
                    width: "100%"
                });
            });
        });

        $('#tanggalrekap').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false
        });



        $("#tanggalrekap").on("dp.change", function(e) {
            refreshrekap();
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

          $('#tanggal').text("Tanggal : "+tanggal+"/"+bulan+"/"+tahun);
          $('#waktu').text("Waktu : "+jam+":"+menit);
          $('#tanggalrekap').val(tanggal+"/"+bulan+"/"+tahun);


        $.ajax({
              type:"post",
              url: "<?php echo base_url('superadminfranchise/get_list_stan')?>/",
              data:{},
              dataType:"json",
              success:function(response)
              {
                var htmlinsideselect = '';
                $.each(response, function (i, item) {
                    if (i == 0) {
                        // $('#stan').append($('<option>', {
                        //     value: item.id_stan,
                        //     text: item.nama_stan+' ( '+item.alamat+' )',
                        //     selected: true
                        // }));
                        htmlinsideselect = htmlinsideselect + '<option selected="selected" value="'+item.id_stan+'">'+item.nama_stan +' ( '+item.alamat+' )' +'</option>';
                    }else{
                        htmlinsideselect = htmlinsideselect + '<option value="'+item.id_stan+'">'+item.nama_stan +' ( '+item.alamat+' )' +'</option>';
                    }
                    
                });
                $("#stan").html(htmlinsideselect);
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                alert(errorThrown);
              },
              complete: function (argument) {
                  $('#stan').trigger("chosen:updated");
                  var id_stan = $('#stan').val();
                  var tanggal_rekap = $('#tanggalrekap').val();
                  var shift = $('#shift').val();
                    // alert(id_stan);
                    ajaxSetData(id_stan,tanggal_rekap,shift);
              }
          }
        );

        

        function ajaxSetData(id_stan,tanggal_rekap,shift) {
            // $.ajax({
            //   type:"post",
            //   url: "<?php echo base_url('superadminfranchise/getrekapdata')?>/",
            //   data:{id_stan:id_stan,tanggal_rekap:tanggal_rekap,shift:shift},
            //   success:function(response)
            //   {
            //     response = jQuery.parseJSON(response);
            //     var kasawal = response.kasawal;
            //     var hasilpenjualan = response.hasilpenjualan;
            //     var pengeluaran = response.pengeluaran;
            //     var cashdetail = response.cashdetail;
            //     var ovodetail = response.ovodetail;
            //     var debitdetail = response.debitdetail;
            //     // var totalkasir = response.totalkasir;
            //     var totalpemasukan = response.totalpemasukan;
            //     var kaspagi = response.kaspagi;
            //     var kasmalam = response.kasmalam;

            //     kasawal = "Rp. "+currency(kasawal)+",-";
            //     hasilpenjualan = "Rp. "+currency(hasilpenjualan)+",-";
            //     pengeluaran = "Rp. "+currency(pengeluaran)+",-";
            //     cashdetail = "Rp. "+currency(cashdetail)+",-";
            //     ovodetail = "Rp. "+currency(ovodetail)+",-";
            //     debitdetail = "Rp. "+currency(debitdetail)+",-";
            //     // totalkasir = "Rp. "+currency(totalkasir)+",-";
            //     totalpemasukan = "Rp. "+currency(totalpemasukan)+",-";
            //     kaspagi = "Rp. "+currency(kaspagi)+",-";
            //     kasmalam = "Rp. "+currency(kasmalam)+",-";

            //     $('#kasawal').html(kasawal);
            //     $('#hasilpenjualan').html(hasilpenjualan);
            //     $('#pengeluaran').html(pengeluaran);
            //     $('#cashdetail').html(cashdetail);
            //     $('#ovodetail').html(ovodetail);
            //     $('#debitdetail').html(debitdetail);
            //     // $('#totalkasir').html(totalkasir);
            //     $('#totalpemasukan').html(totalpemasukan);
            //     $('#kaspagidetail').html(kaspagi);
            //     $('#kasmalamdetail').html(kasmalam);
            //   },
            //   error: function (jqXHR, textStatus, errorThrown)
            //   {
            //     alert(errorThrown);
            //   }
            // });


            $.ajax({
              type:"post",
              url: "<?php echo base_url('superadminfranchise/getdetailpengeluaranrekap')?>/",
              data:{id_stan:id_stan,tanggal_rekap:tanggal_rekap},
              success:function(response)
              {
                $('#detailpengeluaran').html('');
                // console.log(response);
                response = jQuery.parseJSON(response);
                $.each(response, function (i,item) {
                    $('#detailpengeluaran').append(
                        '<tr><td>'+item.keterangan+'</td><td>'+item.pengeluaran+'</td><td>'+item.shift+'</td></tr>'
                    );
                });
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                alert(errorThrown);
              }
            });


        }

      function currency(number1) {
        var retVal=number1.toString().replace(/[^\d]/g,'');
        while(/(\d+)(\d{3})/.test(retVal)) {
          retVal=retVal.replace(/(\d+)(\d{3})/,'$1'+'.'+'$2');
        }
        return retVal;
      }


      function refreshrekap() {
        var id_stan = $('#stan').val();
        var tanggal_rekap = $('#tanggalrekap').val();
        var shift = $('#shift').val();
        // alert(id_stan);
          ajaxSetData(id_stan,tanggal_rekap,shift);
      }
    </script>
</body>
</html>


