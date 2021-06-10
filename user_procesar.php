<?php
    include('inc/conexion.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty($_POST["nombre"])){
            $nombre_error = "Por favor indique un nombre para el usuario";
        } else{
            $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
        }
        
        if(empty($_POST["apellido"])){
            $apellido_error = "Por favor cargue un apellido para el usuario";
        } else{
            $apellido = filter_var($_POST["apellido"], FILTER_SANITIZE_STRING);
        }
        if(empty($_POST["usuario"])){
            $usuario_error = "Por favor indique un usuario por favor";
        } else{
            $usuario = filter_var($_POST["usuario"], FILTER_SANITIZE_STRING);
        }
        
        if(empty($_POST["clave"])){
            $clave_error = "Por favor cargue una clave para el usuario.";
        } else{
            $clave = filter_var($_POST["clave"], FILTER_SANITIZE_STRING);
        }

        if($_POST["accion"] == "alta") {
            if (!empty($descripcion_error) || !empty($nombre_error) || !empty($usuario_error) || !empty($clave_error)) {
                $Message = "Debe completar los campos obligatorios";
                header("Location:user_admin.php?error={$Message}");
            } else {
        
                $existeusuario = "select count(usuario) as nuevo from usuarios where usuario = '$usuario'";
            
                $resultado = pg_query($existeusuario);
        
                while ($a = pg_fetch_assoc($resultado)) {
                    $existe = $a['nuevo'];
                }
        
                if ($existe) {
                    $Message = "El usuario ya existe, elija otro usuario";
                    header("Location:user_alta.php?error={$Message}");
                    exit;
                }
        
                $clavehash = password_hash($clave, PASSWORD_BCRYPT);
                $altausuario = "INSERT INTO usuarios (nombre, apellido, usuario, clave) values ('$nombre', '$apellido', '$usuario', '$clavehash')";
                echo $altausuario;
                $resultado = pg_query($altausuario) or die('No se ha podido ejecutar la consulta.');
                
                pg_close($db);
                
                if ($resultado) {
                    $Message = "Se ha creado el usuario ".$nombre."";
                    header("Location:user_admin.php?success={$Message}");
                } else {
                    $Message = "Error al crear el usuario";
                    header("Location:user_admin.php?error={$Message}");
                }
            }
        } elseif ($_POST["accion"] == "update") {
            if (!empty($descripcion_error) || !empty($nombre_error) || !empty($usuario_error) || !empty($clave_error)) {
                $Message = "Debe completar los campos obligatorios";
                header("Location:user_admin.php?error={$Message}");
            } else {
                $userId = filter_var($_POST["userId"], FILTER_SANITIZE_STRING);

                $existeusuario = "select * from usuarios where usuario = '$usuario'";
            
                $resultado = pg_query($existeusuario);
        
                while ($a = pg_fetch_assoc($resultado)) {
                    $existe = $a['id_usuario'];
                }
        
                if ($existe != $userId) {
                    $Message = "El usuario ya existe, elija otro usuario.";
                    $id = trim($userId);
                    header("Location:user_edit.php?id=".$id."&error={$Message}");
                } else {
                    $clavehash = password_hash($clave, PASSWORD_BCRYPT);
                    $altausuario = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', usuario='$usuario', clave='$clave' WHERE id_usuario='$userId'";
                    $resultado = pg_query($altausuario) or die('No se ha podido ejecutar la consulta.');
                    
                    pg_close($db);
                    
                    if ($resultado) {
                        $Message = "Se ha actualizado el usuario ".$nombre."";
                        header("Location:user_admin.php?success={$Message}");
                    } else {
                        $Message = "Error al actualizar el usuario";
                        header("Location:user_edit.php?id=".$id."&error={$Message}");
                    }
                }
            }
        } else {
            header("Location:error.html");
        }
    } else {
        header("Location:error.html");
    }

?>