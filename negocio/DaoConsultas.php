<?php
require_once '../persistencia/Conexion.php';

class DaoConsultas {
    public function consultarMascotas() {
        $sql = "SELECT * FROM mascota";
        try {
            $con = Conexion::getConexion();
            $stmt = $con->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return [];
    }

    public function consultarPropietarios() {
        $sql = "SELECT * FROM propietario";
        try {
            $con = Conexion::getConexion();
            $stmt = $con->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return [];
    }

    public function buscarMascotasPorNombre($nombre) {
        $sql = "SELECT * FROM mascota WHERE nombre LIKE ?";
        try {
            $con = Conexion::getConexion();
            $stmt = $con->prepare($sql);
            $stmt->execute(["%" . $nombre . "%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return [];
    }

    public function buscarPropietarioPorDni($dni) {
        $sql = "SELECT * FROM propietario WHERE dni = ?";
        try {
            $con = Conexion::getConexion();
            $stmt = $con->prepare($sql);
            $stmt->execute([$dni]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return null;
    }

    public function eliminarAmbos($idMascota) {
        $sqlProp = "DELETE FROM propietario WHERE id_mascota = ?";
        $sqlMascota = "DELETE FROM mascota WHERE id_mascota = ?";
        try {
            $con = Conexion::getConexion();
            $con->beginTransaction();

            $stmt1 = $con->prepare($sqlProp);
            $stmt1->execute([$idMascota]);

            $stmt2 = $con->prepare($sqlMascota);
            $stmt2->execute([$idMascota]);

            $con->commit();
            return true;
        } catch (Exception $e) {
            $con->rollBack();
            echo "Error al eliminar: " . $e->getMessage();
        }
        return false;
    }
}
?>
