# ReservaTec

![Project Logo]("C:\xampp\htdocs\xampp\ReservaTec1\imagenes\logo ReservaTec (1).png")

## Description
ReservaTec es un software desarrollado para el Instituto Tecnológico de Saltillo, específicamente para el edificio de Vinculación.
El objetivo principal es digitalizar y optimizar la gestión de reservas de espacios, mejorando la organización de eventos y reduciendo
problemas como duplicidad de solicitudes o procesos manuales ineficientes.
Con este sistema, estudiantes, docentes y personal administrativo podrán gestionar eventos de manera sencilla, rápida y confiable.

## Features
👤 Usuarios generales (estudiantes, docentes, externos)
-Crear una cuenta y autenticarse en el sistema.
-Consultar el calendario de eventos con disponibilidad en tiempo real.
-Enviar solicitudes de reservación para espacios disponibles (auditorio, centro de cómputo, aula A1, lobby, cafetería).

🛠️ Administradores (Departamento de Vinculación)
- Revisar solicitudes recibidas.
-Aceptar o rechazar solicitudes.
-Generar reportes de eventos (diarios, semanales o mensuales).

## Getting Started
🛠️ Instalación

STEP 1.Clonar o descargar el proyecto
Descarga el repositorio desde GitHub o cópialo en tu máquina.

STEP 2.Ubícalo dentro de la carpeta:
C:\xampp\htdocs\reservatec

STEP 3.Configurar la base de datos
Inicia XAMPP y activa los servicios Apache y MySQL.
Abre http://localhost/phpmyadmin/.
Crea una base de datos, por ejemplo:
Importa el archivo .sql incluido en el proyecto (normalmente estará en la carpeta /db o entregado junto con el código).

STEP 4.Configurar conexión a BD
Edita el archivo conexionBD.php con tus credenciales:
$host = "localhost";
$usuario = "root";      // usuario por defecto en XAMPP
$password = "";         // contraseña vacía por defecto
$bd = "reservatec";

STEP 5.Verificar dependencias
Asegúrate de tener:
PHP (incluido en XAMPP).
MySQL (incluido en XAMPP).
Navegador web actualizado.

### Usage
Usuarios
1.Abre XAMPP y activa Apache y MySQL.
2.Ingresa en tu navegador a:
http://localhost/reservatec/inicioSesion.php
3.Inicia sesión con tu correo y contraseña.
o Registrar cuenta (si no tienes).
Desde la interfaz principal podrás:
-📅 Consultar el calendario de eventos.
-📝 Enviar solicitudes de reservación de espacios.


🔑 Admin
1.Abre XAMPP y activa Apache y MySQL.
2.Ingresa en tu navegador a:
http://localhost/xampp/ReservaTec1/administracion.php
En la interfaz podras:
-Revisar solicitudes, aceptarlas o rechazarlas.
-Generar reportes de eventos.
-Descargar reportes en formato PDF.

## Technologies Used
Frontend: HTML, CSS, JavaScript.
Backend: PHP.
Base de datos: MySQL.

## Contributors
Angel Gabriel Morquecho Pedroza

## License
This project is licensed under the MIT License
