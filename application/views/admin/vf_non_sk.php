  <div id="side_bar" class="sidebar bar-block bg-side">
    <div>
      <a class="dropdown-item btn_n" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-user"></i> <?php echo $this->session->userdata("nama"); ?>
      <i class="fa fa-arrow-circle-down float-right"></i></a>
      <div class="collapse pl-3" id="collapseExample">
        <a class="dropdown-item" href="<?php echo base_url(); ?>admin/ubah_password" ><i class="fa fa-gear"></i> Ubah Password</a>
        <a class="dropdown-item" href="<?php echo base_url(); ?>login/logout" ><i class="fa fa-user-times"></i> Keluar</a>
      </div>
    </div>
    <div>
      <a href="<?php echo base_url(); ?>" target="_blank" class="dropdown-item ho"><i class="fa fa-home"></i> Home</a> 
    </div> 
    <div>
      <a href="<?php echo base_url(); ?>admin/up2ti" class="dropdown-item"><i class="fa fa-dashboard"></i> Dashboard</a> 
    </div> 
    <div>
      <a href="#" class="dropdown-item" data-toggle="collapse" data-target="#collapseSK" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-folder"></i> Dokumen SK 
      <i class="fa fa-arrow-circle-down float-right"></i></a>
      <div class="collapse pl-3" id="collapseSK">
        <?php
          foreach ($kategori_nsk as $ks) {
        ?>
          <a class="dropdown-item" href="<?php echo base_url(); ?>file/f_sk_tampil/<?php echo $ks->nama_kategori; ?>"><i class="fa fa-file"></i> <?php echo $ks->nama_kategori; ?></a>
        <?php
         }
        ?>
      </div>
    </div> 
    <div class="bg-g text-dark">
      <a href="#" class="dropdown-item" data-toggle="collapse" data-target="#collapseNSK" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-folder-open-o"></i> Dokumen Non-SK 
      <i class="fa fa-arrow-circle-down float-right"></i></a>
      <div class="collapse pl-3" id="collapseNSK">
        <?php
          foreach ($kategori_nsk as $ks) {
        ?>
          <a class="dropdown-item" href="<?php echo base_url(); ?>file/f_nsk_tampil/<?php echo $ks->nama_kategori; ?>"><i class="fa fa-file"></i> Dokumen <?php echo $ks->nama_kategori; ?></a>
        <?php
         }
        ?>
      </div>
    </div>
  </div>

<div id="halaman">
  <div class="container pt-4">
    <div class="row">
      <div class="col-sm-3 mb-2">
        <a class="btn btn-danger form-control" href="<?php echo base_url(); ?>admin/up2ti"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
      </div>
    </div>
  </div>

  <div class="container pt-3">
    <div class="row">
      <div class="col-sm-12">
        <div class="card p-2">

          <h3 class="card-header"><i class="fa fa-database"></i> KATEGORI DOKUMEN NON-SK</h3>
          <ul class="card-body list-unstyled">
            <?php
            foreach ($kategori_nsk as $ks) {
            ?>
            <li class="p-2">
              <i class="fa fa-file"></i><a class="link" href="<?php echo base_url(); ?>file/f_nsk_tampil/<?php echo $ks->nama_kategori; ?>"> DOKUMEN <?php echo strtoupper($ks->nama_kategori); ?></a>
            </li>
            <?php
            }
            ?>
          </ul>

        </div>
      </div>
    </div>
  </div>

</div>
      
</body>
</html>
  
