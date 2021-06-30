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


    <style>
        


    
    
    </style>
</head>
<body >
    
    <?php 
        menu();
        if(empty(trim($_GET["id"]))){
            header("Location:/error.html");
            exit;
        } else {
            $prodId = filter_var($_GET["id"], FILTER_SANITIZE_STRING);
            
            $queryProducto = "select * from productos where id = $prodId";
            $productoResult = pg_query($queryProducto) or header("Location:/error.html");

            $fila = pg_fetch_assoc($productoResult);
            $categoriaId = $fila['categoriaid'];
            $consulta = "SELECT * FROM categorias WHERE id=$categoriaId";
            $categoriaResult = pg_query($consulta) or die('No se ha podido ejecutar la consulta.');
            $categoria = pg_fetch_assoc($categoriaResult);
            pg_close($db);
        }
    ?>
        
    <main class="mt-5">

        <!-- filtro de busqueda -->
        <div class="container">
            <h1>Detalle del Producto</h1>
            <hr>
            <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-4" style="text-align: center;">
                <img src="<?php echo urlRecursos()."/producto/".$fila['imagen'].""?>" alt="<?php echo $fila['nombre'];?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text"><small class="text-muted"><?php echo $categoria['nombre'];?></small></p>
                        <h1 class="card-title"><?php echo $fila['nombre'];?></h1>
                        <h2 class="card-text">$ <?php echo $fila['precio'];?></h2>
                        <h3 class="card-text"><?php echo $fila['descripcion'];?></h3>
                        <a href="/carrito/cartAction.php?type=producto&action=addToCart&id=<?php echo $fila["id"]; ?>" class="btn-secondary btn"><i class="fas fa-shopping-cart"></i> Agregar</a>
                    </div>
                </div>
            </div>
            </div>
            
        </div>
    </main>

    <?php 
        footer();
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
   
</body>
</html>