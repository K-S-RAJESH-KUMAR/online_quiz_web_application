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

if(isset($_POST['updatequestion']))
{	
	$qust =htmlspecialchars($_POST['qust']);
	$opt1 = htmlspecialchars($_POST['opt1']);
    $opt2 = htmlspecialchars($_POST['opt2']);
    $opt3 = htmlspecialchars($_POST['opt3']);
    $opt4 = htmlspecialchars($_POST['opt4']);
    $ans = htmlspecialchars($_POST['ans']);

    $qid=@$_GET["qid"];
    $qno=@$_GET["qno"];

	$str = "UPDATE questions set question='$qust',opt1='$opt1',opt2='$opt2',opt3='$opt3',opt4='$opt4',answer='$ans' WHERE quiz_id='$qid'and question_no='$qno'";
	if((mysqli_query($con,$str)))
	{
        ?>
        <script>alert('QUESTION UPDATED SUCCESSFULLY');

	   </script>
	   <?php
		
	}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/edit.css">
<title>EDIT</title>
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

<?php



if($qid=@$_GET["qid"])
{
    $qname=@$_GET["qname"];
    $qno=@$_GET["qno"];
    $qno=$qno+1;
    $result = mysqli_query($con,"SELECT * FROM questions WHERE quiz_id=$qid AND question_no=$qno") or die('Error');   
    if( $row=mysqli_fetch_array($result))
    {
        $questions = $row['question'];
        $opt1 = $row['opt1'];
        $opt2 = $row['opt2'];
        $opt3 = $row['opt3'];
        $opt4 = $row['opt4']; 
        $ans=$row['answer']; 

?>
                <label class='qname'><h1><?php echo $qname;?></h1></label>
            <div class='qwindow'>
                <form action="edit.php?qid=<?php echo $qid;?>&qname=<?php echo $qname;?>&qno=<?php echo $qno;?>" method="post">
                <h2><?php echo $qno;?><input type="text" class='quest' name="qust" placeholder="QUESTION" value="<?php echo $questions?>"></h2><br><hr>
                            <div class='optsions'>
                                1.<input type="text" name="opt1" placeholder="OPTION1" value="<?php echo $opt1?>">
                                2.<input type="text" name="opt2" placeholder="OPTION2" value="<?php echo $opt2?>">
                                3.<input type="text" name="opt3" placeholder="OPTION3" value="<?php echo $opt3?>">
                                4.<input type="text" name="opt4" placeholder="OPTION4" value="<?php echo $opt4?>"><hr>
                                <br><br><br>
                                <label>ANSWER OPTION NUMBER
                                <input type="text" name="ans" id="p1" value="<?php echo $ans?>" onkeyup="check()" ></label>
                            </div>
                        <button class='btn' id="btn" type="submit" name="updatequestion">UPDATE</button>
                </form>
            </div>
            <?php
    }
    else{
        echo "<script>alert('QUIZ UPDATED SUCCESSFULLY');window.location='Dashboard.php';</script>";
        
    }
}
            ?>
</body>
</html>


<script>
	function check()
	{
		if(document.getElementById("p1").value <5 && document.getElementById("p1").value >0 )
		{
            document.getElementById("btn").disabled= false;
			document.getElementById("p1").style.backgroundColor='white';

		}
		else{
            document.getElementById("btn").disabled= true;
            alert("AVAILABLE OPTIONS ARE 1,2,3 AND 4");
			document.getElementById("p1").style.backgroundColor='rgb(248, 141, 141)';

		}
	}
</script>