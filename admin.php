<?php
    include_once 'database.php';
    session_start();
    if(isset($_SESSION["email"]))
	{
		session_destroy();
    }
    
    if(isset($_POST['submit']))
	{	
        $email = $_POST['email'];
        $password = $_POST['password'];
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password); 
        $email = mysqli_real_escape_string($con,$email);
        $password = mysqli_real_escape_string($con,$password);  
        
        $result = mysqli_query($con,"SELECT * FROM host WHERE host_email = '$email' and password = '$password'") or die('Error');
        $row=mysqli_fetch_array($result);
        $count=mysqli_num_rows($result);
        if($count==1)
        {
            session_start();
            $_SESSION["name"] = $row[2];
            $_SESSION["key"] =$row['host_id'];
            $_SESSION["email"] = $email;
            header("location:Dashboard.php");
        }
        else
        {
            echo "<center><h3><script>alert('Sorry.. Wrong Username (or) Password');</script></h3></center>";
            header("refresh:0;url=admin.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/admin.css">
        <title>| Online Quiz System |</title>
    </head>
    <body>
            <form method="post" action="admin.php" enctype="multipart/form-data">
                    <h3>Host Login</h3>
                    <input type="email" placeholder="Email" id="username" required name='email'>
                    <input type="password" placeholder="Password" id="password" required name='password'>
                    <button class="btn" type="submit" name='submit'>Log In</button>
            </form>
    </body>
</html>