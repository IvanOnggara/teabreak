<script type="text/javascript">
  var tabeldata ;

  function edit_stan(id){
    $.ajax({
          type:"post",
          url: "<?php echo base_url('superadminfranchise/select_edit_stan')?>/",
          data:{ id:id},
          dataType:"json",
          success:function(response)
          {
            $("#editid").val(response[0].id_stan);
            $("#editidlama").val(response[0].id_stan);
            $("#editalamat").val(response[0].alamat);
            $("#editnama").val(response[0].nama_stan);
            $("#editpinalti_terlambat").val(response[0].pinalti_terlambat);
            $("#editpinalti_bolos").val(response[0].pinalti_bolos);
            $("#edituang_makan").val(response[0].uang_makan);
            $("#edituang_lembur").val(response[0].uang_lembur);
            // $("#editjumlahpgw").val(response[0].jumlah_pegawai)
            $("#editpassword").val(response[0].password);
            $("#modal_edit").modal('show');
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert(errorThrown);
          }
      }
    );
  }

  function simpanedit(){
    var id = $("#editid").val();
    var alamat = $("#editalamat").val();
    var nama =  $("#editnama").val();
    var id_lama = $("#editidlama").val();
    var password = $("#editpassword").val();
    var pinalti_terlambat = $("#editpinalti_terlambat").val();
    var pinalti_bolos = $("#editpinalti_bolos").val();
    var uang_makan = $("#edituang_makan").val();
    var uang_lembur = $("#edituang_lembur").val();
    // var jumlahpegawai = $("#editjumlahpgw").val();
    if (id.replace(/\s/g, '').length>0&&nama.replace(/\s/g, '').length>0&&alamat.replace(/\s/g, '').length>0&&password.replace(/\s/g, '').length>0&&pinalti_terlambat.replace(/\s/g, '').length>0&&pinalti_bolos.replace(/\s/g, '').length>0&&uang_makan.replace(/\s/g, '').length>0&&uang_lembur.replace(/\s/g, '').length>0) {
      // &&jumlahpegawai.replace(/\s/g, '').length>0
    $.ajax({
          type:"post",
          url: "<?php echo base_url('superadminfranchise/edit_stan')?>/",
          data:{ id_lama:id_lama,id:id,alamat:alamat,nama:nama,password:password,pinalti_terlambat:pinalti_terlambat,pinalti_bolos:pinalti_bolos,uang_makan:uang_makan,uang_lembur:uang_lembur},
          success:function(response)
          {
            if(response == 'Berhasil Diupdate'){
              $("#modal_edit").modal('hide');
              if($('#editid').has("error")){
                $('#editid').removeClass("error");
              }
              if($('#editnama').has("error")){
                $('#editnama').removeClass("error");
              }
              if($('#editalamat').has("error")){
                $('#editalamat').removeClass("error");
              }
              if($('#editpassword').has("error")){
                $('#editpassword').removeClass("error");
              }

              if($('#editpinalti_terlambat').has("error")){
                $('#editpinalti_terlambat').removeClass("error");
              }
              if($('#editpinalti_bolos').has("error")){
                $('#editpinalti_bolos').removeClass("error");
              }
              if($('#edituang_makan').has("error")){
                $('#edituang_makan').removeClass("error");
              }
              if($('#edituang_lembur').has("error")){
                $('#edituang_lembur').removeClass("error");
              }
              // if($('#editjumlahpgw').has("error")){
              //   $('#editjumlahpgw').removeClass("error");
              // }
              reload_table();
            }else{
              $('#editid').addClass("error");
            }
            alert(response);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert(errorThrown);
          }
      });
    }else{
      if (id.replace(/\s/g, '').length<=0) {
        $('#editid').addClass("error");
      }else{
        if($('#editid').has("error")){
          $('#editid').removeClass("error");
        }
      }
      if (nama.replace(/\s/g, '').length<=0) {
        $('#editnama').addClass("error");
      }else{
        if($('#editnama').has("error")){
          $('#editnama').removeClass("error");
        }
      }
    
      if (pinalti_terlambat.replace(/\s/g, '').length<=0) {
        $('#editpinalti_terlambat').addClass("error");
      }else{
        if($('#editpinalti_terlambat').has("error")){
          $('#editpinalti_terlambat').removeClass("error");
        }
      }
      if (pinalti_bolos.replace(/\s/g, '').length<=0) {
        $('#editpinalti_bolos').addClass("error");
      }else{
        if($('#editpinalti_bolos').has("error")){
          $('#editpinalti_bolos').removeClass("error");
        }
      }
      if (uang_makan.replace(/\s/g, '').length<=0) {
        $('#edituang_makan').addClass("error");
      }else{
        if($('#edituang_makan').has("error")){
          $('#edituang_makan').removeClass("error");
        }
      }
      if (uang_lembur.replace(/\s/g, '').length<=0) {
        $('#edituang_lembur').addClass("error");
      }else{
        if($('#edituang_lembur').has("error")){
          $('#edituang_lembur').removeClass("error");
        }
      }
      // if (jumlahpegawai.replace(/\s/g, '').length<=0) {
      //   $('#editjumlahpgw').addClass("error");
      // }else{
      //   if($('#editjumlahpgw').has("error")){
      //     $('#editjumlahpgw').removeClass("error");
      //   }
      // }
      if (alamat.replace(/\s/g, '').length<=0) {
        $('#editalamat').addClass("error");
      }else{
        if($('#editalamat').has("error")){
          $('#editalamat').removeClass("error");
        }
      }
      if (password.replace(/\s/g, '').length<=0) {
        $('#editpassword').addClass("error");
      }else{
        if($('#editpassword').has("error")){
          $('#editpassword').removeClass("error");
        }
      }
      alert("Silahkan periksa kembali inputan anda!");
    }
  }

function delete_stan(id){
     if(confirm('Apakah anda yakin ingin menghapus data ini??')){
      $.ajax({
              type:"post",
              url: "<?php echo base_url('superadminfranchise/delete_stan')?>/",
              data:{ id:id},
              success:function(response)
              {
                   reload_table();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                alert(errorThrown);
              }
          }
      );
    }
  }

function showpwd(id,idicon){
    var pwd = document.getElementById(id);

    if (pwd.type === "password") {
        pwd.type = "text";
        $("#"+idicon).addClass('fa-eye-slash');
        $("#"+idicon).removeClass('fa-eye');
    } else {
        pwd.type = "password";
        $("#"+idicon).addClass('fa-eye');
        $("#"+idicon).removeClass('fa-eye-slash');
    }
}

function tambahstan(){
    var id = $("#id").val();
    var nama = $("#nama").val();
    var alamat = $("#alamat").val();
    var password = $("#password").val();
    var pinalti_terlambat = $("#pinalti_terlambat").val();
    var pinalti_bolos = $("#pinalti_bolos").val();
    var uang_makan = $("#uang_makan").val();
    var uang_lembur = $("#uang_lembur").val();
    // var jumlahpegawai = $("#jumlahpgw").val();
    if (id.replace(/\s/g, '').length>0&&nama.replace(/\s/g, '').length>0&&alamat.replace(/\s/g, '').length>0&&password.replace(/\s/g, '').length>0&&pinalti_terlambat.replace(/\s/g, '').length>0&&pinalti_bolos.replace(/\s/g, '').length>0&&uang_makan.replace(/\s/g, '').length>0&&uang_lembur.replace(/\s/g, '').length>0) {
        $.ajax(
            {
                type:"post",
                url: "<?php echo base_url('superadminfranchise/tambah_stan')?>/",
                data:{ id:id,nama:nama,alamat:alamat,password:password,pinalti_terlambat:pinalti_terlambat,pinalti_bolos:pinalti_bolos,uang_makan:uang_makan,uang_lembur:uang_lembur},
                success:function(response)
                {

                  if(response == 'Berhasil Ditambahkan'){
                    reload_table();
                    if($('#id').has("error")){
                      $('#id').removeClass("error");
                    }
                    if($('#nama').has("error")){
                      $('#nama').removeClass("error");
                    }
                    if($('#alamat').has("error")){
                      $('#alamat').removeClass("error");
                    }
                    if($('#password').has("error")){
                      $('#password').removeClass("error");
                    }
                    // if($('#jumlahpgw').has("error")){
                    //   $('#jumlahpgw').removeClass("error");
                    // }
                    if($('#pinalti_terlambat').has("error")){
                      $('#pinalti_terlambat').removeClass("error");
                    }
                    if($('#pinalti_bolos').has("error")){
                      $('#pinalti_bolos').removeClass("error");
                    }
                    if($('#uang_makan').has("error")){
                      $('#uang_makan').removeClass("error");
                    }
                    if($('#uang_lembur').has("error")){
                      $('#uang_lembur').removeClass("error");
                    }

                    $("#id").val('');
                    $("#nama").val('');
                    $("#alamat").val('');
                    $("#password").val('');
                    // $("#jumlahpgw").val('');
                    $("#id").focus();
                    alert(response);
                  }else if(response == 'ID Data Sudah ada di dalam database'){
                    $('#id').addClass("error");
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
    }else{
        if (id.replace(/\s/g, '').length<=0) {
            $('#id').addClass("error");
        }else{
            if($('#id').has("error")){
                $('#id').removeClass("error");
            }
        }

        if (nama.replace(/\s/g, '').length<=0) {
            $('#nama').addClass("error");
        }else{
            if($('#nama').has("error")){
                $('#nama').removeClass("error");
            }
        }

        if (password.replace(/\s/g, '').length<=0) {
            $('#password').addClass("error");
        }else{
            if($('#password').has("error")){
                $('#password').removeClass("error");
            }
        }

        if (alamat.replace(/\s/g, '').length<=0) {
            $('#alamat').addClass("error");
        }else{
            if($('#alamat').has("error")){
                $('#alamat').removeClass("error");
            }
        }

        if (pinalti_terlambat.replace(/\s/g, '').length<=0) {
          $('#pinalti_terlambat').addClass("error");
        }else{
          if($('#pinalti_terlambat').has("error")){
            $('#pinalti_terlambat').removeClass("error");
          }
        }
        if (pinalti_bolos.replace(/\s/g, '').length<=0) {
          $('#pinalti_bolos').addClass("error");
        }else{
          if($('#pinalti_bolos').has("error")){
            $('#pinalti_bolos').removeClass("error");
          }
        }
        if (uang_makan.replace(/\s/g, '').length<=0) {
          $('#uang_makan').addClass("error");
        }else{
          if($('#uang_makan').has("error")){
            $('#uang_makan').removeClass("error");
          }
        }
        if (uang_lembur.replace(/\s/g, '').length<=0) {
          $('#uang_lembur').addClass("error");
        }else{
          if($('#uang_lembur').has("error")){
            $('#uang_lembur').removeClass("error");
          }
        }

        // if (jumlahpegawai.replace(/\s/g, '').length<=0) {
        //     $('#jumlahpgw').addClass("error");
        // }else{
        //     if($('#jumlahpgw').has("error")){
        //         $('#jumlahpgw').removeClass("error");
        //     }
        // }

        alert("Silahkan periksa kembali inputan anda!");
    }
  }

  jQuery( document ).ready(function( $ ) {
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };

    tabeldata = $("#mytable").dataTable({

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
      serverSide: true,
      ajax: {"url": "<?php echo base_url('superadminfranchise/datastan');?>", "type": "POST",
    "dataSrc": function (json) {
      var return_data = new Array();
      for(var i=0;i< json.data.length; i++){
        return_data.push({
          'id_stan': json.data[i].id_stan,
          'nama_stan' : json.data[i].nama_stan,
          'alamat' : json.data[i].alamat,
          'password' : json.data[i].password,
          'pinalti_terlambat' : json.data[i].pinalti_terlambat,
          'pinalti_bolos' : json.data[i].pinalti_bolos,
          'uang_makan' : json.data[i].uang_makan,
          'uang_lembur' : json.data[i].uang_lembur,
          // 'jumlah_pegawai' : json.data[i].jumlah_pegawai,
          'edit' : '<button onclick=edit_stan("'+json.data[i].id_stan+'") class="btn btn-warning" style="color:white;">Edit</button> ',
          'delete' : '<button onclick=delete_stan("'+json.data[i].id_stan+'") class="btn btn-info" style="color:white;">Delete</button>'
        })
      }
      return return_data;
    }},
    dom: 'Bfrtlip',
        buttons: [
            {
                extend: 'copyHtml5',
                text: 'Copy',
                filename: 'Data Stan',
                exportOptions: {
                  columns:[0,1,2,3,4,5,6,7]
                }
            },{
                extend: 'excelHtml5',
                text: 'Excel',
                className: 'exportExcel',
                filename: 'Data Stan',
                exportOptions: {
                  columns:[0,1,2,3,4,5,6,7]
                }
            },{
                extend: 'csvHtml5',
                filename: 'Data Stan',
                exportOptions: {
                  columns:[0,1,2,3,4,5,6,7]
                }
            },{
                extend: 'pdfHtml5',
                filename: 'Data Stan',
                exportOptions: {
                  columns:[0,1,2,3,4,5,6,7]
                }
            },{
                extend: 'print',
                filename: 'Data Stan',
                exportOptions: {
                  columns:[0,1,2,3,4,5,6,7]
                }
            }
        ],
        "lengthChange": true,
      columns: 
      [
        {"data": "id_stan"},
        {"data": "nama_stan"},
        {"data": "alamat"},
        {"data": "password"},
        {"data": "uang_makan"},
        {"data": "uang_lembur"},
        {"data": "pinalti_terlambat"},
        {"data": "pinalti_bolos"},
        // {"data": "jumlah_pegawai"},
        {"data": "edit","orderable": false,"searchable": false},
        {"data": "delete","orderable": false,"searchable": false},
      ],

      rowCallback: function(row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        var index = page * length + (iDisplayIndex + 1);
        // $('td:eq(0)', row).html(index);
      }
    });


});

function reload_table(){
  tabeldata.api().ajax.reload(null,false);
}


</script>