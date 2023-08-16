<?php 
require_once "../app/config/config.php";
require_once "../app/classes/Cart.php";
require_once "../app/classes/User.php";
require_once "../app/classes/Order.php";
require_once "../app/classes/Product.php";
    $user = new User();
    if($user->is_logged() && $user->is_admin()):
        $orders = new Order();
        $orders= $orders->read($_GET['order_id']);

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $order_id = $orders['order_id'];
            $name = $orders['name'];
            $quantity = $orders['quantity'];
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>All orders</title>
</head>
<body>
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a href="index.php" class="nav-link">Products</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if(!$user->is_logged()) :?>
                    <li class="nav-item">
                        <a href="register.php" class="nav-link">Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Login</a>
                    </li>
                    <?php elseif($user->is_logged() && $user->is_admin()):?>    
                    <li class="nav-item">
                        <a href="allorders.php" class="nav-link">All Orders</a>
                    </li>
                    <li class="nav-item">
                        <a href="../logout.php" class="nav-link">Logout</a>
                    </li>
                    <?php else:?>
                        <li class="nav-item">
                        <a href="../cart.php" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            Cart
                        </a>
                    </li>    
                    <li class="nav-item">
                        <a href="../orders.php" class="nav-link">My orders</a>
                    </li>
                    <li class="nav-item">
                        <a href="../logout.php" class="nav-link">Logout</a>
                    </li>
                    <?php endif;?>
                </ul>
               
            </div>
        </div>
    </nav>
    <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Order id</th>
                    <th scope="col">Name</th>
                    <th scope="col">QTY</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orders as $order):?>
                    <tr>
                        <td><?php echo $order['order_id']?></td>
                        <td><?php echo $order['name']?></td>
                        <td><?php echo $order['quantity']?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
    </table>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php else: 
    header('location:../index.php')    
?>
<?php endif;?>
