<?php
    include('../inc/conexion.php');

    function crearProducto() {
        if(empty($_POST["nombre"]) || 
            empty($_POST["descripcion"]) ||
            empty($_POST["categoria"]) ||
            empty($_POST["precio"])) {
                $Message = "Debe completar los campos nombre, categoria, descripcion y precio";
                header("Location:/admin/productos_alta.php?error={$Message}");
                exit;
        } else {
            $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
            $descripcion = filter_var($_POST["descripcion"], FILTER_SANITIZE_STRING);
            $categoria = filter_var($_POST["categoria"], FILTER_VALIDATE_INT);
            $precio = filter_var($_POST["precio"], FILTER_SANITIZE_STRING);
            $imagen = filter_var($_POST["imagen"], FILTER_SANITIZE_STRING);
            if(empty($imagen) ){
                $imagen = "noimage.jpeg";
            }
            if(!empty($_POST["destacado"])){
                $destacado = "Y";
            } else {
                $destacado = "N";
            }

            $altaproducto = "INSERT INTO productos (nombre, descripcion, categoriaid, precio, destacado, imagen, estado) values ('$nombre', '$descripcion', '$categoria', $precio, '$destacado', '$imagen', 'HA')";
            $resultado = pg_query($altaproducto) or die('No se ha podido ejecutar la consulta.');
            
            pg_close($db);
    
            if ($resultado) {
                $Message = "Se ha creado el producto ".$nombre."";
                header("Location:/admin/productos.php?success={$Message}");
                exit;
            } else {
                $Message = "Error al insertar el producto";
                header("Location:/admin/productos_alta.php?error={$Message}");
                exit;
            }

        }
    }

    function actualizarProducto() {
        if(empty($_POST["nombre"]) || 
            empty($_POST["descripcion"]) ||
            empty($_POST["categoria"]) ||
            empty($_POST["precio"])) {
                $Message = "Debe completar los campos nombre, categoria, descripcion y precio";
                header("Location:/admin/productos_alta.php?error={$Message}");
                exit;
        } else {
            $prodId = filter_var($_POST["prodId"], FILTER_SANITIZE_STRING);
            $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
            $descripcion = filter_var($_POST["descripcion"], FILTER_SANITIZE_STRING);
            $categoria = filter_var($_POST["categoria"], FILTER_VALIDATE_INT);
            $precio = filter_var($_POST["precio"], FILTER_SANITIZE_STRING);
            $imagen = filter_var($_POST["imagen"], FILTER_SANITIZE_STRING);
            $estado = filter_var($_POST["estado"], FILTER_SANITIZE_STRING);
            if(empty($imagen) ){
                $imagen = "noimage.jpeg";
            }
            if(!empty($_POST["destacado"])){
                $destacado = "Y";
            } else {
                $destacado = "N";
            }

            $update_producto = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', categoriaid = '$categoria', precio = $precio, destacado = '$destacado', imagen = '$imagen', estado = '$estado' WHERE id='$prodId'";
            $resultado = pg_query($update_producto) or die('No se ha podido ejecutar la consulta.');
            
            pg_close($db);

            if ($resultado) {
                $Message = "Se ha actualizado el producto ".$nombre."";
                header("Location:/admin/productos.php?success={$Message}");
                exit;
            } else {
                $Message = "Error al actualizar el producto";
                header("Location:/admin/productos_alta.php?error={$Message}");
                exit;
            }

        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $dispatch = $_POST["dispatch"];
        switch ($dispatch) {
            case 'create':
                crearProducto();
                break;
            case 'update':
                actualizarProducto();
                break;
            default:
                header("Location:/error.html");
                break;
        }
    } else {
        header("Location:/error.html");
    }

?>