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

// Obtener nombres de la base de la base de datos
$pacientesQuery = "SELECT id_paciente, nombre_completo FROM pacientes";
$resultadopacientes = mysqli_query($enlace, $pacientesQuery);

// Obtener los nombres de los doctores
$doctoresQuery = "SELECT id_doctor, nombre_doctor FROM doctores";
$resultadodoctores = mysqli_query($enlace, $doctoresQuery);

// Procesar el formulario
if (isset($_POST['agendar'])) {
    $fecha = $_POST['fecha'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $pacienteid = $_POST['pacienteid'] ?? '';
    $doctorid = $_POST['doctorid'] ?? '';

    // Validar que los campos no estén vacíos
    if ($fecha && $hora && $pacienteid && $doctorid) {
        $insertarDatos = "INSERT INTO citas (fecha_cita, hora_cita, id_paciente, id_doctor, estado_cita) VALUES ('$fecha', '$hora', '$pacienteid', '$doctorid', 'Pendiente')";
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
    <h2>Agendar Cita</h2>
    <form id="formAgendarCita" method="POST" action="">
        <!-- Fecha de la Cita -->
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>

        <!-- Hora de la Cita -->
        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" class="form-control" id="hora" name="hora" required>
        </div>

        <!-- Seleccionar Paciente -->
        <div class="mb-3">
            <label for="pacienteid" class="form-label">Paciente</label>
            <select class="form-select" id="pacienteid" name="pacienteid" required>
                <option value="">Selecciona una opción</option>
                <?php 
                if ($resultadopacientes) {
                    while ($pacientes = mysqli_fetch_assoc($resultadopacientes)) {
                        echo "<option value='{$pacientes['id_paciente']}'>{$pacientes['nombre_completo']}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <!-- Seleccionar Doctor -->
        <div class="mb-3">
            <label for="doctorid" class="form-label">Doctor</label>
            <select class="form-select" id="doctorid" name="doctorid" required>
                <option value="">Selecciona una opción</option>
                <?php 
                if ($resultadodoctores) {
                    while ($doctores = mysqli_fetch_assoc($resultadodoctores)) {
                        echo "<option value='{$doctores['id_doctor']}'>{$doctores['nombre_doctor']}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <!-- Botón para Agendar -->
        <button type="submit" class="btn btn-primary" name="agendar">Agendar Cita</button>
           <!-- Botón de Regresar -->
           <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Regresar a Inicio</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
