<?php
	include("database.php");
	session_start();
	
	if(isset($_POST['submit']))
	{	
		$name = htmlspecialchars($_POST['name']);
		$email =htmlspecialchars($_POST['email']);
		$number =htmlspecialchars($_POST['phone']);
		$password =htmlspecialchars($_POST['password']);
		$str="SELECT user_email from user WHERE user_email='$email'";
		$result=mysqli_query($con,$str);
		if((mysqli_num_rows($result))>0)	
		{
            ?> <script>alert('Sorry.. This email is already registered !!');</script><?php
            header("refresh:0;url=login.php");
        }
		else
		{
            $str="insert into user set user_name='$name',user_email='$email',password='$password', user_mob=$number";
			if((mysqli_query($con,$str)))	
            ?><script>alert('Congrats.. You have successfully registered !!');</script><?php
			header('location: login.php?q=1');
		}
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/register.css">
        <title>| REGISTER |</title>
    </head>
    <body>
            <form method="post" action="register.php" enctype="multipart/form-data">
					<input type="text" name="name" placeholder="Enter Your Name"required />
					<input type="email" name="email" placeholder="Enter Your Email Id" required />
					<input type="number" name="phone" id="number" placeholder="Enter Your Mobile Number" required  onblur="phonenumber(phone)"/>
			        <input type="password" id="p1" name="password" placeholder="Enter Your Password"required />
			        <input type="password" id="p2" name="password"  placeholder="Confirm Your Password"required  onkeyup="check()"/>
					HOST<input type="radio" name="type" id="type" value='1'>
					USER<input type="radio" name="type" id="type" value='0'>
					<button class='btn' id='btn' type="submit" name="submit">Register</button>
					<span class="log">Already have an account!&nbsp;<a href="login.php">Login </a>&nbsp;Here..</span> 
            </form>
    </body>
</html>

<script>

function phonenumber(inputtxt)
{
  var phoneno = /^\d{10}$/;
  if((inputtxt.value.match(phoneno)))
	{
		document.getElementById("number").style.backgroundColor='white';
		document.getElementById("btn").disabled= false;
		document.getElementById("p1").disabled= false;
		document.getElementById("p2").disabled= false;
      return true;
    }
    else
    {
        alert("PHONE NUMBER MUST BE 10 DIGITS");
		document.getElementById("btn").disabled= true;
		document.getElementById("p1").disabled= true;
		document.getElementById("p2").disabled= true;
		document.getElementById("number").style.backgroundColor='rgb(248, 141, 141)';
        return false;
    }
}



	function check()
	{
		if(document.getElementById("p1").value==document.getElementById("p2").value)
		{
			document.getElementById("btn").disabled= false;
			document.getElementById("p2").style.backgroundColor='rgb(198, 252, 139)';

		}
		else{
			document.getElementById("btn").disabled= true;
			document.getElementById("p2").style.backgroundColor='rgb(248, 141, 141)';

		}
	}
</script>