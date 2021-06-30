<?php
    if (esUsuarioAdmin()) {

    } else {
        header("location:/desautorizado.html");
        exit;
    }
?>