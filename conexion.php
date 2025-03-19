<?php

// Datos de conexión a la base de datos
$host = 'localhost'; // Dirección del servidor de la base de datos
$db = 'proyecto_db'; // Nombre de la base de datos
$user = 'root'; // Nombre de usuario para la base de datos
$pass = ''; // Contraseña del usuario
$conexion = mysqli_connect($host, $user, $pass, $db); // Conectamos a la base de datos

// Verificamos si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}