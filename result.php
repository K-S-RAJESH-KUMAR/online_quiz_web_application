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
<link rel="stylesheet" href="css/result.css">
<title>RESULT</title>
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
            <h1 class="title">RESULT</h1>
            <div class="content">
            <?php

                        $user=$_SESSION['id'];
                        $qid=$_SESSION['qid'];
                        $result = mysqli_query($con,"SELECT q.topic,r.quiz_id,q.total_marks,r.score,r.time_taken FROM result r,quiz q,user u WHERE r.quiz_id=$qid and r.user_id=$user and r.quiz_id=q.quiz_id and r.user_id=u.user_id") or die('Error');
                        if(mysqli_num_rows($result)>0)
                        {
                            while($row = mysqli_fetch_array($result)) 
                            {
                                $qname = $row['topic'];
                                $qid = $row['quiz_id'];
                                $tmarks = $row['total_marks'];
                                $score = $row['score'];
                                $timetaken=$row['time_taken'];

                                if($timetaken>=0)
                                {
                                        $minutes=floor($timetaken/60);
                                        $seconds=$timetaken%60;
                                        $seconds = $seconds<10 ? '0'+$seconds : $seconds;
                                        $minutes = $minutes<10 ? '0'+$minutes : $minutes;
                                        $timetaken=$minutes.":".$seconds;
                                }
                                echo '<table id="qdata"> <tr><td><center>QUIZ NAME</center></td><td><center>'.$qname.'</center></td></tr> <tr><td><center>QUIZ ID</center></td><td><center>'.$qid.'</center></td></tr> <tr><td><center>TOTAL_MARKS</center></td><td><center>'.$tmarks.'</center></td></tr> <tr><td><center>SCORE</center></td><td><center>'. $score.'</center></td></tr> <tr><td><center>TIME_TAKEN</center></td><td><center>'.$timetaken.'</center></td></tr> <tr class="anslink"><td colspan="2"><h3> <center><a href="answers.php?qid='.$qid.'&qname='.$qname.'">SHOW ANSWERS</a></center></h3></td></tr>';
                            }
                            
                        }
                               
                ?> 
            </div>
</body>
</html>