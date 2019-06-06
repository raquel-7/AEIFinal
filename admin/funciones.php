<?php

$FILE_MODIFICAR = "modificarForm.php?";
$FILE_ELIMINAR = "eliminar.php?";
$FILE_UPLOAD = "fileUpload";

// echo "<link rel='stylesheet' href='main.css'>";
function init(){

    $host="localhost";
    $user="postgres";
    $pass="123456";
    $dbname="postgres";
    $cadenaConexion = "host=$host dbname=$dbname user=$user password=$pass";
    $conexion = pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());
    return $conexion;
}

function menuVerTablas(){
    $json_data = getSchemaJSON();
    $keys = array_keys($json_data);

    echo "<ul class='main-menu'>";
    foreach ($keys as $tabla){

        if($tabla == "Completado" ){

            echo "<li> <a class=menu href=modulo.php>$tabla</a></li>";
        }else{
        echo "<li> <a class=menu href=opcionesTabla.php?tabla=$tabla>$tabla</a></li>";
        // echo "<br>";
        }
    }
    echo "</ul>";

}

function opcionesTabla($table){
    echo "<h3>$table</h3>";
   if($table == "Usuario"){
    echo "
      <p><button class='w3-button  w3-round-xlarge'>  <a href=verTabla.php?tabla=$table>Ver $table</a></button></p>


    <p><button  class='cancel-button' style='color: #000'><a class =regresar href=index.php>Menu Principal</a></button></p>";

   }else{
    echo "
    <p><button class='w3-button w3-round-xlarge' style= 'color: #f6783a'><a href=insertarForm.php?tabla=$table>Insertar $table</a></button></p>
      <p><button class='w3-button  w3-round-xlarge'>  <a href=verTabla.php?tabla=$table>Ver $table</a></button></p>


    <p><button  class='cancel-button' style='color: #000'><a class =regresar href=index.php>Menu Principal</a></button></p>";

   }

}

function getSchemaJSON(){
    $json = file_get_contents('./schema.json');
    $json_data = json_decode($json,true);
    return $json_data;
}
function getSchema($table){
    $json_data = getSchemaJSON();
    return $json_data[$table];
}
function insertForm($table){
    echo "<h3 align=center>Agregar $table</h3>";
    $conexion = init();
    $schema = getSchema($table);
    echo "<form action=insertar.php  class=login method=post enctype=multipart/form-data>";
    echo "<input type=hidden name=tabla value=$table>\n";

    $complete = true;
    foreach ($schema as $key => $type) {
      echo"	<label for='inp' class='inp'>";

        if ($key === 'primary_keys' or $key === 'foreign_keys'){
            continue;
        }
        if ($type === 'serial'){
            continue;
        }


        if (!empty($schema['foreign_keys'][$key])){
          if ($schema['foreign_keys'][$key]){
              $refTable = $schema['foreign_keys'][$key];
              $refKey = getSchema($refTable)['primary_keys'][0];
              $descriptor = getDescriptor($refTable);
              $complete = getComboDescriptor($refKey,$descriptor ,$refTable,$key,'');
              if (!$complete){
                  break;
              }
          }
        }
        else{
            mapType($type,$key,'',$table,$key);
            //echo "<input type=$tipo name=$key required>";
        }
        echo "<span class='label'>$key</span>
        <span class='border'></span>";
echo "</label> <br><br>";



    }
    if ($complete){
        echo "<br><br><div>
        <div style='float: left; width: 130px'><button  class='edit-button'>Enviar</button></div>
        <br>
        </div>
        </form>";
    }


    //pg_close($conexion);
    returnOpciones($table);
}
function displayImage($table,$key,$value){
    $conexion = init();
    $schema = getSchema($table);
    $pkey = $schema['primary_keys'][0];
    $query = "Select $key from $table where $pkey = '$value'";
    $resultado = pg_query($conexion, $query) or die('Query failed: ' . pg_last_error($conexion));

    $row=pg_fetch_assoc($resultado);
    header('Content-type: image/png');
    echo pg_unescape_bytea($row[$key]);
    pg_close($conexion);
}
function imgTag($table, $key, $value){
    echo "<img src=show.php?tabla=$table&llave=$key&valor=$value center >";
}
function displayTable($table){
    echo "<h1>$table</h1>";
    $conexion = init();
    $schema = getSchema($table);
    topTable($schema);
    $pkey = $schema['primary_keys'][0];
    $query = "Select * from $table order by $pkey";
    $resultado = pg_query($conexion, $query);
    while ($row=pg_fetch_assoc($resultado)){
        echo "\t<tr>\n";

        foreach ($schema as $key => $type) {
            if ($key === 'primary_keys' or $key === 'foreign_keys'){
                continue;
            }
            if ($type === 'bytea'){
                //echo pg_unescape_bytea($row[$key]);
                echo "\t\t<td>";
                $pkeyT = $schema['primary_keys'][0];
                $value = $row[$pkeyT];
                imgTag($table, $key, $value);
                //echo "<img src=pikachu.png height=42 width=42 >";
                // header('Content-type: image/png');
                // echo pg_unescape_bytea($row[$key]);
                echo "</td>\n";
                continue;
            }
            if($key == "contrasena" ){
                continue;
            }else{
                echo "\t\t<td>".$row[$key]."</td>\n";
            }

        }
        if (isUsed($table, $row)){
            echo "\t\t<td><img src='img/services-icons/cancel.png' alt='Eliminar' height='30px' width='30px' title='No se puede eliminar'>\n";
              echo "\t\t<a class=modificar href=". modificarURL($row, $schema) ."&tabla=$table><img src='img/services-icons/edit.png' alt='Modificar' height='30px' width='30px' title='Modificar'></a></td>\n";
        }
        else{
            echo "\t\t<td><a class=eliminar href=". eliminarURL($row, $schema) ."&tabla=$table><img src='img/services-icons/delete.png' alt='Eliminar' height='30px' width='30px' title='Eliminar'></a>\n";
              echo "\t\t<a class=modificar href=". modificarURL($row, $schema) ."&tabla=$table><img src='img/services-icons/edit.png' alt='Modificar' height='30px' width='30px'title='Modificar' ></a></td>\n";
        }

        echo "\t</tr>\n";
    }
    echo "</table>";
    echo "<br><br><button style='position: absolute' class='cancel-button' style='color: #000'><a class =regresar href=index.php>Menu Principal</a></button>";
    //pg_close($conexion);
}

function insertarFila($post,$file){
    $conexion = init();
    print_r($post);

    if(empty($post)){
        echo "vacio";
        //print_r($post);
        return;
    }
    $table = $post["tabla"];
    $schema = getSchema($table);
    $query = "insert INTO $table (";
    foreach($schema as $key => $type){
        if ($key === 'primary_keys' or $key === 'foreign_keys'){
            continue;
        }
        $query = $query."$key,";
    }
    $query = rtrim($query, ", ");
    $query = $query.") VALUES (";
    foreach($schema as $key => $type){
        if ($key === 'primary_keys' or $key === 'foreign_keys'){
            continue;
        }
        if ($type == 'bytea'){
            //print_r($file);
            echo "<br>LLAAVE".$key."<br>";
            $data = file_get_contents($file[$key]["tmp_name"]);
            $escaped = pg_escape_bytea($data);
            $query = $query."'{$escaped}',";
            continue;

        }
        if ($type == 'serial'){
            $query = $query."Default,";
            $serialKey = $key;
            continue;
        }
        $value=$post[$key];
        $query = $query."'$value',";
    }
    $query = rtrim($query, ", ");
    $query = $query.")";
    $resultado = pg_query($conexion, $query);
    //  echo "<br>". pg_last_error($conexion)."<br>";

    if (pg_last_error($conexion)){
        echo "Existio un error por favor verificar que no sea duplicado.";
        returnOpciones($table);
        return;
    }
    echo "Operación realizada con exito";
    // errorPostgres($conexion,$query);

  /*if ($serialKey){

        $query = "select $serialKey from $table where ";
        foreach($schema['primary_keys'] as $pkey){
            $query = $query."$pkey='".$post[$pkey]."' and ";
        }
        $query = rtrim($query, "and ");
        echo "$query";
        $resultado = pg_query($conexion, $query) or die('Query failed: ' . pg_last_error($conexion));

        $row=pg_fetch_assoc($resultado);
        echo "<br> ";
        echo "Su numero generado es: ".$row[$serialKey];
        echo "<br> ";

    }*/
    header("Location: index.php");
     pg_close($conexion);

    returnOpciones($table);

}

function updateFila($post,$file){
    //print_r( $file);

    $conexion = init();
    $table = $post["tabla"];

    $query = "update $table set ";
    $schema = getSchema($table);

    foreach($schema as $key => $type){
        if ($key === 'primary_keys' or $key === 'foreign_keys'){
            continue;
        }
        if (in_array ( $key, $schema['primary_keys'] )){
            continue;
        }
        if ($type == 'bytea'){
            if($file[$key]['error']===0){
                $data = file_get_contents($file[$key]["tmp_name"]);
                $escaped = pg_escape_bytea($data);
                $query = $query."$key = '{$escaped}',";
            }


            continue;

        }
        $value=$post[$key];
        $query = $query."$key='$value',";
    }
    $query = rtrim($query, ", ");
    $query = $query." where ";
    foreach($schema['primary_keys'] as $pkey){
        $query = $query."$pkey='".$post[$pkey]."' and ";
    }
    $query = rtrim($query, "and ");
    echo $query;
    $resultado = pg_query($conexion, $query) or die('Query failed: ' . pg_last_error($conexion));
    pg_close($conexion);
    returnOpciones($table);
}
function returnOpciones($table){
    echo "<br>";

    //header("Location: index.php");
    echo "<button style='position: absolute' class='cancel-button' style='color: #000'><a href=opcionesTabla.php?tabla=$table>Regresar</a></button>";
}

function deleteFila($get){
    $conexion = init();
    $table = $get["tabla"];
    $query = "delete from $table where ";
    $schema = getSchema($table);
    foreach($get as $key=>$value){
        if ($key === "tabla"){
            continue;
        }
        $query = $query."$key='$value' and ";
    }
    $query = rtrim($query, "and ");
    echo $query;
    $resultado = pg_query($conexion, $query) or die('Query failed: ' . pg_last_error($conexion));
    pg_close($conexion);
    returnOpciones($table);
}
function eliminarURL($row, $schema){
    $url = $GLOBALS['FILE_ELIMINAR'];
    foreach ($schema["primary_keys"] as $key) {
        $url = $url. "$key=".$row[$key];
        $url=$url."&";
    }
    return rtrim($url, "& ");
}
function modificarURL($row, $schema){
    $url = $GLOBALS['FILE_MODIFICAR'];
    foreach ($schema as $key => $type) {
        if ($key === 'primary_keys' or $key === 'foreign_keys'){
            continue;
        }
        if ($type === "int" || $type ==='bigint' || $type ==='serial'){
            $url = $url. "$key=".$row[$key];
        }
        elseif ($type === "text"||strstr($type, "char") ){
            $url = $url."$key=".urlencode($row[$key]);
        }
        $url=$url."&";
    }
    return rtrim($url, "& ");
}
function topTable($schema){
    echo "<table border=1 style='border-collapse: collapse;
  width: 70%;'>
    <tr>";
    foreach ($schema as $key => $type) {
        if ($key === 'primary_keys' or $key === 'foreign_keys'){
            continue;
        }
        if($key == "contrasena"){
            continue;
        }else{
        echo "<th><b>". $key . "</b></th>";
        }
    }
    echo "<th><b>Acciones</b></th></tr>";

}

function getComboDescriptor($column,$descriptorC,$table,$name, $selected){
    $conexion = init();
    $query = "Select $table.$column,";
    // x//print_r($descriptorC);
    if ($descriptorC[$table] === null){
        foreach ($descriptorC as $tabla => $campo) {

            $schema = getSchema($tabla);
            $pkey = $schema['primary_keys'][0];
            $query=$query."$tabla.$campo from $table, $tabla where $table.$column = $tabla.$pkey";
        }
    }
    else{
            $query = "Select $column," .$descriptorC[$table] ." from $table
            order by $column";


    }

    // //echo $query;
    // $query = "Select $column,$descriptorC from $table order by $column";

    $resultado = pg_query($conexion, $query);
    if (pg_num_rows($resultado) == 0){
        echo " No hay valores de la tabla '$table' favor ingresar valores <br>";
        echo "<a href=opcionesTabla.php?tabla=$table> Ir a $table</a>";
        return false;
    }
    $keys = array_keys( $descriptorC);

    $tempValue = $descriptorC[ $keys[0] ];
    echo "<select id=$name name=$name>\n";


    while ($row=pg_fetch_assoc($resultado)){

        $value=$row[$column];

        $description = $row[$tempValue];
        if ($selected === $value){
            echo "<option selected value=$value>$value:$description</option>";
        }
        else{
            echo "<option value=$value>$value:$description</option>";

        }

    }
    echo "</select>\n";
    pg_close($conexion);
    return true;
}
function mapType($type,$key, $value,$table,$name){

  if($key == "contrasena"){
      echo "<input id='inp'  name=$key type='password' required  value='$value' placeholder='&nbsp;' >";
    }else{
    switch(true){
        case ("int" === $type):
            echo "<input id='inp' type=number min=0 id=$key name=$key required placeholder='&nbsp;' value='$value'>";
            return;
        case ("bigint"=== $type):
            echo "<input  id='inp' type=number min=0  name=$key required value='$value'  placeholder='&nbsp;'>";
            return "number";
        case ("text" === $type):
            echo "<input type=text  id='inp'  name=$key required value='$value'  placeholder='&nbsp;'>";
            return;

        case ("bytea" === $type):
            if($value != ''){
                imgTag($table, $key, $value);
                echo "<input type=file  id='inp' name=$name accept='image/png' value=show.php?tabla=$table&llave=$key&valor=$value id=". $GLOBALS['FILE_UPLOAD']." >";
                return;
            }
            echo "<input type=file name=$name   id='inp' required accept='image/png' id=". $GLOBALS['FILE_UPLOAD']." >";

            return;
        case (strstr($type, "varchar") ):


        $int = (int) filter_var($type, FILTER_SANITIZE_NUMBER_INT);
        echo "<input  id='inp' type=text maxlength=$int name=$key required value='$value' placeholder='&nbsp;'>";
            return;
        default:

            return;
    }
  }
}
function updateForm($get){
    $conexion = init();
    $table = $get["tabla"];
    $schema = getSchema($table);
    echo "<form  class=edit action=modificar.php method=post enctype=multipart/form-data>";
    echo "<h1 class=edit-title>Modificar $table</h1>";
    echo "<input type=hidden  class='edit-input'  name=tabla value=$table>\n";
    foreach ($schema as $key => $type) {
        if ($key === 'primary_keys' or $key === 'foreign_keys'){
            continue;
        }

        if (in_array ( $key, $schema['primary_keys'] ) || ($type == 'serial')){
            echo "<input type=hidden class='edit-input'  name=$key value='".$get[$key]."'>\n";
            echo "<b>$key:  </b>";
            echo $get[$key];
            echo "<br>";
            continue;
        }
        echo "<b>$key</b>";
        if (!empty($schema['foreign_keys'][$key])){
          if ($schema['foreign_keys'][$key]){
              $refTable = $schema['foreign_keys'][$key];
              $refKey = getSchema($refTable)['primary_keys'][0];

              getComboDescriptor($refKey ,getDescriptor($refTable),$refTable,$key,$get[$key] ); //cambiar a selected

          }
        }
        else{
            if ($type === "bytea"){
                $pkey =$schema['primary_keys'][0];
                mapType($type, $key,$get[$pkey] ,$table,$key);
                continue;
            }
            mapType($type, $key, $get[$key],$table,$key);

        }
        echo "<br>";


    }
    echo "<br><br><input type=submit value=Actualizar class=edit-button>
    <input type=submit value=Cancelar class=cancel-button>
        <br>
        </form>";

    //pg_close($conexion);
    returnOpciones($table);
}
function isUsed($table, $row){
    $conexion = init();
    $allSchema = getSchemaJSON();
    $pkeys = getSchema($table)['primary_keys'];
    $condition = array();
    foreach($pkeys as $pkey) {
        $condition[$pkey] = $row[$pkey];
    }
    foreach ($allSchema as $schemaTable => $schema){
      if (!empty($schema['foreign_keys'])){
        foreach($schema['foreign_keys'] as $key => $fTable){
            if ($fTable === $table){

                $query = isUsedQuery($schemaTable, $condition);
                $resultado = pg_query($conexion, $query);
                if (pg_num_rows($resultado) != 0){
                    return true;
                }
            }
        }
      }
    }
    pg_close($conexion);
    return false;

}
function isUsedQuery($table, $condition){
    $query = "Select * from $table where ";
    foreach($condition as $key => $value){
        $query = $query. "$key = '$value' and ";
    }
    return rtrim($query, 'and ');
}
function getDescriptor ($table){
    switch($table){
        case "Usuario":
            return array("Usuario"=>"nombre");
        case "Modulo":
            return array("Modulo"=>"titulo");
        case "Lecciones":
            return array("Lecciones"=>"titulo");

        default:
            return array();
    }
}





?>
