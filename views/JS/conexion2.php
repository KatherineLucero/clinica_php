<?php
class Conexion {
    private $host = '127.0.0.1';
    private $usuario = 'root';
    private $contraseña = '';
    private $baseDatos = 'ml21026clinica_l2';
    public $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contraseña, $this->baseDatos);
        if ($this->conexion->connect_error) {
            die('Error en la conexión: ' . $this->conexion->connect_error);
        } else{
            echo "conectado";
        }
    }

    public function cerrarConexion() {
        $this->conexion->close();
    }
}
?>
