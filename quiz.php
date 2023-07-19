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
    <link rel="stylesheet" href="css/quiz.css">
    <title>Quiz</title>
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
        $result = mysqli_query($con,"SELECT q.topic,q.quiz_id,h.host_name,q.no_of_questions,q.total_time FROM host h,quiz q WHERE q.host_id=h.host_id") or die('Error');
        if(mysqli_num_rows($result)>0)
        {
            echo "<h1 style='color:yellow;text-align:center;position:absolute;top: 280px;left: 500px;'>AVAILABLE QUIZZES</h1>";
            echo  '<table id="qdata">
            <tr><th>QUIZ NAME</th><th>QUIZ ID</th><th>H0ST NAME</th><th>QUESTIONS</th><th>TIME</th><th>TAKE</th></tr>';
        }
        while($row = mysqli_fetch_array($result)) 
        {
                $qname = $row[0];
                $qid = $row[1];
                $hname = $row[2];
                $noq = $row[3];
                $time = $row[4];

                echo '<tr><td><center>'.$qname.'</center></td><td><center>'.$qid.'</center></td><td><center>'.$hname.'</center></td><td><center>'. $noq.'</center></td><td><center>'.$time.':00</center></td><td class="start"><center><a href="startquiz.php?qid='.$qid.'&qname='.$qname.'&time='.$time.'&noq='.$noq.'">START</a></center></td></tr>';
        }       
?>

        
     </div> 
</body>
</html>

