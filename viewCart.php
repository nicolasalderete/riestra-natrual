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
        

            
            function updateCartItem(obj, id){

            $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
                if(data == 'ok'){
                    location.reload();
                }else{
                    alert('Cart update failed, please try again.');
                }
            });
            }
    </script>
</head>
<body >
    
    <?php 
        menu();

    ?>
        
    <main class="mt-5 mr-5 ml-5">
        <h1 class="text-center">Carro de compras</h1>
        <hr>
            <table class="table" id="myInput">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col" style="width: 5%;">Cantidad</th>
                        <th scope="col" class="text-center">Precio</th>
                        <th scope="col" class="text-center">Total</th>
                        <th scope="col" style="width: 5%;"></th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php
                        if($cart->total_items() > 0){
                            //obtener artículos del carrito de la sesión
                            $cartItems = $cart->contents();
                            foreach($cartItems as $item){
                    ?>
                    <tr>
                        <td><?php echo $item["name"]; ?></td>
                        <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
                        <td class="text-center"><?php echo '$'.$item["price"]; ?></td>
                        <td class="text-center"><?php echo '$'.$item["subtotal"]; ?></td>
                        <td>
                            <a href="/carrito/cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Desea eliminar el item del carro de compras?')"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php } }else{ ?>
                        <tr><td colspan="5"><p>No posee productos u ofertas agregadas</p></td>
                    <?php } ?>
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <td></td>
                        <td colspan="2"></td>
                        <?php if($cart->total_items() > 0){ ?>
                        <td class="text-center"><strong>Total <?php echo '$'.$cart->total(); ?></strong></td>
                        <td></td>
                        <?php } ?>
                    </tr>
                </tfoot>
            </table>
            <div style="float: left;"><a href="/productos.php" class="btn btn-warning"><i class="fas fa-plus-circle"></i> Continuar comprando</a></div>
            <?php if($cart->total_items() > 0){ ?>
                <div style="float: right;"><a href="checkout.php" class="btn btn-success"><i class="fas fa-credit-card"></i> Confirmar pedido</a></div>
            <?php } ?>
    </main>

    <?php 
        footer();
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    
</body>
</html>