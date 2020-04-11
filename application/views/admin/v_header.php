<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin E-Filing FSM UNDIP</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/lightbox.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style_home.css">
</head>

<body background="<?php echo base_url(); ?>assets/img/map.png">
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark pl-5 pr-5">
    <a href="<?php echo base_url(); ?>admin/admin" class="navbar-brand">ADMIN E-FILING</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <div class="dropdown user-aktif">
  		      <a class="dropdown-toggle text-light" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $this->session->userdata("nama"); ?>
  		      </a>
  		      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  		        <a class="dropdown-item" href="<?php echo base_url(); ?>admin/ubah_password" ><i class="fa fa-gear"></i> Ubah Password</a>
  		        <a class="dropdown-item" href="<?php echo base_url(); ?>login/logout" ><i class="fa fa-user-times"></i> Keluar</a>
  		      </div>
  		    </div>
        </li>
      </ul>
    </div>
  </nav>