<?php 
require_once "inc/header.php"; 
require_once "app/classes/Cart.php"; 
require_once "app/classes/Order.php"; 



// $cart = new Cart();
// $cart_items = $cart->get_cart_items();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $delivery_address = $_POST['country'] . ", " .$_POST['country'] . ", " . $_POST['city'] . ", ". $_POST['zip'] . ", ". $_POST['address'];
    $order = new Order();
    $order = $order->create($delivery_address);
    $_SESSION['message']['type'] = "success";
    $_SESSION['message']['text'] = "Successfully ordered.";
    header('location:orders.php');
    exit;
}
?>

<form action="" method="post">
        <div class="form-group mb-3">
            <label for="country">Country</label>
            <input type="text" name="country" id="country" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="city">City</label>
            <input type="text" name="city" id="city" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="zip">Post code</label>
            <input type="text" name="zip" id="zip" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Order</button>
    </form>


<?php require_once "inc/footer.php"; ?>

