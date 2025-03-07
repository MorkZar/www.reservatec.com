<?php

session_start();

include 'conexionBD.php';
$correo = $_POST['correo'];
$pass = $_POST['pass'];
//$pass = hash('sha512', $pass);

$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios
WHERE correo='$correo' and contrasena = '$pass'");

if(mysqli_num_rows($validar_login) > 0){
    $_SESSION['usuario'] = $correo;
    header("location: home page.php");
    exit;
}else{
    echo'
    <script>
    alert("Uusario no registrado");
    </script>
    ';
    header("location: inicioSesion.php");
    exit;
}
?>
