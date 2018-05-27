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
	<link rel="shortcut icon" href="avatar/logo.jpg"/>
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<style>
		.content {
			margin-top: 0px;
		}
	</style>
	
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
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
			<h3><center>Profile Karyawan</center></h3>
			<?php
			$nip = $_GET['nip'];
			
			$sql = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nip='$nip'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			
			if(isset($_GET['aksi']) == 'delete'){
				$delete = mysqli_query($koneksi, "DELETE FROM karyawan WHERE nip='$nip'");
				if($delete){
					echo '<div class="alert alert-danger">Data Berhasil Dihapus.</div>';
				}else{
					echo '<div class="alert alert-info">Data Gagal Dihapus.</div>';
				}
			}
			?>
			<img class="img-responsive img-circle center-block" src="avatar/<?php echo $row['foto']; ?>" width="150"><br />
			<table class="table table-striped">
				<tr>
					<th width="20%">NIP</th>
					<td><?php echo $row['nip']; ?></td>
				</tr>
				<tr>
					<th>NAMA LENGKAP</th>
					<td><?php echo $row['nama']; ?></td>
				</tr>
				<tr>
					<th>TEMPAT & TANGGAL LAHIR</th>
					<td><?php echo $row['tempat_lahir'].', '.tanggal($row['tanggal_lahir']); ?></td>
				</tr>
				<tr>
					<th>EMAIL</th>
					<td><?php echo $row['email']; ?></td>
				</tr>
				<tr>
					<th>JENIS KELAMIN</th>
					<td><?php echo $row['jenis_kelamin']; ?></td>
				</tr>
				<tr>
					<th>AGAMA</th>
					<td><?php echo $row['agama']; ?></td>
				</tr>
				<tr>
					<th>DIVISI</th>
					<td><?php echo $row['divisi']; ?></td>
				</tr>
				<tr>
					<th>TAHUN MASUK</th>
					<td><?php echo $row['tahun_masuk']; ?></td>
				</tr>
				<tr>
					<th>ALAMAT</th>
					<td><?php echo $row['alamat']; ?></td>
				</tr>
				<tr>
					<th>STATUS</th>
					<td><?php if($row['status'] == 1){ echo 'AKTIF'; }else{ echo 'TIDAK AKTIF'; } ?></td>
				</tr>
			</table>
			
			<a href="index.php" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a>
			<a href="edit.php?nip=<?php echo $row['nip']; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Data</a>
			<a href="profile.php?aksi=delete&nip=<?php echo $row['nip']; ?>" class="btn btn-danger" onclick="return confirm('Yakin?')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Hapus Data</a>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>