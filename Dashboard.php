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




    if($qid=@$_GET['qid'])
    {
        $result = mysqli_query($con,"DELETE FROM quiz WHERE quiz_id='$qid' ") or die('Error');
        header("location:Dashboard.php");

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/Dashboard.css">
<title>WELCOME</title>
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
<?php
                   
                    $hid=$_SESSION["key"];
                    $str =mysqli_query($con,"SELECT * FROM quiz WHERE host_id='$hid' order by topic") or die('Error');
                    if(mysqli_num_rows($str)>0)
                    {
                            echo  '<table id="quizlist">
                            <tr><th>QUIZ NAME</th><th>QUIZ ID</th><th>HOST ID</th><th>MARKS</th><th>TIME</th> <th>EDIT</th> <th>REMOVE QUIZ</th></tr>';
                    }
                    while($row = mysqli_fetch_array($str)) 
                    {
                        $qname = $row['topic'];
                        $qid = $row['quiz_id'];
                        $hid = $row['host_id'];
                        $qscore = $row['total_marks'];
                        $timetaken = $row['total_time'];
                        echo '<tr><td><center>'.$qname.'</center></td><td><center>'.$qid.'</center></td><td><center>'.$hid.'</center></td><td><center>'. $qscore.'</center></td><td><center>'.$timetaken.'</center></td> <td  id="edit"><a href="edit.php?qid='.$qid.'&qnmae='.$qname.'&noq='. $qscore.'&qno=0" name="edit">EDIT</a></td> <td id="remove"><a href="Dashboard.php?qid='.$qid.'" name="remove">REMOVE</a></td></tr>';
                    }       
        ?>
</div>
</body>
</html>