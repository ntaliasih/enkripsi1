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
                    User
                    <small>Menu</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">User</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar User</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <div class="x_content">
                            <form class="form-horizontal form-label-left" id="formUser">
                                <section class="content col-lg-12 connectedSortable">
                                    <div id="alert_hapus"></div>
                                    <div class="row pull-right">
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <button type="button" id="btnNewUser" class="btn btn-primary" onclick="tambah_user()"><i class="fa fa-plus"></i>&nbsp;Tambah User&nbsp;</button>
                                        </div>
                                    </div>
                                    
                                    <table id="list_user_kosong" class="table table-bordered table-striped">
                                        <thead>
                                            <tr></tr>
                                        </thead>
                                    </table>
                                    
                                    <div class="table-responsive">
                                        <table id="list_user" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Username</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Layanan</th>
                                                    <th>Kab/Kota</th>
                                                    <th>Kantor Wilayah</th>
                                                    <th>Role</th>
                                                    <th>Foto</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($user as $b) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $b['user_id']; ?></td>
                                                        <td><?php echo $b['username']; ?></td>
                                                        <td><?php echo $b['nama']; ?></td>
                                                        <td><?php echo $b['email']; ?></td>
                                                        <td><?php echo $b['layanan']; ?></td>
                                                        <td><?php echo $b['kab_kota']; ?></td>
                                                        <td><?php echo $b['kantor_wilayah']; ?></td>
                                                        <td><?php echo $b['role']; ?></td>
                                                        <td><?php echo $b['foto']; ?></td>
                                                        <td align="center">
                                                            <button type="button" class="btn btn-primary btn-xs" title="Edit" onclick="edit_user(<?php echo $b['user_id']; ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                                                            <button type="button" class="btn btn-danger btn-xs" title="Delete" onclick="hapus_user(<?php echo $b['user_id']; ?>)"><i class="glyphicon glyphicon-remove"></i></button>
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
                    <h3 class="modal-title">Tambah User</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-body">
                            <div id="alert_message"></div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Kode</label>
                                <div class="col-md-9">
                                    <input name="kdUser" class="form-control" type="text" required="required" readOnly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Username</label>
                                <div class="col-md-9">
                                    <input name="username" placeholder="Username" class="form-control" type="text" required="required" title="Masukkan data dapat berupa huruf atau angka tanpa spasi">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Password</label>
                                <div class="col-md-9">
                                    <input name="password" placeholder="Password" class="form-control" type="password" required="required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Nama</label>
                                <div class="col-md-9">
                                    <input name="nama" placeholder="Nama" class="form-control" type="text" required="required" title="Masukkan data dapat berupa huruf, angka dan spasi">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-9">
                                    <input name="email" placeholder="Email" class="form-control" type="text" required="required">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Layanan</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="layanan" name="layanan">
                                        <option value="">-- Select --</option>
                                        <?php
                                            if (sizeof($get_layanan) > 0) {
                                                foreach ($get_layanan as $list) {
                                        ?>
                                        <option value="<?php echo $list['layanan_id']; ?>"><?php echo $list['layanan'] ?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
						    </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Kab/Kota</label>
                                <div class="col-md-9">
                                    <input name="kabkota" placeholder="Kab/Kota" class="form-control" type="text" required="required" title="Masukkan data dapat berupa huruf dan spasi">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Kantor Wilayah</label>
                                <div class="col-md-9">
                                    <input name="kantorwilayah" placeholder="Kantor Wilayah" class="form-control" type="text" required="required" title="Masukkan data dapat berupa huruf dan spasi">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Role</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="role" name="role">
                                        <option value="">-- Select --</option>
                                        <?php
                                            if (sizeof($get_role) > 0) {
                                                foreach ($get_role as $list) {
                                        ?>
                                        <option value="<?php echo $list['role_id']; ?>"><?php echo $list['role'] ?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
						    </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Foto</label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control-file" id="foto" name="foto" aria-describedby="fileHelp">
                                    <small id="fileHelp" class="form-text text-muted">Unggah foto user yang akan digunakan. Max 3MB</small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btnSimpan" onclick="save()" class="btn btn-success">Simpan</button>
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