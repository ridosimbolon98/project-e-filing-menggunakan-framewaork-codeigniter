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
          foreach ($kategori_sk as $ks) {
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
          foreach ($kategori_sk as $ks) {
        ?>
          <a class="dropdown-item" href="<?php echo base_url(); ?>file/fkl_nsk_tampil/<?php echo $ks->nama_kategori; ?>"><i class="fa fa-file"></i> Dokumen <?php echo $ks->nama_kategori; ?></a>
        <?php
         }
        ?>
      </div>
    </div>
  </div>

<div id="halaman">

  <div class="container pt-3 mb-5">

      <div class="row mb-3">   
        <div class="col-sm-12">
          <h3 class="pl-1"><i class="fa fa-pie-chart"></i> DASHBOARD HALAMAN ADMIN FAKULTAS</h3>
        </div>
      </div>

    <div class="card ml-1 mb-4">
      <p class="pl-3 pt-3 card-header text-white bg-primary"><i class="fa fa-tags"></i> Info Data</p>
      <div class="row pl-3 pr-3 pt-3">
        <div class="col-sm-4">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $file_sk ?></h3>
              <p>Dokumen SK</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder-open"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/fkl_sk" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $file_nsk ?></h3>
              <p>Dokumen Non-SK</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder-open-o"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/fkl_non_sk" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $kategori ?></h3>
              <p>Kategori File</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-o"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/fkl_kategori_file" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="card ml-1 mb-4">
      <p class="pl-3 pt-3 card-header text-white bg-primary"><i class="fa fa-tags"></i> Chart Jumlah Data Berdasarkan Departemen</p>
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
  
