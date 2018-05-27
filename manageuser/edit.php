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
	<link rel="shortcut icon" href="avatar/logo.jpg"/>
	<link rel="stylesheet" type="text/css" href="style.css">
	
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
			<h2><center>Edit Data Karyawan</center></h2>
			<hr />
			
			<?php
			$nip = $_GET['nip'];
			$sql = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nip='$nip'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
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
				
				$update = mysqli_query($koneksi, "UPDATE karyawan SET nama='$nama', tempat_lahir='$tmp', tanggal_lahir='$tgl', email='$email', jenis_kelamin='$jk', agama='$agama', divisi='$divisi', tahun_masuk='$thn_masuk', alamat='$alamat', status='$status' WHERE nip='$nip'") or die(mysqli_error());
				if($update){
					header("Location: edit.php?nip=".$nip."&pesan=sukses");
				}else{
					echo '<div class="alert alert-danger">Data Gagal Disimpan, Silahkan Coba Lagi.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success">Data Berhasil Disimpan.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">NIP</label>
					<div class="col-sm-2">
						<input type="text" name="nip" class="form-control" value="<?php echo $row['nip']; ?>" placeholder="NIP" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">NAMA LENGKAP</label>
					<div class="col-sm-4">
						<input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>" placeholder="NAMA LENGKAP" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">TEMPAT & TANGGAL LAHIR</label>
					<div class="col-sm-3">
						<input type="text" name="tmp" class="form-control" value="<?php echo $row['tempat_lahir']; ?>" placeholder="TEMPAT LAHIR" required>
					</div>
					<div class="col-sm-2">
						<div class="input-group date" data-provide="datepicker">
							<input type="text" name="tgl" class="form-control" value="<?php echo $row['tanggal_lahir']; ?>" placeholder="0000-00-00">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">EMAIL</label>
					<div class="col-sm-3">
						<input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" placeholder="EMAIL" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">JENIS KELAMIN</label>
					<div class="col-sm-2">
						<select name="jk" class="form-control" required>
							<option value="">JENIS KELAMIN</option>
							<option value="Laki-Laki" <?php if($row['jenis_kelamin'] == 'Laki-Laki'){ echo 'selected'; } ?>>LAKI-LAKI</option>
							<option value="Perempuan" <?php if($row['jenis_kelamin'] == 'Perempuan'){ echo 'selected'; } ?>>PEREMPUAN</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">AGAMA</label>
					<div class="col-sm-2">
						<select name="agama" class="form-control">
							<option value="">AGAMA</option>
							<option value="Islam" <?php if($row['agama'] == 'Islam'){ echo 'selected'; } ?>>ISLAM</option>
							<option value="Kristen" <?php if($row['agama'] == 'Kristen'){ echo 'selected'; } ?>>KRISTEN</option>
							<option value="Hindu" <?php if($row['agama'] == 'Hindu'){ echo 'selected'; } ?>>HINDU</option>
							<option value="Budha" <?php if($row['agama'] == 'Budha'){ echo 'selected'; } ?>>BUDHA</option>
							<option value="Katholik" <?php if($row['agama'] == 'Katholik'){ echo 'selected'; } ?>>KATHOLIK</option>
							<option value="Konghucu" <?php if($row['agama'] == 'Konghucu'){ echo 'selected'; } ?>>KONGHUCU</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">DIVISI</label>
					<div class="col-sm-3">
						<select name="divisi" class="form-control">
							<option value="Pemasaran"  <?php if($row['divisi'] == 'Pemasaran'){ echo 'selected'; } ?>>PEMASARAN</option>
							<option value="Teknologi Informasi" <?php if($row['divisi'] == 'Teknologi Informasi'){ echo 'selected'; } ?>>TEKNOLOGI INFORMASI</option>
							<option value="Keuangan" <?php if($row['divisi'] == 'Keuangan'){ echo 'selected'; } ?>>KEUANGAN</option>
							<option value="Produksi" <?php if($row['divisi'] == 'Produksi'){ echo 'selected'; } ?>>PRODUKSI</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">TAHUN MASUK</label>
					<div class="col-sm-2">
						<input type="text" name="tahun_masuk" class="form-control" value="<?php echo $row['tahun_masuk']; ?>" placeholder="TAHUN MASUK">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">ALAMAT</label>
					<div class="col-sm-6">
						<textarea name="alamat" class="form-control" placeholder="ALAMAT"><?php echo $row['alamat']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">STATUS</label>
					<div class="col-sm-2">
						<select name="status" class="form-control" required>
							<option value="">STATUS</option>
							<option value="1" <?php if($row['status'] == '1'){ echo 'selected'; } ?>>AKTIF</option>
							<option value="2" <?php if($row['status'] == '2'){ echo 'selected'; } ?>>TIDAK AKTIF</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-primary" value="SIMPAN">
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