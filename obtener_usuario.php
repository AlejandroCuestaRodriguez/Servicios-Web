<?php
// Conexión a la base de datos
          $conexion = mysqli_connect("localhost", "bryant", "1234567890", "geometricos");

// Comprobar la conexión
if (mysqli_connect_errno()) {
    echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
    exit();
}

// Obtener el ID del usuario
$id = $_GET['id'];

// Consulta SQL para obtener los datos del usuario
$consulta = "SELECT id, nombre_usuario, numero_telefono, email, contraseña, tipo_usuario FROM usuarios WHERE id = " . mysqli_real_escape_string($conexion, $id);
$resultado = mysqli_query($conexion, $consulta);

$usuario = mysqli_fetch_assoc($resultado);

// Devolver los datos en formato JSON
echo json_encode($usuario);

// Cerrar la conexión
mysqli_close($conexion);
?>
