<?php
	require('database.php');
	session_start();
	if(!isset($_SESSION["email"]))
	{
		session_destroy();
	}
			
	if(isset($_POST['submit']))
	{	
		$email =htmlspecialchars($_POST['email']);
		$pass = htmlspecialchars($_POST['password']);
		$email = mysqli_real_escape_string($con,$email);
		$pass = mysqli_real_escape_string($con,$pass);			
		$str = "SELECT * FROM user WHERE user_email='$email' and password='$pass'";
		$result = mysqli_query($con,$str);
		if((mysqli_num_rows($result))!=1) 
		{
			echo "<center><h3><script>alert('Sorry.. Wrong Username (or) Password');</script></h3></center>";
			header("refresh:0;url=login.php");
		}
		else
		{
			session_start();
			$_SESSION['logged']=$email;
			$row=mysqli_fetch_array($result);
			$_SESSION['name']=$row[2];
			$_SESSION['id']=$row[0];
			$_SESSION['email']=$row[1];
			$_SESSION['password']=$row[3];
			header('location: welcome.php?'); 					
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/login.css">
        <title>LOGIN</title>
    </head>
    <body>
            <form method="post" action="login.php" enctype="multipart/form-data">
                    <h3>Login</h3>
                    <input type="email" placeholder="Email" id="username" required name='email'>
                    <input type="password" placeholder="Password" id="password" required name='password'>
                    <button class="btn" type="submit" name="submit">Log In</button>
                    <span class="reg">Don't have an account? &nbsp;<a href="register.php">Register</a>&nbsp; Here..</span>
            </form>
    </body>
</html>