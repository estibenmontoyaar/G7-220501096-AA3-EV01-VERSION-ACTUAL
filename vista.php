<?php
// index.php
include 'usuario.php'; // Incluir el archivo de funciones de usuarios

// Comprobamos la acción que se quiere realizar
$action = $_GET['action'] ?? 'listar'; // Por defecto, mostramos la lista de usuarios

// Si se recibe un formulario (POST), creamos o editamos un usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'crear') {
        crearUsuario($_POST['nombre'], $_POST['email']); // Creamos un nuevo usuario
        header('Location: vista.php'); // Redirigimos a la página principal después de crear
        exit; // Terminamos la ejecución
    } elseif ($action === 'editar') {
        actualizarUsuario($_POST['id'], $_POST['nombre'], $_POST['email']); // Actualizamos un usuario
        header('Location: vista.php'); // Redirigimos a la página principal después de editar
        exit; // Terminamos la ejecución
    }
}

// Si la acción es eliminar, eliminamos el usuario
if ($action === 'eliminar') {
    eliminarUsuario($_GET['id']); // Eliminamos el usuario
    header('Location: vista.php'); // Redirigimos a la página principal después de eliminar
    exit; // Terminamos la ejecución
}

// Si estamos editando un usuario, obtenemos sus datos
$user = null;
if ($action === 'editar' && isset($_GET['id'])) {
    $user = obtenerPorId($_GET['id']); // Obtenemos los datos del usuario a editar
}

?>

<!-- HTML para mostrar los usuarios o formularios -->
<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Usuarios</title>
    <link rel="stylesheet" href="../fronted/css.css"> <!--  estilos para la pagina -->
</head>
<body>
    <h1>CRUD de Usuarios</h1>

    <!-- Si la acción es 'listar', mostramos todos los usuarios -->
    <?php if ($action === 'listar'): ?>
        <div class="container">
            <a href="vista.php?action=crear">Crear Usuario</a> <!-- Enlace para crear un nuevo usuario -->
            <ul>
                <?php
                $usuarios = obtenerTodos(); // Obtenemos todos los usuarios
                foreach ($usuarios as $u): // Recorremos la lista de usuarios
                ?>
                    <li>
                        <?= $u['nombre'] ?> - <?= $u['email'] ?> <!-- Mostramos el nombre y email -->
                        <a href="vista.php?action=editar&id=<?= $u['id'] ?>">Editar</a> <!-- Enlace para editar -->
                        <a href="vista.php?action=eliminar&id=<?= $u['id'] ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a> <!-- Enlace para eliminar -->
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif ($action === 'crear' || $action === 'editar'): ?>
        <div class="container">
            <h2><?= $action === 'crear' ? 'Crear' : 'Editar' ?> Usuario</h2>
            <form method="POST" action="vista.php?action=<?= $action ?>"> <!-- Formulario para crear o editar -->
                <?php if ($action === 'editar'): ?>
                    <input type="hidden" name="id" value="<?= $user['id'] ?>"> <!-- Campo oculto para el ID del usuario -->
                <?php endif; ?>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= $user['nombre'] ?? '' ?>" required> <!-- Campo para el nombre -->
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= $user['email'] ?? '' ?>" required> <!-- Campo para el correo -->
                <button type="submit"><?= $action === 'crear' ? 'Crear' : 'Actualizar' ?></button> <!-- Botón para enviar el formulario -->
                <a href="vista.php" class="cancel-link">Cancelar</a> <!-- Enlace para cancelar -->
            </form>
        </div>
    <?php endif; ?>
</body>
</html>
