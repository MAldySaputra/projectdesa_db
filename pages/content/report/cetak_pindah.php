<?php
    // Mulai sesi jika belum dimulai
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Periksa apakah pengguna sudah login
    if (!isset($_SESSION['role'])) {
        // Jika belum login, redirect ke halaman login
        header("Location: ../../../login");
        exit();
    }

    // Periksa apakah pengguna memiliki peran super admin atau admin
    if ($_SESSION['role'] !== 'super admin' && $_SESSION['role'] !== 'admin') {
        // Jika bukan super admin atau admin, tampilkan pesan atau redirect ke halaman lain
        header("Location: ../../../login");
        exit();
    }
?>

<?php
	include "../../../config/db.php";
	
	if (isset($_POST['btnCetak'])) {
		$id_pindah = $_POST['id_pindah'];
	}

	$tanggal = date("m/y");
	$tgl = date("d/m/y");

	// Establish a database connection
	$db_connect = mysqli_connect("localhost", "root", "", "projectdesa_db");

	// Check the connection
	if (!$db_connect) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql_tampil = "SELECT * FROM tbl_pindah WHERE id_pindah = '$id_pindah'";
	$query_tampil = mysqli_query($db_connect, $sql_tampil);

	if (!$query_tampil) {
		die("Query failed: " . mysqli_error($db_connect));
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>CETAK SURAT PINDAH</title>
<link href="../../../assets/img/hero-img.png" rel="icon">
</head>

<body>
	<center>

		<h2>PEMERINTAH KABUPATEN KARAWANG</h2>
		<h3>KECAMATAN TEMPURAN 
			<br>DESA PAGADUNGAN</h3>
		<p>________________________________________________________________________</p>

		<?php
			$sql_tampil = "select m.id_pindah, m.tanggal_pindah, m.alasan, p.nik, p.nama, p.alamat, p.tanggal from tbl_pindah m inner join tbl_penduduk p on 
			m.id_penduduk=p.id_penduduk
			where id_pindah ='$id_pindah'";
			
			$query_tampil = mysqli_query($db_connect, $sql_tampil);
			$no=1;
			while ($data = mysqli_fetch_array($query_tampil,MYSQLI_BOTH)) {
		?>
	</center>

	<center>
		<h4>
			<u>SURAT KETERANGAN PINDAH</u>
		</h4>
		<h4>No Surat :
			<?php echo $data['id_pindah']; ?>/Ket.pindah/
			<?php echo $tanggal; ?>
		</h4>
	</center>
	<p>Yang bertanda tangan dibawah ini Kepala Desa Pagadungan, Kecamatan Tempuran, Kabupaten Karawang, dengan ini menerangkan
		bahwa :</P>
	<table>
		<tbody>
			<tr>
				<td>NIK</td>
				<td>:</td>
				<td>
					<?php echo $data['nik']; ?>
				</td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>
					<?php echo $data['nama']; ?>
				</td>
			</tr>
			<tr>
				<td>TTL</td>
				<td>:</td>
				<td>
					<?php echo $data['alamat']; ?> /
					<?php echo $data['tanggal']; ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<p>Telah benar-benar Pindah dari Desa Pagadungan, Kecamatan Tempuran, Kabuputen Karawang.
	<p>Demikian Surat ini dibuat, agar dapat digunakan sebagai mana mestinya.</P>
	<br>
	<br>
	<br>
	<br>
	<br>
	<p align="right">
		Pagadungan,
		<?php echo $tgl; ?>
		<br> KEPALA DESA PAGADUNGAN
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>(         H. Olim Ridwanullah           )
	</p>

	<script>
		window.print();
	</script>

</body>

</html>

<?php
	// Close the database connection when done
	mysqli_close($db_connect);
?>
