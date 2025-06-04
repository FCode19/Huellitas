<?php
require_once '../negocio/DaoMascota.php';
require_once '../negocio/DaoPropietario.php';
require_once '../persistencia/Conexion.php';

$daoMascota = new DaoMascota();
$daoPropietario = new DaoPropietario();

if (isset($_POST['btnBuscar'])) {
    $idMascota = $_POST['idMascota'];
    $mascota = $daoMascota->buscar($idMascota);
    $propietario = $daoPropietario->buscarPorIdMascota($idMascota);
}

if (isset($_POST['btnRegistrar']) || isset($_POST['btnActualizar'])) {
    $nombre = $_POST['nombreMascota'];
    $tamano = $_POST['tamano'];
    $color = $_POST['color'];
    $edad = $_POST['edad'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $especie = $_POST['especie'];
    $sexo = $_POST['sexo'];
    $raza = $_POST['raza'];
    $vacunas = isset($_POST['vacunas']) ? implode(',', $_POST['vacunas']) : '';
    
    $dni = $_POST['dni'];
    $nombrePropietario = $_POST['nombrePropietario'];
    $apellidoPropietario = $_POST['apellidoPropietario'];
    $direccion = $_POST['direccion'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];

    if (isset($_POST['btnRegistrar'])) {
        $idMascota = $daoMascota->registrar($nombre, $tamano, $color, $edad, $fechaNacimiento, $especie, $sexo, $raza, $vacunas);
        if ($idMascota !== null) {
            $daoPropietario->registrar($dni, $nombrePropietario, $apellidoPropietario, $direccion, $celular, $correo, $idMascota);
        } else {
            echo "No se pudo registrar la mascota, por lo tanto no se registró el propietario.";
        }
    }


    if (isset($_POST['btnActualizar'])) {
        $idMascota = $_POST['idMascota'];
        $daoMascota->actualizar($idMascota, $nombre, $tamano, $color, $edad, $fechaNacimiento, $especie, $sexo, $raza, $vacunas);
        $daoPropietario->actualizar($dni, $nombrePropietario, $apellidoPropietario, $direccion, $celular, $correo, $idMascota);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vista Menu Empleado</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="recursos/PERRO.png"/>
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                document.getElementById('btnLimpiar').addEventListener('click', function () {
                    const form = document.querySelector('#formularioMascota');
                    form.reset();

                    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
                    checkboxes.forEach(cb => cb.checked = false);

                    const hiddenInputs = form.querySelectorAll('input[type="hidden"], input[name="idMascota"]');
                    hiddenInputs.forEach(i => i.value = '');
                });
            });
        </script>
    </head>
    <body class="bg-light">

        <div class="container my-4">
            <div class="d-flex justify-content-between mb-3">
                <a href="VistaPanelConsulta.php" class="btn btn-primary">Ir a Panel de Consultas</a>
                <a href="MasterLogin.php" class="btn btn-secondary">Volver a Inicio</a>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Buscar Mascota</h5>
                </div>
                <div class="card-body">
                    <form method="POST" class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="idMascota" name="idMascota" placeholder="ID de la mascota" required>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" name="btnBuscar" class="btn btn-info w-100">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>

            <form method="POST" id="formularioMascota">
                <input type="hidden" name="idMascota" value="<?php echo isset($mascota['id_mascota']) ? $mascota['id_mascota'] : ''; ?>">

                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Datos de Paciente</h5>
                    </div>
                    <div class="card-body row g-3">
                        <?php

                        function campo($id, $label, $valor, $tipo = "text") {
                            echo "<div class='col-md-4'>
                        <label for='$id' class='form-label'>$label</label>
                        <input type='$tipo' id='$id' name='$id' class='form-control' value='$valor' required>
                    </div>";
                        }
                        ?>
                        <?php
                        campo("nombreMascota", "Nombre Mascota", isset($mascota['nombre']) ? $mascota['nombre'] : '');
                        campo("tamano", "Tamaño", isset($mascota['tamano']) ? $mascota['tamano'] : '');
                        campo("color", "Color", isset($mascota['color']) ? $mascota['color'] : '');
                        campo("edad", "Edad", isset($mascota['edad']) ? $mascota['edad'] : '', "number");
                        campo("fechaNacimiento", "Fecha Nacimiento", isset($mascota['fec_nacimiento']) ? $mascota['fec_nacimiento'] : '', "date");
                        campo("raza", "Raza", isset($mascota['raza']) ? $mascota['raza'] : '');
                        ?>
                        <div class="col-md-4">
                            <label for="especie" class="form-label">Especie</label>
                            <select id="especie" name="especie" class="form-select" required>
                                <?php
                                $opciones = ['PERRO', 'GATO', 'HAMSTER', 'PEZ', 'PAJARO'];
                                foreach ($opciones as $opcion) {
                                    $sel = (isset($mascota['especie']) && $mascota['especie'] == $opcion) ? 'selected' : '';
                                    echo "<option value='$opcion' $sel>$opcion</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="sexo" class="form-label">Sexo</label>
                            <select id="sexo" name="sexo" class="form-select" required>
                                <option value="Macho" <?php echo (isset($mascota['sexo']) && $mascota['sexo'] == 'Macho') ? 'selected' : ''; ?>>Macho</option>
                                <option value="Hembra" <?php echo (isset($mascota['sexo']) && $mascota['sexo'] == 'Hembra') ? 'selected' : ''; ?>>Hembra</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Vacunas</label>
                            <div class="form-check form-check-inline">
                                <?php
                                $vacunas = ['Rabia', 'Refuerzos', 'Polivalentes', 'Parvovirus'];
                                foreach ($vacunas as $v) {
                                    $checked = isset($mascota['vacunas']) && strpos($mascota['vacunas'], $v) !== false ? 'checked' : '';
                                    echo "<div class='form-check form-check-inline me-4 mb-2'><input type='checkbox' class='form-check-input' name='vacunas[]' value='$v' $checked><label class='form-check-label'>$v</label>
                                    </div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">Datos de Propietario</h5>
                    </div>
                    <div class="card-body row g-3">
                        <?php
                        campo("dni", "DNI", isset($propietario['dni']) ? $propietario['dni'] : '');
                        campo("nombrePropietario", "Nombre", isset($propietario['nombre']) ? $propietario['nombre'] : '');
                        campo("apellidoPropietario", "Apellidos", isset($propietario['apellidos']) ? $propietario['apellidos'] : '');
                        campo("direccion", "Dirección", isset($propietario['direccion']) ? $propietario['direccion'] : '');
                        campo("celular", "Celular", isset($propietario['celular']) ? $propietario['celular'] : '');
                        campo("correo", "Correo Electrónico", isset($propietario['correo']) ? $propietario['correo'] : '', "email");
                        ?>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-3">
                    <button type="submit" name="btnRegistrar" class="btn btn-success">Registrar</button>
                    <button type="submit" name="btnActualizar" class="btn btn-primary">Actualizar</button>
                    <button type="button" id="btnLimpiar" class="btn btn-danger">Limpiar</button>
                </div>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

