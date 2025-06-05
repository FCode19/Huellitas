<?php
require_once '../negocio/DaoHorario.php';
require_once '../negocio/DaoMedico.php';
$daoHorario = new DaoHorario();
$daoMedico = new DaoMedico();
$horarios = $daoHorario->listarHorariosConMedico();
$medicos = $daoMedico->listarMedicos();
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Vista Menú Médico</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="recursos/PERRO.png"/>
    </head>
    <body>
        <div class="container mt-4">
            <h3 class="mb-4">Gestión de Horarios Médicos</h3>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>N° Horario</th>
                        <th>CMP</th>
                        <th>Nombre del Médico</th>
                        <th>Especialidad</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Consultorio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($horarios as $h): ?>
                        <tr>
                            <td><?= $h['num_horario'] ?></td>
                            <td><a href="#" class="ver-medico" data-bs-toggle="modal" data-bs-target="#modalMedico" data-cmp="<?= $h['cmp'] ?>" data-nombre="<?= $h['nombre'] ?>" data-apellido="<?= $h['apellido'] ?>" data-especialidad="<?= $h['especialidad'] ?>"><?= $h['cmp'] ?></a></td>
                            <td><?= $h['nombre'] . ' ' . $h['apellido'] ?></td>
                            <td><?= $h['especialidad'] ?></td>
                            <td><?= $h['fecha'] ?></td>
                            <td><?= $h['hora'] ?></td>
                            <td><?= $h['consultorio'] ?></td>
                            <td><?= $h['estado'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning btn-actualizar" 
                                        data-num="<?= $h['num_horario'] ?>"
                                        data-fecha="<?= $h['fecha'] ?>"
                                        data-hora="<?= $h['hora'] ?>"
                                        data-consultorio="<?= $h['consultorio'] ?>"
                                        data-estado="<?= $h['estado'] ?>"
                                        >Actualizar</button>
                                <button class="btn btn-sm btn-danger btn-eliminar" data-num="<?= $h['num_horario'] ?>">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h4 class="mt-5">Registrar Nuevo Horario</h4>
            <form action="../controlador/registrarHorario.php" method="POST">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Médico</label>
                        <select name="cmp" class="form-select" required>
                            <option value="">Seleccione</option>
                            <?php foreach ($medicos as $m): ?>
                                <option value="<?= $m['cmp'] ?>">
                                    <?= $m['cmp'] ?> - <?= $m['nombre'] . ' ' . $m['apellido'] ?> - <?= $m['especialidad'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Fecha</label>
                        <input type="date" name="fecha" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Hora</label>
                        <input type="time" name="hora" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Consultorio</label>
                        <select name="consultorio" class="form-select" required>
                            <?php for ($i = 100; $i <= 110; $i++): ?>
                                <option value="C<?= $i ?>">C<?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Estado</label>
                        <select name="estado" class="form-select" required>
                            <option value="Activo">Activo</option>
                            <option value="Cancelado">Cancelado</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Registrar y Refrescar</button>
                <a href="VistaMantenimientoMed.php" class="btn btn-info ms-2">Ir a Mantenimiento Médico</a>
                <a href="../index.html" class="btn btn-secondary ms-2">Volver</a>
            </form>
        </div>

        <!-- Modal Médico -->
        <div class="modal fade" id="modalMedico" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><h5 class="modal-title">Datos del Médico</h5></div>
                    <div class="modal-body">
                        <p><strong>CMP:</strong> <span id="m-cmp"></span></p>
                        <p><strong>Nombre:</strong> <span id="m-nombre"></span></p>
                        <p><strong>Especialidad:</strong> <span id="m-especialidad"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Actualizar -->
        <div class="modal fade" id="modalActualizar" tabindex="-1">
            <div class="modal-dialog">
                <form class="modal-content" action="../controlador/actualizarHorario.php" method="POST">
                    <div class="modal-header"><h5 class="modal-title">Actualizar Horario</h5></div>
                    <div class="modal-body">
                        <input type="hidden" name="num_horario" id="act-num">
                        <div class="mb-2">
                            <label>Fecha</label>
                            <input type="date" class="form-control" name="fecha" id="act-fecha" required>
                        </div>
                        <div class="mb-2">
                            <label>Hora</label>
                            <input type="time" class="form-control" name="hora" id="act-hora" required>
                        </div>
                        <div class="mb-2">
                            <label>Consultorio</label>
                            <select name="consultorio" id="act-consultorio" class="form-select">
                                <?php for ($i = 100; $i <= 110; $i++): ?>
                                    <option value="C<?= $i ?>">C<?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>Estado</label>
                            <select name="estado" id="act-estado" class="form-select">
                                <option value="Activo">Activo</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Confirmar Eliminación -->
        <div class="modal fade" id="modalEliminar" tabindex="-1">
            <div class="modal-dialog">
                <form class="modal-content" action="../controlador/eliminarHorario.php" method="POST">
                    <div class="modal-header"><h5 class="modal-title">Confirmar Eliminación</h5></div>
                    <div class="modal-body">
                        ¿Está seguro que desea eliminar este horario?
                        <input type="hidden" name="num_horario" id="del-num">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.querySelectorAll('.ver-medico').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.getElementById('m-cmp').textContent = btn.dataset.cmp;
                    document.getElementById('m-nombre').textContent = btn.dataset.nombre + ' ' + btn.dataset.apellido;
                    document.getElementById('m-especialidad').textContent = btn.dataset.especialidad;
                });
            });

            document.querySelectorAll('.btn-actualizar').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.getElementById('act-num').value = btn.dataset.num;
                    document.getElementById('act-fecha').value = btn.dataset.fecha;
                    document.getElementById('act-hora').value = btn.dataset.hora;
                    document.getElementById('act-consultorio').value = btn.dataset.consultorio;
                    document.getElementById('act-estado').value = btn.dataset.estado;
                    const modal = new bootstrap.Modal(document.getElementById('modalActualizar'));
                    modal.show();
                });
            });

            document.querySelectorAll('.btn-eliminar').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.getElementById('del-num').value = btn.dataset.num;
                    const modal = new bootstrap.Modal(document.getElementById('modalEliminar'));
                    modal.show();
                });
            });
        </script>
    </body>
</html>
