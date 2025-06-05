<?php
require_once '../negocio/DaoHorario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num_horario = $_POST['num_horario'];

    $dao = new DaoHorario();
    $resultado = $dao->eliminarHorario($num_horario);

    if ($resultado) {
        header("Location: ../vista/VistaMenuMed.php");
        exit;
    } else {
        echo "Error al actualizar el horario.";
    }
}
?>
