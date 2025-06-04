<?php
class Conexion {
    public static function getConexion() {
        $host = 'localhost';
        $dbname = 'bd_veterinaria';
        $usuario = 'root';
        $clave = '';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $clave);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>
