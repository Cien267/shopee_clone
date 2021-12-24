<?php

    require "./libs/orders.php";

    $id = isset($_GET['id']) ? (int)$_GET['id'] : '';
    
    if($id){
        delete_order($id);
    }
    header("location:trangchu.php");
    

?>