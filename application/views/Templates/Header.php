<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Blank Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-file mr-2"></i>
                        <span class="badge badge-warning navbar-badge">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">last 5 Logs</span>
                        <div class="dropdown-divider"></div>
                        <?php foreach ($logs as $log) {
                            echo '
                            <a href="#" class="dropdown-item">
                                <i class=" mr-2"></i> ' . $log['access'] . ' -> ' . $log['url'] . '
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>';
                        } ?>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Logs</a>
                    </div>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user mr-2"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="<?= site_url('Logout') ?>" class="dropdown-item dropdown-footer">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="<?= base_url('assets') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">UAC</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('assets') ?>/avatar.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $this->session->userdata('fullname') ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <?php
                        if ($data == NULL) {
                            die;
                        }
                        $access_map = $data;
                        $array = array_column($access_map, 'parent_map');
                        $array = array_unique($array);
                        $parent = array_filter($access_map, function ($key, $value) use ($array) {
                            return in_array($value, array_keys($array));
                        }, ARRAY_FILTER_USE_BOTH);
                        foreach ($parent as $row_parent) {
                            echo '<li class="nav-item has-treeview">';
                            echo '<a href="#" class="nav-link">';
                            echo '<i class="' . $row_parent['icon'] . '"></i> ';
                            echo '<p>' . $row_parent['parent_map'] . '<i class="right fas fa-angle-left"></i></p>';
                            echo '</a>';
                            echo '<ul class="nav nav-treeview">';

                            foreach ($access_map as $row_access) {
                                if ($row_parent['parent_map'] == $row_access["parent_map"]) {
                                    echo '<li class="nav-item"><a href="' . site_url($row_access["access_map"]) . '" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i><p>' .  $field = str_replace('_', ' ', $row_access["access_map"])  . '
                                    </p></a></li>';
                                }
                            }
                            echo '</ul>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>