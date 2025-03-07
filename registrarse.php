<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


  <title>Registro</title>
</head>
<body>
<div class="container-all">

  <div class="container-form">
    <img src="imagenes/logo ReservaTec (1).png" alt="" class="logo">
    <h1 class="title">Registro</h1>

  <?php
  
  session_start();
if (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-primary d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:" width="24" height="24">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div>' . $_SESSION['error_message'] . '</div>
        </div>';
    unset($_SESSION['error_message']); // Eliminar el mensaje después de mostrarlo
}
  
  ?>
    <form class ="needs-validation" action="registrarUsuarios.php" method="POST">
    <label for="nombre">Nombre</label>
    <input name="nombre" id="nombre" type="text" maxlength="30" required pattern="[A-Za-záéíóúÁÉÍÓÚ\s]+" 
        oninvalid="validarCampo(this, 'Falta ingresar nombre completo', 'Solo se permiten letras y espacios')"
        oninput="this.setCustomValidity('')">
    
        <label for="ap_paterno">Apellido Paterno</label>
    <input name="ap_paterno" id="ap_paterno" type="text" maxlength="20" required pattern="[A-Za-záéíóúÁÉÍÓÚ\s]+"
        oninvalid="validarCampo(this, 'Falta ingresar apellido paterno', 'Solo se permiten letras y espacios')"
        oninput="this.setCustomValidity('')">
    
    <label for="ap_materno">Apellido Materno</label>
    <input name="ap_materno" id="ap_materno" type="text" maxlength="20" required pattern="[A-Za-záéíóúÁÉÍÓÚ\s]+"
        oninvalid="validarCampo(this, 'Falta ingresar apellido materno', 'Solo se permiten letras y espacios')"
        oninput="this.setCustomValidity('')">
    
    <label for="tipo">Tipo Usuario</label>
<?php
include "conexionBD.php";

$query = "SELECT id_tipousuario, tipo_usuario FROM tipousuario";
$result = $conexion->query($query);
?>

<div class="selectTipo">
<select id="tipo" name="tipo" required>
    <!--<option value="null" selected></option>-->

    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id_tipousuario'] . "'>" . $row['tipo_usuario'] . "</option>";
    }
    ?>
</select>
  </div>
        <div id="campoAdicional" style="display: none;">
        <label for="Nombre Organización">Específique el Nombre de la Organización:</label>
        <input type="text" id="nombreAdicional" name="nombreAdicional" 
       oninvalid="this.setCustomValidity('Falta ingresar nombre de la organización')"
       oninput="this.setCustomValidity('')" 
       pattern="^[A-Za-záéíóúÁÉÍÓÚ0-9\s]+$" 
       title="Solo se permiten letras seguidas de números y espacios">
        </div>
    
        <label for="correo">Correo Electrónico</label>
    <input name="correo" id="correo" type="email" maxlength="30" required
    oninvalid="this.setCustomValidity('Falta ingresar el correo electrónico.')" 
    oninput="this.setCustomValidity('')">
    
    <label for="pass">Contraseña</label>
    <input name="pass" id="pass" type="password" maxlength="20" minlength="8" required
    oninvalid="this.setCustomValidity('Falta ingresar la contraseña, debe tener al menos 8 caracteres.')" 
    oninput="this.setCustomValidity('')">
    
    <br>
    <br>
    
    <button class="buttonin" type="submit">Registrarse</button>
    
  </form>

  <script>
function validarCampo(input, mensajeVacio, mensajeInvalido) {
    if (input.validity.valueMissing) {
        input.setCustomValidity(mensajeVacio);
    } else if (input.validity.patternMismatch || input.validity.typeMismatch) {
        input.setCustomValidity(mensajeInvalido);
    } else {
        input.setCustomValidity('');
    }
}
</script>

  <script>
// Seleccionamos el elemento <select> y el div que contiene el campo adicional
const selectTipo = document.getElementById('tipo');
const campoAdicional = document.getElementById('campoAdicional');
const inputAdicional = document.getElementById('nombreAdicional');  // Seleccionamos el campo de texto dentro de 'campoAdicional'

// Escuchamos el evento 'change' en el <select>
selectTipo.addEventListener('change', function() {
    console.log("Seleccionado: " + selectTipo.value); // Para verificar que el valor cambia correctamente
    // Asegúrate de que los valores de 'empresa' y 'institucionExterna' coincidan exactamente con los valores en la base de datos.
    if (selectTipo.value === '3' || selectTipo.value === '4') {
        // Mostrar el campo adicional y hacerlo obligatorio
        campoAdicional.style.display = 'block';  
        inputAdicional.setAttribute('required', 'required');  // Hacer el campo adicional obligatorio
    } else {
        // Ocultar el campo adicional y quitar el obligatorio
        campoAdicional.style.display = 'none';  
        inputAdicional.removeAttribute('required');  // Quitar el atributo 'required'
    }
});
</script>

  <span class="text-footer">Ya tengo una cuenta  <a href="inicioSesion.php"> Iniciar Sesión</a></span>

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
