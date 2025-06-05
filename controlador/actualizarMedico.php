<?php
require_once '../negocio/DaoMedico.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cmp = $_POST['cmp'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $especialidad = $_POST['especialidad'];

    $dao = new DaoMedico();
    $resultado = $dao->actualizarMedico($cmp, $nombre, $apellido, $especialidad);

    header('Location: ../vista/VistaMantenimientoMed.php');
    exit();
}
