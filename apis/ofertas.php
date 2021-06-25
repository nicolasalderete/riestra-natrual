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
            $imagen = filter_var($_POST["imagen"], FILTER_SANITIZE_STRING);

            if (empty($imagen)) {
                $imagen = "noimage.jpeg";
            }

            $oid = rand();
            $insertOferta = "INSERT INTO ofertas (id, nombre, descripcion, estado, precio, imagen) values ($oid, '$nombre', '$descripcion', 'HA', $precio, '$imagen')";
            $resultado = pg_query($insertOferta) or die('Error en el servidor');

            if ($resultado) {
                foreach ($productos as &$prod) {
                    $insertProdOfertas = "INSERT INTO productos_ofertas (productoid, ofertaid) values ($prod, $oid)";
                    $resultadoProdOfertas = pg_query($insertProdOfertas) or die('Error en el servidor');
                    if (!$resultado) {
                        $Message = "Error al crear la oferta";
                        header("Location:/admin/ofertas_alta.php?error={$Message}");
                    }
                }
                $Message = "Se ha creado la oferta ".$nombre."";
                header("Location:/admin/ofertas.php?success={$Message}");
            } else {
                $Message = "Error al crear la oferta";
                header("Location:/admin/ofertas_alta.php?error={$Message}");
            }
            pg_close($db);
        }
    }

    function actualizarOferta() {

        if(empty($_POST["oferId"]) || empty($_POST["nombre"]) || empty($_POST["descripcion"]) || empty($_POST["estado"]) || empty($_POST["precio"])){
            $Message = "Debe completar los campos obligatorios";
            header("Location:/admin/ofertas_editar.php?id={}&error={$Message}");
        } else{
            $oferId = $_POST["oferId"];
            $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
            $descripcion = filter_var($_POST["descripcion"], FILTER_SANITIZE_STRING);
            $precio = filter_var($_POST["precio"], FILTER_SANITIZE_STRING);
            $estado = $_POST["estado"];
            $productos = $_POST["productos"];
            $imagen = filter_var($_POST["imagen"], FILTER_SANITIZE_STRING);

            $actualizarOferta = "UPDATE ofertas SET nombre='$nombre', descripcion='$descripcion', estado='$estado', precio=$precio, imagen='$imagen'  WHERE id='$oferId'";
            $resultado = pg_query($actualizarOferta) or die('Error en el servidor');

            $borrarProductos = "DELETE FROM productos_ofertas WHERE ofertaid=$oferId";
            $resultadoDelete = pg_query($borrarProductos) or die('Error en el servidor');

            foreach ($productos as &$prod) {
                $insertProdOfertas = "INSERT INTO productos_ofertas (productoid, ofertaid) values ($prod, $oferId)";
                $resultadoProdOfertas = pg_query($insertProdOfertas) or die('Error en el servidor');
                if (!$resultadoProdOfertas) {
                    $Message = "Error al crear la oferta";
                    header("Location:/admin/ofertas_alta.php?error={$Message}");
                }
            }

            pg_close($db);
            if ($resultado) {
                $Message = "Se ha actualizado la Oferta ".$nombre."";
                header("Location:/admin/ofertas.php?success={$Message}");
            } else {
                $Message = "Error al actualizar la oferta";
                header("Location:/admin/ofertas_editar.php?id={$oferId}&error={$Message}");
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