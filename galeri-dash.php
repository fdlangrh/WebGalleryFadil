<?php
error_reporting(0);
include 'koneksi.php';
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
$a = mysqli_fetch_object($kontak);
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
            .container-1 {
            column-count: 3;
            column-gap: 10px;
            padding: 20px;
        }

        .item {
            display: inline-block;
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
            /* untuk memastikan shadow tidak muncul di luar item saat hover */
        }

        .item img {
            width: 100%;
            height: auto;
            display: block;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            transition: transform 0.3s ease;
        }

        .item:hover img {
            transform: scale(1.05);
        }

        .item-content {
            padding: 10px;
        }

        .item-content h3 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }

        .item-content p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #666;
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
    <!-- header -->
<br>
<br>
<br>
    <!-- new product -->
    <center>
        <h1>GalleryKu</h1>
    </center>
    <div class="container-2">
        <?php
        if ($_GET['search'] != '' || $_GET['kat'] != '') {
            $where = "AND image_name LIKE '%" . $_GET['search'] . "%' AND category_id LIKE '%" . $_GET['kat'] . "%' ";
        }
        $foto = mysqli_query($conn, "SELECT * FROM tb_foto WHERE image_status = 1 $where ORDER BY image_id DESC");
        if (mysqli_num_rows($foto) > 0) {
            while ($p = mysqli_fetch_array($foto)) {
                ?>

                <div class="image-container">
                    <img src="foto/<?php echo $p['image'] ?>" />
                </div>

            <?php }
        } else { ?>
            <p>Foto tidak ada</p>
        <?php } ?>
    </div>
    </section>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>