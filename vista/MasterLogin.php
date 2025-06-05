<?php
    session_start();
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Panel Principal</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="recursos/PERRO.png"/>
        <style>
            .full-height {
                height: 100vh;
            }
            .left-panel {
                background-color: #f8f9fa;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .right-section {
                display: flex;
                flex-direction: column;
                height: 100%;
            }
            .clickable-area {
                flex: 1;
                display: flex;
                align-items: center;
                padding-left: 30px;
                border-bottom: 1px solid #dee2e6;
                cursor: pointer;
                transition: background-color 0.3s;
            }
            .clickable-area:hover {
                background-color: #f1f1f1;
            }
            .clickable-area img {
                width: 40px;
                height: 40px;
                margin-right: 15px;
            }
            .clickable-area:last-child {
                border-bottom: none;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid full-height">
            <div class="row full-height">
                <div class="col-3 left-panel">
                    <img src="../recursos/LOGOO.png" alt="Logo" class="img-fluid" style="background-color: #fafafb">
                </div>
                <div class="col-9 right-section">
                    <div class="clickable-area" onclick="location.href='VistaMenuMed.php'">
                        <img src="../recursos/MEDICO.png" alt="Médico">
                        <h4 class="mb-0">MÉDICO</h4>
                    </div>
                    <div class="clickable-area" onclick="location.href='VistaMenuEmp.php'">
                        <img src="../recursos/EMPLEADO.png" alt="Empleado">
                        <h4 class="mb-0">EMPLEADO</h4>
                    </div>
                    <div class="clickable-area" onclick="location.href='#'">
                        <img src="../recursos/PACIENTE.png" alt="Paciente">
                        <h4 class="mb-0">PACIENTE</h4>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
