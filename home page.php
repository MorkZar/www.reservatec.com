<?php

session_start();

if(!isset($_SESSION['usuario'])){
  header("location: inicioSesion.php");
  session_destroy();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/homePage.css">
    <title>ReservaTec</title>
</head>
<body>
  <header class="header">
    <img src="imagenes/logo ReservaTec (1).png" alt="Logo ReservaTec">
    <div class="header-icons">
    <a href="javascript:void(0)" onclick="mostrarCuenta()"><img src="imagenes/usuario.png" alt="Ver Cuenta"></a>
        <a href="cerrar_sesion.php"><img src="imagenes/cerrar-sesion.png" alt="Cerrar Sesión"></a>
    </div>
</header>
<div class="card">
  <div class="card-border-top">
  </div>
  <div class="img">
  </div>
  <span> Person</span>
  <p class="job"> Job Title</p>
  <button> Click
  </button>
</div>

<script>
    function mostrarCuenta() {
        var cuentaCard = document.getElementById('cuentaCard');
        cuentaCard.style.display = (cuentaCard.style.display === 'none' || cuentaCard.style.display === '') ? 'block' : 'none';
    }
</script>

    <nav class="nav-menu">
        <button class="button1" onclick="location.href='home page.php'">
            <svg
              height="24"
              width="24"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path d="M0 0h24v24H0z" fill="none"></path>
              <path
                d="M 5.617 9.018 C 8.674 8.598 9.02 7.785 9.939 7.77 C 10.933 7.762 10.966 5.609 11.856 3.861 C 11.444 3.567 10.287 2.41 10.287 0.874 C 10.548 0.882 12.528 1.506 12.946 3.356 C 12.679 2.281 11.99 0.968 12.55 0.064 C 12.83 0.085 13.992 1.204 13.777 2.862 C 15.834 3.208 14.901 4.554 17.016 3.838 C 16.606 3.908 18.76 4.5 17.611 5.415 C 17.898 7.031 15.422 6.169 15.924 6.349 C 14.991 6.456 14.632 7.084 13.752 7.102 C 13.759 7.716 13.766 8.33 13.773 8.944 C 15.791 9.813 15.55 8.491 16.417 9.994 M 5.614 9.048 C 5.092 8.858 2.789 11.161 4.593 13.94 C 4.7593 14.47 5.306 14.771 5.092 15.53 C 4.997 15.839 4.902 16.076 5.543 17.074 C 5.82 18.207 5.474 17.947 5.578 18.294 C 5.7107 18.7497 6.167 18.345 5.976 19.661 C 5.89 19.869 6.998 20.302 7.725 19.661 C 7.742 19.419 7.2977 18.8763 7.084 18.484 C 7.183 18.248 7.32 17.74 6.812 17.487 C 6.87 17.272 5.855 16.159 6.753 14.617 C 7.046 14.46 7.28 14.168 7.515 13.836 C 7.71 14.129 7.983 14.48 7.964 15.105 C 8.14 15.671 8.81 16.2763 9.233 16.862 C 9.311 17.233 8.862 17.35 9.701 17.897 C 9.714 18.2027 9.727 18.5083 9.74 18.814 C 10.111 19.009 11.107 19.185 11.4 18.678 C 11.1657 18.307 10.9313 17.936 10.697 17.565 C 10.72 17.408 10.932 16.842 10.243 16.489 C 9.925 15.841 9.2 15.552 9.289 14.545 C 9.513 14.303 9.676 13.927 9.713 13.563 C 10.34 13.526 11.818 13.4 12.708 12.398 C 13.0797 12.3147 13.522 12.31 13.823 12.148 C 13.885 12.06 14.173 12.185 14.261 12.887 C 14.249 12.974 14.361 13.538 13.973 13.776 C 13.852 14.0057 13.672 13.814 13.61 14.465 C 13.4137 14.6863 13.2173 14.9077 13.021 15.129 C 13.121 15.606 13.923 16.52 14.311 16.019 C 14.3613 15.6933 14.4117 15.3677 14.462 15.042 C 14.599 14.816 15.025 14.666 14.863 14.303 C 14.929 13.721 15.271 13.287 15.263 12.862 C 15.118 12.257 15.052 11.364 14.382 11.1 C 14.998 11.022 15.476 10.338 15.711 10.709 C 15.89 11.0607 16.414 11.139 16.248 11.764 C 16.1733 12.0637 15.926 11.784 16.024 12.663 C 15.8447 12.8943 15.6653 13.1257 15.486 13.357 C 15.672 13.738 16.326 14.431 16.746 14.08 C 16.903 13.64 16.8573 13.2267 16.913 12.8 C 17.126 12.671 17.339 12.501 17.224 12.154 C 17.091 11.671 17.296 10.964 17.102 10.787 C 16.874 10.523 16.595 10.302 16.418 9.995 M 4.351 9.975 C 4.109 10.04 2.246 10.266 2.095 12.162 C 2.084 12.593 2.117 13.605 2.731 14.413 C 2.8243 14.571 2.9177 14.729 3.011 14.887 C 2.292 15.904 2.142 15.654 2.708 17.434 C 2.984 17.289 3.017 17.019 3.074 16.809 C 3.034 17.086 3.102 17.424 2.916 17.796 C 3.22 17.542 5.245 16.006 3.302 14.77 C 3.317 14.475 1.118 11.375 4.109 10.675"
                fill="currentColor"
              ></path>
            </svg>
            <span>Inicio</span>
          </button>
        <button class="button1" onclick="location.href='agenda.php'">
            <svg
              height="24"
              width="24"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path d="M0 0h24v24H0z" fill="none"></path>
              <path
                d="M 5.617 9.018 C 8.674 8.598 9.02 7.785 9.939 7.77 C 10.933 7.762 10.966 5.609 11.856 3.861 C 11.444 3.567 10.287 2.41 10.287 0.874 C 10.548 0.882 12.528 1.506 12.946 3.356 C 12.679 2.281 11.99 0.968 12.55 0.064 C 12.83 0.085 13.992 1.204 13.777 2.862 C 15.834 3.208 14.901 4.554 17.016 3.838 C 16.606 3.908 18.76 4.5 17.611 5.415 C 17.898 7.031 15.422 6.169 15.924 6.349 C 14.991 6.456 14.632 7.084 13.752 7.102 C 13.759 7.716 13.766 8.33 13.773 8.944 C 15.791 9.813 15.55 8.491 16.417 9.994 M 5.614 9.048 C 5.092 8.858 2.789 11.161 4.593 13.94 C 4.7593 14.47 5.306 14.771 5.092 15.53 C 4.997 15.839 4.902 16.076 5.543 17.074 C 5.82 18.207 5.474 17.947 5.578 18.294 C 5.7107 18.7497 6.167 18.345 5.976 19.661 C 5.89 19.869 6.998 20.302 7.725 19.661 C 7.742 19.419 7.2977 18.8763 7.084 18.484 C 7.183 18.248 7.32 17.74 6.812 17.487 C 6.87 17.272 5.855 16.159 6.753 14.617 C 7.046 14.46 7.28 14.168 7.515 13.836 C 7.71 14.129 7.983 14.48 7.964 15.105 C 8.14 15.671 8.81 16.2763 9.233 16.862 C 9.311 17.233 8.862 17.35 9.701 17.897 C 9.714 18.2027 9.727 18.5083 9.74 18.814 C 10.111 19.009 11.107 19.185 11.4 18.678 C 11.1657 18.307 10.9313 17.936 10.697 17.565 C 10.72 17.408 10.932 16.842 10.243 16.489 C 9.925 15.841 9.2 15.552 9.289 14.545 C 9.513 14.303 9.676 13.927 9.713 13.563 C 10.34 13.526 11.818 13.4 12.708 12.398 C 13.0797 12.3147 13.522 12.31 13.823 12.148 C 13.885 12.06 14.173 12.185 14.261 12.887 C 14.249 12.974 14.361 13.538 13.973 13.776 C 13.852 14.0057 13.672 13.814 13.61 14.465 C 13.4137 14.6863 13.2173 14.9077 13.021 15.129 C 13.121 15.606 13.923 16.52 14.311 16.019 C 14.3613 15.6933 14.4117 15.3677 14.462 15.042 C 14.599 14.816 15.025 14.666 14.863 14.303 C 14.929 13.721 15.271 13.287 15.263 12.862 C 15.118 12.257 15.052 11.364 14.382 11.1 C 14.998 11.022 15.476 10.338 15.711 10.709 C 15.89 11.0607 16.414 11.139 16.248 11.764 C 16.1733 12.0637 15.926 11.784 16.024 12.663 C 15.8447 12.8943 15.6653 13.1257 15.486 13.357 C 15.672 13.738 16.326 14.431 16.746 14.08 C 16.903 13.64 16.8573 13.2267 16.913 12.8 C 17.126 12.671 17.339 12.501 17.224 12.154 C 17.091 11.671 17.296 10.964 17.102 10.787 C 16.874 10.523 16.595 10.302 16.418 9.995 M 4.351 9.975 C 4.109 10.04 2.246 10.266 2.095 12.162 C 2.084 12.593 2.117 13.605 2.731 14.413 C 2.8243 14.571 2.9177 14.729 3.011 14.887 C 2.292 15.904 2.142 15.654 2.708 17.434 C 2.984 17.289 3.017 17.019 3.074 16.809 C 3.034 17.086 3.102 17.424 2.916 17.796 C 3.22 17.542 5.245 16.006 3.302 14.77 C 3.317 14.475 1.118 11.375 4.109 10.675"
                fill="currentColor"
              ></path>
            </svg>
            <span>Visualizar Agenda</span>
            </button>
        <button class="button1" onclick="location.href='#'">
              <svg
                height="24"
                width="24"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path d="M0 0h24v24H0z" fill="none"></path>
                <path
                  d="M 5.617 9.018 C 8.674 8.598 9.02 7.785 9.939 7.77 C 10.933 7.762 10.966 5.609 11.856 3.861 C 11.444 3.567 10.287 2.41 10.287 0.874 C 10.548 0.882 12.528 1.506 12.946 3.356 C 12.679 2.281 11.99 0.968 12.55 0.064 C 12.83 0.085 13.992 1.204 13.777 2.862 C 15.834 3.208 14.901 4.554 17.016 3.838 C 16.606 3.908 18.76 4.5 17.611 5.415 C 17.898 7.031 15.422 6.169 15.924 6.349 C 14.991 6.456 14.632 7.084 13.752 7.102 C 13.759 7.716 13.766 8.33 13.773 8.944 C 15.791 9.813 15.55 8.491 16.417 9.994 M 5.614 9.048 C 5.092 8.858 2.789 11.161 4.593 13.94 C 4.7593 14.47 5.306 14.771 5.092 15.53 C 4.997 15.839 4.902 16.076 5.543 17.074 C 5.82 18.207 5.474 17.947 5.578 18.294 C 5.7107 18.7497 6.167 18.345 5.976 19.661 C 5.89 19.869 6.998 20.302 7.725 19.661 C 7.742 19.419 7.2977 18.8763 7.084 18.484 C 7.183 18.248 7.32 17.74 6.812 17.487 C 6.87 17.272 5.855 16.159 6.753 14.617 C 7.046 14.46 7.28 14.168 7.515 13.836 C 7.71 14.129 7.983 14.48 7.964 15.105 C 8.14 15.671 8.81 16.2763 9.233 16.862 C 9.311 17.233 8.862 17.35 9.701 17.897 C 9.714 18.2027 9.727 18.5083 9.74 18.814 C 10.111 19.009 11.107 19.185 11.4 18.678 C 11.1657 18.307 10.9313 17.936 10.697 17.565 C 10.72 17.408 10.932 16.842 10.243 16.489 C 9.925 15.841 9.2 15.552 9.289 14.545 C 9.513 14.303 9.676 13.927 9.713 13.563 C 10.34 13.526 11.818 13.4 12.708 12.398 C 13.0797 12.3147 13.522 12.31 13.823 12.148 C 13.885 12.06 14.173 12.185 14.261 12.887 C 14.249 12.974 14.361 13.538 13.973 13.776 C 13.852 14.0057 13.672 13.814 13.61 14.465 C 13.4137 14.6863 13.2173 14.9077 13.021 15.129 C 13.121 15.606 13.923 16.52 14.311 16.019 C 14.3613 15.6933 14.4117 15.3677 14.462 15.042 C 14.599 14.816 15.025 14.666 14.863 14.303 C 14.929 13.721 15.271 13.287 15.263 12.862 C 15.118 12.257 15.052 11.364 14.382 11.1 C 14.998 11.022 15.476 10.338 15.711 10.709 C 15.89 11.0607 16.414 11.139 16.248 11.764 C 16.1733 12.0637 15.926 11.784 16.024 12.663 C 15.8447 12.8943 15.6653 13.1257 15.486 13.357 C 15.672 13.738 16.326 14.431 16.746 14.08 C 16.903 13.64 16.8573 13.2267 16.913 12.8 C 17.126 12.671 17.339 12.501 17.224 12.154 C 17.091 11.671 17.296 10.964 17.102 10.787 C 16.874 10.523 16.595 10.302 16.418 9.995 M 4.351 9.975 C 4.109 10.04 2.246 10.266 2.095 12.162 C 2.084 12.593 2.117 13.605 2.731 14.413 C 2.8243 14.571 2.9177 14.729 3.011 14.887 C 2.292 15.904 2.142 15.654 2.708 17.434 C 2.984 17.289 3.017 17.019 3.074 16.809 C 3.034 17.086 3.102 17.424 2.916 17.796 C 3.22 17.542 5.245 16.006 3.302 14.77 C 3.317 14.475 1.118 11.375 4.109 10.675" 
                  fill="currentColor"
                ></path>
              </svg>
              <span>Solicitar Peticion</span>
              </button>
    </nav>
    <br>

    <div class="descripcion">
        <h3>¿Qué es ReservaTEC?</h3>
        <p>Es un sitio web que te facilitara la reservacion de espacios dentro del edificio de vinculación para diversos eventos.</p>
    </div>

            <div class="carousel">
                <ul>
                <li><img src="imagenes/lugar1.jpeg" alt="Lugar 1"></li>
                <li><img src="imagenes/lugar2.jpeg" alt="Lugar 2"></li>
                <li><img src="imagenes/lugar3.jpeg" alt="Lugar 3"></li>
                </ul>
            </div>
        
    <br>
    <div class="container">
        <div class="info">
            <h3>Dirección</h3>
            <p>Blvd. Venustiano Carranza #2400, Col. Tecnológico, Saltillo, Coahuila, México<br>
            C.P. 25280</p>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.8431974888314!2d-100.99239128502212!3d25.44467698378485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86880f1cbe9c72a9%3A0xc0cbbcb3b6b52b32!2sTecNM%20-%20Instituto%20Tecnol%C3%B3gico%20de%20Saltillo!5e0!3m2!1ses!2smx!4v1619373930833!5m2!1ses!2smx" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</body>
<footer class="footer">
    <ul class="social-icon">
      <li class="icon-element" >
        <a href="https://www.facebook.com/TecNMcampusSaltillo" target="_blank" class="icon">
        <ion-icon name="logo-facebook"></ion-icon>
        </a>
      </li>
      <li class="icon-element" >
        <a href="https://www.instagram.com/tecnmitsaltillo/" target="_blank" class="icon">
        <ion-icon name="logo-instagram"></ion-icon>
        </a>
      </li>
      <li class="icon-element" >
        <a href="https://www.saltillo.tecnm.mx/" target="_blank" class="icon">
        <ion-icon name="globe-outline"></ion-icon>
        </a>
      </li>
    </ul>
    <p class="information">2025 | Todos los derechos reservados </p>
  </footer>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>
