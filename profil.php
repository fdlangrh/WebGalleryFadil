<?php
error_reporting(0);
session_start();
include 'koneksi.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE admin_id ='" . $_SESSION['id'] . "'");
$d = mysqli_fetch_object($query);

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

    <style>
        .section-0 {
            padding: 20px;
        }

        .container-0 {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .box-0 {
            background-color: #fff;
            /* Warna latar belakang */
            border-radius: 10px;
            /* Sudut border */
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            /* Efek bayangan */
            padding: 20px;
            /* Padding di dalam box */
        }

        .input-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            /* Jarak antar input */
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

    </style>
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
    <br>
    <br>
    <!-- content -->
    <div class="section-0">
        <div class="container-0">
            <h3>Profil</h3>
            <div class="box-0">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control rounded-4"
                        value="<?php echo $d->admin_name ?>" required>
                    <input type="text" name="user" placeholder="Username" class="input-control rounded-4"
                        value="<?php echo $d->username ?>" required>
                    <input type="text" name="hp" placeholder="No Hp" class="input-control rounded-4"
                        value="<?php echo $d->admin_telp ?>" required>
                    <input type="email" name="email" placeholder="Email" class="input-control rounded-4"
                        value="<?php echo $d->admin_email ?>" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="input-control rounded-4"
                        value="<?php echo $d->admin_address ?>" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="btn btn-primary rounded-5">
                </form>
                <?php
                if (isset($_POST['submit'])) {

                    $nama = $_POST['nama'];
                    $user = $_POST['user'];
                    $hp = $_POST['hp'];
                    $email = $_POST['email'];
                    $alamat = $_POST['alamat'];

                    $update = mysqli_query($conn, "UPDATE tb_user SET 
					                  admin_name = '" . $nama . "',
									  username = '" . $user . "',
									  admin_telp = '" . $hp . "',
									  admin_email = '" . $email . "',
									  admin_address = '" . $alamat . "'
									  WHERE admin_id = '" . $d->admin_id . "'");
                    if ($update) {
                        echo '<script>alert("Ubah data berhasil")</script>';
                        echo '<script>window.location="profil.php"</script>';
                    } else {
                        echo 'gagal ' . mysqli_error($conn);
                    }

                }
                ?>
            </div>
<br>
<br>

            <h3>Ganti password</h3>
            <div class="box-0">
                <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                    <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control"
                        required>
                    <input type="submit" name="ubah_password" value="Ganti Password" class="btn btn-danger">
                </form>
                <?php
                if (isset($_POST['ubah_password'])) {

                    $pass1 = $_POST['pass1'];
                    $pass2 = $_POST['pass2'];

                    if ($pass2 != $pass1) {
                        echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
                    } else {
                        $u_pass = mysqli_query($conn, "UPDATE tb_user SET 
									  password = '" . $pass1 . "'
									  WHERE admin_id = '" . $d->admin_id . "'");
                        if ($u_pass) {
                            echo '<script>alert("Ubah data berhasil")</script>';
                            echo '<script>window.location="profil.php"</script>';
                        } else {
                            echo 'gagal ' . mysqli_error($conn);
                        }
                    }

                }
                ?>
            </div>
        </div>
    </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>