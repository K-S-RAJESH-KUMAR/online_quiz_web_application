<?php
    include_once 'database.php';
    session_start();
    if(!(isset($_SESSION['email'])))
    {
        header("location:admin.php");
    }
    else
    {
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        include_once 'database.php';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/addquiz.css">
<title>ADD QUIZ</title>
</head>

<body>
<div id='admin'><?php echo $email;?></a></div>
<div class='background'>
        <h1 class='heading'>ONLINE QUIZ WEB APPLICATION</h1>
        <nav>
            <a href="Dashboard.php">Home</a>
            <a href="addquiz.php">ADD QUIZ</a>
            <a href="rankingadmin.php">RANKING</a>
            <a href="logout.php">LOGOUT</a>

        </nav>
</div>
<div class="content">
<form action="addquestions.php" method="POST">
                <input type="text" name="qname" id="qname" placeholder="QUIZ NAME" required>
                <input type="text" name="noq" id="noq" placeholder="NUMBER OF QUESTIONS" required onblur="numcheck()">
                <input type="text" name="ttime" id="ttime" placeholder="TOTAL TIME (in minutes)" required  onkeyup="timecheck()">
                <button class="btn" id="btn" type="submit" name='addquiz'>ADD QUIZ</button>
            
        </form>
</div>
</body>
</html>


<script>
	function numcheck()
	{
        val =document.getElementById("noq").value;
		if( val<150 && val >0 )
		{
            document.getElementById("btn").disabled= false;
            document.getElementById("ttime").disabled=false;
			document.getElementById("noq").style.backgroundColor='white';

		}
		else{

            if(val <0)
            {
                document.getElementById("ttime").disabled=true;
                document.getElementById("btn").disabled= true;
                document.getElementById("noq").style.backgroundColor='rgb(248, 141, 141)';
                alert("NUMBER OF QUESTIONS MUST BE GREATER THAN 0");
             
            }
            else{
                document.getElementById("ttime").disabled=true;
                document.getElementById("btn").disabled= true;
                document.getElementById("noq").style.backgroundColor='rgb(248, 141, 141)';
                alert("NUMBER OF QUESTIONS MUST BE LESS THAN 150");
                
            }

		}
	}

    function timecheck()
    {
        val=document.getElementById("ttime").value ;
        if(val<300 &&val >0 )
		{
            document.getElementById("btn").disabled= false;
			document.getElementById("ttime").style.backgroundColor='white';

		}
		else{
            
            if(val <0)
            {
                document.getElementById("btn").disabled= true;
                alert("TIME MUST BE GREATER THAN 0");
            }
            else{
                document.getElementById("btn").disabled= true;
                alert("TIME MUST BE LESS THAN 300 MINUTES");
            }
			document.getElementById("ttime").style.backgroundColor='rgb(248, 141, 141)';

		}
    }
</script>