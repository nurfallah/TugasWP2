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

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="style.css">
	<link rel="shortcut icon" href="avatar/logo.jpg"/>
	
	<style>
		.content {
			margin-top: 0px;
		}
		.btn-file {
			position: relative;
			overflow: hidden;
		}
		.btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0;
			min-width: 100%;
			min-height: 100%;
			font-size: 100px;
			text-align: right;
			filter: alpha(opacity=0);
			opacity: 0;
			background: red;
			cursor: inherit;
			display: block;
		}
		input[readonly] {
			background-color: white !important;
			cursor: text !important;
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
  			<li><a href="logout.php" onclick="return confirm('Yakin Akan Keluar Halaman Admin?')"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
  		</ul>
  	</div>
  </nav>
	<div class="container">
		<div class="content">
			<h2>Upload Avatar</h2>
			<hr />
			<p>Upload Avatar Dengan NIP <b><?php echo $_GET['nip']; ?></b></p>
			<?php
			$nip = $_GET['nip'];
			
			$sql = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nip='$nip'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			
			if(isset($_FILES['fileToUpload'])){
				$target_dir = "avatar/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

				if(isset($_POST["upload"])) {
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check !== false) {
						$uploadOk = 1;
					} else {
						echo "File is not an image.";
						$uploadOk = 0;
					}
				}

				if ($_FILES["fileToUpload"]["size"] > 500000) {
					echo '<div class="alert alert-danger">File size terlalu besar.</div>';
					$uploadOk = 0;
				}

				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
					echo '<div class="alert alert-danger">Hanya JPG, JPEG, PNG & GIF yang di izinkan.</div>';
					$uploadOk = 0;
				}

				if ($uploadOk == 0) {
					echo '<div class="alert alert-danger">File gagal di upload.</div>';
				} else {
					$file = $target_dir.''.$nip.'.'.$imageFileType;
					$new_nip = $nip.'.'.$imageFileType;
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file)) {
						$up = mysqli_query($koneksi, "UPDATE karyawan SET foto='$new_nip' WHERE nip='$nip'");
						if($up){
							header("Location: avatar.php?nip=".$nip."&sukses=ya");
						}
					} else {
						echo '<div class="alert alert-danger">File gagal di upload.</div>';
					}
				}
			}
			
			if(isset($_GET['sukses']) == 'ya'){
				echo '<div class="alert alert-success">File berhasil di upload.</div>';
			}
			?>
			<div class="col-md-6 col-md-offset-3 text-center">
				<img class="img-responsive center-block" src="avatar/<?php echo $row['foto']; ?>" width="150"><br />
				<form class="form-inline" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-sm-10">
							<div class="input-group">
								<span class="input-group-btn">
									<span class="btn btn-primary btn-file">
										Browse&hellip; <input type="file" name="fileToUpload">
									</span>
								</span>
								<input type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="col-sm-2">
							<input type="submit" name="upload" class="btn btn-primary" value="Upload">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
		numFiles = input.get(0).files ? input.get(0).files.length : 1,
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [numFiles, label]);
	});
	
	$(document).ready( function() {
		$('.btn-file :file').on('fileselect', function(event, numFiles, label) {
			var input = $(this).parents('.input-group').find(':text'),
				log = numFiles > 1 ? numFiles + ' files selected' : label;
			if( input.length ) {
				input.val(log);
			} else {
				if( log ) alert(log);
			}
		});
	});
	</script>
</body>
</html>