<?php 
require_once "../app/config/config.php";
require_once "../app/classes/Cart.php";
require_once "../app/classes/User.php";
require_once "../app/classes/Order.php";
require_once "../app/classes/Product.php";

$user = new User();

if($user->is_logged() && $user->is_admin()){
    $order = new Order();
    $order_id = $_GET['order_id'];
    $order->delete($order_id);
    header('location:allorders.php');
}
else{
    header('location:../index.php');
    exit;
}
