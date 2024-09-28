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
$tipoUsuario = 'cliente';

    $consulta = "INSERT INTO usuarios (nombre_usuario, numero_telefono, email, contraseña, tipo_usuario) VALUES ('$nombreUsuario', '$telefono', '$email', '$contraseña', '$tipoUsuario')";


if (mysqli_query($conexion, $consulta)) {
    echo "Datos guardados correctamente.";
	//sleep(5); // Esperar 5 segundos
    header("Location: index.html");
    exit(); 
} else {
    echo "Error al guardar los datos: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
