<?php
// Conexión a la base de datos
          $conexion = mysqli_connect("localhost", "bryant", "1234567890", "geometricos");
		  
// Comprobar la conexión
if (mysqli_connect_errno()) {
    echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
    exit();
}

// Obtener el término de búsqueda
$termino = $_GET['termino'];

// Consulta SQL para buscar usuarios
$consulta = "SELECT id, nombre_producto  FROM producto WHERE nombre_producto  LIKE '%" . mysqli_real_escape_string($conexion, $termino) . "%' LIMIT 10";
$resultado = mysqli_query($conexion, $consulta);

$usuarios = [];
while ($fila = mysqli_fetch_assoc($resultado)) {
    $usuarios[] = $fila;
}
	
// Devolver los resultados en formato JSON
echo json_encode($usuarios);

// Cerrar la conexión
mysqli_close($conexion);
?>
