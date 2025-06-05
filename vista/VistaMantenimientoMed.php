<?php
require_once '../negocio/DaoMedico.php';
$dao = new DaoMedico();
$medicos = $dao->listarMedicos();
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mantenimiento de Médicos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container py-4">

        <h2 class="mb-4">Mantenimiento de Médicos</h2>

        <!-- Tabla de médicos -->
        <div class="table-responsive mb-5">
            <table class="table table-bordered table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th>CMP</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Especialidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($medicos as $m): ?>
                        <tr>
                            <td><?= htmlspecialchars($m['cmp']) ?></td>
                            <td><?= htmlspecialchars($m['nombre']) ?></td>
                            <td><?= htmlspecialchars($m['apellido']) ?></td>
                            <td><?= htmlspecialchars($m['especialidad']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning me-2" onclick="mostrarEditarMedico('<?= $m['cmp'] ?>', '<?= $m['nombre'] ?>', '<?= $m['apellido'] ?>', '<?= $m['especialidad'] ?>')">Actualizar</button>
                                <button class="btn btn-sm btn-danger" onclick="confirmarEliminarMedico('<?= $m['cmp'] ?>')">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Registro de nuevo médico -->
        <h4>Registrar Nuevo Médico</h4>
        <form action="../controlador/registrarMedico.php" method="POST" class="row g-3 mt-2">
            <div class="col-md-3">
                <label class="form-label">CMP</label>
                <input type="number" name="cmp" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Apellido</label>
                <input type="text" name="apellido" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Especialidad</label>
                <input type="text" name="especialidad" class="form-control" required>
            </div>
            <div class="col-12 d-flex justify-content-between mt-2">
                <button class="btn btn-success">Registrar Médico</button>
                <a href="VistaMenuMed.php" class="btn btn-secondary">Volver</a>
            </div>
        </form>

        
        <!-- Modal para actualizar médico -->
        <div class="modal fade" id="modalEditarMedico" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="../controlador/actualizarMedico.php" method="POST" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Actualizar Médico</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <input type="hidden" name="cmp" id="editCmp">
                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="editNombre" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="apellido" id="editApellido" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Especialidad</label>
                            <input type="text" name="especialidad" id="editEspecialidad" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function mostrarEditarMedico(cmp, nombre, apellido, especialidad) {
                document.getElementById('editCmp').value = cmp;
                document.getElementById('editNombre').value = nombre;
                document.getElementById('editApellido').value = apellido;
                document.getElementById('editEspecialidad').value = especialidad;
                                    new bootstrap.Modal(document.getElementById('modalEditarMedico')).show();
                                }

                                function confirmarEliminarMedico(cmp) {
                                    if (confirm("¿Estás seguro de eliminar al médico con CMP " + cmp + "?")) {
                                        window.location.href = "../controlador/eliminarMedico.php?cmp=" + cmp;
                                    }
                                }
        </script>
    </body>
</html>
