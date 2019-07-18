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
                    Download
                    <small>Menu</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Download</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Download</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <div class="x_content">
                            <form class="form-horizontal form-label-left" id="formDownload">
                                <section class="content col-lg-12 connectedSortable">
                                    <iframe id="my_iframe" style="display:none;"></iframe>
                                    <table id="list_download_kosong" class="table table-bordered table-striped">
                                        <thead>
                                            <tr></tr>
                                        </thead>
                                    </table>
                                    
                                    <div class="table-responsive">
                                        <table id="list_download" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>No. Permintaan</th>
                                                    <th>Tanggal Permintaan</th>
                                                    <th>Username</th>
                                                    <th>Layanan</th>
                                                    <th>Kab/Kota</th>
                                                    <th>Kantor Wilayah</th>
                                                    <?php if($this->session->userdata('role_id') == 1) { ?>
                                                       
                                                    <?php } ?>
                                                    <th>File</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($download as $b) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $b['request_id']; ?></td>
                                                        <td><?php echo $b['no_permintaan']; ?></td>
                                                        <td><?php echo $b['tgl_permintaan']; ?></td>
                                                        <td><?php echo $b['username']; ?></td>
                                                        <td><?php echo $b['layanan']; ?></td>
                                                        <td><?php echo $b['kab_kota']; ?></td>
                                                        <td><?php echo $b['kantor_wilayah']; ?></td>
                                                        <?php if($this->session->userdata('role_id') == 1) { ?>
                                                       
                                                        <?php } ?>
                                                        <td><?php echo $b['filename']; ?></td>
                                                        <td align="center">
                                                            <button type="button" class="btn btn-primary btn-xs" title="Download" onclick="show_modal(<?php echo $b['request_id']; ?>)"><i class="glyphicon glyphicon-cloud-download"></i></button>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Download Database</h3>
                </div>
                
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                        <div id="alert_message"></div>
                        <div class="form-body">
                            <div id="alert_message"></div>
                            <input name="kdRequest" id="kdRequest" class="form-control" type="hidden" required="required">
                            <br>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">Masukkan key yang dikirim ke email Anda</label>
                                <div class="col-md-9">
                                    <input name="secretkey" placeholder="Key" class="form-control" type="text" required="required">
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <div id="loadergif" style="display: none;">
                                    <img src="<?php echo base_url('assets/img/loader.gif'); ?>">
                                    <br>
                                    <span>Decrypting file...</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btnSimpan" onclick="download_database()" class="btn btn-success">Proses</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
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