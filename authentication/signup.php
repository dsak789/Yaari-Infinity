<?php
session_start();

include("../dbcon.php");
//$ofcon=mysqli_connect("localhost","root","","practice");
$fn=$_POST['fname'];
$ln=$_POST['lname'];
$pno=$_POST['Phno'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
$usr=$_POST['username'];
$otp=$_POST["otp"];
$pwd=md5($_POST['password']);
$rno=$_POST['rno'];
$br=$_POST['branch'];
$yrsm=$_POST['yr-sem'];
$filename='../profiles/'.$rno.$_FILES["image"]["name"];
$tmp=$_FILES["image"]["tmp_name"];
// if(!$con){
//     echo"check Your Database Connection";
//     header("Location:404.html");
    
// }
if(isset($_FILES['image']['name'])){
    // echo "added";
   if( move_uploaded_file($_FILES['image']['tmp_name'],$filename)){
    // echo"upload success<br>";
    // echo"<img src='$tar'/><br>";
   unset($_FILES["image"]["name"]);
   unset($_FILES["image"]["tmp_name"]);
   }
   else{
       $filename="no_profile.jpg";
       // header("Location:register.php");
   }
}




    //echo "<br><hr>".$fn."<br><hr>".$ln."<br><hr>".$dob."<br><hr>".$gender."<br><hr>".$usr."<br><hr>".$pwd;
    $ins="INSERT INTO users VALUES ('','$fn','$ln','$pno','$filename','$dob','$gender','$usr','$pwd','$rno','$br','$yrsm','$otp','pending')";
    if(mysqli_query($con,$ins)){
        {   
            if(move_uploaded_file($tmp,$filename)){
                if($res){
                    echo "
                <script>
                    alert('Recoreded')
                </script>";
                }
                echo "
                <script>
                    alert('Success')
                </script>";
                //header("Location:show.php");
            }

        }
        echo "<a href='signin.html'>Signin</a>";
        $_SESSION["register_status"]="Signup Succesfull!<br>Just Login Below.";
        header("Location:login.php");
    }
    else{
        echo "Signup Unsuccessful";
        echo $y=mysqli_error($con);
        $_SESSION["register_status"]="Signup Unsuccessfull".$y;
        header("Location:register.php");

    }
    
    


// INSERT INTO `signup` (`fname`, `lname`, `phno`, `dob`, `gender`, `username`, `pswd`, `rollno`, `branch`, `year`) VALUES ('', '', '', '', '', '', '', '', '', '');
// UPDATE `signup` SET `rollno` = '21VV5A1271' WHERE `signup`.`username` = 'dsak.official@gmail.com';
// "DELETE FROM `signup` WHERE `signup`.`username` = \'sak121527@gmail.comss\'"
?>  