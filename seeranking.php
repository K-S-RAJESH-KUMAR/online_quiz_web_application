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
    <link rel="stylesheet" href="css/seeranking.css">
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
                        $result = mysqli_query($con,"SELECT DISTINCT r.quiz_id,q.topic,q.total_marks FROM result r,quiz q WHERE r.quiz_id=q.quiz_id ORDER BY topic") or die('Error');
                        if(mysqli_num_rows($result)>0)
                        {
                            echo  '<table id="qdata">
                            <tr><th>QUIZ NAME</th><th>QUIZ ID</th><th>TOTAL_MARKS</th><th>RANKING</th></tr>';
                        }
                            while($row = mysqli_fetch_array($result)) 
                            {
                                $qname = $row['topic'];
                                $qid = $row['quiz_id'];
                                $tmarks = $row['total_marks'];
                                echo '<tr><td><center>'.$qname.'</center></td><td><center>'.$qid.'</center></td><td><center>'.$tmarks.'</center></td><td class="click"><center><a href="ranking.php?qid='.$qid.'">RANK</a></center></td></tr>';
                            }       
                ?> 
    </div>

</table>
</body>
</html>