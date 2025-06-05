<?php
require_once '../negocio/DaoHorario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cmp = $_POST['cmp'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $consultorio = $_POST['consultorio'];
    $estado = $_POST['estado'];

    $dao = new DaoHorario();

    $resultado = $dao->registrarHorario($cmp, $fecha, $hora, $consultorio, $estado);

    if ($resultado) {
        header("Location: ../vista/VistaMenuMed.php");
        exit;
    } else {
        echo "Error al actualizar el horario.";
    }
}
?>
