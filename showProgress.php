<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    include 'header.php';
    $host="localhost";
    $user="postgres";
    $pass="123456";
    $dbname="postgres";

    $cadenaConexion = "host=$host dbname=$dbname user=$user password=$pass";
    $conexion = pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());
    $conexion2 =pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());

    $query = "select count(idl) as lecc from Lecciones where idmod ='2'";
    $realizado = pg_query($conexion, $query);
    $row = pg_fetch_assoc($realizado);
    print_r($row);
    $conteoLeccion = $row['lecc'];
    echo $conteoLeccion;


    $query2 = "select count(comp.idl) as conteo, comp.usuario as usuario from completado comp
    join lecciones lec on lec.idl = comp.idl
    where  lec.idmod = '2' group by comp.usuario ";
    $realizado2 = pg_query($conexion2, $query2);
    if(!$realizado2){
      echo "Hubo un issue";
    }
    while($row2 = pg_fetch_assoc($realizado2)){
      print_r($row2);
      $conteoCompletado = $row2['conteo'];
      $usuario = $row2['usuario'];

      echo $conteoCompletado;
      if($conteoCompletado != 0){
        $completado = ((int)$conteoCompletado/(int)$conteoLeccion) *100;
        $truncado = substr((string)$completado,0, 2 );
        echo $truncado, $usuario;
      }else {
        echo "Usuario pendiente por realizar leccion";
      }

    }



     ?>




  </body>
  <?php


?>
</html>
