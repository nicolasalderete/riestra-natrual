<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../inc/head.php'); ?>

    <?php 
        head();
    ?>
    <?php include('../inc/secure.php'); ?>
    <?php include('../inc/menu.php'); ?>
    <?php include('../inc/footer.php'); ?>
    <?php include('../inc/conexion.php'); ?>

</head>
<body >
    
    <?php 
        menu();
        
        $consulta = "SELECT * FROM categorias where estado = 'HA'";
        
        $resultado = pg_query($consulta) or die('No se ha podido ejecutar la consulta.');

        pg_close($db);
    ?>
        
    <main class="container mt-5">
        <h1 class="text-center">Nuevo producto</h1>
        <hr>
        <form action="/apis/productos.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" id="exampleFormControlInput1" name="dispatch" value="create">
            <div class="form-group">
                <label for="exampleFormControlInput1">Nombre del producto</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Descripción</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcion" required></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Categoría</label>
                <select class="form-control" id="exampleFormControlSelect1" name="categoria" required>
                    <?php 
                        while ($fila = pg_fetch_assoc($resultado)) {
                            echo "<option value=".$fila['id'].">".$fila['nombre']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Precio</label>
                <input type="text" name="precio" class="form-control" id="exampleFormControlInput1" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="destacado">
                <label class="form-check-label" for="exampleCheck1">Destacado</label>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Nombre de la imagen</label>
                <input type="text" name="imagen" class="form-control" id="exampleFormControlInput1" >
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit"><i class="fas fa-plus-circle"></i> Agregar</button>
                <a href="/admin/productos.php" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Volver</a>
            </div>
        </form>
    </main>

    <?php 
        footer();
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>