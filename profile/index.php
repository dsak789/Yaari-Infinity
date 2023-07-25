<?php
    session_start();
    include("../dbcon.php");
    if(isset($_SESSION['userid'])){
        $id=$_SESSION['userid'];
        $nm=$_SESSION['name'];
        //echo "HI<br>".$name;
        $fn="";
        $ln= "";
        $pn= "";
        $dob="";
        $gen= "";
        $roll= "";
        $brn= "";
        $yr= "";
        // $con=mysqli_connect("localhost","root","","pms");
        $select="SELECT * FROM users WHERE username= '$id'";
        $result=mysqli_query($con,$select);
        
        if(($result)){
            $row=mysqli_fetch_assoc($result);
                // echo "$result";
                $fn= $row['fname'];
                $ln= $row['lname'];
                $pn= $row['phoneno'];
                $img=$row['profile'];
                $dob= $row['dob'];
                $gen= $row['gender'];
                $roll= $row['rollno'];
                $brn= $row['branch'];
                $yr= $row['year'];  
        }
        else{
            echo "<br>Data Not Fecthed";
        }
    }
    else{
        echo "Sessions Expired";
        echo "<a href='login.php'><button>Login</button></a>";
        sleep(2);
        header("Location:index.php");

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="shortcut icon" href="../images/my_logo_balck.png" type="image/x-icon">
    <title>Profile | <?php echo $nm ." ". $id ?></title>
</head>
<body>
    <div class="main">
    <?php include("../nav/header.php") ?>
        <div id="profiledetails">
            <div class="dp">
                <img src="<?php echo $img?>" alt="Profile Picture" id="profilepic" height="150" width="100" title="<?php echo $fn ?>"><br>
                <h5><?php echo $id ?></h5>
                <h6>In Career Development</h6>
            </div>
            <div class="details">
                <ul>
                    <li>First Name:</li><span><?php echo $fn ?></span>
                    <li>Last name:</li><span><?php echo $ln ?></span>
                    <li>Phone: </li><span><?php echo $pn ?></span>
                    <li>Date of Birth:</li><span><?php echo $dob ?></span>
                    <li>Gender:</li><span><?php echo $gen ?></span>
                </ul>  
            </div>
            <div class="education">
                <ul>
                    <li>Roll No:</li><span><?php echo $roll ?></span>
                    <li>Branch:</li><span><?php echo $brn ?></span>
                    <li>Year:</li> <span><?php echo $yr ?></span>
                </ul>               
            </div>
            <div>
                <nav id="opt">
                    <button>Edit Profile</button>
                    <!-- <a href="#">Edit Profile</a>
                    <a href="#">Delete Profile</a> -->
                    <button>Delete Profile</button>
                     
                    
                </nav>
            </div>
        </div>
        
            <div id="disclaimer">
                <h3>Designed By <strong>SB<sub>7</sub> Develpoers</strong></h3> 
            </div>
    </div>
</body>
</html>