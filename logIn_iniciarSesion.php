<?php
/* inicializa las variables */
session_start();

include('conexion.php');
if(isset($_POST['Usuario']) && isset($_POST['Clave'])){
    function validar($data){
        $data   = trim($data);
        $data   = stripcslashes($data);
        $data   = htmlspecialchars($data);
        return $data;
    }
    $Usuario    = validar($_POST['Usuario']);
    $Clave      = validar($_POST['Clave']);
}

if(empty($Usuario)){
    header("Location: index.php?error=Usuario requerido");//................HEADER
    exit();

}elseif(empty($Clave)){
    header("Location: index.php?error=Clave requerida");//................HEADER
    exit();

}else{
    // $Clave  = md5($Clave);
    $sql    = "SELECT * FROM alumnos WHERE Usuario = '$Usuario' AND  Clave = '$Clave'";
    $result = mysqli_query($conexion, $sql);
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if($row['Usuario'] === $Usuario && $row['Clave'] === $Clave){
            /*ahora se generan las variables de sesion*/
            $_SESSION['Usuario'] = $row['Usuario'];
            $_SESSION['Nombre_completo'] = $row['Nombre_completo'];
            $_SESSION['id'] = $row['id'];

            header("Location: inicio.php");//............................................HEADER
            exit();

        }else{
            header("Location: index.php?error=El usuario o clave son erroneas");//................HEADER
            exit();
        }
    }else{
            header("Location: index.php?error=El usuario o clave son erroneas");//................HEADER
            exit();            
    }

}else{
header("Location: index.php?error=El usuario o clave son erroneas");//..................HEADER
exit();
}

?>