<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login | Web Galeri Foto</title>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

	<style>
		#bg-login {
			background: linear-gradient(to right, #f0f3fa, #d5deef, #b1c9ef, #baaee0, #628ecb, #395886);
		}

		.card {
			border: none;
			border-radius: 15px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		.card-body {
			padding: 40px;
		}

		.btn {
			background-color: #1e88e5;
			border: none;
		}

		.btn:hover {
			background-color: #0d47a1;
		}

		.link-primary {
			color: #1e88e5;
			text-decoration: none;
		}

		.link-primary:hover {
			color: #0d47a1;
		}
	</style>
</head>

<body id="bg-login">
	<div class="container">
		<div class="row justify-content-center align-items-center min-vh-100">
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<h2 class="card-title text-center mb-4" style="color: #C70039;">LOGIN</h2>
						<form action="" method="POST">
							<div class="mb-3">
								<input type="text" name="user" placeholder="Username" class="form-control rounded-2">
							</div>
							<div class="mb-3">
								<input type="password" name="pass" placeholder="Password"
									class="form-control rounded-2">
							</div>
							<div class="d-grid">
								<input type="submit" name="submit" value="Login"
									class="btn btn-primary btn-block rounded-2">
							</div>
						</form>
						<?php
						if (isset($_POST['submit'])) {
							session_start();
							include 'koneksi.php';

							$user = mysqli_real_escape_string($conn, $_POST['user']);
							$pass = mysqli_real_escape_string($conn, $_POST['pass']);

							$cek = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '" . $user . "'AND password = '" . $pass . "'");
							if (mysqli_num_rows($cek) > 0) {
								$d = mysqli_fetch_object($cek);
								$_SESSION['status_login'] = true;
								$_SESSION['a_global'] = $d;
								$_SESSION['id'] = $d->admin_id;
								echo '<script>window.location="dashboard.php"</script>';
							} else {
								echo '<div class="alert alert-danger mt-3" role="alert">
                                    Username atau password anda salah
                                </div>';
							}
						}
						?>
						<div class="text-center mt-3">
							<p>Belum punya akun? daftar <a href="registrasi.php" class="link-primary">DISINI</a></p>
							<p>atau klik <a href="index.php" class="link-primary">Kembali</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>