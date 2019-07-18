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
                <p><h2>Selamat Datang <b><?php echo $this->session->userdata('nama') ?></b>.</h2></p>
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