<?php
    include('../inc/conexion.php');

    function crearUsuario() {
        
        if(empty($_POST["nombre"]) || 
                empty($_POST["apellido"]) || 
                empty($_POST["usuario"]) ||
                empty($_POST["clave"])){

            $error = "Por favor debe completar los campos obligatorios";
            $Message = "Debe completar los campos obligatorios";
            header("Location:/admin/usuarios_alta.php?error={$Message}");
        } else {

            $usuario = $_POST["usuario"];
            if (pg_num_rows(pg_query("SELECT id FROM usuarios WHERE usuario = '$usuario'"))) {
                $Message = "El usuario ya existe, elija otro usuario";
                header("Location:/admin/usuarios_alta.php?error={$Message}");
                pg_close($db);
            } else {

                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $usuario = $_POST["usuario"];
                $clave = $_POST["clave"];

                $clavehash = password_hash($clave, PASSWORD_BCRYPT);
                $altausuario = "INSERT INTO usuarios (nombre, apellido, usuario, clave, estado, rol) values ('$nombre', '$apellido', '$usuario', '$clavehash', 'HA', 'USER')";
                $resultado = pg_query($altausuario) or die('No se ha podido ejecutar la consulta.');
                
                pg_close($db);
                if ($resultado) {
                    $Message = "Se ha creado el usuario ".$nombre."";
                    header("Location:/admin/usuarios_alta.php?success={$Message}");
                } else {
                    $Message = "Error al crear el usuario ".$nombre."";
                    header("Location:/admin/usuarios_alta.php?error={$Message}");
                }
            }
        }
    }

    function actualizarUsuario() {

        $userId = filter_var($_POST["userId"], FILTER_SANITIZE_NUMBER_INT);
        if(empty($_POST["nombre"]) || 
            empty($_POST["apellido"]) || 
            empty($_POST["usuario"]) ){

            $error = "Por favor debe completar los campos obligatorios";
            $Message = "Debe completar los campos obligatorios";
            header("Location:/admin/usuarios_editar.php?id=".$userId."&error={$Message}");
        } else {
            $resultado = pg_query("SELECT clave as clave FROM usuarios WHERE id = " .$userId."");

            if ($resultado) {
                $row = pg_fetch_assoc($resultado);
                $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
                $apellido = filter_var($_POST["apellido"], FILTER_SANITIZE_STRING);
                $usuario = filter_var($_POST["usuario"], FILTER_SANITIZE_STRING);
                $clave = filter_var($_POST["clave"], FILTER_SANITIZE_STRING);
                $rol = filter_var($_POST["rol"], FILTER_SANITIZE_STRING);
                $estado = filter_var($_POST["estado"], FILTER_SANITIZE_STRING);

                if (empty($_POST["changeclave"])) {
                    $updateUsuario = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', usuario='$usuario', estado='$estado', rol='$rol' WHERE id='$userId'";
                    $resul = pg_query($updateUsuario) or die('No se ha podido ejecutar la consulta.');
                } else {
                    $actual = $row["clave"];
                    
                    if ($clave != $row['clave']) {
                        $clave = password_hash($clave, PASSWORD_BCRYPT);
                    }
                    $updateUsuario = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', usuario='$usuario', clave='$clave', estado='$estado', rol='$rol' WHERE id='$userId'";
                    $resul = pg_query($updateUsuario) or die('No se ha podido ejecutar la consulta.');
                }
                if ($resul) {
                    $Message = "Se ha actualizado el usuario ".$nombre."";
                    header("Location:/admin/usuarios.php?success={$Message}");
                } else {
                    $Message = "Error al actualizar el usuario";
                    header("Location:/admin/usuarios_editar.php?id=".$userId."&error={$Message}");
                }
            }
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $dispatch = $_POST["dispatch"];
        switch ($dispatch) {
            case 'create':
                crearUsuario();
                break;
            case 'update':
                actualizarUsuario();
                break;
            default:
                header("Location:/error.html");
                break;
        }
    } else {
        header("Location:/error.html");
    }

?>