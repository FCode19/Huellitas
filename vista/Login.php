<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Iniciar Sesion - HappyPets</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="recursos/PERRO.png"/>
    </head>
    <body class="bg-light">
        <?php
        session_start();
        if (isset($_SESSION['error_login'])) {
            echo '<div class="alert alert-danger text-center">' . $_SESSION['error_login'] . '</div>';
            unset($_SESSION['error_login']);
        }
        ?>
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="card shadow-sm p-4" style="min-width: 320px; max-width: 400px;">
                <h3 class="text-center mb-4">Iniciar Sesión</h3>

                <form action="../controlador/validar_login.php" method="POST">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" required>
                    </div>

                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <a href="../index.php" class="text-decoration-none">← Volver al inicio</a>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
