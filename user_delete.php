<?php
    include('inc/conexion.php');

    if($_SERVER["REQUEST_METHOD"] == "GET"){

        if(empty(trim($_GET["id"]))){
            $mensaje = "Error al eliminar el usuariodasdsadas";
            header("Location:user_admin.php?error=$mensaje");
            exit;
        } else {
            $idUsuario = filter_var($_GET["id"], FILTER_SANITIZE_STRING);
            $sqlupdate = "DELETE FROM usuarios where id_usuario = '$idUsuario'";
            if (mysqli_query($conexion, $sqlupdate)) {
                mysqli_close($conexion);
                $mensaje = "Usuario eliminado";
                header("Location:user_admin.php?success=$mensaje");
            } else {
                $mensaje = "Error al eliminar el usuario";
                header("Location:user_admin.php?error=$mensaje");
            }
        }
    }

    
?>