<?php
include("koneksi.php");
include("func.php");

session_start();
	if($_SESSION['status']!="login"){
		header("location:login.php?pesan=belum_login");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Data Karyawan</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="shortcut icon" href="avatar/logo.jpg"/>
	
	<style>
		.content {
			margin-top: 0px;
		}
	</style>
	
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="navbar-header">
			<table>
				<tr>
					<td><img src="avatar/logo.jpg" class="img-responsive" style="max-height:30px"> </td>
					<td><a class="navbar-brand" href="#">Asurance Optimize</a></td>
				</tr>
			</table>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="index.php">HOME</a></li>
  			<li><a href="add.php">TAMBAH KARYAWAN</a></li>
  			<li><a href="about.php">ABOUT</a></li>
  			<li><a href="logout.php" onclick="return confirm('Yakin akan keluar dari halaman web?')"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
  		</ul>
  	</div>
  </nav>
	<div class="container">
		<div class="content">
			<h3><center>Tambah Data Karyawan</center></h3>
			<hr />
			
			<?php
			if(isset($_POST['add'])){
				$nip		= aman($_POST['nip']);
				$nama		= aman($_POST['nama']);
				$tmp		= aman($_POST['tmp']);
				$tgl		= aman($_POST['tgl']);
				$email		= aman($_POST['email']);
				$jk			= aman($_POST['jk']);
				$agama		= aman($_POST['agama']);
				$divisi		= aman($_POST['divisi']);
				$thn_masuk	= aman($_POST['tahun_masuk']);
				$alamat		= aman($_POST['alamat']);
				$status		= aman($_POST['status']);
				
				$cek = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nip='$nip'");
				if(mysqli_num_rows($cek) == 0){
					if($insert = mysqli_query($koneksi, "INSERT INTO karyawan(nip, nama, tempat_lahir, tanggal_lahir, email, jenis_kelamin, agama, divisi, tahun_masuk, alamat, foto, status)VALUES('$nip', '$nama', '$tmp', '$tgl', '$email', '$jk', '$agama', '$divisi', '$thn_masuk', '$alamat', 'avatar.png', '$status')") or die(mysqli_error()));
					if($insert){
							echo '<div class="alert alert-success">Pendaftaran Berhasil Dilakukan.</div>';
						}else{
							echo '<div class="alert alert-danger">Pendaftaran Gagal Dilakukan, Silahkan Coba Lagi.</div>';
						}
					}else{
					echo '<div class="alert alert-danger">NIP Sudah Terdaftar.</div>';
				}
			}
			?>
			
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">NIP</label>
					<div class="col-sm-2">
						<input type="text" name="nip" class="form-control" placeholder="NIP" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">NAMA LENGKAP</label>
					<div class="col-sm-4">
						<input type="text" name="nama" class="form-control" placeholder="NAMA LENGKAP" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">NO HP/TELEPON</label>
					<div class="col-sm-4">
						<input type="number" name="pass2" class="form-control" placeholder="NO HP/TELEPON" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">TEMPAT & TANGGAL LAHIR</label>
					<div class="col-sm-3">
						<input type="text" name="tmp" class="form-control" placeholder="TEMPAT LAHIR" required>
					</div>
					<div class="col-sm-2">
						<div class="input-group date" data-provide="datepicker">
							<input type="text" name="tgl" class="form-control" placeholder="0000-00-00">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">EMAIL</label>
					<div class="col-sm-3">
						<input type="email" name="email" class="form-control" placeholder="EMAIL" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">JENIS KELAMIN</label>
					<div class="col-sm-2">
						<select name="jk" class="form-control" required>
							<option value="">JENIS KELAMIN</option>
							<option value="Laki-Laki">LAKI-LAKI</option>
							<option value="Perempuan">PEREMPUAN</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">AGAMA</label>
					<div class="col-sm-2">
						<select name="agama" class="form-control">
							<option value="">AGAMA</option>
							<option value="Islam">ISLAM</option>
							<option value="Kristen">KRISTEN</option>
							<option value="Hindu">HINDU</option>
							<option value="Budha">BUDHA</option>
							<option value="Katholik">KATHOLIK</option>
							<option value="Konghucu">KONGHUCU</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">DIVISI</label>
					<div class="col-sm-3">
						<select name="divisi" class="form-control">
							<option value="Divisi">DIVISI</option>
							<option value="Pemasaran">PEMASARAN</option>
							<option value="Teknologi Informasi">TEKNOLOGI INFORMASI</option>
							<option value="Keuangan">KEUANGAN</option>
							<option value="Produksi">PRODUKSI</option>
							<option value="Pembelanjaan">PEMBELANJAAN</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">TAHUN MASUK</label>
					<div class="col-sm-2">
						<input type="text" name="thn_masuk" class="form-control" placeholder="TAHUN MASUK">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ALAMAT</label>
					<div class="col-sm-6">
						<textarea name="alamat" class="form-control" placeholder="ALAMAT"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">STATUS</label>
					<div class="col-sm-2">
						<select name="status" class="form-control" required>
							<option value="">STATUS</option>
							<option value="1">TETAP</option>
							<option value="2">KONTRAK</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-primary" value="TAMBAH">
						<a href="index.php" class="btn btn-warning">BATAL</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'yyyy-mm-dd',
	})
	</script>
</body>
</html>