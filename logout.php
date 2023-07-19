<?php 
        session_start();
        if(isset($_SESSION['email'])){
            session_unset();
            session_destroy();
        }
        $ref= @$_GET['q'];
        header("location:index.php");
?>