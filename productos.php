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

        $productoSearch = "";
        $categoriaSearch = "";
        $consulta = "select * from productos";
        if (isset($_GET["producto"]) && $_GET["producto"] != "") {
            $productoSearch = filter_var($_GET["producto"], FILTER_SANITIZE_STRING);
            $consulta = $consulta." where nombre like '$productoSearch%'";
        }

        if (isset($_GET["categoria"]) && $_GET["categoria"] != "") {
            $categoriaSearch = $_GET["categoria"];
            if ($productoSearch != "") {
                $consulta = $consulta." and categoriaid='$categoriaSearch'";
            } else {
                $consulta = $consulta." where categoriaid='$categoriaSearch'";
            }
        }
        $resultado = mysqli_query($conexion, $consulta)
            or header("location: error.html?'$consulta'");

        $queryCat = 'SELECT * FROM categorias';
    
        $listCat = mysqli_query($conexion, $queryCat)
            or die('No se ha podido ejecutar la consulta.');

    ?>
        
    <main class="mt-5">

        <!-- filtro de busqueda -->
        <div class="container">
            <div >
                <form action="productos.php" method="GET">
                    <div class="form-row align-items-center">
                        <div class="col-sm-3 my-1">
                            <input type="text" class="form-control" id="inlineFormInputName" placeholder="Nombre del producto" name="producto" value="<?php echo $productoSearch?>">
                        </div>
                        <div class="col-sm-3 my-1">
                            <select class="form-control" name="categoria" id="inlineFormInputName">
                                <option value="">Seleccione una categoria</option>
                                <?php 
                                    while ($fila = mysqli_fetch_assoc($listCat)) {
                                        if ($categoriaSearch == $fila['id']) {
                                            $isSelected = "selected";
                                        } else {
                                            $isSelected = "";
                                        }
                                        echo "<option $isSelected value=".$fila['id'].">".$fila['nombre']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </form>
                <p></p>
            </div>

        </div>
        <?php if (!$resultado): ?>
            <h1 class="text-center">No se encontraron resultados</h1> 
        <?php else: ?>
            <div class="container mt-5">
                <div class="row row-cols-1 row-cols-md-3">
                    <?php 
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<div class='col mb-4'>";
                                echo "<div class='card'>";
                                    echo "<img src=img/prod/".$fila['imagen']." class='card-img-top' alt='Cereal'>";
                                    echo "<div class='card-body'>";
                                        echo "<h5 class='card-title'>".$fila['nombre']."</h5>";
                                        echo "<p class='card-text'>".$fila['descripcion']."</p>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
        <?php endif; ?>  
    </main>

    <?php
        mysqli_close($conexion); 
        footer();
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>