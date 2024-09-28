<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administración</title>
  <link rel="stylesheet" href="css/styles.css">
  <style>
    /* Estilos adicionales para la lista de sugerencias */
    #sugerencias {
      border: 1px solid #ccc;
      max-height: 100px;
      overflow-y: auto;
      display: none;
    }
    .sugerencia-item {
      padding: 8px;
      cursor: pointer;
    }
    .sugerencia-item:hover {
      background-color: #ddd;
    }
  </style>
</head>
<body>
  <header>
    <h1>Panel de Administración</h1>
  </header>
  <nav>
    <ul>
      <li><a href="Admin.php">Bienvenido</a></li>
      <li><a href="Admon_users.php">Usuarios</a></li>
      <li><a href="Admon_product.php">Productos</a></li>
	  <li><a href="index.html">Cerrar sesión</a></li>

    </ul>
  </nav>
  <main>
    <section id="bienvenido">
      <h2>Bienvenido al Panel de Administración</h2>
      <p>¡Hola, Administrador! Bienvenido a tu panel de administración. Aquí puedes gestionar usuarios y productos.</p>
    </section>
    <section id="usuarios">
      <h2>Productos</h2>
      <button id="toggleTable">Mostrar Productos</button>
      <button id="showForm">Gestión de Productos</button>
      <button id="hideTable" style="display:none;">Regresar</button>
      <button id="hideForm" style="display:none;">Regresar</button>
      <div id="tablaUsuarios" style="display:none;">
        <?php
          // Conexión a la base de datos
          $conexion = mysqli_connect("localhost", "bryant", "1234567890", "geometricos");

          // Comprobar la conexión
          if (mysqli_connect_errno()) {
            echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
            exit();
          }

          // Consulta SQL para obtener los usuarios
          $consulta = "SELECT id, nombre_producto , precio , presentacion, DESCRIPCION  FROM producto";
          if ($resultado = mysqli_query($conexion, $consulta)) {
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Nombre de producto</th><th>Precio</th><th>Presentacion</th><th>Descripcion</th></tr>";
            while ($fila = mysqli_fetch_assoc($resultado)) {
              echo "<tr>";
              echo "<td>" . $fila['id'] . "</td>";
              echo "<td>" . $fila['nombre_producto'] . "</td>";
              echo "<td>" . $fila['precio'] . "</td>";
              echo "<td>" . $fila['presentacion'] . "</td>";
              echo "<td>" . $fila['DESCRIPCION'] . "</td>";
              echo "</tr>";
            }
            echo "</table>";
            // Liberar el conjunto de resultados
            mysqli_free_result($resultado);
          }

          // Cerrar la conexión
          mysqli_close($conexion);
        ?>
      </div>
      <div id="formularioUsuarios" style="display:none;">
        <input type="text" id="buscarUsuario" placeholder="Buscar usuario por nombre">
        <div id="sugerencias"></div>
		 
       <form action="guardar_producto.php" method="POST" id="formulario">

    <input type="text" id="idUsuario" name="idUsuario"> <!-- Campo oculto para enviar el ID -->
    <label for="nombreUsuario">nombre de producto :</label>
    <input type="text" id="nombreUsuario" name="nombreUsuario" required><br>
    <label for="telefono">Precio:</label>
    <input type="text" id="telefono" name="telefono" required><br>
    <label for="email">Presentacion:</label>
    <input type="text" id="email" name="email" required><br>
	<label for="email">Descripcion:</label>
    <input type="text" id="Descripcion" name="Descripcion" required><br>
  <select id="delete" name="delete" required>
        <option value="vacio">.</option>
        <option value="Eliminar">Eliminar</option>
	</select>
 
	   <input type="submit" value="Guardar">
	</form>
	

      </div>
    </section>
  </main>

  <script>
    document.getElementById("toggleTable").addEventListener("click", function() {
      document.getElementById("tablaUsuarios").style.display = "block";
      document.getElementById("toggleTable").style.display = "none";
      document.getElementById("showForm").style.display = "none";
      document.getElementById("hideTable").style.display = "inline-block";
    });

    document.getElementById("hideTable").addEventListener("click", function() {
      document.getElementById("tablaUsuarios").style.display = "none";
      document.getElementById("toggleTable").style.display = "inline-block";
      document.getElementById("showForm").style.display = "inline-block";
      document.getElementById("hideTable").style.display = "none";
    });

    document.getElementById("showForm").addEventListener("click", function() {
      document.getElementById("formularioUsuarios").style.display = "block";
      document.getElementById("toggleTable").style.display = "none";
      document.getElementById("showForm").style.display = "none";
      document.getElementById("hideForm").style.display = "inline-block";
    });

    document.getElementById("hideForm").addEventListener("click", function() {
      document.getElementById("formularioUsuarios").style.display = "none";
      document.getElementById("toggleTable").style.display = "inline-block";
      document.getElementById("showForm").style.display = "inline-block";
      document.getElementById("hideForm").style.display = "none";
    });

// Búsqueda dinámica
document.getElementById("buscarUsuario").addEventListener("input", function() {
    var termino = this.value;

    if (termino.length > 0) {
        fetch(`buscar_producto.php?termino=${termino}`)
            .then(response => response.json())
            .then(data => {
                var sugerenciasDiv 	= document.getElementById("sugerencias");
                sugerenciasDiv.innerHTML = "";

                data.forEach(function(usuario) {
                    var div = document.createElement("div");
                    div.classList.add("sugerencia-item");
                    div.textContent = usuario.nombre_producto ;
                    div.addEventListener("click", function() {
                        fetch(`obtener_producto.php?id=${usuario.id}`)
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById("idUsuario").value = data.id;
                                document.getElementById("nombreUsuario").value = data.nombre_producto ;
                                document.getElementById("telefono").value = data.precio ;
                                document.getElementById("email").value = data.presentacion ;
								 document.getElementById("Descripcion").value = data.DESCRIPCION ;
                             
                            })
                            .catch(error => console.error('Error al obtener usuario:', error));
                        sugerenciasDiv.innerHTML = "";
                        sugerenciasDiv.style.display = "none";
                    });
                    sugerenciasDiv.appendChild(div);
                });

                sugerenciasDiv.style.display = "block";
            })
            .catch(error => console.error('Error al buscar usuarios:', error));
    } else {
        document.getElementById("sugerencias").style.display = "none";
    }
});

  </script>
</body>
</html>
