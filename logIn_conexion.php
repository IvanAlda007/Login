<?php
    $host  =  "localhost";
    $user  =  "root";
    $pass  =  " ";
    $db    =  "universidad";

    $conexion = mysqli_connect($host, $user, $pass, $db);

    if(!$conexion){
        echo "fallo la conexion";
    }

?>