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
      <a href="#" class="dropdown-item" data-toggle="collapse" data-target="#collapseSK" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-folder"></i> Dokumen SK 
      <i class="fa fa-arrow-circle-down float-right"></i></a>
      <div class="collapse pl-3" id="collapseSK">
        <?php
          foreach ($kategori_sk as $ks) {
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
          foreach ($kategori_sk as $ks) {
        ?>
          <a class="dropdown-item" href="<?php echo base_url(); ?>file/f_nsk_tampil/<?php echo $ks->nama_kategori; ?>"><i class="fa fa-file"></i> Dokumen <?php echo $ks->nama_kategori; ?></a>
        <?php
         }
        ?>
      </div>
    </div>
  </div>

<div id="halaman">

  <div class="container pt-3">

    <div class="card ml-1 mb-4">
      <div class="row">   
        <div class="col-sm-12">
          <h3 class="card-header"><i class="fa fa-pie-chart"></i> DASHBOARD HALAMAN ADMIN UP2TI</h3>
        </div>
      </div>
    </div>

    <div class="card ml-1 mb-4">
      <p class="pl-3 pt-3 card-header text-dark bg-light"><i class="fa fa-tags"></i> Tambah Data</p>
      <div class="row p-3">
        <div class="col-sm-6">
          <a class="btn btn-success form-control" data-toggle="modal" data-target="#tambahAkunModal" href="#"><i class="fa fa-plus-circle"></i> Tambah Akun Admin</a>
        </div>
        <div class="col-sm-6">
          <a class="btn btn-warning form-control" data-toggle="modal" data-target="#tambahKategoriModal" href="#"><i class="fa fa-plus-circle"></i> Tambah Kategori File</a>
        </div>
      </div>
    </div>

    <div class="card ml-1 mb-4">
      <p class="pl-3 pt-3 card-header text-dark bg-light"><i class="fa fa-tags"></i> Info Data</p>
      <div class="row pl-3 pr-3 pt-3">
        <div class="col-sm-3">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $akun ?></h3>
              <p>Daftar Akun</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder-open"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/daftar_akun" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $file_sk ?></h3>
              <p>Dokumen SK</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder-open"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/f_sk" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $file_nsk ?></h3>
              <p>Dokumen Non-SK</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder-open-o"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/f_non_sk" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $kategori ?></h3>
              <p>Kategori File</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-o"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/kategori_file" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="card ml-1 mb-4">
      <p class="pl-3 pt-3 card-header text-dark bg-light"><i class="fa fa-tags"></i> Chart Jumlah Data Berdasarkan Departemen</p>
      <div class="row pl-3 pr-3 mb-3 pt-3">
        <div class="col-sm-6">
          <div class="bg-light">
            <p class="judul"><i class="fa fa-pie-chart"></i> Perdandingan Jumlah Data File SK Per Departemen</p>
            <canvas id="myChart1"></canvas>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="bg-light">
            <p class="judul"><i class="fa fa-pie-chart"></i> Perdandingan Jumlah Data File Non-SK Per Departemen</p>
            <canvas id="myChart2"></canvas>
          </div>
        </div>
      </div>
    </div>

    </div>
  </div>

</div>

<!--TAMBAH AKUN MODAL-->
<div class="modal fade" id="tambahAkunModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Tambah Akun Admin</h5>
        <button class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url(); ?>admin/tambah_akun">
          <div class="form-group">
            <label for="title">Nama Admin</label>
            <input type="text" name="nama" autofocus class="form-control" required placeholder="Nama Admin">
          </div>
          <div class="form-group">
            <label for="title">Username</label>
            <input type="text" name="username" class="form-control" required placeholder="Username/Email">
          </div>
          <div class="form-group">
            <label for="title">Password</label>
            <input type="password" name="password" class="form-control" required placeholder="Password">
          </div>
          <div class="form-group">
            <label for="title">Level</label>
            <select name="level" class="form-control" required>
              <option value="" disabled selected>--Pilih Level Admin--</option>
              <option value="departemen">Admin Departemen</option>
              <option value="admin_fakultas">Admin Fakultas</option>
              <option value="admin">Admin UP2TI</option>
            </select>
          </div>
          <div class="form-group">
            <label for="title">Kategori Admin</label>
            <select class="form-control" name="kategori" required>
              <option value="" disabled selected>--Pilih Kategori--</option>
              <option value="1">Departemen Matematika</option>
              <option value="2">Departemen Fisika</option>
              <option value="3">Departemen Kimia</option>
              <option value="4">Departemen Biologi</option>
              <option value="5">Departemen Statistika</option>
              <option value="6">Departemen Ilmu Komputer/Informatika</option>
              <option value="7">Admin Fakultas</option>
              <option value="8">Admin UP2TI</option>
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
<!-- AKHIR TAMBAH AKUN MODAL -->

<!--TAMBAH KATEGORI MODAL-->
<div class="modal fade" id="tambahKategoriModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Tambah Kategori File</h5>
        <button class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url(); ?>admin/tambah_kategori_file">
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

<script>
  //CHART PIE UNTUK SK
  var cdata1 = document.getElementById("myChart1").getContext('2d');
  var myChart1 = new Chart(cdata1, {
    type: 'pie',
    data: {
      labels: [<?php foreach ($akun_r as $d) {
        echo '"' . $d->departemen. '",';
      } ?>],
      datasets: [
      {
        data: [
          <?php echo $file_sk1; ?>,
          <?php echo $file_sk2; ?>,
          <?php echo $file_sk3; ?>,
          <?php echo $file_sk4; ?>,
          <?php echo $file_sk5; ?>,
          <?php echo $file_sk6; ?>
        ],
        backgroundColor: [
        '#3c8dbc',
        '#32ba54',
        '#d17995',
        '#6d756a',
        '#c6b925',
        '#d35832'
        ],
        borderWidth: 1
      }
      ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });

  //CHART PIE UNTUK NON-SK
  var cdata2 = document.getElementById("myChart2").getContext('2d');
  var myChart2 = new Chart(cdata2, {
    type: 'pie',
    data: {
      labels: [<?php foreach ($akun_r as $d) {
        echo '"' . $d->departemen. '",';
      } ?>],
      datasets: [
      {
        data: [
          <?php echo $file_nsk1; ?>,
          <?php echo $file_nsk2; ?>,
          <?php echo $file_nsk3; ?>,
          <?php echo $file_nsk4; ?>,
          <?php echo $file_nsk5; ?>,
          <?php echo $file_nsk6; ?>
        ],
        backgroundColor: [
        '#3c8dbc',
        '#32ba54',
        '#d17995',
        '#6d756a',
        '#c6b925',
        '#d35832'
        ],
        borderWidth: 1
      }
      ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
  //CHART BAR UNTUK FILE NON-SK
</script>
      

</body>
</html>
  
