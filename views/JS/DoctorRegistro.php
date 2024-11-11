<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registro</title>
</head>
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
<body>

<?php 
// Conexión a la base de datos
$enlace = mysqli_connect("localhost", "root", "", "ml21026clinica_l2");

if (!$enlace) {
    die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
}

// Obtener especialidades de la base de datos
$especialidadesQuery = "SELECT id_especialidad, nombre_especialidad FROM especialidades";
$resultadoEspecialidades = mysqli_query($enlace, $especialidadesQuery);

if (isset($_POST['guardar'])) {
    $nombreDoctor = $_POST['nombreDoctor'] ?? '';
    $especialidad = $_POST['especialidad'] ?? '';
    $telefonoDoctor = $_POST['telefonoDoctor'] ?? '';

    // Validar que los campos no estén vacíos
    if ($nombreDoctor && $especialidad && $telefonoDoctor) {
        $insertarDatos = "INSERT INTO doctores (nombre_doctor, especialidad, telefono) VALUES ('$nombreDoctor', '$especialidad', '$telefonoDoctor')";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registro de Doctor</title>
</head>
<body>

<div class="container mt-5">
    <h2>Registro de Doctor</h2>
    <form method="POST">
        <!-- Nombre del Doctor -->
        <div class="mb-3">
            <label for="nombreDoctor" class="form-label">Nombre del Doctor</label>
            <input type="text" class="form-control" id="nombreDoctor" name="nombreDoctor" placeholder="Ingresa el nombre completo" required>
        </div>

        <!-- Especialidad -->
        <div class="mb-3">
            <label for="especialidad" class="form-label">Especialidad</label>
            <select class="form-select" id="especialidad" name="especialidad" required>
                <option value="">Selecciona una especialidad</option>
                <?php 
                // Generar las opciones del select con las especialidades de la base de datos
                if ($resultadoEspecialidades) {
                    while ($especialidad = mysqli_fetch_assoc($resultadoEspecialidades)) {
                        echo "<option value='{$especialidad['id_especialidad']}'>{$especialidad['nombre_especialidad']}</option>";
                    }
                }
                ?>
            </select>
        </div>


        
        <!-- Teléfono -->
        <div class="mb-3">
            <label for="telefonoDoctor" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefonoDoctor" name="telefonoDoctor" placeholder="Número de teléfono" maxlength="8" pattern="\d{8}" required>
            <div class="form-text">Formato: 8 dígitos (ej. 12345678).</div>
        </div>

        <!-- Botón de Enviar -->
        <button type="submit" class="btn btn-primary" name="guardar">Registrar Doctor</button>
        <!-- Botón de Regresar -->
        <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Regresar a Inicio</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
