<?php

class M_data extends CI_Model{
	public function __construct()
    {
        parent::__construct();
    }
    
	function get_kategori($table){
		$sql = "SELECT * FROM $table";
		return $this->db->query($sql);
	}

	function get_departemen($table){
		$sql = "SELECT * FROM $table";
		return $this->db->query($sql);
	}

	function get_akun($table,$table2){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`kategori`=`$table2`.`id_dep` ";
		return $this->db->query($sql);
	}

	function get_data_dep($table,$table2){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`kategori`=`$table2`.`id_dep` AND `$table`.`level`='departemen' ORDER BY `$table`.`kategori` ";
		return $this->db->query($sql);
	}

	function cari_akun($table,$table2,$cari){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`kategori`=`$table2`.`id_dep` AND nama like '%".$cari."%'";
		return $this->db->query($sql);
	}

	function cari_kategori($table,$cari){
		$sql = "SELECT * FROM `$table` WHERE nama_kategori like '%".$cari."%'";
		return $this->db->query($sql);
	}

	function get_kat_sk($table,$table2){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`kategori`=`$table2`.`nama_kategori` ORDER BY `$table2`.`id` ";
		return $this->db->query($sql);
	}

	function get_file_cari($table,$kat_admin,$kategori,$cari){
		$sql = "SELECT * FROM `$table` WHERE `$table`.`kategori`='$kategori' AND `$table`.`iddepartemen`='$kat_admin' AND (`$table`.`date` LIKE '%$cari%' OR `$table`.`judul` LIKE '%$cari%' )";
		return $this->db->query($sql);
	}

	function get_file_cari_b_judul($table,$kat_admin,$kategori,$cari){
		$sql = "SELECT * FROM `$table` WHERE `$table`.`kategori`='$kategori' AND `$table`.`iddepartemen`='$kat_admin' AND `judul` LIKE '%$cari%' ";
		return $this->db->query($sql);
	}

	function get_file_cari_b_tahun($table,$kat_admin,$kategori,$cari){
		$sql = "SELECT * FROM `$table` WHERE `$table`.`kategori`='$kategori' AND `$table`.`iddepartemen`='$kat_admin' AND `$table`.`date` LIKE '%$cari%' ";
		return $this->db->query($sql);
	}

	function get_file_list_cari($table,$kat_admin,$kategori,$cari,$limit, $start){
        $sql = "SELECT * FROM `$table` WHERE `$table`.`iddepartemen`='$kat_admin' AND `$table`.`kategori`='$kategori' AND (`$table`.`date` LIKE '%$cari%' OR `$table`.`judul` LIKE '%$cari%' )  LIMIT $start, $limit ";
		return $this->db->query($sql);
    }

    function get_file_list_cari_b_judul($table,$kat_admin,$kategori,$cari,$limit, $start){
        $sql = "SELECT * FROM `$table` WHERE `$table`.`iddepartemen`='$kat_admin' AND `$table`.`kategori`='$kategori' AND `$table`.`judul` LIKE '%$cari%' LIMIT $start, $limit ";
		return $this->db->query($sql);
    }

    function get_file_list_cari_b_tahun($table,$kat_admin,$kategori,$cari,$limit, $start){
        $sql = "SELECT * FROM `$table` WHERE `$table`.`iddepartemen`='$kat_admin' AND `$table`.`kategori`='$kategori' AND `$table`.`date` LIKE '%$cari%'  LIMIT $start, $limit ";
		return $this->db->query($sql);
    }

	function get_file_sk($table){
		$sql = "SELECT * FROM $table";
		return $this->db->query($sql);
	}

	function get_file_sk_dep($table,$iddep){
		$sql = "SELECT * FROM $table WHERE iddepartemen='$iddep' ";
		return $this->db->query($sql);
	}

	function get_file_nsk($table){
		$sql = "SELECT * FROM $table";
		return $this->db->query($sql);
	}

	function get_file_nsk_dep($table,$iddep){
		$sql = "SELECT * FROM $table WHERE iddepartemen='$iddep' ";
		return $this->db->query($sql);
	}

	function get_file($table,$kat_admin,$kategori){
		$sql = "SELECT * FROM `$table` WHERE `$table`.`kategori`='$kategori' AND `$table`.`iddepartemen`='$kat_admin' ";
		return $this->db->query($sql);
	}

	function get_file_list($table,$where,$limit, $start){
        $query = $this->db->get_where($table, $where, $limit, $start);
        return $query;
    }






	//fakultas
	function get_file_f($table,$table2,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' ";
		return $this->db->query($sql);
	}

	function get_file_f_nosk($table,$table2,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`no_sk`";
		return $this->db->query($sql);
	}


	function get_file_f_urut_judul($table,$table2,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`judul`";
		return $this->db->query($sql);
	}

	function get_file_f_urut_nama_file($table,$table2,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`nama_sk`";
		return $this->db->query($sql);
	}

	function get_file_f_urut_unit($table,$table2,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' ORDER BY `$table2`.`departemen`";
		return $this->db->query($sql);
	}

	function get_file_f_tahun($table,$table2,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`date` DESC";
		return $this->db->query($sql);
	}

	function get_file_f_list_nosk($table, $table2, $kategori, $limit, $start){
		$sql = "SELECT * FROM `$table` JOIN `$table2` WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`no_sk` LIMIT $start, $limit ";
		return $this->db->query($sql);
	}

	function get_file_f_list_urut_judul($table, $table2, $kategori, $limit, $start){
		$sql = "SELECT * FROM `$table` JOIN `$table2` WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`judul` LIMIT $start, $limit ";
		return $this->db->query($sql);
	}

	function get_file_f_list_urut_nama_file($table, $table2, $kategori, $limit, $start){
		$sql = "SELECT * FROM `$table` JOIN `$table2` WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`nama_sk` LIMIT $start, $limit ";
		return $this->db->query($sql);
	}

	function get_file_f_list_urut_unit($table, $table2, $kategori, $limit, $start){
		$sql = "SELECT * FROM `$table` JOIN `$table2` WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' ORDER BY `$table2`.`departemen` LIMIT $start, $limit ";
		return $this->db->query($sql);
	}

	function get_file_f_list_tahun($table, $table2, $kategori, $limit, $start){
		$sql = "SELECT * FROM `$table` JOIN `$table2` WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`date` DESC LIMIT $start, $limit ";
		return $this->db->query($sql);
	}

	function get_file_urut_judul_fnsk($table,$table2,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`judul`";
		return $this->db->query($sql);
	}

	function get_file_urut_nama_file_fnsk($table,$table2,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`nama_nsk`";
		return $this->db->query($sql);
	}

	function get_file_fnsk_list_urut_nama_file($table, $table2, $kategori, $limit, $start){
		$sql = "SELECT * FROM `$table` JOIN `$table2` WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`nama_nsk` LIMIT $start, $limit ";
		return $this->db->query($sql);
	}
	//akhir fakultas

	





	function get_file_urut_nosk($table,$kat_admin,$kategori){
		$sql = "SELECT * FROM `$table` WHERE `$table`.`iddepartemen`='$kat_admin' AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`no_sk`";
		return $this->db->query($sql);
	}

	function get_file_urut_judul($table,$kat_admin,$kategori){
		$sql = "SELECT * FROM `$table` WHERE `$table`.`iddepartemen`='$kat_admin' AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`judul`";
		return $this->db->query($sql);
	}

	function get_file_urut_nama_file($table,$kat_admin,$kategori){
		$sql = "SELECT * FROM `$table` WHERE `$table`.`iddepartemen`='$kat_admin' AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`nama_sk`";
		return $this->db->query($sql);
	}

	function get_file_urut_nama_file_nsk($table,$kat_admin,$kategori){
		$sql = "SELECT * FROM `$table` WHERE `$table`.`iddepartemen`='$kat_admin' AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`nama_nsk`";
		return $this->db->query($sql);
	}

	function get_file_list_urut_judul($table,$kat_admin,$kategori,$limit,$start){
		$sql = "SELECT * FROM `$table` WHERE `$table`.`iddepartemen`='$kat_admin' AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`judul` LIMIT $start, $limit ";
		return $this->db->query($sql);
	}

	function get_file_list_urut_nama_file($table,$kat_admin,$kategori,$limit,$start){
		$sql = "SELECT * FROM `$table` WHERE `$table`.`iddepartemen`='$kat_admin' AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`nama_sk` LIMIT $start, $limit ";
		return $this->db->query($sql);
	}

	function get_file_list_urut_nama_file_nsk($table,$kat_admin,$kategori,$limit,$start){
		$sql = "SELECT * FROM `$table` WHERE `$table`.`iddepartemen`='$kat_admin' AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`nama_nsk` LIMIT $start, $limit ";
		return $this->db->query($sql);
	}

	function get_file_list_urut_nosk($table, $kat_admin, $kategori, $limit, $start){
		$sql = "SELECT * FROM `$table` WHERE `$table`.`iddepartemen`='$kat_admin'  AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`no_sk` LIMIT $start, $limit ";
		return $this->db->query($sql);
	}






	function get_file_f_list($table, $table2, $kategori, $limit, $start){
		$sql = "SELECT * FROM `$table` JOIN `$table2` WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' LIMIT $start, $limit ";
		return $this->db->query($sql);
	}

	function get_file_cari_f_list($table, $table2, $kategori, $cari, $limit, $start){
		$sql = "SELECT * FROM `$table` JOIN `$table2` WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND (`$table`.`judul` LIKE '%$cari%' OR `$table`.`date` LIKE '%$cari%' OR `$table2`.`departemen` LIKE '%$cari%') LIMIT $start, $limit ";
		return $this->db->query($sql);
	}

	function get_file_cari_f_list_judul($table, $table2, $kategori, $cari, $limit, $start){
		$sql = "SELECT * FROM `$table` JOIN `$table2` WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND `$table`.`judul` LIKE '%$cari%' LIMIT $start, $limit ";
		return $this->db->query($sql);
	}

	function get_file_cari_f_list_nama_file($table, $table2, $kategori, $cari, $limit, $start){
		$sql = "SELECT * FROM `$table` JOIN `$table2` WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND `$table`.`nama_sk` LIKE '%$cari%' LIMIT $start, $limit ";
		return $this->db->query($sql);
	}

	function get_file_cari_fnsk_list_nama_file($table, $table2, $kategori, $cari, $limit, $start){
		$sql = "SELECT * FROM `$table` JOIN `$table2` WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND `$table`.`nama_nsk` LIKE '%$cari%' LIMIT $start, $limit ";
		return $this->db->query($sql);
	}

	function get_file_cari_f_list_unit($table, $table2, $kategori, $cari, $limit, $start){
		$sql = "SELECT * FROM `$table` JOIN `$table2` WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND `$table2`.`departemen` LIKE '%$cari%' LIMIT $start, $limit ";
		return $this->db->query($sql);
	}

	function get_file_cari_f_list_tahun($table, $table2, $kategori, $cari, $limit, $start){
		$sql = "SELECT * FROM `$table` JOIN `$table2` WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND `$table`.`date` LIKE '%$cari%' LIMIT $start, $limit ";
		return $this->db->query($sql);
	}





	function get_file_urut_tahun($table,$kat_admin,$kategori){
		$sql = "SELECT * FROM `$table` WHERE `$table`.`kategori`='$kategori' AND `$table`.`iddepartemen`='$kat_admin' ORDER BY `$table`.`date` DESC ";
		return $this->db->query($sql);
	}

    function get_file_list_urut_tahun($table,$kat_admin,$kategori,$limit, $start){
        $sql = "SELECT * FROM `$table` WHERE `$table`.`iddepartemen`='$kat_admin' AND `$table`.`kategori`='$kategori' ORDER BY `$table`.`date` DESC  LIMIT $start, $limit ";
		return $this->db->query($sql);
    }

	function get_file_id($table,$kategori,$id){
		$sql = "SELECT * FROM `$table` WHERE `$table`.`kategori`='$kategori' AND `$table`.`id`='$id' ";
		return $this->db->query($sql);
	}

	function get_file_name($table,$kategori,$id){
		$sql = "SELECT nama_sk FROM `$table` WHERE `$table`.`kategori`='$kategori' AND `$table`.`id`='$id' ";
		return $this->db->query($sql);
	}




	function ambil_file($table,$kat_admin,$kategori,$id){
		$sql = "SELECT * FROM $table WHERE iddepartemen='$kat_admin' AND kategori='$kategori' AND id='$id' ";
		return $this->db->query($sql);
	}

	function download_file($table,$kat_admin,$kategori,$id){
		$sql = "SELECT * FROM $table WHERE iddepartemen='$kat_admin' AND kategori='$kategori' AND id='$id' ";
		return $this->db->query($sql);
	}

	function save($table,$data){
		return $this->db->insert($table,$data);
	}

	function hapus_file($table,$kat_admin,$kategori,$id){
		$sql = "DELETE FROM $table WHERE iddepartemen='$kat_admin' AND kategori='$kategori' AND id='$id' ";
		return $this->db->query($sql);
	}

	function ubah_kategori_file($table,$kategori,$id){
		$update = "UPDATE $table SET nama_kategori='$kategori' WHERE id='$id' ";
		return $this->db->query($update);
	}

	function hapus_kategori_file($table,$id){
		$sql = "DELETE FROM $table WHERE id='$id' ";
		return $this->db->query($sql);
	}






	function cari_f_nsk($table,$table2,$cari,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND (`$table`.`judul` LIKE '%$cari%' OR `$table`.`date` LIKE '%$cari%' OR `$table2`.`departemen` LIKE '%$cari%') ";
		return $this->db->query($sql);
	}

	function cari_f_nsk_judul($table,$table2,$cari,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND `$table`.`judul` ";
		return $this->db->query($sql);
	}

	function cari_f_nsk_nama_file($table,$table2,$cari,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND `$table`.`nama_nsk` ";
		return $this->db->query($sql);
	}

	function cari_f_nsk_unit($table,$table2,$cari,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND `$table2`.`departemen` LIKE '%$cari%' ";
		return $this->db->query($sql);
	}

	function cari_f_nsk_tahun($table,$table2,$cari,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND `$table`.`date` LIKE '%$cari%' ";
		return $this->db->query($sql);
	}

	function cari_f_sk($table,$table2,$cari,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND (`$table`.`judul` LIKE '%$cari%' OR `$table`.`date` LIKE '%$cari%' OR `$table2`.`departemen` LIKE '%$cari%') ";
		return $this->db->query($sql);
	}

	function cari_f_sk_judul($table,$table2,$cari,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND `$table`.`judul` LIKE '%$cari%' ";
		return $this->db->query($sql);
	}

	function cari_f_sk_nama_file($table,$table2,$cari,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND `$table`.`nama_sk` LIKE '%$cari%' ";
		return $this->db->query($sql);
	}

	function cari_f_sk_unit($table,$table2,$cari,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND `$table2`.`departemen` LIKE '%$cari%' ";
		return $this->db->query($sql);
	}

	function cari_f_sk_tahun($table,$table2,$cari,$kategori){
		$sql = "SELECT * FROM `$table` JOIN `$table2`  WHERE `$table`.`iddepartemen`=`$table2`.`id_dep` AND `$table`.`kategori`='$kategori' AND `$table`.`date` LIKE '%$cari%' ";
		return $this->db->query($sql);
	}


}