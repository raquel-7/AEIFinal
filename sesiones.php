<html>
<body>
<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    echo '<script type="text/javascript"> window.open("index.html","_self");</script>';
    //header("Location: index.php");
    exit();

}

?>
</body>
</html>
