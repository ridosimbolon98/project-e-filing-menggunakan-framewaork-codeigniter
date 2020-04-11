  <style type="text/css">
    #input_tahun {
        display: block;
        width: 20%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    #input_tahun::-ms-expand {
        background-color: transparent;
        border: 0;
    }

    #input_tahun:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    #input_file {
      width: 100%;
    }
  </style>
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
      <a href="<?php echo base_url(); ?>admin/fakultas" class="dropdown-item"><i class="fa fa-dashboard"></i> Dashboard</a> 
    </div> 
    <div class="bg-g text-dark">
      <a href="#" class="dropdown-item" data-toggle="collapse" data-target="#collapseSK" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-folder-open-o"></i> Dokumen SK 
      <i class="fa fa-arrow-circle-down float-right"></i></a>
      <div class="collapse pl-3" id="collapseSK">
        <?php
          foreach ($kategori_f_sk as $ks) {
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
          foreach ($kategori_f_sk as $ks) {
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

      <div class="col-sm-3 mb-3">
        <a href="#" class="btn btn-primary form-control" data-toggle="modal" data-target="#tambahSKModal">
          <i class="fa fa-upload float-left"></i> Unggah File
        </a>
      </div>

      <div class="col-sm-9 input-group mb-3">
        <form class="input-group" method="get" action="<?php echo base_url(); ?>file/fkl_sk_tampil/<?php echo $kategori; ?>">
          <span class="form-control bg-warning text-white">Tampilkan Perhalaman</span>
          <select class="form-control" name="paginasi">
            <option value="50"> 50 File (Default)</option>
            <option value="100"> 100 File</option>
            <option value="150"> 150 File</option>
            <option value="semua"> Semua File</option>
          </select>
          <button class="btn btn-warning" type="submit" name="submit"><i class="fa fa-file-text-o"></i> Tampilkan</button>
        </form>
      </div>

      <form class="input-group" method="get" action="<?php echo base_url(); ?>file/fkl_cari_f_sk/<?php echo $kategori; ?>">
        <div class="col-sm-6">
          <input class="form-control" name="cari" required type="text" placeholder="Cari file berdasarkan">
        </div>
        <div class="col-sm-4">
          <select name="kolom" class="form-control">
            <option value="semua">Semua File</option>
            <option value="judul">Judul SK</option>
            <option value="nama_file">Nama File SK</option>
            <option value="unit">Unit</option>
            <option value="tahun">Tahun SK</option>
          </select>
        </div>
        <div class="col-sm-2">
          <button class="btn btn-success form-control" type="submit"><i class="fa fa-search float-left"></i> Cari</button>
        </div>
      </form>
      
    </div>
  </div>

  <div class="container pt-3">
    <div class="row">
      <div class="col-sm-12">
        <div class="card p-2">

          <h3 class="card-header"><i class="fa fa-list"></i> DOKUMEN SK KATEGORI <?php echo strtoupper($kategori); ?></h3>
          <!-- database table = dokumen_sk -->
          <table class="table table-hover">
            <thead class="bg-dark text-light">
              <tr  class="text-center">
                <th>No</th>
                <th>No SK <a href="<?php echo base_url(); ?>file/fkl_sk_urut_nosk/<?php echo $kategori; ?>" class="float-right text-white"><i class="fa fa-sort"></i> </a></th>
                <th>Judul SK <a href="<?php echo base_url(); ?>file/fkl_sk_urut_judul/<?php echo $kategori; ?>" class="float-right text-white"><i class="fa fa-sort"></i> </a></th>
                <th>Nama File <a href="<?php echo base_url(); ?>file/fkl_sk_urut_nama_file/<?php echo $kategori; ?>" class="float-right text-white"><i class="fa fa-sort"></i> </a></th>
                <th>Unit <a href="<?php echo base_url(); ?>file/fkl_sk_urut_unit/<?php echo $kategori; ?>" class="float-right text-white"><i class="fa fa-sort"></i> </a></th>
                <th style="column-width: 80px;">Tahun <a href="<?php echo base_url(); ?>file/fkl_sk_urut_tahun/<?php echo $kategori; ?>" class="float-right text-white"><i class="fa fa-sort"></i> </a></th>
                <th colspan="3">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $no = 1;
                foreach($data->result() as $s){ 
              ?>
              <tr>
                <td class="text-center"><?php echo $no; ?></td>
                <td><?php echo $s->no_sk ?></td>
                <td><?php echo $s->judul ?></td>
                <td><?php echo $s->nama_sk ?></td>
                <td class="text-center"><?php echo $s->departemen ?></td>
                <td class="text-center"><?php $dt = new DateTime($s->date) ; echo $dt->format('Y'); ?></td>
                <td class="text-center">
                  <a href="<?php echo base_url(); ?>file/fkl_sk_hasil/<?php echo $s->id; ?>/<?php echo $s->kategori; ?>" target="_blank"><i class="fa fa-eye text-primary"></i></a>
                </td>
                <td class="text-center">
                  <?php echo anchor('../file/fkl_sk_hapus/'.$s->id_dep.'/'.$s->id.'/'.$s->kategori,'<i class="fa fa-trash text-danger"></i>'); ?>
                </td>
                <td class="text-center">
                  <?php echo anchor('../file/fkl_sk_download/'.$s->id_dep.'/'.$s->id.'/'.$s->kategori,'<i class="fa fa-download text-secondary"></i>'); ?>
                </td>
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
          <h5 class="modal-title">Tambah File SK <?php echo $kategori; ?></h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <?php
          $kat = array(); 
          $x   = 0;
          foreach ($kategori_f_sk as $kat_sk) {
            $kat[$x] = $kat_sk->nama_kategori;
            $x++;
          }
          ?>
          <form method="post" action="<?php echo base_url(); ?>file/upload_f_sk_file/<?php echo $kategori; ?>" enctype="multipart/form-data">
            <div class="form-group">
              <label for="title">No SK</label>
              <input type="text" name="no_sk" autofocus class="form-control" required placeholder="No SK">
            </div>
            <div class="form-group">
              <label for="title">Judul SK/ Deskripsi</label>
              <textarea name="judul" class="form-control" required placeholder="Judul/Deskripsi"></textarea>
            </div>
            <div class="form-group">
              <label for="title">Pilih Unit</label>
              <select id="select_kategori" class="form-control" name="departemen" required>
                <option value="" disabled selected>--Pilih Departemen--</option>
                <?php
                  foreach ($departemen as $d) {
                ?>
                  <option value="<?php echo $d->id_dep; ?>"><?php echo $d->departemen; ?></option>
                <?php
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="title">Kategori SK</label>
              <input class="form-control" type="text" name="kategori" readonly value="<?php echo($kategori); ?>">
            </div>
            <div class="form-group">
              <label for="title">Tahun SK</label><br>
              <input id="input_tahun" class="input_tahun" name="tahun" required type="date">
            </div>
            <div class="form-group">
              <label for="title">File SK</label>
              <div class="file-field">
                  <input id="input_file" class="btn btn-primary btn-sm float-left" type="file" name="sk">
                  <p class="alert-warning">File yang diijinkan hanya yang berekstensi .pdf, .docx, .doc!</p>
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
            $.post("<?php echo base_url(); ?>file/fkl_sk_hasil/<?php echo $kategori; ?>",
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
  
