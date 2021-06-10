<?php
    function headHtml(string $title) {
?>
    <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title ?></title>

        <!--
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        -->
        
        <script src="https://kit.fontawesome.com/be65c86741.js" crossorigin="anonymous"></script>

        <!--Estilo propio-->
        <link rel="stylesheet" href="css/estilo.css">
        
        <!--Template -->
        <link rel="stylesheet" href="css/flatly.min.css">

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        </head>
        <body>
<?php
    }
?>


<?php
    function menu() {
?>
<!--Menu-->
<header>

    <?php if (isset($_GET["error"]) && $_GET["error"] != ''):?>
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?php echo $_GET["error"] ?></strong>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET["success"]) && $_GET["success"] != ''):?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?php echo $_GET["success"] ?></strong>
        </div>
    <?php endif; ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <a class="navbar-brand" href="/">Riestra Natural</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="ofertas.php"><i class="fas fa-piggy-bank"></i> Ofertas
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="productos.php"><i class="fas fa-store"></i> Productos</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="ubicacion.php"><i class="fas fa-street-view"></i> Ubicación</a>
                </li>
                <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
                    <!--Ver si esta logueado -->
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administración</a>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="prod_admin.php">Productos</a>
                        <a class="dropdown-item" href="cat_admin.php">Categorias</a>
                        <a class="dropdown-item" href="ofer_admin.php">Ofertas</a>
                        <a class="dropdown-item" href="user_admin.php">Usuarios</a>
                        </div>
                    </li>
                    <!--Ver si esta logueado -->
                <?php endif; ?> 
            </ul>

            <!--Buscar productos -->
            <form class="form-inline my-2 my-lg-0" action="productos.php" method="GET">
                <input class="form-control mr-sm-2" type="text" placeholder="Buscar producto" name="producto">
                <button class="btn btn-primary ary my-2 my-sm-0" type="submit"> Buscar</button>
            </form>
            <!--Buscar productos -->

            <?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
                <div class="nav-item ml-2">
                    <a class="nav-link btn btn-danger " href="logout.php"> <?php echo $_SESSION['usuario'] ?> <i class="fas fa-user-times"></i></a>
                </div>
            <?php else: ?>
                <div class="nav-item dropleft">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" id="dropdownMenuOffset" data-offset="10,20"><i class="fas fa-user-lock"></i> iniciar sesion</a>
                    <form class="dropdown-menu p-4" aria-labelledby="dropdownMenuOffset" action="login.php" method="POST">
                        <div class="form-group">
                            <label for="exampleDropdownFormEmail2">Usuario</label>
                            <input type="text" class="form-control" id="usuario" placeholder="Usuario" name="username" >
                        </div>
                        <div class="form-group">
                            <label for="exampleDropdownFormPassword2">Clave</label>
                            <input type="password" class="form-control" id="password" placeholder="Clave" name="password" >
                        </div>
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</header>
<!--Fin Menu-->

<?php
    }
?>
<?php
    function content() {
?>
    <p>Hello World</p>
<?php
    }
?>

<?php
    function footer() {
?>
    <!--Footer-->
    <footer class="footer">
        <div class="container">
          <span class="float-rigth">@Copyrigth 2020 | Grupo PHP</span>
        </div>
    </footer>
    <!-- Fin footer -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    </body>
    </html>
<?php
    }
?>