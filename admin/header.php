
<!DOCTYPE html>
<html lang="en">
<head>
	<title> AEI - Alfabetización y Evangelismo Internacional</title>
	<meta charset="UTF-8">
	<meta name="description" content="Unica University Template">
	<meta name="keywords" content="event, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="../img/logo-AEI" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="../css/bootstrap.min.css"/>
	<link rel="stylesheet" href="../css/font-awesome.min.css"/>
	<link rel="stylesheet" href="../css/themify-icons.css"/>
	<link rel="stylesheet" href="../css/magnific-popup.css"/>
	<link rel="stylesheet" href="../css/animate.css"/>
	<link rel="stylesheet" href="../css/owl.carousel.css"/>
	<link rel="stylesheet" href="../css/style.css"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<style>
.cancel-button {
    width: auto;
    height: 50px;
    padding: 0;
    font-size: 20px;
    color: #fff;
    text-align: center;
    background: #dddbdb;
    border: 0;
    border-radius: 4px;
    cursor: pointer;
    outline:0;
  }
</style>

	<!-- header section -->
	<header class="header-section">
		<div class="container">
			<!-- logo -->
			<a href="index.php" class="site-logo"><img src="img/logo1.png" alt=""></a>
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			<div class="header-info">
				<form class="newsletter" action= "logout.php">
					<button class="site-btn">Cerrar Sesión</button>
				</form>
			</div>

		</div>


			<!-- Header section  -->
			<nav class="nav-section">
				<div class="container">
					<div class="nav-right">

						<a href="#">Administrador</a>
				

					</div>

				<?php
				include 'funciones.php';
				menuVerTablas();
				 ?>
				</div>
			</nav>

	</header>


</html>
