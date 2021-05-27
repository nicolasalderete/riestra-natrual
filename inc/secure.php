<?php
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {

    } else {
        header("location: desautorizado.html");
        exit;
    }
?>