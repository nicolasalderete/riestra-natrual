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
</head>
<body >
    
    <?php 
        menu();
        $consulta = 'SELECT * FROM categorias';
        $resultado = pg_query($consulta) or die('No se ha podido ejecutar la consulta.');

        pg_close($db);
    ?>
        
    <main class="container mt-5">
        <h1 class="text-center">Alta, baja y modificación de categorías</h1>
        <p><a href="/admin/categorias_alta.php" class="btn btn-secondary"><i class="fas fa-plus-circle"></i> Nueva categoría</a></p>
        <?php if (!$resultado): ?>
            <h1 class="text-center">No se encontraron resultados</h1> 
        <?php else: ?>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col" style="width: 20%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while ($fila = pg_fetch_array($resultado)) {
                            echo "<tr>";
                            echo "<th scope='row'>".$fila['id']."</th>";
                                echo "<td>".$fila['nombre']."</td>";
                                echo "<td>".$fila['descripcion']."</td>";
                                echo "<td>";
                                    echo "<a href='/admin/categorias_editar.php?id=".$fila['id']."' class='btn'>";
                                        echo "<i class='fas fa-pencil-alt'></i> Editar";
                                    echo "</a> ";
                                echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        <?php endif; ?>      
    </main>

    <?php 
        footer();
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>