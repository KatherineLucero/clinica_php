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
<!-- Botón de Regresar -->
<button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Regresar a Inicio</button>

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
            </tr>
        </thead>
        <tbody id="tablaCitasProgramadas">
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
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No se han agendado citas aún.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
