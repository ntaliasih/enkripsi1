<?php
    $this->load->view('template/head');
?>

<body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
        <?php
            $this->load->view('template/topnav');
            $this->load->view('template/sidenav');
        ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Upload
                    <small>Menu</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Upload</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Upload</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <div class="x_content">
                            <form class="form-horizontal form-label-left" id="formUpload">
                                <section class="content col-lg-12 connectedSortable">
                                    <div id="alert_hapus"></div>
                                    
                                    <table id="list_upload_kosong" class="table table-bordered table-striped">
                                        <thead>
                                            <tr></tr>
                                        </thead>
                                    </table>
                                    
                                    <div class="table-responsive">
                                        <table id="list_upload" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>No. Permintaan</th>
                                                    <th>Tanggal Permintaan</th>
                                                    <th>Username</th>
                                                    <th>Layanan</th>
                                                    <th>Kab/Kota</th>
                                                    <th>Kantor Wilayah</th>
                                                   
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($upload as $b) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $b['request_id']; ?></td>
                                                        <td><?php echo $b['no_permintaan']; ?></td>
                                                        <td><?php echo $b['tgl_permintaan']; ?></td>
                                                        <td><?php echo $b['username']; ?></td>
                                                        <td><?php echo $b['layanan']; ?></td>
                                                        <td><?php echo $b['kab_kota']; ?></td>
                                                        <td><?php echo $b['kantor_wilayah']; ?></td>
                                                        
                                                        <td align="center">
                                                            <button type="button" class="btn btn-primary btn-xs" title="Upload" onclick="upload_database(<?php echo $b['request_id']; ?>)"><i class="glyphicon glyphicon-cloud-upload"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </form>
                        </div>
                    </div>
                
                    <div class="box-footer">Infokes - All Rights Reserved</div>
                </div>
            </section>
        </div>
    </div>

    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload()"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Tambah Upload</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-body">
                            <div id="alert_message"></div>
                            <input name="kdUpload" class="form-control" type="hidden" required="required">
                            <input name="secretkey" class="form-control" type="hidden" required="required">
                            <br>
                            <div class="form-group">
                                <label class="control-label col-md-3">Database</label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control-file" id="database" name="database" aria-describedby="fileHelp">
                                    <small id="fileHelp" class="form-text text-muted">Pilih database yang akan diunggah.</small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <img id="loadergif" src="<?php echo base_url('assets/img/loader.gif'); ?>" style="display: none;">
                    <button type="button" id="btnSimpan" onclick="save()" class="btn btn-success mr-auto">Proses</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.reload()">Batal</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    <!-- jQuery 3 -->
    <script src="<?php echo base_url('vendors/jquery/dist/jquery.min.js'); ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url('vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('vendors/fastclick/lib/fastclick.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/js/adminlte.min.js'); ?>"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url('vendors/datatables/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('vendors/datatables/js/dataTables.bootstrap.min.js') ?>"></script>
    <!-- Related js for this page -->
    <?php if ($js_to_load != '') { ?>
        <script type="text/javascript" src="<?php echo base_url('assets/js/pages/') . $js_to_load; ?>"></script>
	<?php } ?>

</body>

<?php
    $this->load->view('template/foot');
?>