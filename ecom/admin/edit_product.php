<?php 
require_once "../app/config/config.php";
require_once "../app/classes/User.php";
require_once "../app/classes/Product.php";

$user = new User();

if($user->is_logged() && $user->is_admin()){
    $product_obj = new Product();
    $product = $product_obj->read($_GET['id']);
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $product_id = $_GET['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $size = $_POST['size'];
        $image = $_POST['photo_path'];

        $edited = $product_obj->update($product_id,$name,$price,$size,$image);
        if($edited){
           
            $_SESSION['message']['type'] = "danger";
            $_SESSION['message']['text'] = "Error while updating product!";
            header('location:edit_product.php?id='.$product_id);
            exit;
        }
        else{
            $_SESSION['message']['type'] = "success";
            $_SESSION['message']['text'] = "Successfully updated product!";
            header('location:edit_product.php?id='.$product_id);
            exit;
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> 
    <title>Admin</title>
</head>
<body>
    <div class="container"> 
    <?php if(isset($_SESSION['message'])):?>
        <div class="alert alert-<?php echo $_SESSION['message']['type'];?> alert-dismissible fade show" role="alert">
            <?php 
                echo $_SESSION['message']['text'];
                unset($_SESSION['message']);
            ?>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
    <?php endif;?>
        <div class="row justify-content-center">
            <div class="col-lg-5">
            <form action="" method="post">
                <input type="text" style="margin-top: 10px;" name="name" value="<?php echo $product['name'];?>"><br>
                <input type="text" style="margin-top: 10px;" name="price" value="<?php echo $product['price'];?>"><br>
                <input type="text" style="margin-top: 10px;" name="size" value="<?php echo $product['size'];?>"><br>
                <input type="hidden" name="photo_path" id="photoPathInput">
                <div class="dropzone" id="dropzone-upload"></div>
                
                <input type="submit" style="margin-top: 10px;" value="Update product" class="btn btn-primary">     <br>  <br>
                <a href="index.php" class="btn btn-primary">Products</a>
            </form>
            </div>
        </div>
    </div>

<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
    Dropzone.options.dropzoneUpload ={
        url: "upload_photo.php",
        paramName: "photo",
        maxFilesize: 20,
        acceptedFiles: "image/*",
        init: function(){
            this.on("success",function(file,response){
                const jsonResponse = JSON.parse(response)
                if(jsonResponse.success){
                    document.getElementById('photoPathInput').value=jsonResponse.photo_path
                }
                else{
                    console.error(jsonResponse.error)
                }
            })
        }
    }
</script>
</body>
</html>