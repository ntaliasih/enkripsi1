<?php
	$this->load->view('template/head');
?>

<body class="hold-transition login-page">
	<div class="login-box">
  		<div class="login-logo">
			<a href=""><img src="<?php echo base_url('assets/img/logoinfokes.png'); ?>" width="250"></a>
  		</div>

		<?php
            if ($pesan != "") {
        ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Warning!</strong> <?php echo "<p><font color=white>" . $pesan . "</font></p>"; ?>
            </div>
            <div class="clearfix"></div>
        <?php } ?>
		  
  		<div class="login-box-body">
			<p class="login-box-msg">Silakan login untuk masuk ke aplikasi.</p>

			<form action="<?php echo site_url('login/auth') ?>" method="post">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="username" placeholder="Username" required="required">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="password" placeholder="Password" required="required">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-4"></div>
					<div class="col-xs-4">
						<button type="submit" class="btn btn-success btn-block btn-flat">Log In</button>
					</div>
				</div>
			</form>
		</div>
  	</div>

	<!-- jQuery 3 -->
	<script src="<?php echo base_url('vendors/jquery/dist/jquery.min.js'); ?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url('vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
	<!-- iCheck -->
	<script src="<?php echo base_url('plugins/iCheck/icheck.min.js'); ?>"></script>
	<!-- Related js for this page -->
    <?php if ($js_to_load != '') { ?>
        <script type="text/javascript" src="<?php echo base_url('assets/js/pages/') . $js_to_load; ?>"></script>
	<?php } ?>
</body>

<?php
	$this->load->view('template/foot');
?>