<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Login</title>
</head>
<body>
<?php

?>
<div class="container-all">

  <div class="container-form">
    <img src="imagenes/logo ReservaTec (1).png" alt="" class="logo">
    <h1 class="title">Inicio de Sesión</h1>

    <form action="iniciarSesion.php" method="POST">

    
      <label for=""></label>
      <input name = correo id = correo type="email" placeholder="Correo Electrónico" required>
     <label for=""></label>
     <input name = pass id = pass type="password" class="pass" placeholder="Contraseña" required>

     <span class="olvidar"><a href="">¿Olvidaste tu Contraseña?</a></span>

     <button name = iniciarSesion class="buttonin">Iniciar Sesion</button>

  </form>


  <span class="text-footer">¿Aún no te has registrado? <a href="registrarse.php">Registrate</a></span>

  </div>

  <div class="container-image">
  <div class="capa"></div>
  </div>

</div>

</body>
<footer class="footer">
  <p class="information">2025 | Todos los derechos reservados </p>
</footer>
</html>