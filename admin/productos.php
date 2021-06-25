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
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
    </script>
</head>
<body >
    
    <?php 
        menu();
        $consulta = 'SELECT * FROM productos';
        $resultado = pg_query($consulta) or die('No se ha podido ejecutar la consulta.');

        pg_close($db);
    ?>
        
    <main class="mt-5 mr-5 ml-5">
        <h1 class="text-center">Alta, baja y modificación de productos</h1>
        <hr>
        <p><a href="/admin/productos_alta.php" class="btn btn-secondary"><i class="fas fa-plus-circle"></i> Nuevo producto</a></p>
        <p><input id="myInput" type="text" placeholder="Búsqueda rápida" class="form-control"></p>
        <?php if (!$resultado): ?>
            <h1 class="text-center">No se encontraron resultados</h1> 
        <?php else: ?>
            <table class="table" id="myInput">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Estado</th>
                        <th scope="col" style="width: 20%;"></th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php 
                        while ($fila = pg_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<th scope='row'>".$fila['id']."</th>";
                                echo "<td>".$fila['nombre']."</td>";
                                echo "<td>".$fila['descripcion']."</td>";
                                echo "<td>".$fila['precio']."</td>";
                                echo "<td>";
                                if ($fila['estado'] == 'HA') {
                                    echo 'STOCK';
                                } else {
                                    echo 'SIN STOCK';
                                }
                                echo "</td>";
                                echo "<td>";
                                    echo "<a href='/admin/productos_editar.php?id=".$fila['id']."' class='btn'>";
                                        echo "<i class='fas fa-pencil-alt'></i> Editar";
                                    echo "</a>";
                                echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            Confirmar
                        </div>
                        <div class="modal-body">
                            Desea eliminar el producto?
                        </div>
                        <p class="debug-url"></p>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-danger btn-ok">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>



    <?php 
        footer();
    ?>



    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script>
        $( document ).ready(function() {
            $('#confirm-delete').on('show.bs.modal', function(e) {
                $('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                
                $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
            });
        });
        

    <script>
</body>
</html>