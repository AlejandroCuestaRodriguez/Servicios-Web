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
$delete = $_POST['delete'];
$descripcion  = $_POST['Descripcion'];


// Obtener el ID del formulario (si existe)
$id = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : null;



// Preparar y ejecutar la consulta de actualización o inserción
if($delete=="Eliminar")
{
	$consulta = "DELETE FROM `producto` WHERE nombre_producto ='$nombreUsuario' and id='$id'";
	
	
}
else
{
	if ($id) {
		// Si existe un ID, actualizar el usuario existente
		$consulta = "UPDATE producto SET nombre_producto ='$nombreUsuario', precio  ='$telefono', presentacion ='$email', DESCRIPCION = '$descripcion' WHERE id=$id";
	} else {
		// Si no existe un ID, insertar un nuevo usuario
		$consulta = "INSERT INTO producto (nombre_producto , precio  , presentacion, DESCRIPCION) VALUES ('$nombreUsuario', '$telefono', '$email', '$descripcion')";
	}
}


if (mysqli_query($conexion, $consulta)) {
    echo "Datos guardados correctamente.";
	sleep(5); // Esperar 5 segundos
    header("Location: Admon_product.php");
    exit(); 
} else {
    echo "Error al guardar los datos: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
