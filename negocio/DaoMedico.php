<?php
require_once '../persistencia/Conexion.php';

class DaoMedico {
    public function listarMedicos() {
        $sql = "SELECT * FROM medico";
        try {
            $con = Conexion::getConexion();
            $stmt = $con->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error al listar médicos: " . $e->getMessage();
            return [];
        }
    }
    
    public function insertarMedico($cmp, $nombre, $apellido, $especialidad) {
        $con = new Conexion();
        $cn = $con->getConexion();
        $sql = "INSERT INTO medico (cmp, nombre, apellido, especialidad) VALUES (?, ?, ?, ?)";
        $stmt = $cn->prepare($sql);
        return $stmt->execute([$cmp, $nombre, $apellido, $especialidad]);
    }

    public function actualizarMedico($cmp, $nombre, $apellido, $especialidad) {
        $con = new Conexion();
        $cn = $con->getConexion();
        $sql = "UPDATE medico SET nombre = ?, apellido = ?, especialidad = ? WHERE cmp = ?";
        $stmt = $cn->prepare($sql);
        return $stmt->execute([$nombre, $apellido, $especialidad, $cmp]);
    }

    public function eliminarMedico($cmp) {
        $con = new Conexion();
        $cn = $con->getConexion();
        $sql = "DELETE FROM medico WHERE cmp = ?";
        $stmt = $cn->prepare($sql);
        return $stmt->execute([$cmp]);
    }

    public function tieneHorarios($cmp) {
        $conexion = new Conexion();
        $cn = $conexion->getConexion();
        $sql = "SELECT COUNT(*) as total FROM horario WHERE cmp = ?";
        $stmt = $cn->prepare($sql);
        $stmt->execute([$cmp]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] > 0;
    }

    public function eliminarMedicoYHorarios($cmp) {
        $conexion = new Conexion();
        $cn = $conexion->getConexion();
        $stmt1 = $cn->prepare("DELETE FROM horario WHERE cmp = ?");
        $stmt1->execute([$cmp]);
        $stmt2 = $cn->prepare("DELETE FROM medico WHERE cmp = ?");
        return $stmt2->execute([$cmp]);
    }
}
