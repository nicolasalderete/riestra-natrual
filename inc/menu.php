<?php
    function menu() {
        $cart = new Cart;
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
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/ofertas.php"><i class="fas fa-piggy-bank"></i> Ofertas
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/productos.php"><i class="fas fa-store"></i> Productos</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/ubicacion.php"><i class="fas fa-street-view"></i> Ubicación</a>
                </li>
                <?php if (esUsuarioAdmin()): ?>
                    <!--Ver si esta logueado -->
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administración</a>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="/admin/categorias.php">Categorias</a>
                        <a class="dropdown-item" href="/admin/productos.php">Productos</a>
                        <a class="dropdown-item" href="/admin/ofertas.php">Ofertas</a>
                        <a class="dropdown-item" href="/admin/usuarios.php">Usuarios</a>
                        </div>
                    </li>
                    <!--Ver si esta logueado -->
                <?php endif; ?> 
            </ul>

            <!--Buscar productos -->
            <form class="form-inline mr-auto ml-5" action="productos.php" method="GET">
                <div class="input-group">
                    <input type="text" name="producto" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Buscar</button>
                    </div>
                </div>   
            </form>
            <!--Buscar productos -->

            <?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
                <div class="nav-item ml-2">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active red">
                            <?php if ($cart->total_items() > 0):?>
                                <a href="/viewCart.php" class="btn-danger btn"><i class="fas fa-shopping-cart"></i> <?php echo $cart->total_items();?></a>
                            <?php else: ?>
                                <a href="/viewCart.php" class="btn-primary btn"><i class="fas fa-shopping-cart"></i></a>
                            <?php endif; ?> 
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="far fa-user"></i> <?php echo $_SESSION['usuario'] ?></a>
                            <div class="dropdown-menu">
                                <a href="/logout.php"><i class="fas fa-sign-out-alt ml-5"></i>Salir</i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="nav-item dropleft">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active red">
                            <?php if ($cart->total_items() > 0):?>
                                <a href="/viewCart.php" class="btn-danger btn"><i class="fas fa-shopping-cart"></i> <?php echo $cart->total_items();?></a>
                            <?php else: ?>
                                <a href="/viewCart.php" class="btn-primary btn"><i class="fas fa-shopping-cart"></i></a>
                            <?php endif; ?> 
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="login.php" role="button"><i class="fas fa-user-lock"></i> Ingresar</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link btn btn-secondary" href="registro.php" role="button"><i class="fas fa-list-alt"></i> Registrarse</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</header>
<!--Fin Menu-->

<?php
    }
?>