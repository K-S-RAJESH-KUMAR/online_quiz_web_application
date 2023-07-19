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
    $dur='';

        $_SESSION["dur"]=@$_GET["time"];
         $qid=@$_GET["qid"];
        $_SESSION["qid"]=$qid;
         $time=@$_GET["time"];
         $time=$time*60;
         $qname=@$_GET["qname"];
         $noq= @$_GET["noq"];
         $user=$_SESSION['id'];       
         $score=0;
          
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $qname=@$_GET["qname"];?></title>
    <link rel="stylesheet" href="css/startquiz.css">
</head>
<body  onload="start()" id='body'>
        <h1 class='title'><?php echo $qname=@$_GET["qname"];?></h1>
        <div id='clock'><?php echo $dur; ?>00:00<p></p></div>
<div class="qwindow">
<form name ="quiz" id="form" action="check.php"  method="POST">
            
                <?php
                        $res1 = mysqli_query($con,"SELECT * FROM result WHERE quiz_id=$qid and user_id=$user") or die('Error'); 
                        if(mysqli_num_rows($res1)>0)
                        {
                            ?>
                            <script>alert("You have already taken this quiz");
                            window.location="quiz.php?";
                        </script>
                            <?php
                        }
                        else {
                            ?>
                                    <script>
                                            alert("* DO NOT REFRESH THE PAGE OR NAVIATE BETWEEN THE PAGES\n* YOU WILL GET ONLY ONE CHANCE TO ATTEND A QUIZ");
                                    </script>
                            <?php
                            
                        }






                        $result = mysqli_query($con,"INSERT INTO result SET quiz_id='$qid',user_id='$user',score='$score',time_taken='$time'") or die('Error'); 

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
                            

                            $_SESSION["qid"]=$qid;
                            $_SESSION["time"]=$time;
                            

                            echo '
                            <h2 class="quest"><labl id="question">'.$qno.')&nbsp;&nbsp;&nbsp;</label>'.$questions.'</h2><br>
                            <div class="optsions">
                            <h2 class="ans"><input type="radio" name='.$qno.'  value=1>'.$opt1.'</h2>
                            <h2 class="ans"><input type="radio" name='.$qno.'  value=2>'.$opt2.'</h2>
                            <h2 class="ans"><input type="radio" name='.$qno.'  value=3>'.$opt3.'</h2>
                            <h2 class="ans"><input type="radio" name='.$qno.'  value=4>'.$opt4.'</h2>
                            <br> <br> <br> <br>';
                                                      
                        }
                        echo '<hr><input type="hidden" name="hidden" id="hidden" value=0>
                        </div><button class="next" id="submit" type="submit" name="submit">SUBMIT</button>'; 
                ?>
                
</form>                                      

</div>
    
</body>

</html>

<script>
    function start()
    {
       
        sec=<?php echo $dur=$_SESSION["time"]; ?>;
        showtimer=document.getElementById('clock');
        secvalue=document.getElementById('hidden');
        inter1=setInterval(runtimer, 1000);
        function runtimer()
        { 
            
            if(sec>=0)
            {
                    let minutes=Math.floor(sec/60);
                    let seconds=sec%60;
                    seconds = seconds<10 ? '0'+seconds : seconds;
                    minutes = minutes<10 ? '0'+minutes : minutes;
                    showtimer.innerHTML=`${minutes}:${seconds}`;
                    sec--;
                    secvalue.value=sec;
            } else
            {
                clearInterval(inter1);
                document.getElementById("submit").click();
            } 

            if(sec<60){
                        document.getElementById('body').style.animation = "colortransition 3s ease-in";
                        document.getElementById('body').style.backgroundColor="rgb(162, 34, 34)";
            }          
        } 
    }
    
</script>