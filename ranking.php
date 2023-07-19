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
    <link rel="stylesheet" href="css/ranking.css">
    <title>RANKING</title>
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
                        $qid=@$_GET['qid'];
                        $result = mysqli_query($con,"SELECT q.topic,r.quiz_id,u.user_name,u.user_email FROM result r,user u,quiz q WHERE r.quiz_id=$qid and r.quiz_id=q.quiz_id and r.user_id=u.user_id ORDER BY score DESC ,time_taken") or die('Error');
                        $rank=0;
                        if(mysqli_num_rows($result)>0)
                        {
                            echo  '<table id="qdata">
                            <tr><th>QUIZ NAME</th><th>QUIZ ID</th><th>NAME</th><th>EMAIL</th><th>RANK</th></tr>';
                        }
                            while($row = mysqli_fetch_array($result)) 
                            {
                                $qname = $row['topic'];
                                $qid = $row['quiz_id'];
                                $uname = $row['user_name'];
                                $uemail = $row['user_email'];
                                $rank=$rank+1;
                                echo '<tr><td><center>'.$qname.'</center></td><td><center>'.$qid.'</center></td><td><center>'.$uname.'</center></td><td><center>'. $uemail.'</center></td><td><center>'.$rank.'</center></td></tr>';
                            }       
                ?>
</div>
</body>
</html>