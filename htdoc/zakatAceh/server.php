<?php 

// Ambil kode nusoap

require_once('lib/nusoap.php');

// buat instance server

$server = new soap_server;

// daftar kan metode yang bisa diakses

$server->register('cariData');

// buat fungsi dari yang barusan didaftarin

function cariData($nama_muzakki, $kategori) {
if (!$nama_muzakki){
		return new nusoap_fault('Client', '', 'Harus ada nilainya!', '');
	}
	if($conn=mysql_connect("localhost","root","")){
		if ($db = mysql_select_db("zakataceh")){
			$result = mysql_query("SELECT * FROM id_muzakki WHERE kategori='$kategori' AND nama like '%$nama_muzakki%'");
			$i=0;
			while ($row = mysql_fetch_array($result)){
				$Nama=$row['nama'];
				$hasil[$i]=array(
								'Nama' => $Nama,
								'Alamat' => $row['alamat'],
								'Telp' => $row['telp'],
								'No_Rek' => $row['no_rek'],
								'Zakat' => $row['zakat'],
								'Kategori' => $row['kategori']
								);
				$i++;
			}
		} else {
			return new nusoap_fault('Database Server', '', 'Koneksi  ke database gagal!', '');
		}
	} else {
		return new nusoap_fault('Database Server', '', 'Koneksi  ke database gagal!', '');
	}
	
	return $hasil;
}
// gunakan request untuk mencoba memanggil service yang dibuka

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : �;

$server->service($HTTP_RAW_POST_DATA);

?>

