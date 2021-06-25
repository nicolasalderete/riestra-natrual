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

    <script>
        $(document).ready(function(){
            enable_cb();
            $("#changeclave").click(enable_cb);
        });
        
        function enable_cb() {
            if (this.checked) {
                $("#clave").removeAttr("disabled");
            } else {
                $("#clave").attr("disabled", true);
            }
        }
        </script>

</head>
<body >
    
    <?php 
        menu();

        if(!isset($_GET["id"]) || empty(trim($_GET["id"]))){
            header("Location:/admin/usuarios.php");
            exit;
        } else {
            $idUsuario = filter_var($_GET["id"], FILTER_SANITIZE_STRING);
            
            $consulta = "select * from usuarios where id = '$idUsuario'";
            $resultado = pg_query($consulta) or header("Location:error");
            $fila = pg_fetch_assoc($resultado);
            
            pg_close($db);
        }
    ?>
        
    <main class="container mt-5">
        <h1 class="text-center">Modificar usuario</h1>
        <hr>
        <form action="/apis/usuarios.php" method="POST">
            <input type="hidden" name="dispatch" id="exampleFormControlInput1" value="update">
            <input type="hidden" name="userId" id="exampleFormControlInput1" value="<?php echo $fila['id']?>">

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
                <input type="checkbox" name="changeclave"  id="changeclave"> Cambiar clave
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Clave</label>
                <input type="password" disabled name="clave" class="form-control" id="clave" value="<?php echo $fila['clave']?>">
            </div>
            <div class="form-group">
                <label for="rol">Rol</label>
                <select name="rol" id="rol" class="form-control">
                    <option value="ADMIN" <?php if ($fila['rol'] == 'ADMIN') { echo 'selected';} ?>>Administrador</option>
                    <option value="USER" <?php if ($fila['rol'] == 'USER') { echo 'selected';} ?>>Usuario</option>
                </select>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" id="estado" class="form-control">
                    <option value="HA" <?php if ($fila['estado'] == 'HA') { echo 'selected';} ?>>Habilitada</option>
                    <option value="DH" <?php if ($fila['estado'] == 'DH') { echo 'selected';} ?>>Deshabilitada</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Modificar</button>
                <a href="/admin/usuarios.php" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Volver</a>
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