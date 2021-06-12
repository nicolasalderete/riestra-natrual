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
        <a class="navbar-brand" href="/php-cuch">Riestra Natural</a>
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
                    <a class="nav-link" href="login.php" role="button"><i class="fas fa-user-lock"></i> Igresar</a>
                    <a class="nav-link" href="registrarse.php" role="button"><i class="fas fa-user-lock"></i> Registrarse</a>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</header>
<!--Fin Menu-->

<?php
    }
?>