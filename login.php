<?php
 session_start();

 if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
 }
 require 'functions.php';

if( isset($_POST["login"]) ) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //cek username
    if ( mysqli_num_rows($result) === 1 ) {

        //cek password 
        $row = mysqli_fetch_assoc($result);
        if ( password_verify($password, $row["password"]) ) {
            //cek session
            $_SESSION["login"] = true;


            header( "Location: index.php" );
            exit;
        }
    }

    $error = true;

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="signin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body class="text-center">



<main class="form-signin">
<?php  
if (isset($error)) :
?>
<p style="color:red ; font-style:italic;">Username atau password tidak benar!</p>
<?php
endif;
?>
  <form action="" method="post" enctype="multipart/form-data">
 
    <img class="mb-4" src="logozen.png" alt="" width="102" height="102">
    <h1 class="h3 mb-3 fw-normal">Halaman Login</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="username" name="username" placeholder="Username anda">
      <label for="username">Username anda</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password Anda">
      <label for="password">Masukkan Password Anda</label>
    </div>

    <button class="w-100 btn btn-lg btn-danger" name="login" type="submit">Login</button>
    <p class="mt-5 mb-3 text-muted">&copy; Copyright 2022 RyuuZen</p>
  </form>
</main>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>




