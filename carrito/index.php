<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../inc/head.php'); ?>

    <?php 
        head();
    ?>
    <?php include('../inc/menu.php'); ?>
    <?php include('../inc/footer.php'); ?>
    <?php include('../inc/conexion.php'); ?>


    <style>
        


    
    
    </style>
</head>
</head>
<body>
    <?php 
            menu();
    ?>

    <main class="mt-5">

        <!-- filtro de busqueda -->
        <div class="container">
            <h1>Carro de compras</h1>
            <hr>
            <?php
                //obtener consultas de filas
                $query = pg_query("SELECT * FROM products ORDER BY id DESC LIMIT 10");
                if(pg_num_rows($query) > 0){ 
                    while($row = pg_fetch_assoc($query)){
                ?>
                <div class="item col-lg-4">
                    <div class="thumbnail">
                        <div class="caption">
                            <h4 class="list-group-item-heading"><?php echo $row["name"]; ?></h4>
                            <p class="list-group-item-text"><?php echo $row["description"]; ?></p>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="lead"><?php echo '$'.$row["price"].' USD'; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-success" href="cartAction.php?action=addToCart&id=<?php echo $row["id"]; ?>">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } }else{ ?>
                <p>No hay productos en su carro de compras</p>
                <?php } ?>
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