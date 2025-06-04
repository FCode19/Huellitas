<?php
require_once '../persistencia/Conexion.php';

class DaoLogin {
    public function validarCredenciales($usuario, $clave) {
        $sql = "SELECT * FROM usuarios WHERE usuario = ? AND clave = ?";
        try {
            $con = Conexion::getConexion();
            $stmt = $con->prepare($sql);
            $stmt->execute([$usuario, $clave]);
            return $stmt->fetch() !== false;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return false;
    }
}
?>
