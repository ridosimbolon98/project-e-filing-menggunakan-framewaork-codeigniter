<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>E-Filing FSM UNDIP</title>
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
    <a href="<?php echo base_url(); ?>" class="navbar-brand">E-FILING</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>admin/kembali" class="nav-link"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>login/" class="nav-link"><i class="fa fa-sign-in"></i> Login</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container j-33">
    <div class="row">
    	<div class="col-sm-12">
    	  <div class="card login jl-35">
    	    <div class="login-head">
    	      <div class="text-center p-2">
    	      	<h4><i class="fa fa-user"></i> Ubah Password Admin</h4>
    	      </div>
    	    </div>
    	    <div  class="login-body">
    	      <div class="card-body">
    	      	<form method="post" action="<?php echo base_url(); ?>admin/ubah_password_aksi">
          		  <div class="form-group">
          		  	<label>Password Lama</label>
                  <input type="hidden" name="id" value="<?php echo $this->session->userdata("id"); ?>">
                  <input type="hidden" name="kategori" value="<?php echo $this->session->userdata("kategori"); ?>">
                  <input type="hidden" name="level" value="<?php echo $this->session->userdata("level"); ?>">
          		  	<input class="form-control" type="password" name="pass_lama" placeholder="Password Lama" required>
          		  </div>
          		  <div class="form-group">
          		  	<label>Password Baru</label>
          		  	<input class="form-control" type="password" name="pass_baru" placeholder="Password Baru" required>
          		  </div>
          		  <div class="form-group">
                  <label>Konfirmasi Password Baru</label>
                  <input class="form-control" type="password" name="konf_pass_baru" placeholder="Konfirmasi Password Baru" required>
                </div>
          		  <div class="form-group">
          		  	<input class="form-control btn btn-success" type="submit" name="submit" value="Simpan">
          		  </div>
    	      	</form>
    	      </div>
    		  </div>
    	  </div>
    	</div>
    </div>
  </div>

  <div class="j-40"></div>