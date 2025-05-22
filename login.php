<?php  require_once("connection.php") ?>

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
    $msg = "";
    extract($_POST);

    if(empty($email)){
        $error['email'] = "email/useranme is required";
    }

    if(empty($password)){
        $error['password'] = "password is reqired";
    }

    if(empty($error)){
        $sql = "SELECT * FROM register WHERE email = '". $email ."' AND password = '". $password ."' OR username = '". $email ."' AND password = '". $password ."' ";

        $data = mysqli_query($conn, $sql);
        if(!$data){
            die("Error" .$conn->error);
        }else{
            $count = $data->num_rows;
            if($count > 0){
                $msg = "User has been login successfully";
            }else{
                $error['match'] = "email and password has not match";
            }
        }
    }


    }


 if(!empty($msg)) { ?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="btn btn-close" data-bs-dismiss="alert"></button>
    <strong>SUCCESS!</strong> <?php echo $msg ?>
</div>
<?php } ?>












<div class="container">

<h3 class="text-white text-center rounded bg-dark">Login Form</h3>

<form action="" method="POST">

Username or Email: <input type="text" name="email" id="email" class="form-control">
<p class="text-danger h6"><?php echo (isset($error["email"]) && $error["email"] != "") ? $error["email"] : "";   ?></p>


Password: <input type="password" name="password" id="password" class="form-control">
<p class="text-danger h6"><?php echo (isset($error["password"]) && $error["password"] != "") ? $error["password"] : "";   ?></p>
<br>
<input type="submit" name="submit" id="submit" class="btn btn-info w-100">
<br><br>

<button class="btn btn-info rounded float-end"><a href="register.php">Register</button></a>



</form>


</div>
    
</body>
</html>