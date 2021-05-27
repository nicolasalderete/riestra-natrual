<?php
    include('inc/conexion.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty($_POST["nombre"])){
            $nombre_error = "Por favor indique un nombre de categoria";
        } else{
            $nombre = $_POST["nombre"];
        }
        
        if(empty($_POST["descripcion"])){
            $descripcion_error = "Por favor cargue una descripcion para la categoria";
        } else{
            $descripcion = $_POST["descripcion"];
        }

        

        if($_POST["accion"] == "alta") {
            if (!empty($descripcion_error) || !empty($nombre_error)) {
                $Message = "Debe completar los campos categoria y descripcion";
                header("Location:cat_alta.php?error={$Message}");
            } else {
                $altausuario = "INSERT INTO categorias (nombre, descripcion) values ('$nombre', '$descripcion')";
                $resultado = mysqli_query($conexion, $altausuario) or die('No se ha podido ejecutar la consulta.');
                
                mysqli_close($conexion);
        
                if ($resultado) {
                    $Message = "Se ha creado la categoria ".$nombre."";
                    header("Location:cat_admin.php?success={$Message}");
                } else {
                    $Message = "Error al insertar la categoria";
                    header("Location:cat_alta.php?error={$Message}");
                }
            }

        } elseif ($_POST["accion"] == "update") {
            $catId = filter_var($_POST["catId"], FILTER_SANITIZE_STRING);

            if (!empty($descripcion_error) || !empty($nombre_error)) {
                $Message = "Debe completar los campos categoria y descripcion";
                header("Location:cat_edit.php?id=".$catId."&error={$Message}");
            } else {
                $actualizarCategoria = "UPDATE categorias SET nombre='$nombre', descripcion='$descripcion' WHERE id='$catId'";
                if (mysqli_query($conexion, $actualizarCategoria)) {
                    mysqli_close($conexion);
                    $Message = "Se ha actualizado la categoria ".$nombre."";
                    header("Location:cat_admin.php?success={$Message}&m='$nombre'&n='$descripcion'");
                } else {
                    $Message = "No se pudo actualizar la categoria";
                    header("Location:cat_edit.php?id=".$catId."&error={$Message}");
                }
            }
        } else {
            header("Location:error.html");
        }

    } else {
        header("Location:error.html");
    }
?>