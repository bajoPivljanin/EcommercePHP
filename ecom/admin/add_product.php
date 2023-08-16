<?php 
require_once "../app/config/config.php";
require_once "../app/classes/User.php";
require_once "../app/classes/Product.php";

$user = new User();

if($user->is_logged() && $user->is_admin()){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $product = new Product();

        $name = $_POST['name'];
        $price = $_POST['price'];
        $size = $_POST['size'];
        $image = $_POST['photo_path'];

        if($image == NULL){
            $image = "error.png";
        }

        $created = $product->create($name,$price,$size,$image);
        if($created){
           
            $_SESSION['message']['type'] = "danger";
            $_SESSION['message']['text'] = "Error while creating product!";
            header('location:index.php');
            exit;
        }
        else{
            $_SESSION['message']['type'] = "success";
            $_SESSION['message']['text'] = "Successfully created product!";
            header('location:index.php');
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
    <title>Add product</title>
</head>
<body>
    <div class="container"> 
        <br>
        <div class="row justify-content-center">
            <div class="col-lg-5">
            <form action="" method="post">
                <input type="text" style="margin-top: 10px;" name="name" placeholder="Product name"><br>
                <input type="text" style="margin-top: 10px;" name="price"  step="0.01" placeholder="Product price"><br>
                <input type="text" style="margin-top: 10px;" name="size"  placeholder="Product size"><br>
                <input type="hidden" name="photo_path" id="photoPathInput">
                <div class="dropzone" id="dropzone-upload"></div>
                <input type="submit" value="Add product" style="margin-top: 20px;" class="btn btn-primary"><br>
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