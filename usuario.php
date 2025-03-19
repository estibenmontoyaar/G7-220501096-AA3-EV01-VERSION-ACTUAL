<?php
// usuario.php
include 'conexion.php'; // Incluir la conexión a la base de datos

// Función para obtener todos los usuarios
function obtenerTodos() {
    global $conexion; // Usamos la conexión global
    $sql = "SELECT * FROM usuarios"; // Consulta para obtener todos los usuarios
    $resultado = mysqli_query($conexion, $sql); // Ejecutamos la consulta

    $usuarios = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $usuarios[] = $row; // Guardamos cada usuario en un array
    }
    return $usuarios; // Devolvemos la lista de usuarios
}

// Función para obtener un usuario por su ID
function obtenerPorId($id) {
    global $conexion; // Usamos la conexión global
    $sql = "SELECT * FROM usuarios WHERE id = $id"; // Consulta para obtener un usuario específico
    $resultado = mysqli_query($conexion, $sql); // Ejecutamos la consulta

    return mysqli_fetch_assoc($resultado); // Devolvemos el usuario encontrado
}

// Función para agregar un nuevo usuario
function crearUsuario($nombre, $email) {
    global $conexion; // Usamos la conexión global
    $sql = "INSERT INTO usuarios (nombre, email) VALUES ('$nombre', '$email')"; // Consulta para insertar un nuevo usuario
    return mysqli_query($conexion, $sql); // Ejecutamos la consulta
}

// Función para actualizar los datos de un usuario
function actualizarUsuario($id, $nombre, $email) {
    global $conexion; // Usamos la conexión global
    $sql = "UPDATE usuarios SET nombre = '$nombre', email = '$email' WHERE id = $id"; // Consulta para actualizar un usuario
    return mysqli_query($conexion, $sql); // Ejecutamos la consulta
}

// Función para eliminar un usuario
function eliminarUsuario($id) {
    global $conexion; // Usamos la conexión global
    $sql = "DELETE FROM usuarios WHERE id = $id"; // Consulta para eliminar un usuario
    return mysqli_query($conexion, $sql); // Ejecutamos la consulta
}
?>
