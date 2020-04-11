
<div class="container">
  <div class="row">
	<div class="col-sm-12">
	  <div class="card login jl-35 j-80">
	    <div class="login-head">
	      <div class="text-center p-2">
	      	<h4><i class="fa fa-user"></i> Login Admin</h4>
	      </div>
	    </div>
	    <div  class="login-body">
	      <div class="card-body">
	      	<form method="post" action="<?php echo base_url(); ?>login/login_aksi">
      		  <div class="form-group">
      		  	<label>Username</label>
      		  	<input class="form-control" type="text" name="username" autofocus placeholder="Username" required>
      		  </div>
      		  <div class="form-group">
      		  	<label>Password</label>
      		  	<input class="form-control" type="password" name="password" placeholder="Password" required>
      		  </div>
      		  <div class="form-group">
      		  	<input class="form-control btn btn-success" type="submit" name="submit" value="Login">
      		  </div>
	      	</form>
	      </div>
		</div>
	  </div>
	</div>
  </div>
</div>
<div class="j-70"></div>


<!--BANTUAN MODAL-->
  <div class="modal fade" id="bantuanModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Tentang E-FILING</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <ul>
            <li>Elektronik-filing FSM UNDIP adalah suatu sistem untuk mengelola data-data berupa file SK dan Non-SK fakultas Sains dan Matematika</li>
            <li>Setiap departemen diberi akses satu akun per departemennya</li>
            <li>Setiap admin departemen wajib mengubah password default</li>
            <li>Jika password lupa, hubungi admin UP2TI untuk mendapatkan password baru</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- AKHIR MODAL-->