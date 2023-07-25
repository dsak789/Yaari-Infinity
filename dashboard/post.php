<?php 

session_start();
if(isset($_SESSION['userid'])){
    $id=$_SESSION['userid'];
    $name=$_SESSION['name'];
    echo "S<br>";
}
else{
    echo "N";
    header("Location:../index.php");
}
// $con=mysqli_connect("localhost","root","","practice");
require("../dbcon.php");
$sel="SELECT * FROM users WHERE username='$id'";
$query=mysqli_query($con,$sel);
if($query){
    $usrdata=mysqli_fetch_assoc($query);
    $postdp=$usrdata['profile'];
    $postuid=$usrdata['username'];
    $postby=$usrdata['fname'].$usrdata['lname'];
}
date_default_timezone_set('Asia/Kolkata');
$postdate= date("d-m-y ").date("H:i");
$filedate= date("d-m-y-").date("H-i");
$postcontent=$_POST["writecontent"];
$tar='../posts/'.$postby.$filedate.'.jpeg';
if(isset($_FILES['postphoto']['name'])){
    echo "added";
   if( move_uploaded_file($_FILES['postphoto']['tmp_name'],$tar)){
    echo"upload success<br>";
    echo"<img src='$tar'/><br>";
   unset($_FILES["postphoto"]["name"]);
   unset($_FILES["postphoto"]["tmp_name"]);
   }
   else{
       $tar="";
       // header("Location:profile.php");
   }
}
echo $tar;
$inspost="INSERT INTO posts VALUES ('','$postdp','$postuid','$postdate','$tar','$postby','$postcontent');";
$posting=mysqli_query($con,$inspost);
if($posting){
    // echo "Posted";
    $_SESSION["post_status"]="$postby!"."Your Post was Successfully Uploaded.";
    header("Location:../dashboard/");
}
else{
    // echo" post not done";
    $_SESSION["post_status"]="$postby!"." Sorry Your Post was Not Uploaded.";
     $_SESSION["post_status"]=mysqli_error($con);
    
    header("Location:../dashboard/");
}

?>