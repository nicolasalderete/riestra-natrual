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
        $resultado = pg_query($consulta)
            or die('No se ha podido ejecutar la consulta.');

        pg_close($db);
    ?>
        
    <main class="container mt-5">
        <h1>Ofertas</h1>
        <hr>
        <?php if (!$resultado): ?>
            <h1 class="text-center">No se encontraron ofertas</h1> 
        <?php else: ?> 
            <?php  while ($fila = pg_fetch_assoc($resultado)) { ?>
                <div class="row no-gutters bg-light position-relative">
                    <div class="col-md-6 mb-md-0 p-md-4">
                        <?php $srcimagen = urlRecursosOfertas($fila['imagen']); ?>    
                        <img src="<?php echo $srcimagen; ?>" class="w-100" alt="<?php echo $fila['nombre']?>">
                    </div>
                    <div class="col-md-6 position-static p-4 pl-md-0">
                        <h5 class="mt-0"><?php echo $fila['nombre']; ?></h5>
                        <p><?php echo $fila['descripcion']; ?></p>
                        <a href="/user/carrito.php" class="btn-secondary btn"><i class="fas fa-shopping-cart"></i> Agregar</a>
                    </div>
                </div>
                <br>
            <?php } ?>
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