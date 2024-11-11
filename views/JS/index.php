<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MENU_ML21026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href='views/css/index_ML21026_CLAVE_X.css'>
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


h1{
    color: blue;
}
</style>

<body>


<h1>BIENVENIDO AL MENU</h1>


<div>
<nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">AGENDA DE CITAS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <!-- primera opcion  -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Pacientes
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="PacienteFormulario.php">Registro</a></li>
            </ul>
          </li>
<!-- segunda opcion -->
<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             Doctores
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="DoctorRegistro.php">Registro</a></li>
              <li><a class="dropdown-item" href="DoctorListado.php">Listado</a></li>
              </ul>
          </li>

          <!-- tercera opcion -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             Registro de citas
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="AgendarCita.php">Agendar cita</a></li>
              <li><a class="dropdown-item" href="ListadoCita.php">Estado</a></li>
              </ul>
            </li>

          <!-- cuarta opcion -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             Gestion de citas
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="estadoCita.php">Estado</a></li>
              </ul> 
          </li>

        </ul>
       
      </div>
    </div>
  </div>
</nav>
<footer class="text-center mt-5 p-3" style="background-color: #f8f9fa;">
    <p>&copy; 2024 ML21026_ Clave_X_ . KATHERINE PATRICIA MENDEZ LUCERO.</p>
</footer>

</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>