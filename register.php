<?php
    include("./assets/config.php");
    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $cpassword = md5($_POST['cpassword']);

        if($password == $cpassword) {
            $sql = "SELECT * FROM users WHERE email = '$email' AND password ='$password'";
            $result = mysqli_query($con,$sql);

            if($result -> num_rows > 0) {
                echo "<script>alert('user already exists')</script>";
            } else {
                $sql = "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$password')";
                $result = mysqli_query($con, $sql);
                if($result) {
                    header('location: login.php');
                    //echo "<script>alert('200 status code')</script>";
                    $username="";
                    $email="";
                    $_POST['password']="";
                    $_POST['cpassword']="";
                } else {
                    echo "<script>alert('Something went wrong')</script>";
                }
            }
        } else {
            echo "<script>alert('passwords do not match')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register here</title>
    <link rel="stylesheet" href="./CSS/login.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text">Register</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="cpassword" required>
            </div>
            <div class="input-group">
                <button class="btn" name="submit">Register</button>
            </div>
            <div>
               <p>Already have an account?<a href="/alcool/login.php">Login here</a></p>
            </div>
        </form>
    </div>
</body>
</html>