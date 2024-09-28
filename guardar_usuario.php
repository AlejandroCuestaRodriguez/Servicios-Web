<?php
// Conexión a la base de datos
          $conexion = mysqli_connect("localhost", "bryant", "1234567890", "geometricos");

// Comprobar la conexión
if (mysqli_connect_errno()) {
    echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
    exit();
}

// Obtener datos del formulario
$nombreUsuario = $_POST['nombreUsuario'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$contraseña = $_POST['contraseña'];
$tipoUsuario = $_POST['tipoUsuario'];

// Obtener el ID del formulario (si existe)
$id = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : null;

// Preparar y ejecutar la consulta de actualización o inserción
if ($id) {
    // Si existe un ID, actualizar el usuario existente
    $consulta = "UPDATE usuarios SET nombre_usuario='$nombreUsuario', numero_telefono='$telefono', email='$email', contraseña='$contraseña', tipo_usuario='$tipoUsuario' WHERE id=$id";
} else {
    // Si no existe un ID, insertar un nuevo usuario
    $consulta = "INSERT INTO usuarios (nombre_usuario, numero_telefono, email, contraseña, tipo_usuario) VALUES ('$nombreUsuario', '$telefono', '$email', '$contraseña', '$tipoUsuario')";
}

if (mysqli_query($conexion, $consulta)) {
    echo "Datos guardados correctamente.";
	sleep(5); // Esperar 5 segundos
    header("Location: Admon_users.php");
    exit(); 
} else {
    echo "Error al guardar los datos: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
