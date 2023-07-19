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
    <link rel="stylesheet" href="css/rankingadmin.css">
    <title>RANKING</title>
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
                        $result = mysqli_query($con,"SELECT DISTINCT topic,quiz_id,no_of_questions,total_marks FROM quiz q,host h WHERE q.host_id=$hid and q.host_id=h.host_id ORDER BY topic") or die('Error');
                        if(mysqli_num_rows($result)>0)
                        {
                            echo  '<table id="qdata">
                            <tr><th>QUIZ NAME</th><th>QUIZ ID</th><th>NUMBER OF QUESTIONS</th><th>TOTAL MARKS</th><th>SEE RANKING</th>';
                        }
                            while($row = mysqli_fetch_array($result)) 
                            {
                                $qname = $row['topic'];
                                $qid = $row['quiz_id'];
                                $noq = $row['no_of_questions'];
                                $totalmarks = $row['total_marks'];
                                echo '<tr><td><center>'.$qname.'</center></td><td><center>'.$qid.'</center></td><td><center>'.$noq.'</center></td><td><center>'. $totalmarks.'</center></td><td class="start"><center><a href="adminseeranking.php?qid='.$qid.'">RANKING</a></center></td></tr>';
                            }       
                ?>
</div>
</body>
</html>