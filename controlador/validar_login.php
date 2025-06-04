<?php
session_start();
require_once '../negocio/DaoLogin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $clave = trim($_POST['contrasena']);

    $dao = new DaoLogin();
    if ($dao->validarCredenciales($usuario, $clave)) {
        $_SESSION['usuario'] = $usuario;
        header("Location: ../vista/MasterLogin.php");
        exit();
    } else {
        $_SESSION['error_login'] = "Usuario o contraseña incorrectos";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
