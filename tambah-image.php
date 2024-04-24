<?php
error_reporting(0);
session_start();
include 'koneksi.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WEB Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
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
                                $kategori = mysqli_query($conn, "SELECT * FROM tb_album ORDER BY AlbumID DESC");
                                if (mysqli_num_rows($kategori) > 0) {
                                    while ($k = mysqli_fetch_array($kategori)) {
                                        ?>
                                        <a style="text-decoration:none; color:black;"
                                            href="galeri-dash.php?kat=<?php echo $k['AlbumID'] ?>">
                                            <div class="col-5">
                                                <p><?php echo $k['NamaAlbum'] ?></p>
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
            <h3>Tambah Data Foto</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <?php $result = mysqli_query($conn, "select * from tb_album");
                    $jsArray = "var prdName = new Array();\n";
                    echo '<select class="input-control" name="kategori" onchange="document.getElementById(\'prd_name\').value = prdName[this.value]" required>
  <option>-Pilih Kategori Foto-</option>';
                    while ($row = mysqli_fetch_array($result)) {
                        echo
                            ' <option value="' . $row['AlbumID'] . '">' . $row['NamaAlbum'] . '</option>';
                        $jsArray .= "prdName['" . $row['AlbumID'] . "'] = '" . addslashes($row['NamaAlbum']) . "';\n";
                    }
                    echo '</select>'; ?>
                    </select>
                    <input type="hidden" name="nama_kategori" id="prd_name">
                    <input type="hidden" name="adminid" value="<?php echo $_SESSION['a_global']->admin_id ?>">
                    <input type="text" name="namaadmin" class="input-control"
                        value="<?php echo $_SESSION['a_global']->admin_name ?>" readonly="readonly">
                    <input type="text" name="nama" class="input-control" placeholder="Nama Foto" required>
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br />
                    <input type="file" name="gambar" class="input-control" required>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                </form>
                <?php
                if (isset($_POST['submit'])) {

                    // print_r($_FILES[gambar']);
                    // menampung inputan dari form
                    $kategori = $_POST['kategori'];
                    $nama_ka = $_POST['nama_kategori'];
                    $ida = $_POST['adminid'];
                    $user = $_POST['namaadmin'];
                    $nama = $_POST['nama'];
                    $deskripsi = $_POST['deskripsi'];
                    $status = $_POST['status'];

                    // menampung data file yang diupload
                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

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
                        // jika format file sesuai dengan yang ada di dalam array tipe diizinkan
                        // proses upload file sekaligus insert ke database
                        move_uploaded_file($tmp_name, './foto/' . $newname);

                        $insert = mysqli_query($conn, "INSERT INTO tb_foto VALUES (
						               null,
									   '" . $kategori . "',
									   '" . $nama_ka . "',
									   '" . $ida . "',
									   '" . $user . "',
									   '" . $nama . "',
									   '" . $deskripsi . "',
									   '" . $newname . "',
									   '" . $status . "',
									   null
						                   ) ");

                        if ($insert) {
                            echo '<script>alert("Tambah Foto berhasil")</script>';
                            echo '<script>window.location="data-image.php"</script>';
                        } else {
                            echo 'gagal' . mysqli_error($conn);

                        }
                    }


                }
                ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <script>
        CKEDITOR.replace('deskripsi');
    </script>
    <script type="text/javascript"><?php echo $jsArray; ?></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>