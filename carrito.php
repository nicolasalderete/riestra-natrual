<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('inc/head.php'); ?>

    <?php 
        head();
    ?>
    <?php include('inc/menu.php'); ?>
    <?php include('inc/footer.php'); ?>
    <?php include('inc/conexion.php'); ?>
    <script>
        $(document).ready(function(){
            
        });
    </script>
</head>
<body >
    
    <?php 
        menu();

    ?>
        
    <main class="mt-5 mr-5 ml-5">
        <h1 class="text-center">Carrito de compras</h1>
        <hr>
        <?php if (false): ?>
            <h1 class="text-center">No tiene productos agregados a su carrito</h1> 
        <?php else: ?>
            <table class="table" id="myInput">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total</th>
                        <th scope="col" style="width: 5%;"></th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr>
                        <td>Producto 1</td>
                        <td><input type="number" id="cantidad" name="cantidad" min="1" max="10" value="1"></td>
                        <td>$ 12</td>
                        <td>$ 12</td>
                        <td><a class="btn"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th>$ 12000</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <p><a href="/apis/checkout.php?item=1" class="btn btn-secondary"><i class="fas fa-plus-circle"></i> Confirmar pedido</a></p>    
        <?php endif; ?>
        
    </main>

    <?php 
        footer();
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>
</html>