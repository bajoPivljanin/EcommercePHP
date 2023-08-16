<?php 

require_once "inc/header.php"; 
require_once "app/classes/User.php";
if($user->is_logged()){
    header('location: index.php');
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $user->login($username,$password);

    if(!$result){
        $_SESSION['message']['type'] = "danger";
        $_SESSION['message']['text'] = "Wrong username or password.";
        header('location:login.php');
        exit;
    }
    else{
        $_SESSION['message']['type'] = "success";
        $_SESSION['message']['text'] = "Successfully registred.";
        header('location:index.php');
        exit;
    }

}
?>


<div class="row justify-content-center">
    <div class="col-lg-5">
        <h3 class="text-center py-5">Login</h3>
        <form action="" method="post">
            <div class="form-group mb-3">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
            <a href="register.php">Register?</a>
    </div>
</div>


<?php require_once "inc/footer.php"; ?>