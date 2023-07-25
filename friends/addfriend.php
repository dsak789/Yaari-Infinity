<?php

session_start();
if(isset($_SESSION['from'])){
$cuid=$_SESSION['from'];
$cunm=$_SESSION['name'];
$id= $_REQUEST["id"];
$frid= $_REQUEST["frid"];
}
else{
    echo "no requests ";
}
include("../dbcon.php");
$reqtb="CREATE TABLE if not exists requests(
    id int primary key AUTO_INCREMENT,
    requid varchar(200) not null,
    reqname varchar(70) not null,
    reqfrom varchar(50) not null,
    reqto varchar(50) not null,
    reqdate date not null
)";
mysqli_query($con,$reqtb);
$dt=date('Y-m-d');
echo $dt.'<br>';
$sel="SELECT * FROM requests where reqfrom='$cuid' and reqto='$id'";
if($res=mysqli_query($con,$sel)){
    if(mysqli_num_rows($res)>0){
        echo "request alredy sent";
        header("Location:index.php");
    }
    else{
        
        $ins="INSERT Into requests VALUES('','$frid','$cunm','$cuid','$id','$dt')";
        if(mysqli_query($con,$ins)){
            echo "inserted";
            header("Location:index.php");
            
        }
        else{
            echo mysqli_error($con);
            
        }
        
    }
}
else{
    echo mysqli_error($con);
}




?>
