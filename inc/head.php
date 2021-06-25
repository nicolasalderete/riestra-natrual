<?php
    session_start();

    include('poo.php');
    
    function urlRecursos() {
        if (isset($_ENV["URL_RECURSOS"])) {
            return $_ENV["URL_RECURSOS"];
        }
        return $_SERVER["URL_RECURSOS"];
    }

    function urlRecursosOfertas($imagen) {
        return urlRecursos()."/ofertas/".$imagen;
    }
    
    function urlRecursosProductos($imagen) {
        return urlRecursos()."/productos/".$imagen;
    }

    function head() {
?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dietetica on line</title>

        <!--
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        -->
        
        <script src="https://kit.fontawesome.com/be65c86741.js" crossorigin="anonymous"></script>

        <!--Estilo propio-->
        <link rel="stylesheet" href="/css/estilo.css">
        
        <!--Template -->
        <link rel="stylesheet" href="/css/flatly.min.css">

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<?php
    }
?>