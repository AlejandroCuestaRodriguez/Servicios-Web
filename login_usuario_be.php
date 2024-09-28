<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "geometricos");

// Comprobar la conexión
if ($conexion->connect_error) {
    die("Fallo al conectar a MySQL: " . $conexion->connect_error);
}

// Obtener datos del formulario
$nombre_completo = $_POST['nombre_completo'];
$contrasena = $_POST['contrasena'];

// Consulta para verificar las credenciales
$sql = "SELECT tipo_usuario FROM usuarios WHERE nombre_usuario = ? AND contraseña = ?";
$stmt = $conexion->prepare($sql);

// Verificar si la preparación de la consulta fue exitosa
if ($stmt === false) {
    die('Error en la preparación de la consulta: ' . $conexion->error);
}

// Enlazar parámetros
$stmt->bind_param('ss', $nombre_completo, $contrasena);

// Ejecutar la consulta
$stmt->execute();

// Almacenar el resultado para poder obtener el número de filas
$stmt->store_result();

// Verificar si se encontraron resultados
if ($stmt->num_rows > 0) {
    // Vincular resultado a variables
    $stmt->bind_result($tipo_usuario);
    $stmt->fetch();

    // Redirigir según el tipo de usuario
    if ($tipo_usuario == 'admin') {
        header("Location: admin.php");
    } else if ($tipo_usuario == 'cliente') {
        header("Location: index_cl.html");
    }

    // Finalizar el script después de redirigir
    exit();
} else {
    echo "No se pudo iniciar sesión: Credenciales incorrectas";
}

// Cerrar la conexión y liberar los recursos
$stmt->close();
$conexion->close();
?>
