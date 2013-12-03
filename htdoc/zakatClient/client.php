
<?php 

// ambil kode nusoap

require_once('lib/nusoap.php');

// buat instansiasi klien, perhatikan urlnya
$alamat=$_POST['Lokasi_Rumah_Zakat'];
if ($alamat=='Yogyakarta') {
	$client = new nusoap_client('http://localhost/zakatYogya/server.php');
}
if ($alamat=='Aceh'){
	$client = new nusoap_client('http://localhost/zakatAceh/server.php');
}
// Panggil metode SOAP dengan parameter nama
$nama=$_POST['Nama_Muzakki'];
$category=$_POST['Kategori_Zakat'];
$result = $client->call('cariData', array('nama_muzakki' => $nama,'kategori'=>$category));

// Tampilkan hasilnya
if ($result){
	$i=count($result);
	echo "<table  border = '1' bgcolor = 'green'  align='center' cellspacing='1'>";
	echo "<tr>";
	echo "<th>Nama</th>";
	echo "<th>Alamat</th>";
	echo "<th>Telepon</th>";
	echo "<th>No.Rekening</th>";
	echo "<th>Jumlah Zakat</th>";
	echo "<th>Kategori Zakat</th>";
	echo "</tr>";
	for($x=0; $x<$i; $x++) {
		echo "<tr>";
		echo "<td align='center'>".$result[$x]['Nama']."</td>";
		echo "<td align='center'>".$result[$x]['Alamat']."</td>";
		echo "<td align='center'>".$result[$x]['Telp']."</td>";
		echo "<td align='center'>".$result[$x]['No_Rek']."</td>";
		echo "<td align='center'>".$result[$x]['Zakat']."</td>";
		echo "<td align='center'>".$result[$x]['Kategori']."</td>";
		echo "</tr>";
	}
} else {
echo"<table border = '1' bgcolor = 'green' align ='center' width ='900'>";
echo "<td><font color ='red' face ='arial' ><B><center> Data Tidak Ditemukan<B></td</font></center>";
}
	?>