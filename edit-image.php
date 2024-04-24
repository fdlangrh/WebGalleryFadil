<?php
error_reporting(0);
session_start();
include 'koneksi.php';
if ($_SESSION['status_login'] != true) {
	echo '<script>window.location="login.php"</script>';
}

$produk = mysqli_query($conn, "SELECT * FROM  tb_foto WHERE image_id = '" . $_GET['id'] . "'");
if (mysqli_num_rows($produk) == 0) {
	echo '<script>window.location="data-image.php"</script>';
}
$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WEB Galeri Foto</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>

<body>
	<!-- header -->
	<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top mb-5 bg-body-tertiary rounded">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">GalleryKuDashboard</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
				data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item dropdown ">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
							aria-expanded="false">
							kategori
						</a>
						<ul class="dropdown-menu lg ">
							<div class="box">
								<?php
								$kategori = mysqli_query($conn, "SELECT * FROM tb_album ORDER BY category_id DESC");
								if (mysqli_num_rows($kategori) > 0) {
									while ($k = mysqli_fetch_array($kategori)) {
										?>
										<a style="text-decoration:none; color:black;"
											href="galeri-dash.php?kat=<?php echo $k['category_id'] ?>">
											<div class="col-5">
												<p><?php echo $k['category_name'] ?></p>
											</div>
										</a>
									<?php }
								} else { ?>
									<p>Kategori tidak ada</p>
								<?php } ?>
							</div>
						</ul>
					</li>
				</ul>
				<form class="d-flex" action="galeri-dash.php">
					<input class="form-control me-2 rounded-5" type="text" name="search" placeholder="Cari Foto" />
					<input class="btn btn-secondary rounded-5" type="submit" name="cari" value="Cari Foto" />
				</form>
				<button class="btn btn-primary ms-4 rounded-5"><a style="color: white; text-decoration:none;"
						href="dashboard.php">Dashboard</a></button>
				<button class="btn btn-primary ms-2 rounded-5"><a style="color: white; text-decoration:none;"
						href="profil.php">Profil</a></button>
				<button class="btn btn-primary ms-2 rounded-5"><a style="color: white; text-decoration:none;"
						href="data-image.php">Data
						Foto</a></button>
				<button class="btn btn-danger ms-2 rounded-5"><a style="color: white; text-decoration:none;"
						href="keluar.php">Keluar</a></button>
			</div>
		</div>
	</nav>
<br><br><br>
	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Edit Data Foto</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<input type="text" name="kategori" class="input-control" placeholder="Kategori Foto"
						value="<?php echo $p->category_name ?>" readonly="readonly">
					<input type="text" name="namauser" class="input-control" placeholder="Nama User"
						value="<?php echo $p->admin_name ?>" readonly="readonly">
					<input type="text" name="nama" class="input-control" placeholder="Nama Foto"
						value="<?php echo $p->image_name ?>" required>

					<img src="foto/<?php echo $p->image ?>" width="100px" />
					<input type="hidden" name="foto" value="<?php echo $p->image ?>" />
					<input type="file" name="gambar" class="input-control">
					<textarea class="input-control" name="deskripsi"
						placeholder="Deskripsi"><?php echo $p->image_description ?></textarea><br />
					<select class="input-control" name="status">
						<option value="">--Pilih--</option>
						<option value="1" <?php echo ($p->image_status == 1) ? 'selected' : ''; ?>>Aktif</option>
						<option value="0" <?php echo ($p->image_status == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
					</select>
					<input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php
				if (isset($_POST['submit'])) {

					// data inputan dari form
					$kategori = $_POST['kategori'];
					$user = $_POST['namauser'];
					$nama = $_POST['nama'];
					$deskripsi = $_POST['deskripsi'];
					$status = $_POST['status'];
					$foto = $_POST['foto'];

					// data gambar yang baru 
					$filename = $_FILES['gambar']['name'];
					$tmp_name = $_FILES['gambar']['tmp_name'];

					//jika admin ganti gambar
					if ($filename != '') {

						$type1 = explode('.', $filename);
						$type2 = $type1[1];

						$newname = 'foto' . time() . '.' . $type2;

						// menampung data format file yang diizinkan
						$tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

						// validasi format file
						if (!in_array($type2, $tipe_diizinkan)) {
							// jika format file tidak ada di dalam tipe diizinkan
							echo '<script>alert("Format file tidak diizinkan")</script>';

						} else {
							unlink('./foto/' . $foto);
							move_uploaded_file($tmp_name, './foto/' . $newname);
							$namagambar = $newname;
						}

					} else {
						// jika admin tidak ganti gambar
						$namagambar = $foto;

					}

					//query update data produk
					$update = mysqli_query($conn, "UPDATE tb_foto SET
					                       category_name       = '" . $kategori . "',
										   admin_name          = '" . $user . "',
										   image_name          = '" . $nama . "',
										   image_description   = '" . $deskripsi . "',
										   image               = '" . $namagambar . "',
										   image_status        = '" . $status . "'
										   WHERE image_id      = '" . $p->image_id . "' ");
					if ($update) {
						echo '<script>alert("Ubah data berhasil")</script>';
						echo '<script>window.location="data-image.php"</script>';
					} else {
						echo 'gagal' . mysqli_error($conn);

					}
				}
				?>
			</div>
		</div>
	</div>

	<!-- footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2024 - Web Galeri Foto.</small>
		</div>
	</footer>
	<script>
		CKEDITOR.replace('deskripsi');
	</script>
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>