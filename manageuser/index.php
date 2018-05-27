<?php
include("koneksi.php");

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

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="style.css">
	<link rel="shortcut icon" href="avatar/logo.jpg"/>
	<style>
		.content {
			margin-top: 10px;
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
  			<li><a href="logout.php" onclick="return confirm('Yakin Akan Keluar Halaman Admin?')"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
  		</ul>
  	</div>
  </nav>
	<div class="container">
		<div class="content">
			<?php
			if(isset($_GET['aksi']) == 'delete'){
				$nip = $_GET['nip'];
				$cek = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nip='$nip'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info">Data Tidak Ditemukan.</div>';
				}else{
					$delete = mysqli_query($koneksi, "DELETE FROM karyawan WHERE nip='$nip'");
					if($delete){
						echo '<div class="alert alert-danger">Data Berhasil Dihapus.</div>';
					}else{
						echo '<div class="alert alert-info">Data Gagal Dihapus.</div>';
					}
				}
			}
			?>

          	<h4>Selamat datang, <?php echo $_SESSION['email']; ?>!</h4>
			<form class="form-inline" method="get">
				<div class="form-group">
					<select name="urut" class="form-control" onchange="form.submit()">
						<option value="0">Filter</option>
						<?php $urut = (isset($_GET['urut']) ? strtolower($_GET['urut']) : NULL);  ?>
						<option value="1" <?php if($urut == '1'){ echo 'selected'; } ?>>Karyawan Tetap</option>
						<option value="2" <?php if($urut == '2'){ echo 'selected'; } ?>>Karyawan Kontrak</option>
					</select>
				</div>
			</form>
			<br />
			<div class="table-responsive">
			<table class="table ">
				<thead>
				<tr>
					<th>NO.</th>
					<th>NIP</th>
					<th>NAMA LENGKAP</th>
					<th>EMAIL</th>
					<th>JENIS KELAMIN</th>
					<th>DIVISI</th>
					<th>STATUS</th>
					<th>SETTING</th>
				</tr>
				</thead>
				<?php
				if($urut){
					$sql = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE status='$urut' ORDER BY nip ASC");
				}else{
					$sql = mysqli_query($koneksi, "SELECT * FROM karyawan ORDER BY nip ASC");
				}
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">Tidak Ada Data.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['nip'].'</td>
							<td>'.$row['nama'].'</td>
							<td>'.$row['email'].'</td>
							<td>'.$row['jenis_kelamin'].'</td>
							<td>'.$row['divisi'].'</td>
							<td>';
							if($row['status'] == 1){
								echo '<span class="label label-success">Tetap</span>';
							}else if ($row['status'] == 2) {
								echo '<span class="label label-warning">Kontrak</span>';
							}
						echo '
							</td>
							<td>
								<a href="profile.php?nip='.$row['nip'].'" title="Lihat Detail"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
								<a href="edit.php?nip='.$row['nip'].'" title="Rubah Data"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="avatar.php?nip='.$row['nip'].'" title="Ganti Avatar"><span class="glyphicon glyphicon-camera" aria-hidden="true"></span></a>
								<a href="index.php?aksi=delete&nip='.$row['nip'].'" title="Hapus Data" onclick="return confirm(\'Data Akan Dihapus?\')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
						</tr>
						';
						$no++;
					}
				}
				?>
			</table>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>