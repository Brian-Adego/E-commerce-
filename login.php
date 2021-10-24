<?php
	include './assets/config.php';
	session_start();
	if(isset($_POST['submit'])) {
		$email = $_POST['email'];
		$password = md5($_POST['password']);

		$sql = "SELECT * FROM users WHERE email = '$email' AND password ='$password'";
		$result = mysqli_query($con,$sql);
		if($result -> num_rows > 0) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION['username'] = $row['username'];
			header("location: index.php");
		} else{
			echo "<script>alert('Email or password is wrong')</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>alcool login</title>
		<link rel="stylesheet" href="./CSS/login.css" />
		<link
			rel="stylesheet"
			href="./CSS/fontawesome-free-5.15.3-web/css/all.min.css"
		/>
	</head>
	<body>
		<div class="container">
            <form action="" method="POST" class="login-email">
                <p class="login-text">Login</p>
                <div class="input-group">
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="input-group">
                    <button class="btn" name="submit">Login</button>
                </div>
                <div>
                   <p>Do not have an account?<a href="/alcool/register.php">Register here</a></p>
                </div>
            </form>
		</div>
	</body>
</html>
