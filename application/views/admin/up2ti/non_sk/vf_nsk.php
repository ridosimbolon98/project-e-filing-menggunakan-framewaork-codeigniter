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
      <a href="<?php echo base_url(); ?>admin/f_sk" class="dropdown-item" data-toggle="collapse" data-target="#collapseSK" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-folder"></i> Dokumen SK 
      <i class="fa fa-arrow-circle-down float-right"></i></a>
      <div class="collapse pl-3" id="collapseSK">
        <?php
          foreach ($kategori_f_nsk as $ks) {
        ?>
          <a class="dropdown-item" href="<?php echo base_url(); ?>file/f_sk_tampil/<?php echo $ks->nama_kategori; ?>"><i class="fa fa-file"></i> <?php echo $ks->nama_kategori; ?></a>
        <?php
         }
        ?>
      </div>
    </div> 
    <div class="bg-g text-dark">
      <a href="<?php echo base_url(); ?>admin/f_non_sk" class="dropdown-item" data-toggle="collapse" data-target="#collapseNSK" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-folder-open-o"></i> Dokumen Non-SK 
      <i class="fa fa-arrow-circle-down float-right"></i></a>
      <div class="collapse pl-3" id="collapseNSK">
        <?php
          foreach ($kategori_f_nsk as $ks) {
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
        <a class="btn btn-danger form-control" href="<?php echo base_url(); ?>admin/f_non_sk"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
      </div>

      <div class="col-sm-3 mb-2">
        <a class="btn btn-success form-control" href="<?php echo base_url(); ?>file/f_nsk_tampil/<?php echo $kategori; ?>"><i class="fa fa-refresh"></i> Tampilkan Semua</a>
      </div>

      <div class="col-sm-6 mb-2">
        <form method="get" action="<?php echo base_url(); ?>file/cari_f_nsk/<?php echo $kategori; ?>">
          <div class="input-group">
              <input type="text" name="cari" class="form-control" placeholder="Cari file berdasarkan judul, unit atau tahun" required>
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

          <h3 class="card-header"><i class="fa fa-list"></i> DOKUMEN NON-SK KATEGORI <?php echo strtoupper($kategori); ?></h3>
          <!-- database table = dokumen_sk -->
          <table class="table table-hover">
            <thead class="bg-dark text-light">
              <tr  class="text-center">
                <th>No</th>
                <th>Judul Non-SK</th>
                <th>Nama File</th>
                <th>Unit</th>
                <th>Tahun</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $no = 1;
                foreach($data->result() as $s){ 
              ?>
              <tr>
                <td class="text-center"><?php echo $no; ?></td>
                <td><?php echo $s->judul ?></td>
                <td><?php echo $s->nama_nsk ?></td>
                <td class="text-center"><?php echo $s->departemen ?></td>
                <td class="text-center"><?php $dt = new DateTime($s->date) ; echo $dt->format('Y'); ?></td>
              </tr>
              <?php 
                  $no++;
                } 
              ?>
            </tbody>
          </table>
          <div class="row">
            <div class="col">
              <!--Tampilkan pagination-->
              <?php echo $pagination; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--TAMBAH FILE SK MODAL-->
  <div class="modal fade" id="tambahSKModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Tambah File SK</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <?php
          $kat = array(); 
          $x   = 0;
          foreach ($kategori_nsk as $kat_nsk) {
            $kat[$x] = $kat_nsk->nama_kategori;
            $x++;
          }
          ?>
          <form method="post" action="<?php echo base_url(); ?>file/upload_nsk_file/<?php echo $kategori; ?>" enctype="multipart/form-data">
            <div class="form-group">
              <input type="number" name="kat_dep" autofocus class="form-control" hidden value="<?php echo $kat_admin; ?>">
            </div>
            <div class="form-group">
              <label for="title">Judul Non-SK/ Deskripsi</label>
              <input type="text" name="judul" class="form-control" required placeholder="Judul/Deskripsi">
            </div>
            <div class="form-group">
              <label for="title">Kategori Non-SK</label>
              <select class="form-control" name="kategori" readonly>
                <?php
                  foreach ($kat as $k) {
                    echo "<option value'$k' ";
                    echo $kategori==$k?'selected="selected"':'';
                    echo ">$k</option>";
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="title">Tahun Non-SK</label>
              <input class="date-own form-control" name="tahun" required type="text">
            </div>
            <div class="form-group">
              <label for="title">File Non-SK</label>
              <div class="file-field">
                  <input class="btn btn-primary btn-sm float-left" type="file" name="nsk">
              </div>
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
  <!-- AKHIR MODALUPLOAD FILE-->

  <!-- MODAL PREVIEW FILE-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
          <h4 class="modal-title" id="myModalLabel"></h4>
        </div>
        <div id="preview_file" class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <!-- AKHIR MODAL PREVIEW FILE-->
  
<script type="text/javascript">
    $('.date-own').datepicker({
       minViewMode: 2,
       format: 'yyyy'
     });
</script>

<script>
    $(function () {
        $(document).on('click', '.edit-record', function (e) {
            e.preventDefault();
            $("#myModal").modal('show');
            $.post("<?php echo base_url(); ?>file/nsk_hasil/<?php echo $kat_admin; ?>/<?php echo $kategori; ?>",
              {id: $(this).attr('data-id')},
              function (html) {
                $("#preview_file").html(html).toString();
              }
            );
        });
    });
</script>
        
</body>
</html>
  
