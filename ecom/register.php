<?php 

require_once "inc/header.php";
require_once "app/classes/User.php";
if($user->is_logged()){
    header('location: index.php');
}
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $created = $user->create($name,$username,$email,$password);

        if($created){
            $_SESSION['message']['type'] = "success";
            $_SESSION['message']['text'] = "Successfully registred.";
            header('location:index.php');
            exit;
        }
        else{
            $_SESSION['message']['type'] = "danger";
            $_SESSION['message']['text'] = "Error.";
            header('location:register.php');
            exit;
        }
    }
?>
    <h1 class="mt-5 mb-3">Registration</h1>
    <form action="" method="post">
        <div class="form-group mb-3">
            <label for="name">Full name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="email">Email address</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <a href="login.php">Login?</a>
<?php require_once "inc/footer.php"; ?>
