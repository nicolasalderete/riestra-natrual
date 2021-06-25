<?php

    session_start();
    include('../inc/conexion.php');

    if(($_SERVER["REQUEST_METHOD"] == "POST") 
        && ($_POST["dispatch"]=="register")) {

        if (empty($_POST["nombre"]) || 
            empty($_POST["apellido"]) ||
            empty($_POST["usuario"]) ||
            empty($_POST["clave"]) ||
            empty($_POST["confirmaClave"])) {

                $Message = "Debe completar los campos obligatorios";
                header("Location:/registro.php?error={$Message}");
                exit;
        }

        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $usuario = $_POST["usuario"];
        $clave = $_POST["clave"];
        $confirma = $_POST["confirmaClave"];

        if (strcmp($clave, $confirma) !== 0) {
            $Message = "Las claves deben ser iguales";
            header("Location:/registro.php?error={$Message}");
            exit;
        }

        if (pg_num_rows(pg_query("SELECT id FROM usuarios WHERE usuario = '$usuario'"))) {
            $Message = "El usuario ya existe, elija otro usuario";
            header("Location:/admin/usuarios_alta.php?error={$Message}");
            pg_close($db);
        } else {

            $clavehash = password_hash($clave, PASSWORD_BCRYPT);
            $altausuario = "INSERT INTO usuarios (nombre, apellido, usuario, clave, estado, rol) values ('$nombre', '$apellido', '$usuario', '$clavehash', 'HA', 'USER')";
            $resultado = pg_query($altausuario) or die('No se ha podido ejecutar la consulta.');
            
            pg_close($db);
            if ($resultado) {
                $Message = "Se ha registrado como usuario de la tienda";
                header("Location:/index.php?success={$Message}");
            } else {
                $Message = "Se a producido un error en el servidor";
                header("Location:/error.html?error={$Message}");
            }
        }

    } else {
        $Message = "Se a producido un error en el servidor";
        header("Location:/error.html?error={$Message}");
        exit;
    }


?>