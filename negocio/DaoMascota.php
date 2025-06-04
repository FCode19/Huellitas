<?php
require_once '../persistencia/Conexion.php';

class DaoMascota {
    public function registrar($nombre, $tamano, $color, $edad, $fechaNacimiento, $especie, $sexo, $raza, $vacunas) {
        $sql = "INSERT INTO mascota (nombre, tamano, color, edad, fec_nacimiento, especie, sexo, raza, vacunas)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        try {
            $con = Conexion::getConexion();
            $stmt = $con->prepare($sql);
            $stmt->execute([$nombre, $tamano, $color, $edad, $fechaNacimiento, $especie, $sexo, $raza, $vacunas]);
            return $con->lastInsertId();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function buscar($idMascota) {
        $sql = "SELECT * FROM mascota WHERE id_mascota = ?";
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

    public function actualizar($idMascota, $nombre, $tamano, $color, $edad, $fecNacimiento, $especie, $sexo, $raza, $vacunas) {
        $sql = "UPDATE mascota SET nombre = ?, tamano = ?, color = ?, edad = ?, fec_nacimiento = ?, especie = ?, sexo = ?, raza = ?, vacunas = ?
                WHERE id_mascota = ?";
        try {
            $con = Conexion::getConexion();
            $stmt = $con->prepare($sql);
            $stmt->execute([$nombre, $tamano, $color, $edad, $fecNacimiento, $especie, $sexo, $raza, $vacunas, $idMascota]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
