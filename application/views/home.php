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
                    Home
                    <small>Menu</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Notifikasi Permintaan Database</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <div class="x_content">
                            <form class="form-horizontal form-label-left" id="formHome">
                                <section class="content col-lg-12 connectedSortable">
                                    <div id="alert_hapus"></div>
                                    
                                    <table id="list_permintaan_database_kosong" class="table table-bordered table-striped">
                                        <thead>
                                            <tr></tr>
                                        </thead>
                                    </table>
                                    
                                    <div class="table-responsive">
                                        <table id="list_permintaan_database" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No. Permintaan</th>
                                                    <th>Tanggal Permintaan</th>
                                                    <th>Username</th>
                                                    <th>Layanan</th>
                                                    <th>Kab/Kota</th>
                                                    <th>Kantor Wilayah</th>
                                                   
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($home as $b) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $b['no_permintaan']; ?></td>
                                                        <td><?php echo $b['tgl_permintaan']; ?></td>
                                                        <td><?php echo $b['username']; ?></td>
                                                        <td><?php echo $b['layanan']; ?></td>
                                                        <td><?php echo $b['kab_kota']; ?></td>
                                                        <td><?php echo $b['kantor_wilayah']; ?></td>
                                                        
                                                        <?php if ($b['status'] == 0) { ?>
                                                            <td><span style="background-color: #FFAA56; padding: 3px; color: #FFFFFF;">Pending</span></td>
                                                         <?php } ?>
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