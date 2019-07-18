<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url($this->session->userdata('foto')); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('nama'); ?></p>
                <a><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
    
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?php if ($this->session->userdata('role_id') == 1) { ?>
                <li class="treeview">
                    <a href="<?php echo site_url('home'); ?>"><i class="fa fa-home"></i><span>Home</span></a>
                </li>
                <li class="treeview">
                    <a href="<?php echo site_url('user'); ?>"><i class="fa fa-user"></i>User</a>
                </li>

                <li class="header">Process</li>
                <li class="treeview">
                    <a href="<?php echo site_url('upload'); ?>"><i class="fa fa-upload"></i><span>Upload</span></a>
                </li>
                <li class="treeview">
                    <a href="<?php echo site_url('download'); ?>"><i class="fa fa-download"></i><span>Download</span></a>
                </li>
            <?php } else { ?>
                <li class="treeview">
                    <a href="<?php echo site_url('home'); ?>"><i class="fa fa-home"></i><span>Home</span></a>
                </li>

                <li class="header">Process</li>
                <li class="treeview">
                    <a href="<?php echo site_url('request'); ?>"><i class="fa fa-upload"></i><span>Request</span></a>
                </li>
                <li class="treeview">
                    <a href="<?php echo site_url('download'); ?>"><i class="fa fa-download"></i><span>Download</span></a>
                </li>
            <?php } ?>
        </ul>
    </section>
</aside>