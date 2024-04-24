<?php

error_reporting(0);
include 'koneksi.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
$a = mysqli_fetch_object($kontak);

$produk = mysqli_query($conn, "SELECT * FROM tb_foto WHERE image_id = '" . $_GET['id'] . "' ");
$p = mysqli_fetch_object($produk);

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


    <style>
        .section {
            margin-top: 10px;
            padding: 20px 20px 20px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 15px 15px 15px 15px;
        }

        .card {
            display: flex;
            margin-top: 50px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            /* Shadow */
            border-radius: 10px;
            overflow: hidden;
            flex-direction: row;
            /* Menyusun item dalam baris */
        }

        .card-image {
            flex: 1;
            padding: 20px 20px 20px 20px;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-image img {
            max-width: 100%;
            max-height: 100%;

            border-radius: 10px 0 0 10px;
            /* Membuat sudut bulat pada kiri atas dan kiri bawah gambar */
        }

        .card-description {
            flex: 1;
            padding: 20px;
        }


        .like2 {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        .content {
            margin-top: 20px;
        }

        .input-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn1 {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .container-2 {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 65px;
            /* Jarak atas */
        }

        .image-container {
            width: calc(33.33% - 10px);
            /* Lebar total dikurangi jarak antar gambar */
            margin-bottom: 10px;
            /* Jarak antar baris */
            display: flex;
            /* Membuat gambar sejajar */
            justify-content: space-between;
            /* Menyusun gambar ke pinggir */
        }

        .image-container img {
            width: 700px;
            /* Lebar maksimum gambar */
            height: 1000px;
            /* Tinggi gambar menyesuaikan proporsi */
            border-radius: 30px;
            /* Sudut elemen */
            cursor: pointer;
            /* Kursor pointer saat dihover */
            max-height: 270px;
            /* Tinggi gambar maksimum */
            max-width: 700px;
            object-fit: cover;
            /* Memastikan gambar mengisi ruang tanpa merubah aspek */
        }

        .container-3 {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .bot-sec {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .col-21 {
            width: 120px;
            margin: 10px;
            border-radius: 10px;
            overflow: hidden;
        }

        .col-21 img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>

<body>
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
                                            href="galeri.php?kat=<?php echo $k['AlbumID'] ?>">
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
                <form class="d-flex" action="galeri.php">
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



    <!-- image detail -->
    <div class="section">
        <div class="container">
            <div class="card">
                <div class="card-image">
                    <img class="rounded-5" src="foto/<?php echo $p->image ?>" />
                </div>
                <div class="card-description">
                    <h2><b><?php echo $p->image_name ?></b></h2>
                    <h5><br />Kategori : <?php echo $p->category_name ?>
                        <br>Nama User : <?php echo $p->admin_name ?><br />
                        Upload Pada Tanggal : <?php echo $p->date_created ?>
                    </h5>
                    <p>Deskripsi :<br />
                        <?php echo $p->image_description ?>
                    </p>
                    <?php
                    $like = mysqli_query($conn, "SELECT * FROM tb_like WHERE image_id = '" . $_GET['id'] . "' ");
                    $L = mysqli_num_rows($like);
                    $id1 = $_GET['id'];
                    $cek1 = mysqli_query($conn, "SELECT * FROM tb_like WHERE image_id = '$id1' ");
                    if (mysqli_num_rows($cek1)) {
                        while ($cek2 = mysqli_fetch_array($cek1)) {
                            if ($_SESSION['id'] == $cek2['admin_id']) {
                                ?>
                                <form method="POST" action="">
                                    <input type="hidden" name="gam" value="<?php echo $p->image_id ?>">
                                    <input type="hidden" name="idadm" value="<?php echo $_SESSION['a_global']->admin_id ?>"
                                        required>
                                    <input type="hidden" name="adname" value="<?php echo $_SESSION['a_global']->admin_name ?>"
                                        required>
                                    <button name="suka" class="like"> Like <?php echo $L ?> </button>
                                </form>
                            <?php }
                        }
                    } ?>

                    <?php
                    
                    $jumlah_like = mysqli_query($conn, "SELECT * FROM tb_likefoto WHERE image_id = '$id1'");
                    $L = mysqli_num_rows($jumlah_like);
                    ?>
                    <form method="POST" action="">
                        <input type="hidden" name="gam" value="<?php echo $p->image_id ?>">
                        <input type="hidden" name="idadm" value="<?php echo $_SESSION['a_global']->admin_id ?>"
                            required>
                        <input type="hidden" name="adname" value="<?php echo $_SESSION['a_global']->admin_name ?>"
                            required>
                        <button name="suka" class=" btn btn-outline-primary"> Like <?php echo $L ?> </button>
                    </form>
                    <?php
                    $L = 0;
                    if (isset($_POST['suka'])) {
                        $gambar_id = $_POST['gam'];
                        $admin_id = $_SESSION['a_global']->admin_id;
                        $admin_name = $_SESSION['a_global']->admin_name;

                        // Periksa apakah admin sudah melakukan like sebelumnya
                        $cek_like = mysqli_query($conn, "SELECT * FROM tb_likefoto WHERE image_id = '$gambar_id' AND admin_id = '$admin_id'");
                        if (mysqli_num_rows($cek_like) > 0) {
                            // Jika sudah, hapus like
                            $hapus_like = mysqli_query($conn, "DELETE FROM tb_likefoto WHERE image_id = '$gambar_id' AND admin_id = '$admin_id'");
                            if ($hapus_like) {
                                echo '<script>window.location="detail-image-dashboard.php?id=' . $_GET['id'] . '"</script>';
                            } else {
                                echo 'gagal ' . mysqli_error($conn);
                            }
                        } else {
                            // Jika belum, tambahkan like
                            $tambah_like = mysqli_query($conn, "INSERT INTO tb_likefoto (image_id, admin_id, admin_name, tanggal_like) VALUES ('$gambar_id', '$admin_id', '$admin_name', NOW())");
                            if ($tambah_like) {
                                echo '<script>window.location="detail-image-dashboard.php?id=' . $_GET['id'] . '"</script>';
                            } else {
                                echo 'gagal ' . mysqli_error($conn);
                            }
                        }
                    }



                    ?>
                    <br />

                    <!-- komentar -->
                    <form action="" method="POST">
                        <input type="hidden" name="image" value="<?php echo $p->image_id ?>">
                        <input type="hidden" name="adminid" value="<?php echo $_SESSION['a_global']->admin_id ?>"
                            required>
                        <input type="hidden" name="adminnm" value="<?php echo $_SESSION['a_global']->admin_name ?>"
                            required>
                        <textarea name="komentar" class="input-control" maxlength="80" placeholder="Tulis Komentar..."
                            required></textarea>
                        <input type="submit" name="submit" value="Kirim" class="btn btn-primary">
                    </form>
                    <?php
                    $komentar = mysqli_query($conn, "SELECT * FROM tb_komentarfoto WHERE image_id = '" . $_GET['id'] . "' ");
                    $kom = mysqli_num_rows($komentar);
                    if (isset($_POST['submit'])) {
                        $image = $_POST['image'];
                        $adminid = $_POST['adminid'];
                        $adminnm = $_POST['adminnm'];
                        $komen = $_POST['komentar'];
                        $insert = mysqli_query($conn, "INSERT INTO tb_komentarfoto VALUES (
						               null,
									   '" . $image . "',
									   '" . $adminid . "',
									   '" . $adminnm . "',
									   '" . $komen . "',
									    CURRENT_TIMESTAMP
									   ) ");
                        if ($insert) {
                            echo '<script>window.location="detail-image-dashboard.php? id=' . $_GET['id'] . '"</script>';
                        } else {
                            echo 'gagal' . mysqli_error($conn);
                        }
                    }
                    ?>

                    <br />
                    <div class="content">
                        <h3>Komentar <?php echo $kom ?></h3>
                        <div class="">
                            <?php
                            $up = mysqli_query($conn, "SELECT * FROM tb_komentarfoto WHERE image_id = '" . $_GET['id'] . "' ORDER BY tanggal_komentar DESC ");
                            if (mysqli_num_rows($up) > 0) {
                                while ($u = mysqli_fetch_array($up)) {
                                    ?>

                                    <div class="inpu">
                                        <h4><?php echo $u['admin_name'] ?><br /></h4>
                                        <h5> <?php echo $u['isi_komentar'] ?><br /></h5>
                                        <h6> <?php echo $u['tanggal_komentar'] ?></h6>
                                    </div>
                                    <?php
                                    if ($_SESSION['id'] == $u['admin_id']) {
                                        ?>
                                        <div class="inpu2">
                                            <form action="" method="POST">
                                                <input type="hidden" name="image_id" value="<?php echo $p->image_id ?>" />
                                                <input type="hidden" name="hapus" value="<?php echo $u['komentarID'] ?>" />

                                                <button style="border:none; cursor:pointer;" name="hapuskomen"
                                                    onclick="return confirm('Yakin Ingin Hapus ?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                                        viewBox="0 0 30 30">
                                                        <path
                                                            d="M 13 3 A 1.0001 1.0001 0 0 0 11.986328 4 L 6 4 A 1.0001 1.0001 0 1 0 6 6 L 24 6 A 1.0001 1.0001 0 1 0 24 4 L 18.013672 4 A 1.0001 1.0001 0 0 0 17 3 L 13 3 z M 6 8 L 6 24 C 6 25.105 6.895 26 8 26 L 22 26 C 23.105 26 24 25.105 24 24 L 24 8 L 6 8 z">
                                                        </path>
                                                    </svg> </button>
                                            </form>
                                        </div>
                                        <?php
                                        if (isset($_POST['hapuskomen'])) {
                                            if (isset($_SESSION['id'])) {
                                                $user_id = $_SESSION['id'];
                                                $image_id = $_POST['image_id'];
                                                $comment_id = $_POST['hapus'];
                                                mysqli_query($conn, "DELETE FROM tb_komentarfoto WHERE image_id='$image_id' && admin_id='$user_id' && komentarID='$comment_id'");
                                                echo '<script>window.location="detail-image-dashboard.php?id=' . $_GET['id'] . '"</script>';
                                            } else {
                                                echo 'gagal' . mysqli_error($conn);
                                            }
                                        }
                                    }
                                    ?>
                                <?php }
                            } else { ?>
                                <p>komentar tidak ada</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <div class="container-3">
                <center>
                    <h3>Lebih banyak foto untuk di jelajahi</h3>
                </center>
                <div class="bot-sec">
                    <?php
                    if ($_GET['search'] != '' || $_GET['kat'] != '') {
                        $where = "AND image_name LIKE '%" . $_GET['search'] . "%' AND category_id LIKE '%" . $_GET['kat'] . "%' ";
                    }
                    $foto = mysqli_query($conn, "SELECT * FROM tb_foto WHERE image_status = 1 $where ORDER BY image_id DESC");
                    if (mysqli_num_rows($foto) > 0) {
                        while ($p = mysqli_fetch_array($foto)) {
                            ?>
                            <a href="detail-image.php?id=<?php echo $p['image_id'] ?>">
                                <div class="col-21">
                                    <img class="rounded-5" src="foto/<?php echo $p['image'] ?>" />
                                </div>
                            </a>
                        <?php }
                    } else { ?>
                        <p>Foto tidak ada</p>
                    <?php } ?>
                </div>
            </div>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>
</body>

</html>