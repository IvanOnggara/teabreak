        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Master Data Stan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Semua Data Stan</li>
                        </ol>
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
                            <strong class="card-title">Tambah Stan Baru</strong>
                        </div>
                        <div class="card-body">
                          <!-- Credit Card -->
                          <div id="pay-invoice">
                            <div class="card-body card-block">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="id" class=" form-control-label">ID Stan</label>
                                            <input type="text" name="fake" style="display: none">
                                            <input type="text" id="id" placeholder="Masukkan ID Stan" class="form-control" autocomplete="none">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama" class=" form-control-label">Nama Stan</label>
                                            
                                            <input type="text" id="nama" placeholder="Masukkan Nama Stan" class="form-control" value="" autocomplete="none">
                                            <input type="text" style="display: none">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="password" class=" form-control-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" style="display: none">
                                                <input type="password" id="password" name="password" placeholder="Masukkan Password Stan" class="form-control" value="" autocomplete="new-password">

                                                <div class="input-group-btn">
                                                    <button onclick="showpwd('password','eye')" class="btn btn-primary">
                                                        <i id="eye" class="fa fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nama" class=" form-control-label">Jumlah Pegawai</label>
                                            
                                            <input type="text" id="jumlahpgw" placeholder="Masukkan Jumlah Pegawai" class="form-control numeric" value="" autocomplete="none">
                                            <input type="text" style="display: none">
                                        </div>
                                        
                                    </div> -->
                                    
                                </div>
                                <div class="row">
                                <!-- <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Pinalti Terlambat</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp. </div>
                                            <input type="text" id="pinalti_terlambat" placeholder="ex: 25000" class="form-control numeric">
                                        </div>
                                        
                                    </div>
                                    
                                </div> -->
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
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Uang Lembur</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp. </div>
                                            <input type="text" id="uang_lembur" placeholder="ex: 25000" class="form-control numeric">
                                        </div>

                                    </div>
                                    
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Batas Telat Lembur</label>
                                        <div class="input-group">
                                            
                                            <input type="text" id="batastelatlembur" placeholder="ex: 12" class="form-control numerichour">
                                            <div class="input-group-addon"> Jam</div>
                                        </div>

                                    </div>
                                    
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Standard Lembur</label>
                                        <div class="input-group">
                                            
                                            <input type="text" id="standarlembur" placeholder="ex: 12" class="form-control numerichour">
                                            <div class="input-group-addon"> Jam</div>
                                        </div>

                                    </div>
                                    
                                </div>
                            </div>


                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="alamat" class=" form-control-label">Alamat</label>
                                            <input type="text" id="alamat" placeholder="Masukkan Alamat Stan" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="company" class=" form-control-label">Action</label>
                                            <button type="submit" onclick="tambahstan()" class="btn btn-success btn-md form-control">
                                              <i class="fa fa-floppy-o"></i> TAMBAH
                                            </button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>    
                          </div>

                        </div>
                    </div> <!-- .card -->

                  </div><!--/.col-->

                  <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Stan</strong>
                        </div>
                        <div class="card-body">
                          <table id="mytable" class="table table-striped table-bordered" style="width: 100%" width="100%">
                            <thead>
                              <tr>
                                <th>ID Stan</th>
                                <th>Nama Stan</th>
                                <th>Alamat</th>
                                <th>Password</th>
                                <th>Uang Makan</th>
                                <th>Uang Lembur</th>
                                <!-- <th>Denda Terlambat</th> -->
                                <th>Denda Bolos</th>
                                <th>Batas Lembur</th>
                                <th>Standar Lembur</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                    </div> <!-- .card -->

                  </div><!--/.col-->
                </div>
            </div>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->
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
                                    <label for="id" class=" form-control-label">ID Stan</label>
                                    <input type="text" id="editid" placeholder="Masukkan ID Stan" class="form-control">
                                    <input type="hidden" id="editidlama">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama" class=" form-control-label">Nama Stan</label>
                                    <input type="text" id="editnama" placeholder="Masukkan Nama Stan" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class=" form-control-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" id="editpassword" name="editpassword" placeholder="Masukkan Password" class="form-control">
                                        <div class="input-group-btn">
                                            <button onclick="showpwd('editpassword')" class="btn btn-primary">
                                                <i class="fa fa-eye"></i></button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama" class=" form-control-label">Jumlah Pegawai</label>
                                    <input type="text" id="editjumlahpgw" placeholder="Masukkan Jumlah Pegawai" class="form-control numeric">
                                </div>
                            </div> -->
                        </div>
                        <div class="row">
                                <!-- <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Pinalti Terlambat</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp. </div>
                                            <input type="text" id="editpinalti_terlambat" placeholder="ex: 25000" class="form-control numeric">
                                        </div>
                                        
                                    </div>
                                    
                                </div> -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Pinalti Bolos</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp. </div>
                                            <input type="text" id="editpinalti_bolos" placeholder="ex: 25000" class="form-control numeric">
                                        </div>

                                    </div>
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Uang Makan</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp. </div>
                                            <input type="text" id="edituang_makan" placeholder="ex: 25000" class="form-control numeric">
                                        </div>

                                    </div>
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Uang Lembur</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">Rp. </div>
                                            <input type="text" id="edituang_lembur" placeholder="ex: 25000" class="form-control numeric">
                                        </div>

                                    </div>
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Batas Telat Lembur</label>
                                        <div class="input-group">
                                            
                                            <input type="text" id="editbatastelatlembur" placeholder="ex: 12" class="form-control numerichour">
                                            <div class="input-group-addon"> Jam</div>
                                        </div>

                                    </div>
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id" class=" form-control-label">Standard Lembur</label>
                                        <div class="input-group">
                                            
                                            <input type="text" id="editstandarlembur" placeholder="ex: 12" class="form-control numerichour">
                                            <div class="input-group-addon"> Jam</div>
                                        </div>

                                    </div>
                                    
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="alamat" class=" form-control-label">Alamat</label>
                                    <input type="text" id="editalamat" placeholder="Masukkan Alamat Stan" class="form-control">
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
    <script type="text/javascript">
        $('.numeric').on('input', function (event) { 
                this.value = this.value.replace(/[^0-9]/g, '');
                if ($(this).val().length > 1) {
                    if ($(this).val().charAt(0) == '0') {
                        if ($(this).val().charAt(1) == '0') {
                            $(this).val(0);
                        }else{
                            $(this).val($(this).val().substring(1));
                        }
                    }
                }
            });

        $('.numerichour').on('input', function (event) { 
                this.value = this.value.replace(/[^0-9]/g, '');
                if ($(this).val().length > 1) {
                    if ($(this).val().charAt(0) == '0') {
                        if ($(this).val().charAt(1) == '0') {
                            $(this).val(0);
                        }else{
                            $(this).val($(this).val().substring(1));
                        }
                    }

                    if ($(this).val()>24) {
                        this.value = 24;
                    }
                }
            });
    </script>
</body>
</html>
