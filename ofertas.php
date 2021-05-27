<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('inc/head.php'); ?>

    <?php 
        head();
    ?>
    <?php include('inc/menu.php'); ?>
    <?php include('inc/footer.php'); ?>
    <?php include('inc/conexion.php'); ?>
</head>
<body >
    
    <?php 
        menu();

        $consulta = 'SELECT * FROM ofertas';
        $resultado = mysqli_query($conexion, $consulta)
            or die('No se ha podido ejecutar la consulta.');

        mysqli_close($conexion);
    ?>
        
    <main class="container mt-5">

        <?php if (!$resultado): ?>
            <h1 class="text-center">No se encontraron ofertas</h1> 
        <?php else: ?>

            <?php 
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<div class='jumbotron'>";
                        echo "<div class='container'>";
                            echo "<h1 class='display-4'>".$fila['nombre']."</h1>";
                            echo "<p class='lead'>".$fila['descripcion']."</p>";
                        echo "</div>";
                    echo "</div>";
                }
            ?>
        <?php endif; ?>
    </main>

    <?php 
        footer();
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>