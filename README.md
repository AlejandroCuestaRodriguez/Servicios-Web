<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interacción con Botones en JavaScript</title>
    <style>
        body {
            height: 200vh;
        }
        #message {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            width: 300px;
            text-align: center;
        }
        button {
            display: block;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Eventos en JavaScript</h1>

    <!-- Botones -->
    <button id="clickBtn">Haz clic aquí</button>
    <button id="dobleClicBtn">Haz doble clic aquí</button>
    <button id="hoverBtn">Pasa el ratón por aquí</button>
    <button id="keydownBtn">Haz clic y presiona una tecla</button>
    <button id="submitBtn">Envía el formulario</button>

    <!-- Formulario -->
    <form id="miFormulario" style="display: none;">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Introduce tu nombre">
        <button type="submit">Enviar</button>
    </form>

    <!-- contenedor -->
    <div id="message">Presiona algun boton</div>

    <script>
        const messageDiv = document.getElementById('message');

        // Evento click
        const clickBtn = document.getElementById('clickBtn');
        clickBtn.addEventListener('click', function() {
            messageDiv.textContent = 'Hiciste clic en el botón';
        });

        // Evento doble clic
        const dobleClicBtn = document.getElementById('dobleClicBtn');
        dobleClicBtn.addEventListener('dblclick', function() {
            messageDiv.textContent = 'Hiciste doble clic en el botón';
        });

        // Evento mouseover
        const hoverBtn = document.getElementById('hoverBtn');
        hoverBtn.addEventListener('mouseover', function() {
            messageDiv.textContent = 'Pasaste el ratón por encima del botón';
        });

        // Evento keydown 
        const keydownBtn = document.getElementById('keydownBtn');
        keydownBtn.addEventListener('click', function() {
            document.addEventListener('keydown', function(event) {
                
                if (/^[a-zA-Z]$/.test(event.key)) {
                    messageDiv.textContent = `Presionaste la tecla: ${event.key}`;
                } else {
                    messageDiv.textContent = 'Solo se permiten letras';
                }
            }, { once: true }); 
        });

        // Evento submit
        const submitBtn = document.getElementById('submitBtn');
        const formulario = document.getElementById('miFormulario');
        submitBtn.addEventListener('click', function() {
            formulario.style.display = 'block'; // Mostrar el formulario
        });

        formulario.addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar que el formulario se envíe
            const nombre = document.getElementById('nombre').value;
            messageDiv.textContent = `Formulario enviado. Nombre: ${nombre}`;
        });

        // Evento scroll
       window.addEventListener('scroll', function() {
      //   messageDiv.textContent = `Te has desplazado ${window.scrollY} píxeles hacia abajo`;
        });
    </script>
</body>
</html>
