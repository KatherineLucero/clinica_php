<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listado de Doctores</title>
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

<div class="container mt-5">
    <h2>Listado de Doctores</h2>
    
    <?php
    // Conexión a la base de datos
    $enlace = mysqli_connect("localhost", "root", "", "ml21026clinica_l2");

    // Verifica si la conexión fue exitosa
    if (!$enlace) {
        die("Error de conexión a la base de datos: " . mysqli_connect_error());
    }

    // Consulta SQL para obtener doctores y sus especialidades
    $consulta = "
        SELECT d.nombre_doctor, e.nombre_especialidad 
        FROM doctores d
        JOIN especialidades e ON d.especialidad = e.id_especialidad
    ";

    $resultado = mysqli_query($enlace, $consulta);

    // Verifica si la consulta obtuvo resultados
    if (mysqli_num_rows($resultado) > 0) {
        echo '<table class="table table-striped table-bordered">';
        echo '<thead class="table-dark">';
        echo '<tr>';
        echo '<th scope="col">Nombre del Doctor</th>';
        echo '<th scope="col">Especialidad</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Itera sobre cada fila de resultados y genera una fila de tabla
        while ($doctor = mysqli_fetch_assoc($resultado)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($doctor['nombre_doctor']) . '</td>';
            echo '<td>' . htmlspecialchars($doctor['nombre_especialidad']) . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "<div class='alert alert-info'>No hay doctores registrados.</div>";
    }

    // Cierra la conexión
    mysqli_close($enlace);
    ?>
      <!-- Botón de Regresar -->
      <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Regresar a Inicio</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
