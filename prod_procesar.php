<?php
    include('inc/conexion.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty($_POST["nombre"])){
            $nombre_error = "Por favor indique un nombre del producto";
        } else{
            $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
        }

        if(empty($_POST["descripcion"])){
            $descripcion_error = "Por favor indique un nombre del producto";
        } else{
            $descripcion = filter_var($_POST["descripcion"], FILTER_SANITIZE_STRING);
        }
        
        if(empty($_POST["categoria"])){
            $categoria_error = "Por favor indique la categoria para el producto";
        } else{
            $categoria = filter_var($_POST["categoria"], FILTER_VALIDATE_INT);
        }

        /* Esto es lo que estaba, solo le puse una validacion si ingresaba una letra
        en vez de un numero.
        if(empty($_POST["precio"])){
            $precio_error = "Por favor indique el precio para el producto";
        } 
        */
        if(is_numeric($_POST["precio"]) == false || empty($_POST["precio"]))
        {
            $precio_error = "Por favor indique el precio para el producto";
        } 
        else
        {
            $precio = filter_var($_POST["precio"], FILTER_SANITIZE_STRING);
        }

        if(!empty($_FILES['imagen']['name'])){
            $imagen = $_FILES['imagen']['name'];
        }

        if(!empty($_POST["destacado"])){
            $destacado = 1;
        } else {
            $destacado = 0;
        }

        if (!empty($categoria_error) || !empty($nombre_error) || !empty($precio_error) || !empty($descripcion_error)) {
            $Message = "Debe completar los campos nombre, categoria, descripcion y precio";
            header("Location:prod_alta.php?error={$Message}");
            exit;
        }

        if($_POST["accion"] == "alta") {
            $archivo_subido = true;
            $dir_subida = 'img/prod/';
            if (isset($imagen)) {
                $fichero_subido = $dir_subida . basename($_FILES['imagen']['name']);
                $archivo_subido = move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido);
            } else {
                $imagen = "noimage.jpeg";
            }
            if ($archivo_subido) {
                $altaproducto = "INSERT INTO productos (nombre, descripcion, categoriaid, precio, destacado, imagen) values ('$nombre', '$descripcion', '$categoria', '$precio', $destacado, '$imagen')";
                $resultado = mysqli_query($conexion, $altaproducto) or die('No se ha podido ejecutar la consulta.');
                
                mysqli_close($conexion);
        
                if ($resultado) {
                    $Message = "Se ha creado el producto ".$nombre."";
                    header("Location:prod_admin.php?success={$Message}");
                    exit;
                } else {
                    $Message = "Error al insertar el producto";
                    header("Location:prod_alta.php?error={$Message}");
                    exit;
                }
            } else {
                $Message = "Error al subir el archivo";
                header("Location:prod_alta.php?error={$Message}");
                exit;
            }
            
        } elseif ($_POST["accion"] == "update") {

            $prodId = filter_var($_POST["prodId"], FILTER_SANITIZE_STRING);
            $existe_producto = "select * from productos where id='$prodId'";
            $resultado_producto = mysqli_query($conexion, $existe_producto);
    
            while ($a = mysqli_fetch_assoc($resultado_producto)) {
                $existe = $a['id'];
            }

            if ($existe == $prodId) {
                if (isset($imagen)) {
                    $update_producto = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', categoriaid = '$categoria', precio = '$precio', destacado = $destacado, imagen = '$imagen' WHERE id='$prodId'";
                } else {
                    $update_producto = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', categoriaid = '$categoria', precio = '$precio', destacado = $destacado WHERE id='$prodId'";
                }
                $resultado = mysqli_query($conexion, $update_producto) or die('No se ha podido ejecutar la consulta.');
                mysqli_close($conexion);
                if ($resultado) {
                    $Message = "Se ha actualizado el producto ".$nombre."";
                    header("Location:prod_admin.php?success={$Message}");
                } else {
                    $Message = "Error al actualizar el producto";
                    header("Location:prod_edit.php?id=".$id."&error={$Message}");
                }
            } else {
                $Message = "El producto no existe.";
                $id = trim($prodId);
                header("Location:prod_edit.php?id=".$prodId."&error={$Message}");
            }
        } else {
            header("Location:error.html");
        }
    }
    
?>