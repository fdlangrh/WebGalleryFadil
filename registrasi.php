<?php
include 'koneksi.php';
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
            /* Warna latar belakang *
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

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top mb-5 bg-body-tertiary rounded">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">GalleryKu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a style="color:white;" class="nav-link bg-dark rounded-5 p-2" href="galeri.php">Galeri</a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Kategori
                        </a>
                        <ul class="dropdown-menu lg ">
                            <div class="box">
                                <?php
                                $kategori = mysqli_query($conn, "SELECT * FROM tb_album ORDER BY AlbumID DESC");
                                if (mysqli_num_rows($kategori) > 0) {
                                    while ($k = mysqli_fetch_array($kategori)) {
                                        ?>
                                        <a style="color:black;" href="galeri.php?kat=<?php echo $k['AlbumID'] ?>">
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
                <form class="d-flex mt-3" action="galeri.php">
                    <input class="form-control me-2 rounded-5" type="text" name="search" placeholder="Cari Foto" />
                    <input class="btn btn-secondary rounded-5" type="submit" name="cari" value="Cari Foto" />
                </form>
                <button class="btn btn-primary ms-2 mt-3 rounded-5"><a style="color: white;"
                        href="login.php">Login</a></button>

            </div>
        </div>
    </nav>
    <br>
    <br>
    <br>
    <!-- content -->
    <div class="section-0">
        <div class="container-0">
            <h3 class="text-center">Registrasi Akun</h3>
            <div class="box-0 rounded-3">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama User" class="input-control" required>
                    <input type="text" name="user" placeholder="Username" class="input-control" required>
                    <input type="password" name="pass" placeholder="Password" class="input-control" required>
                    <input type="number" name="tlp" placeholder="Nomor Telpon" class="input-control" required>
                    <input type="Email" name="email" placeholder="E-mail" class="input-control" required>
                    <input type="text" name="almt" placeholder="Alamat" class="input-control" required>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                </form>
                <?php
                if (isset($_POST['submit'])) {

                    $nama = ucwords($_POST['nama']);
                    $username = $_POST['user'];
                    $password = $_POST['pass'];
                    $telpon = $_POST['tlp'];
                    $mail = $_POST['email'];
                    $alamat = ucwords($_POST['almt']);
                
                    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                
                   
                    $check_username = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
                    if (mysqli_num_rows($check_username) > 0) {
                        echo '<script>alert("Username sudah digunakan, silakan gunakan username lain")</script>';
                    } else {
                        $insert = mysqli_query($conn, "INSERT INTO tb_user (nama, username, password, telpon, email, alamat) VALUES (
                                            '$nama',
                                            '$username',
                                            '$hashed_password',
                                            '$telpon',
                                            '$mail',
                                            '$alamat')
                                            
                                            ");
                        if ($insert) {
                            echo '<script>alert("Registrasi berhasil")</script>';
                            echo '<script>window.location="login.php"</script>';
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>