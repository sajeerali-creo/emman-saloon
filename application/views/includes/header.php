<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $pageTitle; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url(); ?>assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url(); ?>assets/admin/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin/css/style.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url(); ?>securepanel/dashboard">
                <div class="sidebar-brand-text mx-3">
                    <img src="<?php echo base_url(); ?>assets/admin/img/logo.png">
                </div>
            </a><?php

            $currBaseUrl = basename(base_url(uri_string()));

            ?><!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo( ( $currBaseUrl == 'dashboard') ? "active" : ""); ?>">
                <a class="nav-link" href="<?php echo base_url(); ?>securepanel/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Bookings -->
            <li class="nav-item <?php echo( ( $currBaseUrl == 'booking') ? "active" : ""); ?>">
                <a class="nav-link" href="<?php echo base_url(); ?>securepanel/booking">
                    <i class="far fa-hand-pointer"></i>
                    <span>Bookings</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Services -->
            <li class="nav-item <?php echo( ( $currBaseUrl == 'services') ? "active" : ""); ?>">
                <a class="nav-link" href="<?php echo base_url(); ?>securepanel/services">
                    <i class="fab fa-servicestack"></i>
                    <span>Services</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Team -->
            <li class="nav-item <?php echo( ( $currBaseUrl == 'team') ? "active" : ""); ?>">
                <a class="nav-link" href="<?php echo base_url(); ?>securepanel/team">
                    <i class="fas fa-user-friends"></i>
                    <span>Team</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Invetory -->
            <li class="nav-item <?php echo( ( $currBaseUrl == 'invetory') ? "active" : ""); ?> ">
                <a class="nav-link" href="<?php echo base_url(); ?>securepanel/invetory">
                    <i class="fas fa-list-ul"></i>
                    <span>Inventory</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Suppliers -->
            <li class="nav-item <?php echo( ( $currBaseUrl == 'suppliers') ? "active" : ""); ?>">
                <a class="nav-link" href="<?php echo base_url(); ?>securepanel/suppliers">
                    <i class="fas fa-truck-loading"></i>
                    <span>Suppliers</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Customers -->
            <li class="nav-item <?php echo( ( $currBaseUrl == 'customers') ? "active" : ""); ?>">
                <a class="nav-link" href="<?php echo base_url(); ?>securepanel/customers">
                    <i class="fas fa-user"></i>
                    <span>Customers</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Settings -->
            <li class="nav-item <?php echo( ( $currBaseUrl == 'settings') ? "active" : ""); ?>">
                <a class="nav-link" href="<?php echo base_url(); ?>securepanel/settings">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Logout -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#logoutModal" href="#">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link" href="<?php echo base_url(); ?>securepanel/notification">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <?php 
                                if(isset($notificationCount) && $notificationCount > 0){
                                    ?><span class="badge badge-danger badge-counter"><?php echo$notificationCount; ?>+</span><?php
                                }
                                ?>
                                
                            </a>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo base_url(); ?>assets/admin/img/avatar.svg">
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->