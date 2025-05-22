
<?php require_once("connection.php"); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>
<body>

<?php   

if(isset($_POST['submit'])){
    $error = array();
    extract($_POST);

    if(empty($username)){
        $error['username'] = "useranme is required";
    }

    if(empty($email)){
        $error['email'] = "email is required";
    }

    if(empty($password)){
        $error['password'] = "password is reqired";
    }

    if(empty($cpassword)){
        $error['cpassword'] = "Confirm password is required";
    }

    if(empty($dob)){
        $error['dob'] = "date is required";
    }



    $image_name = $_FILES['image']['name'];
    $image_type = $_FILES['image']['type'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];

    if(empty($image_name)){
        $error['image'] = "image is required";
    }else{

    if($image_type == "image/jpg" || $image_type == "image/jpeg" || $image_type == "image/png"){
        
        if($image_size > 1000000){
            $error['image'] = "image must be less than 1MB";
        }
    }else{
        $error['image'] = "image only accept jpg/jpeg/png format";
    }

    }


if(empty($error)){

    $sql = "INSERT INTO register(username,email,password,date_of_birth,profile)VALUES('". $username ."', '". $email ."', '". $password ."', '". $dob ."', '". $image_name ."')";

    $data = mysqli_query($conn, $sql);

    if($data){
        if(move_uploaded_file($image_tmp_name,"image/".$image_name)){
            $msg = "inserted successfully and image uploaded";
        }else{
            $error['image'] = "image not move to folder";
        }
    }else{
        die("Error". $conn->error);
    }
}


    

    

  

}


?>


<div class="container mt-3">
<?php if(!empty($msg)) { ?>
<div class="alert alert-success alert-dismissible">
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
<strong>SUCCESS!</strong> <?php echo $msg; ?>
</div>

<?php } ?>





<div class="container">

<h3 class="bg-dark text-white rounded text-center">Registration Form</h3>

<form action="" method="POST" enctype="multipart/form-data">

Username: <input type="text" name="username" id="username" class="form-control">
<p class="text-danger h6"><?php echo (isset($error["username"]) && $error["username"] != "") ? $error["username"] : "";   ?></p>
Email: <input type="email" name="email" id="email" class="form-control">
<p class="text-danger h6"><?php echo (isset($error["email"]) && $error["email"] != "") ? $error["email"] : "";   ?></p>
Password: <input type="password" name="password" class="form-control" id="password">
<p class="text-danger h6"><?php echo (isset($error["password"]) && $error["password"] != "") ? $error["password"] : "";   ?></p>
Confirm Password: <input type="password" name="cpassword" id="cpassword" class="form-control">
<p class="text-danger h6"><?php echo (isset($error["cpassword"]) && $error["cpassword"] != "") ? $error["cpassword"] : "";   ?></p>
Date Of Birth: <input type="date" name="dob" id="dob" class="form-control">
<p class="text-danger h6"><?php echo (isset($error["dob"]) && $error["dob"] != "") ? $error["dob"] : "";   ?></p>
Profile: <input type="file" name="image" id="image" class="form-control">
<p class="text-danger h6"><?php echo (isset($error["image"]) && $error["image"] != "") ? $error["image"] : "";   ?></p>

<br>
<input type="submit" name="submit" id="submit" class="btn btn-info w-100">
<br>    <br>
<button class="rounded btn btn-info float-end"><a href="login.php">Login</button></a>



</form>


</div>





    
</body>
</html>