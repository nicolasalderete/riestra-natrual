<?php
    include('../inc/conexion.php');

    function crearOferta() {
        if(empty($_POST["nombre"]) || empty($_POST["descripcion"]) || empty($_POST["precio"]) ){
            $Message = "Debe completar los campos nombre, descripcion y precio";
            header("Location:/admin/ofertas_alta.php?error={$Message}");
            
        } else{

            $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
            $descripcion = filter_var($_POST["descripcion"], FILTER_SANITIZE_STRING);
            $precio = filter_var($_POST["precio"], FILTER_SANITIZE_STRING);
            $estado = $_POST["estado"];
            $productos = $_POST["productos"];

            $oid = rand();
            $insertOferta = "INSERT INTO ofertas (id, nombre, descripcion, estado, precio) values ($oid, '$nombre', '$descripcion', 'HA', $precio)";
            $resultado = pg_query($insertOferta) or die('Error en el servidor');

            if ($resultado) {
                foreach ($productos as &$prod) {
                    $insertProdOfertas = "INSERT INTO productos_ofertas (productoid, ofertaid) values ($prod, $oid)";
                    $resultadoProdOfertas = pg_query($insertProdOfertas) or die('Error en el servidor');
                    if (!$resultado) {
                        $Message = "Error al crear la oferta";
                        header("Location:/admin/Ofertas_alta.php?error={$Message}");
                    }
                }
                $Message = "Se ha creado la oferta ".$nombre."";
                header("Location:/admin/Ofertas.php?success={$Message}");
            } else {
                $Message = "Error al crear la oferta";
                header("Location:/admin/Ofertas_alta.php?error={$Message}");
            }
            pg_close($db);
        }
    }

    function actualizarOferta() {
        if(empty($_POST["nombre"]) || empty($_POST["descripcion"]) || empty($_POST["estado"]) ){
            $Message = "Debe completar los campos oferta, descripcion y estado";
            header("Location:/admin/Ofertas_alta.php?error={$Message}");
        } else{
            $catId = filter_var($_POST["catId"], FILTER_SANITIZE_STRING);
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $estado = $_POST["estado"];
            $actualizarOferta = "UPDATE Ofertas SET nombre='$nombre', descripcion='$descripcion', estado='$estado' WHERE id='$catId'";
            $resultado = pg_query($actualizarOferta) or die('Error en el servidor');
            
            pg_close($db);
    
            if ($resultado) {
                $Message = "Se ha actualizado la Oferta ".$nombre."";
                header("Location:/admin/ofertas.php?success={$Message}");
            } else {
                $Message = "Error al actualizar la oferta";
                header("Location:/admin/ofertas_edit.php?error={$Message}");
            }
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $dispatch = $_POST["dispatch"];

        switch ($dispatch) {
            case 'create':
                crearOferta();
                break;
            case 'update':
                actualizarOferta();
                break;
            default:
                header("Location:/error.html");
                break;
        }
    } else {
        header("Location:/error.html");
    }

?>