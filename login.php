<?php
    include('inc/conexion.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){

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
    }

    if (!empty($password_err) || !empty($username_err)) {
        $Message = "Debe completar los campos usuario y/o clave";
        header("Location:index.php?error={$Message}");
    } else {
        $resultado = mysqli_query($conexion, "SELECT nombre as nombre,  apellido as apellido, clave as clave FROM usuarios WHERE usuario = '$username'");
        
        while($fila = mysqli_fetch_assoc($resultado)) {
            $clavebdd = $fila['clave'];
        }

        if (password_verify($password, $clavebdd)) {
            session_start();

            $resultado = mysqli_query($conexion, "SELECT nombre as nombre,  apellido as apellido FROM usuarios WHERE usuario = '$username'");
            $fila = mysqli_fetch_assoc($resultado);

            $_SESSION["usuario"] = $fila['nombre']. " " .$fila['apellido'];
            $_SESSION["loggedIn"] = true;
            $Message = "Bienvenido ".$_SESSION["usuario"]. "";
            header("Location:index.php?success={$Message}");
        } else {
            $Message = "Usuario y/o clave inválidos";
            header("Location:index.php?error={$Message}");
        }
    }
    mysqli_close($conexion);

    
?>