<?php
    include('../inc/conexion.php');

    function crearCategoria() {
        if(empty($_POST["nombre"]) || empty($_POST["descripcion"]) || empty($_POST["estado"]) ){
            $Message = "Debe completar los campos categoria, descripcion y estado";
            header("Location:/admin/categorias_alta.php?error={$Message}");
        } else{
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $estado = $_POST["estado"];
            $insertCategoria = "INSERT INTO categorias (nombre, descripcion, estado) values ('$nombre', '$descripcion', '$estado')";
            $resultado = pg_query($insertCategoria) or die('Error en el servidor');
            
            pg_close($db);
    
            if ($resultado) {
                $Message = "Se ha creado la categoria ".$nombre."";
                header("Location:/admin/categorias.php?success={$Message}");
            } else {
                $Message = "Error al crear la categoria";
                header("Location:/admin/categorias_alta.php?error={$Message}");
            }
        }
    }

    function actualizarCategoria() {
        if(empty($_POST["nombre"]) || empty($_POST["descripcion"]) || empty($_POST["estado"]) ){
            $Message = "Debe completar los campos categoria, descripcion y estado";
            header("Location:/admin/categorias_alta.php?error={$Message}");
        } else{
            $catId = filter_var($_POST["catId"], FILTER_SANITIZE_STRING);
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $estado = $_POST["estado"];
            $actualizarCategoria = "UPDATE categorias SET nombre='$nombre', descripcion='$descripcion', estado='$estado' WHERE id='$catId'";
            $resultado = pg_query($actualizarCategoria) or die('Error en el servidor');
            
            pg_close($db);
    
            if ($resultado) {
                $Message = "Se ha actualizado la categoria ".$nombre."";
                header("Location:/admin/categorias.php?success={$Message}");
            } else {
                $Message = "Error al actualizar la categoria";
                header("Location:/admin/categorias_edit.php?error={$Message}");
            }
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $dispatch = $_POST["dispatch"];

        switch ($dispatch) {
            case 'create':
                crearCategoria();
                break;
            case 'update':
                actualizarCategoria();
                break;
            default:
                header("Location:error.html");
                break;
        }
    } else {
        header("Location:error.html");
    }

?>