<?php
    include('inc/conexion.php');

    if($_SERVER["REQUEST_METHOD"] == "GET"){

        if(empty(trim($_GET["id"]))){
            $mensaje = "Error al eliminar el producto";
            header("Location:prod_admin.php?error=$mensaje");
            exit;
        } else {
            $idProd = filter_var($_GET["id"], FILTER_SANITIZE_STRING);
            $sqldelete = "DELETE FROM productos where id = '$idProd'";
            if (mysqli_query($conexion, $sqldelete)) {
                mysqli_close($conexion);
                $mensaje = "Producto eliminado";
                header("Location:prod_admin.php?success=$mensaje");
            } else {
                $mensaje = "Error al eliminar el producto";
                header("Location:prod_admin.php?error=$mensaje");
            }
        }
    }

    
?>