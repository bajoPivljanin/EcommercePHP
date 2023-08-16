<?php 
require_once "inc/header.php"; 
require_once "app/classes/Cart.php"; 

if(!$user->is_logged()){
    header('location: login.php');
    exit;
}
$cart = new Cart();
$cart_items = $cart->get_cart_items();
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Size</th>
            <th scope="col">Price</th>
            <th scope="col">quantity</th>
            <th scope="col">Image</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($cart_items as $item):?>
            <tr>
                <td><?php echo $item['name']?></td>
                <td><?php echo $item['size']?></td>
                <td>$<?php echo $item['price']?></td>
                <td><?php echo $item['quantity']?></td>
                <td><img src="public/product_img/<?php echo $item['image']?>" height="50px"></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<a href="checkout.php" class="btn btn-success">Checkout</a>

<?php require_once "inc/footer.php"; ?>