<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('inc/head.php'); ?>

    <?php 
        head();
    ?>
    <?php include('inc/secure.php'); ?>
    <?php include('inc/menu.php'); ?>
    <?php include('inc/footer.php'); ?>
    <?php include('inc/conexion.php'); ?>
</head>
<body >
    
    <?php 
        menu();

        if(empty(trim($_GET["id"]))){
            header("Location:error");
            exit;
        } else {
            $idUsuario = filter_var($_GET["id"], FILTER_SANITIZE_STRING);
            
            $consulta = "select * from usuarios where id_usuario = '$idUsuario'";
            $resultado = pg_query($consulta)
            or header("Location:error");

            pg_close($db);

            $fila = pg_fetch_assoc($resultado);
        }
    ?>
        
    <main class="container mt-5">
        <h1 class="text-center">Modificar usuario</h1>
        <form action="user_procesar.php" method="POST">
            <input type="hidden" name="accion" id="exampleFormControlInput1" value="update">
            <input type="hidden" name="userId" id="exampleFormControlInput1" value="<?php echo $fila['id_usuario']?>">

            <div class="form-group">
                <label for="exampleFormControlInput1">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="exampleFormControlInput1" value="<?php echo $fila['nombre']?>" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Apellido</label>
                <input type="text" name="apellido" class="form-control" id="exampleFormControlInput1" value="<?php echo $fila['apellido']?>" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Usuario</label>
                <input type="text" name="usuario" class="form-control" id="exampleFormControlInput1" value="<?php echo $fila['usuario']?>" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Clave</label>
                <input type="password" name="clave" class="form-control" id="exampleFormControlInput1" value="<?php echo $fila['clave']?>" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Modificar</button>
                <a href="user_admin.php" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Volver</a>
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