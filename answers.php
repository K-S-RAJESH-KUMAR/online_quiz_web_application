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
        <link rel="stylesheet" href="css/answers.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ANSWERS</title>
    </head>
    <style>
        
    </style>
    <body>
                        <?php
                            if($qid=@$_GET["qid"])
                            {
                                $qname=@$_GET["qname"];
                                echo "<div class='navbar'><h1 class='title'>$qname &nbsp;QUIZ&nbsp;ANSWERS</h1> <nav>
                                <a href='welcome.php'>Home</a>
                                <a href='quiz.php'>TAKE QUIZ</a>
                                <a href='seeranking.php'>RANKING</a>
                                <a href='account.php'>ACCOUNT</a>
                                <a href='logout.php'>LOGOUT</a>
                            </nav> <hr></div>";
                            $uid=$_SESSION["id"];
                                $result = mysqli_query($con,"SELECT * FROM questions WHERE quiz_id=$qid ORDER BY question_no") or die('Error');   
                                                while( $row=mysqli_fetch_array($result))
                                                {
                                                    $qno=$row['question_no'];
                                                    $questions = $row['question'];
                                                    $opt1 = $row['opt1'];
                                                    $opt2 = $row['opt2'];
                                                    $opt3 = $row['opt3'];
                                                    $opt4 = $row['opt4']; 
                                                    $ans=$row['answer'];
                                                    $res = mysqli_query($con,"SELECT option_selected FROM history WHERE quiz_id=$qid and question_no=$qno and user_id=$uid") or die('Error');
                                                    $row1=mysqli_fetch_array($res);
                                                    $user_ans=$row1['option_selected'];

                                                    echo '<div class="ans">
                                                    <h2 class="quest"><labl id="question">'.$qno.')&nbsp;&nbsp;&nbsp;</label>'.$questions.'</h2><br>
                                                    <div class="optsions">
                                                    <h2 class="1" name='.$qno.'  value=1>1.&nbsp;&nbsp;'.$opt1.'</h2>
                                                    <h2 class="2" name='.$qno.'  value=2>2.&nbsp;&nbsp;'.$opt2.'</h2>
                                                    <h2 class="3" name='.$qno.'  value=3>3.&nbsp;&nbsp;'.$opt3.'</h2>
                                                    <h2 class="4" name='.$qno.'  value=4>4.&nbsp;&nbsp;'.$opt4.'</h2>';
                                                    if($ans==$user_ans){
                                                        echo '<h2 style="color:rgb(86, 243, 8);">YOUR ANSWER:&nbsp;'.$user_ans.'&nbsp;&nbsp;&check;</h2>'; 
                                                    }
                                                    else if($user_ans==0){
                                                        echo '<h2 style="color: rgb(173, 22, 22);">&nbsp;NOT ATTEMPTED!!!&nbsp;</h2>';
                                                        echo '<h2 style="color: rgb(173, 22, 22);">CORRECT OPTION:&nbsp;&nbsp;'.$ans.'</h2>';
                                                    }
                                                    else {
                                                        echo '<h2 style="color: rgb(173, 22, 22);">WRONG!! &nbsp;&nbsp;</h2>';
                                                        echo '<h2 style="color: rgb(173, 22, 22);">CORRECT OPTION:&nbsp;&nbsp;'.$ans.'</h2>';
                                                    }
                                                    echo '<br> <br><hr> <br> <br></div>';
                                                }

                            }
                        ?>
    </body>
    </html>