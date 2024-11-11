<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registro</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url('../IMG/Hospital.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: rgba(255, 255, 255, 0.5); /* Color semi-transparente */
            background-blend-mode: overlay;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>

<?php 
/* conecion de la base de datos */
$enlace = mysqli_connect("localhost", "root", "", "ml21026clinica_l2");

if (!$enlace) {
    die("No se pudo conectarse a la base de datos: " . mysqli_connect_error());
}

//nombre del boton
if (isset($_POST['registro'])) {
    $nombre = $_POST['nombre'] ?? '';
    $fechaNacimiento = $_POST['fechaNacimiento'] ?? '';
    $dui = $_POST['dui'] ?? '';
    $telefono = $_POST['telefono'] ?? '';

    // Validar que los campos no estén vacíos
    if ($nombre && $fechaNacimiento && $dui && $telefono) {
        $insertarDatos = "INSERT INTO pacientes (nombre_completo, fecha_nacimiento, dui, telefono) VALUES ('$nombre', '$fechaNacimiento', '$dui', '$telefono')";
        $ejecutarInsertar = mysqli_query($enlace, $insertarDatos);

        if ($ejecutarInsertar) {
            echo "<div class='alert alert-success'>Registro exitoso.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error en el registro: " . mysqli_error($enlace) . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Por favor, complete todos los campos.</div>";
    }
}
?>

<div class="container mt-5">
    <h2>Registrar pacientes</h2>
    <form action="#" method="POST">
        <!-- Nombre Completo -->
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa tu nombre completo" required>
        </div>

        <!-- Fecha de Nacimiento -->
        <div class="mb-3">
            <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento" required>
        </div>

        <!-- Dui (máximo 9 dígitos) -->
        <div class="mb-3">
            <label for="dui" class="form-label">DUI</label>
            <input type="text" class="form-control" name="dui" id="dui" placeholder="000000000" maxlength="9" pattern="\d{9}" title="El DUI debe consistir en 9 dígitos." required>
            <small class="form-text text-muted">Por favor, ingresa un número de DUI de 9 dígitos.</small>
        </div>

        <!-- Teléfono (máximo 8 dígitos) -->
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Número de teléfono" maxlength="8" pattern="\d{8}" required>
            <div class="form-text">8 dígitos como máximo (ej. 12345678).</div>
        </div>

        <!-- Botón de Enviar  -->
        <button type="submit" class="btn btn-primary" name="registro">Enviar</button>
         <!-- Botón de al inicio -->
        <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Regresar a Inicio</button>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
