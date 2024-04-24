<?php
error_reporting(0);
include 'koneksi.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_user WHERE admin_id = 2");
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
            <a class="navbar-brand" href="#">GalleryKu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a style="color:white;" class="nav-link nav-link bg-dark rounded-5 p-2 active" href="galeri.php">Galeri</a>
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
                                        <a style="color: black; text-decoration:none;"
                                            href="galeri.php?kat=<?php echo $k['AlbumID'] ?>">
                                            <div style="color: black; text-decoration:none;" class="col-56">
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
                <button class="btn btn-primary ms-2 rounded-5"><a style="color: white; text-decoration:none;"
                        href="login.php">Login</a></button>
                        
            </div>
        </div>
    </nav>



    <!-- new product -->
    <center>
        <h1 class="mt-5">GalleryKu</h1>
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

    <div class="container-3">
        <center>
            <h3>Galeri Foto</h3>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>