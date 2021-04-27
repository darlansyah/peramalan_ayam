<?php
include_once '../../functions/functions.php';
if (!empty($_SESSION['level'])) {
	header('location:../dashboard/');
}
$pesan = NULL;
if (isset($_POST['masuk'])) {

	// echo '<pre>';  print_r($_POST); echo '</pre>';	die;
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = mysqli_query($link, "SELECT * FROM akun WHERE username = '$username'");

	if (mysqli_num_rows($query) === 1) {
		$row = mysqli_fetch_assoc($query);
		if ($row['password'] === "$password") {
			$_SESSION['nama'] = $row['nama'];
			$_SESSION['level'] = $row['level'];
			$_SESSION['id'] = $row['id'];
			$waktu = date('Y-m-d H:i:s');
			waktu_login($_SESSION['id'], $waktu);
			header('location:../dashboard/index.php');
		} else {
			$pesan = "Username Atau Password Salah!";
		}
	} else {
		$pesan = "Username Atau Password Salah!";
	}
}

$title = "Login | Peramalan Kamera";
include '../../tampleting/html_head.php';
?>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<p class="lead">Login</p>
							</div>
							<form class="form-auth-small" method="POST">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Username</label>
									<input type="text" class="form-control" id="signin-email" name="username" placeholder="Masukakan Username" required>
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" id="signin-password" name="password" placeholder="Masukakan Password" required>
								</div>
								<button type="submit" name="masuk" class="btn btn-primary btn-lg btn-block">LOGIN</button>
							</form>
							<br />
							<p class="text-danger"><?= $pesan ?></p>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Aplikasi Peramalan Ayam Boider</h1>
							<p>Metode Double Exponential Smoothing Holt</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>