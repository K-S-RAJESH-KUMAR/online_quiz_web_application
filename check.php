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


    
        if(isset($_POST['submit']))
        {   
            $rem =$_POST['hidden'];
            $time=$_SESSION['time'];
            $uid=$_SESSION['id'];
            $sec=$time-$rem;
            
             $qid=$_SESSION["qid"];
            $result = mysqli_query($con,"SELECT answer FROM questions WHERE quiz_id=$qid ORDER BY question_no") or die('Error');  
            $i=1;
            $j=0;
               while($row=mysqli_fetch_array($result))
               {
                    @$response=$_POST[$i];
                    $i++;
                    $j++;
                    $res = mysqli_query($con,"INSERT INTO history SET user_id='$uid',quiz_id='$qid',question_no='$j',option_selected='$response'") or die('Error');
                    if(@$response==$row['answer'])
                    {
                        @$_SESSION["score"]+=1;  
                    }
               }
               $user=$_SESSION['id'];       
               $score=@$_SESSION["score"];
                     $result = mysqli_query($con,"UPDATE result SET score='$score',time_taken='$sec'  where quiz_id='$qid' and user_id='$user' ") or die('Error');   
                     $_SESSION["score"]=0;  
                     header("location:result.php");

        }
        else
        {
            $qid=$_SESSION["qid"];
            $user=$_SESSION['id']; 
            $score=0;
            $time=$_SESSION['time'];
            $result = mysqli_query($con,"UPDATE result SET score='$score',time_taken=$time WHERE quiz_id='$qid' and '$user' ") or die('Error');
            $_SESSION["score"]=0; 
            header("location:result.php");
    
        }



?>