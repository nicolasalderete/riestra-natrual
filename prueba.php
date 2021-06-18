<?php
$nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
$descripcion = filter_var($_POST["descripcion"], FILTER_SANITIZE_STRING);
$precio = filter_var($_POST["precio"], FILTER_SANITIZE_STRING);
$estado = filter_var($_POST["estado"], FILTER_SANITIZE_STRING);

echo $nombre."\n";
echo $descripcion."\n";
echo $precio."\n";
echo $estado."\n";
foreach ($_POST["productos"] as $selectedOption)
    echo $selectedOption."\n";
?>
