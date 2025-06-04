<?php
require_once '../persistencia/Conexion.php';

class DaoPropietario {
    public function registrar($dni, $nombre, $apellidos, $direccion, $celular, $correo, $idMascota) {
        $sql = "INSERT INTO propietario (dni, nombre, apellidos, direccion, celular, correo, id_mascota)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        try {
            $con = Conexion::getConexion();
            $stmt = $con->prepare($sql);
            $stmt->execute([$dni, $nombre, $apellidos, $direccion, $celular, $correo, $idMascota]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function buscarPorIdMascota($idMascota) {
        $sql = "SELECT * FROM propietario WHERE id_mascota = ?";
        try {
            $con = Conexion::getConexion();
            $stmt = $con->prepare($sql);
            $stmt->execute([$idMascota]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return null;
    }

    public function actualizar($dni, $nombre, $apellidos, $direccion, $celular, $correo, $idMascota) {
        $sql = "UPDATE propietario SET dni = ?, nombre = ?, apellidos = ?, direccion = ?, celular = ?, correo = ?
                WHERE id_mascota = ?";
        try {
            $con = Conexion::getConexion();
            $stmt = $con->prepare($sql);
            $stmt->execute([$dni, $nombre, $apellidos, $direccion, $celular, $correo, $idMascota]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
