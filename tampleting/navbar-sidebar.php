<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href=""><img src="../../assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="../../assets/img/user.png" class="img-circle" alt="Avatar"> <span> <?= $_SESSION['nama']  ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li> <a href='#'> <i class="lnr lnr-user"></i>
										<?php
										if ('admin' == 'admin') {
										?>
											<span class="label label-default">Admin</span>
										<?php
										} elseif ('superadmin' == 'superadmin') {
										?>
											<span class="label label-info">Super Admin</span>
										<?php
										}
										?>
									</a>
								</li>
								<li><a href="../auth/Logout.php"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
						<!-- <li>
							<a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
						</li> -->
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="../dashboard/" <?php if ($a_dashboard) { ?> class="active" <?php	} ?>><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="../ayam/" <?php if ($a_ayam) { ?> class="active" <?php	} ?>><i class="lnr lnr-home"></i> <span>Ayam</span></a></li>
						<li><a href="../rekap/" <?php if ($a_rekap) { ?> class="active" <?php	} ?>><i class="lnr lnr-home"></i> <span>Rekap</span></a></li>
						<li><a href="../peramalan/" <?php if ($a_peramalan) { ?> class="active" <?php	} ?>><i class="lnr lnr-home"></i> <span>Peramalan</span></a></li>
						<li><a href="../akun/" <?php if ($a_akun) { ?> class="active" <?php	} ?>><i class="lnr lnr-home"></i> <span>Akun</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->