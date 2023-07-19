<?php
    include_once 'database.php';
    session_start();
    if(!(isset($_SESSION['email'])))
    {
        header("location:login.php");
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
<link rel="stylesheet" href="css/welcome.css">
<title>WELCOME</title>
</head>

<body>
<div class='background'>
        <h1 class='heading'>ONLINE QUIZ WEB APPLICATION</h1>
        <nav>
            <a href="welcome.php">Home</a>
            <a href="quiz.php">TAKE QUIZ</a>
            <a href="seeranking.php">RANKING</a>
            <a href="account.php">ACCOUNT</a>
            <a href="logout.php">LOGOUT</a>
        </nav>     
</div>
<div class="content">
    

                <?php

                        $user=$_SESSION['id'];
                        $result = mysqli_query($con,"SELECT q.topic,r.quiz_id,q.total_marks,r.score,r.time_taken FROM result r,quiz q WHERE r.user_id=$user AND r.quiz_id=q.quiz_id ORDER BY topic") or die('Error');
                        if(mysqli_num_rows($result)>0)
                        {
                            echo "<h1 style='color:yellow;text-align:center;padding-top:30px;'>HISTORY</h1>";
                            echo  '<table id="qdata">
                            <tr><th>QUIZ NAME</th><th>QUIZ ID</th><th>TOTAL_MARKS</th><th>SCORE</th> <th>SEE REPORT</th></tr>';
                        }
                        else
                        {
                            echo "<h1 style='color:yellow;text-align:center;padding-top:30px;'>NO DATA AVAILBLE</h1>";
                        }
                            while($row = mysqli_fetch_array($result)) 
                            {
                                $qname = $row['topic'];
                                $qid = $row['quiz_id'];
                                $tmarks = $row['total_marks'];
                                $score = $row['score'];
                                $timetaken=$row['time_taken'];
                        
                                echo '<tr><td><center>'.$qname.'</center></td><td><center>'.$qid.'</center></td><td><center>'.$tmarks.'</center></td><td><center>'. $score.'</center></td>> <td style="background-color: blue;"> <center><a style="color:white;" href="answers.php?qid='.$qid.'&qname='.$qname.'">REPORT</a></center></td></tr>';
                            }       
                ?> 
    </div>
</body>
</html>