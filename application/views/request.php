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
                    Request
                    <small>Menu</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Request</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Permintaan Database</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <div class="x_content">
                            <form action="#" id="formRequest" class="form-horizontal" enctype="multipart/form-data">
                                <section class="content col-lg-12 connectedSortable">
                                    <div id="alert_message"></div>

                                    <input name="kdRequest" value="<?php echo $kdRequest->request_id + 1; ?>" class="form-control" type="hidden">
                                    <input name="noPermintaan" value="<?php echo $noPermintaan; ?>" class="form-control" type="hidden">

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="total_permintaan">
                                                Silakan masukkan secret key untuk mengenkripsi data
                                            </label>
                                            <input name="secretkey" placeholder="Secret Key" class="form-control" type="text" style="width: 100% !important;" required="required">
                                        </div>

                                        <div class="row">
                                            <button type="button" id="btnNewRequest" class="btn btn-primary" onclick="tambah_request()">&nbsp;Proses&nbsp;</button>
                                        </div>
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