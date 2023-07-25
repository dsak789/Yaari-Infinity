<?php 

$con=mysqli_connect("localhost","root","","yaari_infinity");
if(!$con){
    // echo"CON DONE<BR>";
    $err=mysqli_connect_error();
    header("Location:../404.php?err=$err");
}

?>