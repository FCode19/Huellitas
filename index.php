<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Huellitas - Bienvenido</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="recursos/PERRO.png"/>
    </head>
    <body class="bg-light">

        <header class="bg-primary text-white py-3">
            <div class="container d-flex justify-content-between align-items-center">
                <h1 class="h3 m-0">🐾 Huellitas</h1>
                <a href="vista/Login.php" class="btn btn-light">Iniciar Sesión</a>
            </div>
        </header>

        <main class="container text-center py-5">
            <h2 class="mb-4">Bienvenido a nuestro sistema de gestión veterinaria</h2>
            <p class="lead">Administra las mascotas, propietarios y consultas fácilmente.</p>
            <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="Veterinaria" width="120" class="my-4">
            <p>Haz clic en "Iniciar Sesión" para comenzar a gestionar.</p>
        </main>

        <footer class="bg-dark text-white text-center py-3 mt-auto">
            <small>&copy; <?php echo date('Y'); ?> Happy Pets. Todos los derechos reservados.</small>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
