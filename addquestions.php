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
    $result = mysqli_query($con,"SELECT host_id FROM host WHERE host_email = '$email'") or die('Error');
	$row = mysqli_fetch_array($result);
	$hid=$row[0];
    


if(isset($_POST['addquiz']))
{	
    $qname=$_POST["qname"];

	$qname =htmlspecialchars($_POST['qname']);
	$noq = htmlspecialchars($_POST['noq']);
    $ttime = htmlspecialchars($_POST['ttime']);

    $_SESSION['noq']=$noq;
    $_SESSION['qname']=$qname;
    $_SESSION['ttime']=$ttime;
    $_SESSION['qno']=1;
	$ttime=htmlspecialchars($_POST['ttime']);	
	$str = "insert into quiz set host_id='$hid',topic='$qname',no_of_questions='$noq',total_marks='$noq',total_time='$ttime'";
	if((mysqli_query($con,$str)))
	{
		?>

	   <script>alert('QUIZ ADDED SUCCESSFULLY');
	   </script>
	   <?php 
		
	}
}

if(isset($_POST['addquestion']))
{	
	$qust =htmlspecialchars($_POST['qust']);
	$opt1 = htmlspecialchars($_POST['opt1']);
    $opt2 = htmlspecialchars($_POST['opt2']);
    $opt3 = htmlspecialchars($_POST['opt3']);
    $opt4 = htmlspecialchars($_POST['opt4']);
    $ans = htmlspecialchars($_POST['ans']);
    $qno=$_SESSION['qno'];
    $noq=$_SESSION['noq'];
    $qname=$_SESSION['qname'];
    $ttime=$_SESSION['ttime'];

    $result = mysqli_query($con,"SELECT quiz_id FROM quiz WHERE host_id='$hid'and topic='$qname' and no_of_questions='$noq' and total_marks='$noq' and total_time='$ttime'") or die('Error');
	$row = mysqli_fetch_array($result);
	$qid=$row[0];

 
    
	
	$str = "insert into questions set quiz_id='$qid',question_no='$qno',question='$qust',opt1='$opt1',opt2='$opt2',opt3='$opt3',opt4='$opt4',answer='$ans'";
	if((mysqli_query($con,$str)))
	{
        ?>
        <script>alert('QUESTION ADDED SUCCESSFULLY');

	   </script>
	   <?php
       $qno=$_SESSION['qno'];
       $noq=$_SESSION['noq'];
       
       if($qno<$noq)
       {
            $_SESSION['qno']=$qno+1;
       }
       if($qno>=$noq){
        header('Location:Dashboard.php');
       }
	   
		
	}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/addquestions.css">
<title>WELCOME</title>
</head>
<body>
<div id='admin'><?php echo $email;?></a></div>
<div class='background'>
        <h1 class='heading'>ONLINE QUIZ WEB APPLICATION</h1>
        <nav>
            <a href="Dashboard.php">Home</a>
            <a href="addquiz.php">ADD QUIZ</a>
            <a href="removequiz.php">REMOVE QUIZ</a>
            <a href="rankingadmin.php">RANKING</a>
            <a href="logout.php">LOGOUT</a>

        </nav>
</div>
        <label class='qname'><h1><?php echo $qname;?></h1></label>
    <div class='qwindow'>
          <form action="addquestions.php" method="post">
          <h2><?php $qno=$_SESSION['qno'];echo $qno;?><input type="text" class='quest' name="qust" placeholder="QUESTION" required></h2><br><hr>
                    <div class='optsions'>
                        1.<input type="text" name="opt1" placeholder="OPTION 1" required>
                        2.<input type="text" name="opt2" placeholder="OPTION 2" required>
                        3.<input type="text" name="opt3" placeholder="OPTION 3" required>
                        4.<input type="text" name="opt4" placeholder="OPTION 4" required><hr>
                        <br><br><br>
                        <input type="text" name="ans" id="p1" placeholder="ANSWER OPTION NUMBER" required onkeyup="check()">
                    </div>
                <button class='btn' id= "btn" type="submit" name="addquestion">NEXT</button>
          </form>
    </div>

</body>
</html>
<script>
	function check()
	{
       num =document.getElementById("p1").value;
		if(num<5 && num>0) 
		{
            document.getElementById("btn").disabled= false;
			document.getElementById("p1").style.backgroundColor='white';

		}
		else{
            document.getElementById("btn").disabled= true;
			document.getElementById("p1").style.backgroundColor='rgb(248, 141, 141)';
            alert("AVAILABLE OPTIONS ARE 1,2,3 AND 4");

		}
	}
</script>