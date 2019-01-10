<script type="text/javascript">
	var howmuch = 0;
	var tabeldata;
	var tabeldetail;
	
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
			    "data": function(data) {
				  data.tanggal_awal = $('#tanggal_awal').val();
				  data.tanggal_akhir = $('#tanggal_awal').val();
				  data.id_stan = $('#select_stan').val();
				},
			    "url"    : "<?php echo base_url('superadminfranchise/stokData');?>",
			    "dataSrc": function (json) {
			      var return_data = new Array();
			      var total_harga_akhir = 0;
			      howmuch = json.length;

			      for(var i=0;i< json.length; i++){
			        return_data.push({
			          'tanggal': json[i].tanggal,
			          'id_bahan_jadi'  : json[i].id_bahan_jadi,
			          'nama_bahan_jadi' : json[i].nama_bahan_jadi,
			          'stok_masuk' : json[i].stok_masuk,
			          'stok_keluar' : json[i].stok_keluar,
			          'stok_sisa' : json[i].stok_sisa
			        });
			      }
			      return return_data;
			    }
			  },
            // dom: 'Bfrtlip',
            //     buttons: [
            //         {
            //             extend: 'excelHtml5',
            //             title:function(argument) {
            //                 return 'Data Laporan Sisa Stok ';
            //             } ,
            //             messageTop: function (argument) {
            //                 return 'Stan : '+$("#select_stan option:selected").text()+', Tanggal : '+$("#tanggal_awal").val();
            //             },
            //             customize: function ( xlsx ){
            //                 var sheet = xlsx.xl.worksheets['sheet1.xml'];

            //                 // jQuery selector to add a border
            //                 $('row c[r*="3"]', sheet).attr( 's', '27' );

            //                 for (var i = 0; i < howmuch; i++) {
            //                   var row = i + 4;
            //                   $('row c[r*="'+row+'"]', sheet).attr( 's', '25' );
            //                 }

            //             },
            //             text: '<i class="fa fa-download"></i> Download Excel',
            //             className: 'btn btn-success',
            //             init: function(api, node, config) {
            //                $(node).removeClass('dt-button');
            //                $(node).removeClass('buttons-excel');
            //                $(node).removeClass('buttons-html5');
            //             },
            //             filename: function (argument) {
            //                   // var standdd = $("#select_stan option:selected").text();
            //                   // var tgl = $("#tanggal_awal").val();

            //                   return 'Laporan Sisa Stok '+$("#select_stan option:selected").text()+', Tanggal : '+$("#tanggal_awal").val();
            //             } ,

            //             exportOptions: {
            //               columns:[0,1,2,3,4,5]
            //             }
            //         }
            //     ],
            //     "lengthChange": true,
				  columns: [
				    {'data': 'tanggal'},
				    {'data': 'id_bahan_jadi'},
				    {'data': 'nama_bahan_jadi'},
				    {'data': 'stok_masuk'},
				    {'data': 'stok_keluar'},
				    {'data': 'stok_sisa'}
				  ],
	    	});
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert(errorThrown);
          }
      }
    );

    function refreshTable() {
    	reload_table();
    }

    function reload_table(){
	  tabeldata.ajax.reload();
	}

</script>