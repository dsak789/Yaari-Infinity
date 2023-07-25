<?php 
 
    session_start();
    echo "Sessions Expired<br><hr>";
    echo "<br><a href='login.php'><Button>Login</Button></a>";
    session_destroy();
    header("Location:../index.php");
    //sleep(2);
?>