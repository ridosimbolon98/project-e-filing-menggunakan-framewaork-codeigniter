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
      <a href="<?php echo base_url(); ?>admin/fakultas" class="dropdown-item"><i class="fa fa-dashboard"></i> Dashboard</a> 
    </div>
    <div>
      <a href="#" class="dropdown-item" data-toggle="collapse" data-target="#collapseSK" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-folder"></i> Dokumen SK 
      <i class="fa fa-arrow-circle-down float-right"></i></a>
      <div class="collapse pl-3" id="collapseSK">
        <?php
          foreach ($kategori_file as $ks) {
        ?>
          <a class="dropdown-item" href="<?php echo base_url(); ?>file/fkl_sk_tampil/<?php echo $ks->nama_kategori; ?>"><i class="fa fa-file"></i> <?php echo $ks->nama_kategori; ?></a>
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
          foreach ($kategori_file as $ks) {
        ?>
          <a class="dropdown-item" href="<?php echo base_url(); ?>file/fkl_nsk_tampil/<?php echo $ks->nama_kategori; ?>"><i class="fa fa-file"></i> Dokumen <?php echo $ks->nama_kategori; ?></a>
        <?php
         }
        ?>
      </div>
    </div>
  </div>

<div id="halaman">

  <div class="container pt-4">
    <div class="row">
      <div class="col-sm-4 mb-2">
        <a class="btn btn-danger form-control" href="<?php echo base_url(); ?>admin/fakultas"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
      </div>

      <div class="col-sm-4 mb-2">
        <a class="btn btn-warning form-control" data-toggle="modal" data-target="#tambahKategoriModal" href="#"><i class="fa fa-plus-circle"></i> Tambah Kategori File</a>
      </div>

      <div class="col-sm-4 mb-2">
        <a class="btn btn-success form-control" href="<?php echo base_url(); ?>admin/fkl_kategori_file"><i class="fa fa-refresh"></i> Tampilkan Semua</a>
      </div>

      <div class="col-sm-12 mb-2">
        <form method="get" action="<?php echo base_url(); ?>admin/fkl_cari_kategori">
          <div class="input-group">
              <input type="text" name="cari" class="form-control" placeholder="Cari Kategori" required>
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

          <h3 class="card-header"><i class="fa fa-list"></i> DAFTAR KATEGORI FILE</h3>
          <table class="table table-hover">
            <thead class="bg-dark text-light">
              <tr  class="text-center">
                <th>No</th>
                <th>Kategori File</th>
                <th>Edit</th>
                <th>Hapus</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $no = 1;
                foreach($kategori_file as $s){ 
              ?>
              <tr class="text-center">
                <td><?php echo $no; ?></td>
                <td><?php echo $s->nama_kategori ?></td>
                <td>
                  <a data-toggle="modal" data-target="#modal_edit<?php echo $s->id; ?>" href="javascript:;" data-id="<?php echo $s->id; ?>" data-kategori="<?php echo $s->nama_kategori ?>" ><i class="fa fa-edit text-primary"></i>
                  </a>
                </td>
                <td>
                  <?php echo anchor('../admin/fkl_hapus_kategori_file/'.$s->id,'<i class="fa fa-trash text-danger"></i>'); ?>
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

<!-- UBAH MODAL-->
<?php 
  foreach ($kategori_file as $ak) :
    $kf_id=$ak->id;
    $kf_kategori=$ak->nama_kategori;
?>
<div class="modal fade" id="modal_edit<?php echo $kf_id; ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Ubah Kategori</h5>
        <button class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url(); ?>admin/fkl_ubah_kategori_file/<?php  ?>">
          <div class="form-group">
            <label for="title">Kategori File</label>
            <input type="text" name="id" value="<?php echo $kf_id; ?>" hidden>
            <input type="text" name="kategori" value="<?php echo $kf_kategori; ?>" autofocus class="form-control" required placeholder="Kategori File">
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

<!--TAMBAH KATEGORI MODAL-->
<div class="modal fade" id="tambahKategoriModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Tambah Kategori File</h5>
        <button class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url(); ?>admin/fkl_tambah_kategori_file">
          <div class="form-group">
            <label for="title">Kategori File</label>
            <input type="text" name="kategori" autofocus class="form-control" required placeholder="Kategori File">
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
<!-- AKHIR TAMBAH KATEGORI MODAL -->

<script type="text/javascript">
  $(document).ready(function(){
    $('#mydata').DataTable();
  });
</script>
        
</body>
</html>
  
