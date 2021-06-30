<?php
    session_start();
    include '../carrito/Cart.php';
    include('../inc/poo.php');
    include('../inc/conexion.php');

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username.";
        } else{
            $username = trim($_POST["username"]);
        }
        
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }
        if (!empty($password_err) || !empty($username_err)) {
            $Message = "Debe completar los campos usuario y/o clave";
            header("Location:/login.php?error={$Message}");
        } else {
            $resultado = pg_query("SELECT nombre,  apellido, clave FROM usuarios WHERE usuario = '$username'");
            while($fila = pg_fetch_array($resultado)) {
                $clavebdd = $fila['clave'];
            }
    
            if (password_verify($password, $clavebdd)) {
    
                $resultado = pg_query("SELECT nombre as nombre,  apellido as apellido, rol as rol FROM usuarios WHERE usuario = '$username'");
                $fila = pg_fetch_array($resultado);
                $cart = new Cart();

                $_SESSION = array();

                $_SESSION["usuario"] = $fila['nombre']. " " .$fila['apellido'];
                $_SESSION["loggedIn"] = true;
                $_SESSION["rol"] = $fila['rol'];
                
                if ($cart->total_items() > 0) {
                    $_SESSION['cart_contents'] = $cart->get_cart();
                }

                $Message = "Bienvenido ".$_SESSION["usuario"]. "";
                header("Location:/?success={$Message}");
                exit;
            } else {
                $Message = "Usuario y/o clave inválidos";
                header("Location:/login.php?error={$Message}");
                exit;
            }
        }
    }
    pg_close($db);
    
?>