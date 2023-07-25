<?php
session_start();
//$ofcon=mysqli_connect("localhost","root","","practice");
require("../dbcon.php");

$usr=$_POST['username'];
$pwd=md5($_POST['password']);

// $auth="SELECT * from signup";
$verify= "SELECT * FROM users WHERE username='$usr' AND password='$pwd' "; 
if(!$con){
    echo"Db not connected";
    exit;
}
$res=mysqli_query($con,$verify);
if(!$res){
    echo "Error".mysqli_connect_error();
}

$data=mysqli_fetch_assoc($res);
if($data){
    
    // echo "<br>"."Login With ". $data['username']."\tas ".$data['fname']."<hr>";
    $_SESSION['userid']=$data['username'];
    $_SESSION['name']=$data['fname']." ".$data["lname"];
    $_SESSION['emailstatus']=$data['email_status'];
    $_SESSION['roll']=$data['rollno'];
    $status=$data['email_status'];
    if($status=="verified"){
        header("Location:../dashboard/");
    }
    else{
        header("Location:emailverification.php");
    }
    echo "<h1><a href='signout.php'><button>Signout</button></a></h1>";
    echo "<h1><a href='showuser.php'><button>Show Users</button></a></h1>";
    //sleep(2);
    //header("Location:profile.php");
}
else{
    $_SESSION["register_status"]="Invalid Credentials. <br> Login Failed!";
    header("Location:login.php");
}

// $a=mysqli_query($con,$auth);
// echo ($a).toString();
// while($row=mysqli_fetch_assoc($res)){
// echo "<br>"."Login With ". $row['username']."\tas ".$row['fname']."<hr>";
// // echo "hello ".$row['fname']."<br>";
// }
?>