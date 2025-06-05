<?php
require_once '../negocio/DaoMedico.php';

$dao = new DaoMedico();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $cmp = $_GET['cmp'] ?? null;
    $forzar = isset($_GET['forzar']) && $_GET['forzar'] === 'true';

    if ($cmp) {
        if ($dao->tieneHorarios($cmp)) {
            if ($forzar) {
                $dao->eliminarMedicoYHorarios($cmp);
                header('Location: ../vista/VistaMantenimientoMed.php');
                exit();
            } else {
                echo "<script>
                    if (confirm('El médico tiene citas pendientes. ¿Deseas eliminarlas y continuar?')) {
                        window.location.href = 'eliminarMedico.php?cmp={$cmp}&forzar=true';
                    } else {
                        window.location.href = '../vista/VistaMantenimientoMed.php';
                    }
                </script>";
                exit();
            }
        } else {
            $dao->eliminarMedico($cmp);
            header('Location: ../vista/VistaMantenimientoMed.php');
            exit();
        }
    }
}
