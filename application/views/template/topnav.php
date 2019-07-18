<header class="main-header">
    <a href="" class="logo">
        <span class="logo-mini"><b>I</b>FK</span>
        <span class="logo-lg"><b>INFO</b>KES</span>
    </a>

    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php if ($this->session->userdata('role_id') == 1) { ?>
                    <!-- Notifications Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <?php if ($count_request <> 0 ) { ?>
                                <span class="label label-danger"><?php echo $count_request; ?></span>
                            <?php } else { } ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Notifications</li>
                            <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                <li><!-- start notification -->
                                <a href="<?php echo site_url('upload'); ?>">
                                    <i class="fa fa-database text-green"></i> Anda memiliki <?php echo $count_request; ?> permintaan database.
                                </a>
                                </li>
                                <!-- end notification -->
                            </ul>
                            </li>
                            <li class="footer"></li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url($this->session->userdata('foto')); ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?php echo base_url($this->session->userdata('foto')); ?>" class="img-circle" alt="User Image">
                            <p>
                                <?php echo $this->session->userdata('nama'); ?>
                                <small><?php echo $this->session->userdata('role'); ?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="<?php echo site_url('login/logout'); ?>" class="btn btn-default btn-flat">Log out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>