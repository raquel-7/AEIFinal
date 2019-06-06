<!DOCTYPE html>
<html lang="en">
<head>
<title>Módulos - AEI</title>
	<meta charset="UTF-8">
	<meta name="description" content="Unica University Template">
	<meta name="keywords" content="event, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/logo-AEI" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/themify-icons.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>
</head>
<body>


    <?php
    include "header.php";
		$host="localhost";
    $user="postgres";
    $pass="123456";
    $dbname="postgres";
    $cadenaConexion = "host=$host dbname=$dbname user=$user password=$pass";
    $dbconn = pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());

		$sql_grupo = "SELECT * FROM modulo";
		$result = pg_query($dbconn, $sql_grupo);
		if (!$result) {
			echo "Ocurrió un error con query (modulos.php).\n";
			exit;
		}
	?>


	<!-- Courses section -->
	<section class="full-courses-section spad pt-0">
		<div class="container">
			<div class="row">
				<?php
				while ($row2 = pg_fetch_array($result)) {
					$idmod = $row2['idmod'];
					$titulo = $row2['titulo'];
					$descripcion = $row2['descripcion'];
					$imagen = $row2['imagen'];
				?>
				<!-- course item -->
				<div class="col-lg-4 col-md-6 course-item">
					<div class="course-thumb">

                    <?php
                    imgTag("Modulo","imagen",$idmod);
                    ?>
						<div class="course-cat">
							<a href="completado.php?modulo=<?php echo $idmod ?>"><span>Ver Progreso</span></a>
						</div>
					</div>
					<div class="course-info">
						<h4>Módulo <?php echo $idmod ?> <br> <?php echo $titulo ?></h4>
					</div>
				</div>
				<?php
				}
				?>

	</section>
</body>
</html>
