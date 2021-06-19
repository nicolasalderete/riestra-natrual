<?php

    session_start();
    include('../inc/conexion.php');

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty(trim($_POST["nombre"])) || 
            empty(trim($_POST["apellido"])) ||
            empty(trim($_POST["usuario"])) ||
            empty(trim($_POST["clave"])) ||
            empty(trim($_POST["confirmaClave"]))) {

                $Message = "Debe completar los campos obligatorios";
                header("Location:/login.php?error={$Message}");
                exit;
        }
    }


?>