<?php
include 'conn.php';

session_start();
if (isset($_POST['submit'])){

    $username = $_POST['username'];
    $password = MD5($_POST['pass']);

    // var_dump($username, $password);

    $query = "SELECT username AND pass FROM tbl_users WHERE username = '$username' AND pass = '$password' ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_array($result)){
                $_SESSION['LoginUser'] = $row['username'];
                header('Location: admin-index.php');
                
            }
        }
    
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=5.0">
    <title>Digital Placement System</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<form method = "POST" action = "admin-login.php" class='container mt-5' autocomplete = "off">
  <div class="mb-3">
    <label for="exampleInputUsername" class="form-label">Username</label>
    <input type="text" name="username" class="form-control" id="exampleInputUsername" autocomplete = "off">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" autocomplete = "off">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</body>    