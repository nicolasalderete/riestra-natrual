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

        $resultado = pg_query("SELECT * FROM productos");
    ?>
        
    <main class="container mt-5">
        <h1 class="text-center">Nueva oferta</h1>
        <form action="ofer_procesar.php" method="POST">
            <div class="form-group">
                <label for="exampleFormControlInput1">Nombre de la oferta</label>
                <input type="nombre" class="form-control" id="exampleFormControlInput1" >
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Descripción</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect2">Seleccione los productos de la oferta</label>
                <select multiple class="form-control" id="exampleFormControlSelect2">
                    <?php 
                        while ($fila = pg_fetch_assoc($resultado)) {
                            echo "<option value='".$fila['id']."'>".$fila['nombre']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><i class="fas fa-plus-circle"></i> Agregar</button>
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