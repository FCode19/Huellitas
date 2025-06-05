<?php
require_once '../persistencia/Conexion.php';
class DaoHorario {
    public function listarHorariosConMedico() {
        $sql = "SELECT 
                    h.num_horario,
                    h.cmp,
                    m.nombre,
                    m.apellido,
                    m.especialidad,
                    h.fecha,
                    h.hora,
                    h.consultorio,
                    h.estado
                FROM horario h
                JOIN medico m ON h.cmp = m.cmp";
        try {
            $con = Conexion::getConexion();
            $stmt = $con->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error al listar horarios: " . $e->getMessage();
        }
        return [];
    }
    
    public function actualizarHorario($num_horario, $fecha, $hora, $consultorio, $estado) {
        $sql = "UPDATE horario SET fecha = ?, hora = ?, consultorio = ?, estado = ? WHERE num_horario = ?";
        try {
            $con = Conexion::getConexion();
            $stmt = $con->prepare($sql);
            return $stmt->execute([$fecha, $hora, $consultorio, $estado, $num_horario]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function eliminarHorario($num_horario) {
        $sql = "DELETE FROM horario WHERE num_horario = ?";
        try {
            $con = Conexion::getConexion();
            $stmt = $con->prepare($sql);
            return $stmt->execute([$num_horario]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    public function registrarHorario($cmp, $fecha, $hora, $consultorio, $estado) {
        $sql = "INSERT INTO horario (cmp, fecha, hora, consultorio, estado) VALUES (?, ?, ?, ?, ?)";
        try {
            $con = Conexion::getConexion();
            $stmt = $con->prepare($sql);
            return $stmt->execute([$cmp, $fecha, $hora, $consultorio, $estado]);
        } catch (Exception $e) {
            echo "Error al registrar: " . $e->getMessage();
            return false;
        }
    }
}
