<?php
require_once '../negocio/DaoConsultas.php';
require_once '../objetos/Reporte.php';

$dao = new DaoConsultas();

$mascotas = $dao->consultarMascotas();
$propietarios = $dao->consultarPropietarios();

$tablaMaestra = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['buscarMascota'])) {
        $nombre = $_POST['nombreMascota'];
        $tablaMaestra = $dao->buscarMascotasPorNombre($nombre);
    } elseif (isset($_POST['buscarPropietario'])) {
        $dni = $_POST['dniPropietario'];
        $prop = $dao->buscarPropietarioPorDni($dni);
        if ($prop) {
            $tablaMaestra[] = $prop;
        }
    } elseif (isset($_POST['eliminar']) && isset($_POST['idSeleccionado'])) {
        $id = $_POST['idSeleccionado'];
        $dao->eliminarAmbos($id);
        header("Location: VistaPanelConsulta.php"); // Evitar reenvío en recarga
        exit;
    } elseif (isset($_POST['generarReporte'])) {
        $reporte = new Reporte();
        $headers = [];
        $data = [];

        if (isset($_POST['tabla_maestra'])) {
            $headers = !empty($tablaMaestra) ? array_keys($tablaMaestra[0]) : [];
            $data = $tablaMaestra;
        } elseif (isset($_POST['tabla_mascotas'])) {
            $headers = !empty($mascotas) ? array_keys($mascotas[0]) : [];
            $data = $mascotas;
        } elseif (isset($_POST['tabla_propietarios'])) {
            $headers = !empty($propietarios) ? array_keys($propietarios[0]) : [];
            $data = $propietarios;
        }

        if (!empty($headers) && !empty($data)) {
            $reporte->generarReportePDF($headers, $data);
        } else {
            echo "<script>alert('No hay datos disponibles para el reporte.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Panel de Consultas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="recursos/PERRO.png"/>
    </head>
    <body class="container py-4">
        <h2 class="mb-4">Panel de Consultas</h2>
        <form method="POST" class="row mb-4 g-3">
            <div class="col-md-5">
                <label>Buscar por Nombre de Mascota</label>
                <input type="text" name="nombreMascota" class="form-control">
            </div>
            <div class="col-md-5">
                <label>Buscar Propietario por DNI</label>
                <input type="text" name="dniPropietario" class="form-control">
            </div>
            <div class="col-md-2 d-flex align-items-end gap-2">
                <button type="submit" name="buscarMascota" class="btn btn-primary">Buscar Mascota</button>
                <button type="submit" name="buscarPropietario" class="btn btn-secondary">Buscar Propietario</button>
            </div>
        </form>
        <h4>Tabla Maestra</h4>
        <form method="POST" id="formEliminar">
            <input type="hidden" name="idSeleccionado" id="idSeleccionado">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <?php
                        if (!empty($tablaMaestra)) {
                            foreach (array_keys($tablaMaestra[0]) as $col) {
                                echo "<th>$col</th>";
                            }
                            echo "<th>Seleccionar</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($tablaMaestra as $fila) {
                        echo "<tr>";
                        foreach ($fila as $valor) {
                            echo "<td>" . htmlspecialchars($valor) . "</td>";
                        }
                        echo "<td><input type='radio' name='seleccion' value='" . $fila['id_mascota'] . "' onclick='seleccionarFila(this)'></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" name="eliminar" class="btn btn-danger">Eliminar Seleccionado</button>
        </form>
        <hr>
        <h4>Tabla Mascotas</h4>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <?php
                    foreach (array_keys($mascotas[0] ?? []) as $col)
                        echo "<th>$col</th>";
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mascotas as $fila): ?>
                    <tr>
                        <?php
                        foreach ($fila as $valor)
                            echo "<td>" . htmlspecialchars($valor) . "</td>";
                        ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h4>Tabla Propietarios</h4>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <?php
                    foreach (array_keys($propietarios[0] ?? []) as $col)
                        echo "<th>$col</th>";
                    ?>
                </tr>
            </thead>
            <tbody>
                    <?php foreach ($propietarios as $fila): ?>
                    <tr>
                        <?php
                        foreach ($fila as $valor)
                            echo "<td>" . htmlspecialchars($valor) . "</td>";
                        ?>
                    </tr>
        <?php endforeach; ?>
            </tbody>
        </table>
        <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#modalReporte">Imprimir Reporte</button><br><br>
        <a href="VistaMenuEmp.php" class="btn btn-secondary">Volver</a>
        <div class="modal fade" id="modalReporte" tabindex="-1" aria-labelledby="modalReporteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Seleccionar tablas para el reporte</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tabla_maestra" id="tabla_maestra">
                            <label class="form-check-label" for="tabla_maestra">Tabla Maestra</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tabla_mascotas" id="tabla_mascotas">
                            <label class="form-check-label" for="tabla_mascotas">Tabla Mascotas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tabla_propietarios" id="tabla_propietarios">
                            <label class="form-check-label" for="tabla_propietarios">Tabla Propietarios</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="generarReporte" class="btn btn-primary">Generar PDF</button>
                    </div>
                </form>
            </div>
        </div>
        

        <script>
            function seleccionarFila(radio) {
                document.getElementById('idSeleccionado').value = radio.value;
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
