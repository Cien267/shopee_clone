<?php

global $conn;

function connect_db(){
    global $conn;
    if(!$conn){
        $conn = mysqli_connect('localhost', 'root', '', 'bt3');
        mysqli_set_charset($conn, 'utf8');
    }
}

function disconnect_db(){
    global $conn;
    if($conn){
        mysqli_close($conn);
    }
}

function get_all_orders(){
    global $conn;
    connect_db();
    $sql = "select *  from orders";
    $query = mysqli_query($conn, $sql);

    $result = [];

    if($query){
        while($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    return $result;
    
}

function get_order($order_id){
    global $conn;
    connect_db();

    $sql = "select * from orders where id = {$order_id}";

    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
    return $result;
}

function add_order($shop_name, $product_name, $product_image, $product_quantity, $cost, $status, $order_date){
    global $conn;

    connect_db();

    $shop_name = addslashes($shop_name);
    $product_name = addslashes($product_name);
    $product_image = addslashes($product_image);
    $product_quantity = addslashes($product_quantity);
    $cost = addslashes($cost);
    $status = addslashes($status);
    $order_date = addslashes($order_date);

    $sql = "INSERT INTO orders(shop_name, product_name, product_image, product_quantity, cost, status, order_date) VALUES ('$shop_name', '$product_name', '$product_image', '$product_quantity', '$cost', '$status', '$order_date')";

    $query = mysqli_query($conn, $sql);
    return $query;
}

function edit_order($id, $shop_name, $product_name, $product_image, $product_quantity, $cost, $status){
    global $conn;

    connect_db();

    $shop_name = addslashes($shop_name);
    $product_name = addslashes($product_name);
    $product_image = addslashes($product_image);
    $product_quantity = addslashes($product_quantity);
    $cost = addslashes($cost);
    $status = addslashes($status);

    $sql = "UPDATE orders SET shop_name = '$shop_name', product_name = '$product_name', product_image = '$product_image', product_quantity = '$product_quantity', cost = '$cost', status = '$status' WHERE id = $id ";

    $query = mysqli_query($conn, $sql);
    
    return $query;
}

function delete_order($order_id){
    global $conn;

    connect_db();

    $sql = "DELETE FROM orders WHERE id = $order_id";
    $query = mysqli_query($conn, $sql);

    return $query;
}

?>