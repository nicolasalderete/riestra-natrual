<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php include('inc/head.php'); ?>
    
    <?php 
        head();
    ?>

    <?php include('inc/conexion.php'); ?>
    <?php include('inc/menu.php'); ?>
    <?php include('inc/footer.php'); ?>
    <?php include('inc/conexion.php'); ?> 
</head>
<body>
    
    <?php 
        menu();

        $queryOfertas = "select * from ofertas limit 3";
        $ofertasResult = pg_query($queryOfertas);

        $queryProducto = "select * from productos where destacado='Y' limit 3";
        $productoResult = pg_query($queryProducto);
    ?>
        
    <main>
        <!--Jumbotron -->
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="5"></li>
            </ol>

            

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?php echo urlRecursos()."/promo/1.jpeg"?>" class="d-block w-100" >
                    <div class="carousel-caption d-none d-md-block">
                        <h5>
                           Vino vegano
                        </h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?php echo urlRecursos()."/promo/2.jpeg"?>" class="d-block w-100" >
                    <div class="carousel-caption d-none d-md-block">
                        <h5>
                            Aceites
                        </h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?php echo urlRecursos()."/promo/3.jpg"?>" class="d-block w-100" >
                    <div class="carousel-caption d-none d-md-block">
                        <h5>
                            Leches
                        </h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?php echo urlRecursos()."/promo/4.jpeg"?>" class="d-block w-100" >
                    <div class="carousel-caption d-none d-md-block">
                        <h5>
                            Leches
                        </h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?php echo urlRecursos()."/promo/5.jpeg"?>" class="d-block w-100" >
                    <div class="carousel-caption d-none d-md-block">
                        <h5>
                            Leches
                        </h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?php echo urlRecursos()."/promo/6.jpeg"?>" class="d-block w-100" >
                    <div class="carousel-caption d-none d-md-block">
                        <h5>
                            Leches
                        </h5>
                    </div>
                </div>
            </div>

            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
            </a>

            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
            </a>
        </div>

        <!--Fin jumbotron -->
        <br><br><br><br>
        
        
        <!-- Ofertas -->
        <h1 class="text-center">Productos destacados</h1>
        <br><br>

        <div class="container marketing">

            <div class="row">
                <?php while ($fila = pg_fetch_array($productoResult)) { ?>
                    <div class="col-lg-4">
                        
                        <img src="<?php echo urlRecursos()."/producto/".$fila['imagen'].""?>" alt="<?php echo $fila['nombre']?>" class="rounded-circle">
                        <title><?php echo $fila['nombre']?></title>
                        <h2><?php echo $fila['nombre']?></h2>
                        <p><?php echo $fila['descripcion']?></p>
                        <p><a class="btn btn-secondary" href="<?php echo "/producto_detalle.php?id=".$fila['id']?>" role="button">Ver m??s</a></p>
                    </div>
                <?php } ?>
                
            </div>
        </div>
        <!--Fin Ofertas -->
    </main>
    
    <?php 
        footer();
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>