<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listado de Citas</title>
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

// Obtener las citas programadas
$citasQuery = "SELECT c.id_cita, c.fecha_cita, c.hora_cita, p.nombre_completo AS paciente, d.nombre_doctor AS doctor, c.estado_cita
               FROM citas c
               JOIN pacientes p ON c.id_paciente = p.id_paciente
               JOIN doctores d ON c.id_doctor = d.id_doctor";
$resultadoCitas = mysqli_query($enlace, $citasQuery);

// Función para actualizar el estado de una cita
if (isset($_GET['cita_id']) && isset($_GET['estado'])) {
    $cita_id = $_GET['cita_id'];
    $nuevo_estado = $_GET['estado'];

    // Actualizar el estado de la cita en la base de datos
    $updateQuery = "UPDATE citas SET estado_cita = '$nuevo_estado' WHERE id_cita = $cita_id";
    $updateResult = mysqli_query($enlace, $updateQuery);

    if ($updateResult) {
        echo "<script>alert('Estado de cita actualizado correctamente');</script>";
    } else {
        echo "<script>alert('Error al actualizar el estado: " . mysqli_error($enlace) . "');</script>";
    }

    // Redirigir de nuevo al listado de citas
    echo "<script>window.location.href = 'Listado_citas.php';</script>";
}
?>

<div class="container mt-5">
    <h2>Listado de Citas Programadas</h2>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID de Cita</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Paciente</th>
                <th scope="col">Doctor</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaCitas">
            <?php
            // Mostrar las citas de la base de datos en la tabla
            if ($resultadoCitas) {
                while ($cita = mysqli_fetch_assoc($resultadoCitas)) {
                    echo "<tr>
                            <td>{$cita['id_cita']}</td>
                            <td>{$cita['fecha_cita']}</td>
                            <td>{$cita['hora_cita']}</td>
                            <td>{$cita['paciente']}</td>
                            <td>{$cita['doctor']}</td>
                            <td>{$cita['estado_cita']}</td>
                            <td>";
                    // Si la cita está cancelada, mostrar opción de re-agendar
                    if ($cita['estado_cita'] == 'cancelada') {
                        echo "<a href='AgendarCita.php?id={$cita['id_cita']}' class='btn btn-warning btn-sm'>Re-agendar</a>";
                    } else {
                        // Si no está cancelada, mostrar opción para marcar como completada o cancelada
                        echo "<a href='ListadoCitas.php?cita_id={$cita['id_cita']}&estado=completada' class='btn btn-success btn-sm'>Completada</a>
                              <a href='istadoCitas.php?cita_id={$cita['id_cita']}&estado=cancelada' class='btn btn-danger btn-sm'>Cancelar</a>";
                    }
                    echo "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No se han agendado citas aún.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Botón de Regresar -->
<button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Regresar a Inicio</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
