<?php
    use Core\Helpers\Html_Helper as H;
?>
<!doctype html>
<html lang="en">
<base href="<?= WEBPATH;?>"
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?=    H::link('stylesheet','vendor/bootstrap/css/bootstrap.min');?>
    <?=    H::link('stylesheet','vendor/fonts/circular-std/style');?>
    <?=    H::link('stylesheet','libs/css/style');?>
    <?=    H::link('stylesheet','vendor/fonts/fontawesome/css/fontawesome-all');?>
    <?=    H::link('stylesheet','vendor/charts/chartist-bundle/chartist');?>
    <?=    H::link('stylesheet','vendor/charts/morris-bundle/morris');?>
    <?=    H::link('stylesheet','vendor/fonts/material-design-iconic-font/css/materialdesignicons.min')?>
    <?=    H::link('stylesheet','vendor/charts/c3charts/c3.css');?>
    <?=    H::link('stylesheet','vendor/fonts/flag-icon-css/flag-icon.min')?>
    <?=    H::link('stylesheet','vendor/datatables/css/dataTables.bootstrap4')?>
    <?=    H::link('stylesheet','vendor/datatables/css/buttons.bootstrap4')?>
    <?=    H::link('stylesheet','vendor/datatables/css/select.bootstrap4')?>
    <?=    H::link('stylesheet','vendor/datatables/css/fixedHeader.bootstrap4')?>
    <?=    H::link('stylesheet','vendor/sweet-alert/sweetalert')?>
    <title><?= TITLE ?> | <?= ($title) ? $title : SUBTITLE?></title>
    <?= $this->section('head');?>
</head>

<body>
<div class="dashboard-main-wrapper">
    <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" href="<?= WEBPATH?>Admin/"><?= TITLE;?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                        </div>
                    </li>
                    <li class="nav-item dropdown nav-user">
                        <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?= $this->assets('images/avatar-1.jpg');?>" alt="" class="user-avatar-md rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                            <div class="nav-user-info">
                                <h5 class="mb-0 text-white nav-user-name">Administrator </h5>
                                <span class="status"></span><span class="ml-2">Available</span>
                            </div>
                            <a class="dropdown-item" href="Admin/Logout">
                                <i class="fas fa-power-off mr-2"></i>Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            Menu
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= WEBPATH."Admin/"?>">
                                <i class="fa fa-cubes"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1">
                                <i class="fa fa-tint"></i>
                                Manage Blood Groups
                            </a>
                            <div id="submenu-1" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="Blood/">Blood Groups</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="Blood/Create">Add Blood Group</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-1">
                                <i class="fa fa-users"></i>
                                Manage Donors
                            </a>
                            <div id="submenu-2" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="Donor/">Donors</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="Donor/Create">Add Donor</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-1">
                                <i class="fa fa-tint"></i>
                                Manage Requests
                            </a>
                            <div id="submenu-3" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="Blood/Request">All Requests</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Admin/Contact">
                                <i class="fa fa-bookmark"></i>
                                All Contacts
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="dashboard-wrapper">
        <?= $this->section('body');?>
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        Copyright © 2018 <?= TITLE;?> All rights reserved.
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="text-md-right footer-links d-none d-sm-block">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= H::script('vendor/jquery/jquery-3.3.1.min');?>
<?= H::script('vendor/bootstrap/js/bootstrap.bundle');?>
<?= H::script('vendor/slimscroll/jquery.slimscroll');?>
<?= H::script('libs/js/main-js.js');?>
<?= H::script('vendor/datatables/js/jquery.dataTables.min');?>
<?= H::script('vendor/datatables/js/dataTables.bootstrap4.min');?>
<?= H::script('vendor/datatables/js/buttons.bootstrap4.min');?>
<?= H::script('vendor/datatables/js/data-table');?>
<?= H::script('vendor/sweet-alert/sweetalert.min');?>
<?= $this->section('footer');?>
</body>

</html>
