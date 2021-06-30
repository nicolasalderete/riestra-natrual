<?php
// inicializar la clase del carrito de la compra
session_start();
include 'Cart.php';
include 'dbConfig.php';
$cart = new Cart;

// incluir el archivo de configuración de la base de datos
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
        $ofertaid = $_REQUEST['id'];
        // obtener detalles del producto
        $type = $_REQUEST['type'];
        if ($type == 'oferta') {

            $query = pg_query("SELECT * FROM ofertas WHERE id = ".$ofertaid);
            $row = pg_fetch_assoc($query);
            $itemData = array(
                'id' => $row['id'],
                'name' => $row['nombre'],
                'price' => $row['precio'],
                'type' => 'oferta',
                'qty' => 1
            );
            $insertItem = $cart->insert($itemData);
            
            $redirectLoc = $insertItem? "/viewCart.php?success=Oferta agregada": "/error.html";
            header("Location:".$redirectLoc);
            exit;
        } elseif ($type == 'producto') {
            $sqlquery = "SELECT * FROM productos WHERE id = ".$ofertaid;
            $query = pg_query($sqlquery);
            $row = pg_fetch_assoc($query);
            $itemData = array(
                'id' => $row['id'],
                'name' => $row['nombre'],
                'price' => $row['precio'],
                'type' => 'producto',
                'qty' => 1
            );
            $insertItem = $cart->insert($itemData);
            
            $redirectLoc = $insertItem? "/viewCart.php?success=Producto agregado": '/error.html';
            header("Location:".$redirectLoc);
            exit;
        } else {
            header("Location:/error.html");
            exit;
        }
        
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location:/viewCart.php");
        exit;
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])){
        // insertar detalles del pedido en la base de datos
        $insertOrder = pg_query("INSERT INTO orders (customer_id, total_price, created, modified) VALUES ('".$_SESSION['sessCustomerID']."', '".$cart->total()."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
        
        if($insertOrder){
            $orderID = pg_insert_id;
            $sql = '';
            // obtener artículos del carrito
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');";
            }
            // insertar artículos de pedido en la base de datos
            $insertOrderItems = pg_multi_query($sql);
            
            if($insertOrderItems){
                $cart->destroy();
                header("Location: orderSuccess.php?id=$orderID");
                exit;
            }else{
                header("Location: checkout.php");
                exit;
            }
        }else{
            header("Location: checkout.php");
            exit;
        }
    }else{
        header("Location:/error.html");
        exit;
    }
}else{
    header("Location:/error.html");
    exit;
}