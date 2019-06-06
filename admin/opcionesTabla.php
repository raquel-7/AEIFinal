<html>
    <head> <link rel='stylesheet' href='main.css'>
        <title>Proyecto</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <body>
   <center>
        <?php
            include 'header.php';
            $table = $_GET["tabla"];
            opcionesTabla($table);
        ?>
        <!-- Footer section -->
      	<footer class="footer-section">
      		<div class="container footer-top">
      			<div class="row">
      				<!-- widget -->
      				<div class="col-sm-6 col-lg-3 footer-widget">
      					<div class="about-widget">
      						<img src="img/logo-AEI.png" alt="">
      						<div class="social pt-1">
      							<a href="https://twitter.com/leiusa"><i class="fa fa-twitter-square"></i></a>
      							<a href="https://www.facebook.com/LEIUSA"><i class="fa fa-facebook-square"></i></a>
      							<a href="https://www.instagram.com/literacy_evangelism/"><i class="fa fa-camera-retro"></i></a>
      						</div>
      					</div>
      				</div>
      				<!-- widget -->
      				<div class="col-sm-6 col-lg-3 footer-widget">
      					<h6 class="fw-title">LINKS ÚTILES</h6>
      					<div class="dobule-link">
      						<ul>
      							<li><a href="index.html">Inicio</a></li>
      							<li><a href="sobre.html">Acerca de</a></li>
      							<li><a href="course.html">Curso</a></li>
      							<li><a href="contact.html">Contacto</a></li>
      						</ul>
      					</div>
      				</div>
      			</div>
      		</div>
      		<!-- copyright -->
      		<div class="copyright">
      			<div class="container">
      				<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
      				&copy;<script>document.write(new Date().getFullYear());</script> Literacy & Evangelism International
      	<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
      			</div>
      		</div>
      	</footer>
    </body>

    </center>
</html>
