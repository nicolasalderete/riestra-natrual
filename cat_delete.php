<?php
    include('inc/conexion.php');

    if($_SERVER["REQUEST_METHOD"] == "GET"){

        if(empty(trim($_GET["id"]))){
            $mensaje = "Error al eliminar la categoria";
            header("Location:cat_admin.php?error=$mensaje");
            exit;
        } else {
            $idCat = filter_var($_GET["id"], FILTER_SANITIZE_STRING);
            $sqlupdate = "DELETE FROM categorias where id = '$idCat'";
            if (mysqli_query($conexion, $sqlupdate)) {
                mysqli_close($conexion);
                $mensaje = "Categoria eliminada";
                header("Location:cat_admin.php?success=$mensaje");
            } else {
                $mensaje = "Error al eliminar la categoria";
                header("Location:cat_admin.php?error=$mensaje");
            }
        }
    }

    
?>