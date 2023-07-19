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
    <link rel="stylesheet" href="css/accounts.css">
    <title>ACCOUNT</title>
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
<div class="user">
    <?php
                $user=$_SESSION['id'];
                $result = mysqli_query($con,"SELECT count(*) FROM result  WHERE user_id=$user") or die('Error');
                $row = mysqli_fetch_array($result);
                
                 echo '<img src="css/images/user.png" width=200px style="float:right;">
                 <h2>USER NAME:&nbsp;<?php echo "<label>'.$name.'</label></h2>
                <h2>EMAIL:&nbsp;<label>'.$email.'</label></h2>
                <h2>NO OF QUIZZES ATTEMPTED:&nbsp;'.$row[0].'</h2>';
    ?>
</div>
</body>
</html>