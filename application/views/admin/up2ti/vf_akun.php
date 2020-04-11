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
    <div class="bg-g text-dark">
      <a href="<?php echo base_url(); ?>admin/up2ti" class="dropdown-item"><i class="fa fa-dashboard"></i> Dashboard</a> 
    </div>
    <div>
      <a href="#" class="dropdown-item" data-toggle="collapse" data-target="#collapseSK" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-folder-open-o"></i> Dokumen SK 
      <i class="fa fa-arrow-circle-down float-right"></i></a>
      <div class="collapse pl-3" id="collapseSK">
        <?php
          foreach ($kategori_f_sk as $ks) {
        ?>
          <a class="dropdown-item" href="<?php echo base_url(); ?>file/f_sk_tampil/<?php echo $ks->nama_kategori; ?>"><i class="fa fa-file"></i> <?php echo $ks->nama_kategori; ?></a>
        <?php
         }
        ?>
      </div>
    </div> 
    <div>
      <a href="#" class="dropdown-item" data-toggle="collapse" data-target="#collapseNSK" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-folder"></i> Dokumen Non-SK 
      <i class="fa fa-arrow-circle-down float-right"></i></a>
      <div class="collapse pl-3" id="collapseNSK">
        <?php
          foreach ($kategori_f_sk as $ks) {
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

      <div class="col-sm-3 mb-2">
        <a class="btn btn-success form-control" href="<?php echo base_url(); ?>admin/daftar_akun"><i class="fa fa-refresh"></i> Tampilkan Semua</a>
      </div>

      <div class="col-sm-6 mb-2">
        <form method="get" action="<?php echo base_url(); ?>admin/cari_akun">
          <div class="input-group">
              <input type="text" name="cari" class="form-control" placeholder="Cari Username" required>
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit" ><i class="fa fa-search"></i> Cari</button>
              </span>
          </div>
        </form>
      </div>

    </div>
  </div>

  <div class="container pt-3">
    <div class="row">
      <div class="col-sm-12">
        <div class="card p-2">

          <h3 class="card-header"><i class="fa fa-list"></i> DAFTAR AKUN ADMIN</h3>
          <table class="table table-hover">
            <thead class="bg-dark text-light">
              <tr  class="text-center">
                <th>No</th>
                <th>Nama Akun</th>
                <th>Username</th>
                <th>Level</th>
                <th>Kategori</th>
                <th colspan="2">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $no = 1;
                foreach($akun as $s){ 
              ?>
              <tr>
                <td class="text-center"><?php echo $no; ?></td>
                <td><?php echo $s->nama ?></td>
                <td><?php echo $s->username ?></td>
                <td class="text-center"><?php echo $s->level ?></td>
                <td class="text-center"><?php echo $s->departemen ?></td>
                <td class="text-center">
                  <a data-toggle="modal" data-target="#modal_edit<?php echo $s->id; ?>" href="javascript:;" data-id="<?php echo $s->id; ?>" data-nama="<?php echo $s->nama ?>" data-username="<?php echo $s->username ?>" data-level="<?php echo $s->level ?>" data-kategori="<?php echo $s->kategori ?>" ><i class="fa fa-edit text-primary"></i>
                  </a>
                </td>
                <td>
                  <?php echo anchor('../admin/hapus_akun/'.$s->id,'<i class="fa fa-trash text-danger"></i>'); ?>
                </td>
              </tr>
              <?php 
                  $no++;
                } 
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  

<!-- UBAH AKUN MODAL-->
<?php 
  $lev = array('admin', 'departemen', 'admin_fakultas');
  foreach ($akun as $ak) :
    $akun_id=$ak->id;
    $akun_nama=$ak->nama;
    $akun_username=$ak->username;
    $akun_level=$ak->level;
    $akun_kategori=$ak->kategori;
?>
<div class="modal fade" id="modal_edit<?php echo $akun_id; ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Ubah Akun Admin</h5>
        <button class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url(); ?>admin/ubah_akun/<?php  ?>">
          <div class="form-group">
            <label for="title">Nama Admin</label>
            <input type="text" name="id" value="<?php echo $akun_id; ?>" hidden>
            <input type="text" name="nama" value="<?php echo $akun_nama; ?>" autofocus class="form-control" required placeholder="Nama Admin">
          </div>
          <div class="form-group">
            <label for="title">Username</label>
            <input type="text" name="username" value="<?php echo $akun_username; ?>" class="form-control" required placeholder="Username/Email">
          </div>
          <div class="form-group">
            <label for="title">Level</label>
            <select class="form-control" name="level" required>
              <?php
                foreach ($lev as $k) {
                  echo "<option value'$k' ";
                  echo $akun_level==$k?'selected="selected"':'';
                  echo ">$k</option>";
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="title">Kategori Admin</label>
            <select class="form-control" name="kategori" required>
              <option value="" disabled selected>--Pilih Kategori--</option>
              <option value="1" <?php echo ($akun_kategori == 1) ? "selected": "" ?>>Matematika</option>
              <option value="2" <?php echo ($akun_kategori == 2) ? "selected": "" ?>>Fisika</option>
              <option value="3" <?php echo ($akun_kategori == 3) ? "selected": "" ?>>Kimia</option>
              <option value="4" <?php echo ($akun_kategori == 4) ? "selected": "" ?>>Biologi</option>
              <option value="5" <?php echo ($akun_kategori == 5) ? "selected": "" ?>>Statistika</option>
              <option value="6" <?php echo ($akun_kategori == 6) ? "selected": "" ?>>Ilmu Komputer/Informatika</option>
              <option value="7" <?php echo ($akun_kategori == 7) ? "selected": "" ?>>Admin up2ti</option>
              <option value="8" <?php echo ($akun_kategori == 8) ? "selected": "" ?>>Admin UP2TI</option>
            </select>
          </div>

          <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>
<!-- AKHIR UBAH AKUN MODAL -->

<script type="text/javascript">
  $(document).ready(function(){
    $('#mydata').DataTable();
  });
</script>
        
</body>
</html>
  
