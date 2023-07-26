
<?php

session_start();
if(isset($_SESSION['userid'])){

$id=$_SESSION['userid'];
$name=$_SESSION['name'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel='stylesheet' href='showusers.css'></head> -->
    <link rel="stylesheet" href="../CSS/allusers.css">
    <link rel="shortcut icon" href="../images/my_logo_balck.png" type="image/x-icon">
    <title>Show Users | <?php echo $name ." ". $id ?></title>
</head>
<body>
    <div id="nav">
        <div class="divlogo">
            
            <img src="../images/my_logo_balck.png" alt="SAK789" id="logo" height="100" width="100">
            <h3> YAARI INFINITY</h3>
            
        </div>
        
        <div id="link">
            <a href="../profile/">Profile</a>
            <a href="../dashboard/">Dashboard</a>
            <a href="../nav/about.html">About</a>
            <a href="../nav/contact.html">Contact</a>
            <a href="../authentication/signout.php">Logout</a>
        </div>
                
    </div>
    </body>
    </html>
    
    
    <?php
echo "<center><br>Login as <strong>$name</strong><h1>All users of YAARI INFINITY</h1></center><br>";
// $ofcon=mysqli_connect("localhost","root","","practice");
require("../dbcon.php");
if(!$con){
    echo "Connection Falied";
}
$all="SELECT * from users";
$users=mysqli_query($con,$all);
if($users){
    $i=0;
    echo "<center><table bgcolor='363636' cellpadding='08' cellspacing='15' border=`2`>
    <tr bgcolor='697373'>
    <th>Sno.</th>
    <th>Profile</th>
    <th>First name</th>
    <th>Last Name</th>
    <th>Phone</th>
    <th>Dob</th>
    <th>Gender</th>
    <th>Username</th>
    <th>Rollno</th>
    <th>Branch</th>
    <th>Year</th>
    </tr> ";
    
    while($usr=mysqli_fetch_assoc($users)){
        $i++;
        //  echo "<br>". $usr['fname']."".$usr['lname']."<hr>";
        
        $img=$usr['profile'];
        $fn=$usr['fname'];
        $ln=$usr['lname'];
        $ph=$usr['phoneno'];
        $dob=$usr['dob'];
        $gen=$usr['gender'];
        $un=$usr['username'];
        $rno=$usr['rollno'];
        $br=$usr['branch'];
        $yr=$usr['year'];
        
        echo "<tr bgcolor='478181'>
            <th>$i</th>
            <td align='center'><img src='$img' height='50' widht='50' id='dp' ></td>
            <td>$fn</td>
            <td>$ln</td>
            <td>$ph</td>
            <td>$dob</td>
            <td>$gen</td>
            <td>$un</td>
            <td>$rno</td>
            <td>$br</td>
            <td>$yr</td>
       </tr> ";
    }
    echo"<br>
    </table></center>";
}
// echo "<br><a href='signout.php'><Button>Logout</Button></a>";

}
else{
    echo "Sessions Expired<br><hr>";
    echo "<br><a href='login.php'><Button>Login</Button></a>";
    header("Location:index.php");
}

?>
