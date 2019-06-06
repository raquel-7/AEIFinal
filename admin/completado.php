<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/loading-bar.css">
    <title></title>
  </head>
  <body>
  <table class="container-center">
  <tr>
  <th>Usuario</th>

  </tr>

    <?php
    include 'header.php';
    $modulo = $_GET['modulo'];
    $host="localhost";
    $user="postgres";
    $pass="123456";
    $dbname="postgres";

    $cadenaConexion = "host=$host dbname=$dbname user=$user password=$pass";
    $conexion = pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());
    $conexion2 =pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());

    $query = "select count(idl) as lecc from Lecciones where idmod =$modulo";
    $realizado = pg_query($conexion, $query);
    $row = pg_fetch_assoc($realizado);

    $conteoLeccion = $row['lecc'];



    $query2 = "select count(comp.idl) as conteo, comp.usuario as usuario from completado comp
    join lecciones lec on lec.idl = comp.idl
    where  lec.idmod = $modulo group by comp.usuario ";
    $realizado2 = pg_query($conexion2, $query2);
    if(!$realizado2){
      echo "Hubo un issue";
    }
              $cont = 0;
    while($row2 = pg_fetch_assoc($realizado2)) {

      $conteoCompletado = $row2['conteo'];
      $usuario = $row2['usuario'];

     // echo $conteoCompletado;
      if($conteoCompletado != 0){
        $completado = ((int)$conteoCompletado/(int)$conteoLeccion) *100;
        $truncado = substr((string)$completado,0, 2 );
       // echo $truncado, $usuario;
      }else {
        echo "Usuario pendiente por realizar leccion";
      }



     ?>

  <?php

  ?>
</p>

     <tr>

       <div>
       <td>
       <?php
      echo  $usuario;
     ?>

       </div>




      <div class="container-test">
      <div class="loading-bar-container">
        <div class="loading-bar-indicator">
          <div style="width:<?php print($truncado); ?>%;" class="indicator-spacer">
            <div class="indicator">
              <?php print($truncado); ?>%
            </div>
          </div>
        </div>
        <div class="loading-bar">
        <?php
            echo "<div style='width:$truncado%;' id=myBar$cont class='dynamic-loading-box'>";
            ?>


          <br>
          </div>
        </div>
      </div>
    </div>


 </td>
    </tr>

     </table>

   <?php
     $cont++;
}
       echo "<p id='cont'> $cont <p>";
?>
<script>
console.log( "Empezamos");
var cont = document.getElementById("cont").innerHTML;
console.log(cont, "Contador");
var j = 0;
    var id = setInterval(frame, 10);

    function frame() {
      j = j +1;
  for (var i = 0; i < cont; i++){
    var elem = document.getElementById("myBar"+ i);
    // console.log(elem, "mybar");
    var widthphp = document.getElementById("gato"+i).innerHTML;
    // console.log(widthphp, "widthphp");
      if (j == 100){
        clearInterval(id);
      }
        if (j >= widthphp) {
           continue;

        } else {
          console.log("Aqui "+ j);


            elem.style.width = j + '%';


        }
}



    }






</script>
  </body>
</html>
