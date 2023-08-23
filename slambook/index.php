<?php
    require('../dbcon.php');
    session_start();
    if(isset($_SESSION['userid'])){
       
        $id=$_SESSION['userid'];
        $nm=$_SESSION['name'];
        $select="SELECT * FROM users WHERE username= '$id'";
        $result=mysqli_query($con,$select);
        
        if(($result)){
            $row=mysqli_fetch_assoc($result);
                $fn= $row['fname'].' '. $row['lname'];
                $img=$row['profile'];
        }
        else{
            echo "<br>Data Not Fecthed";
        }
    }
    else{
        echo "Sessions Expired";
        echo "<a href='../authentication/'><button>Signin</button></a>";
        sleep(2);
        header("Location:../index.html");

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/slambook.css">
    <link rel="shortcut icon" href="../images/my_logo_balck.png" type="image/x-icon">
    <title>SLAMBOOK</title>
</head>
<body>
    <div class="main">
    <?php include("../nav/header.php") ?>
        <div id="logo">Dedicate a Slam to your LoVeD oNe</div>
        <div id="coverpage">
            
            <div id="from">
                <img src="<?php echo $img ?>" alt="<?php echo $fn ?>">
                <h6><?php echo $fn ?></h6>
            </div>
            <div id="to">
                <form action="" method="post">
                    
                    <?php 
                    $reqto=$_SESSION['roll'];
                     $curo="";
                    $getrequests1="SELECT * FROM friends WHERE receiver='$curo'or sender='$reqto'";
                    $getrequests2="SELECT * FROM friends WHERE receiver='$reqto'or sender='$curo'";
                    
                    if($reqres=mysqli_query($con,$getrequests1)){
                        echo"
                        <select name='towhom' id='towhom' >
                        <option  value='none' onclick='alert()' >Select to Whom </option>";
                        while($requests= mysqli_fetch_assoc($reqres)){
                            // $reqname=$requests['reqname'];
                            $reqfrom=($requests['sender']);
                            $reqto=($requests['receiver']);
                            {
                                
                                echo"
                                <option  value='$reqto'>$reqto</option>";
                            }
                        }
                        
                    }
                    if($reqres=mysqli_query($con,$getrequests2)){
                        
                        while($requests= mysqli_fetch_assoc($reqres)){
                            // $reqname=$requests['reqname'];
                            $reqfrom=($requests['sender']);
                            $reqto=($requests['receiver']);
                            {
                                
                                echo"
                                <option  value='$reqfrom'>$reqfrom</option>";
                            }
                        }
                        echo"</select>";
                    }
                
                
                $usrnm="Select Sm One to Dedicate";
                $uid="EHO";
                $udp="../profiles/no_profile.jpeg";
                ?>
                <script>
                    function choose(){
                        alert();
                        // Form.submit();
                    }
                </script>
                <input  type='submit' name='sel' value="Choose">
            </form>
            <?php 
                if(isset($_POST["sel"])){
                    $uid=$_POST["towhom"];
                    $sel="SELECT * FROM users WHERE rollno='$uid'";
                    $res=mysqli_query($con,$sel);
                    if($res){
                        if($users=mysqli_fetch_assoc($res)){
                        $usrnm=$users["fname"].$users["lname"];
                        $udp=$users["profile"];
                        }
                    }   
                    else{
                        
                        $usrnm="Select Sm One to Dedicate";
                        $uid="";
                        $udp="../profiles/no_profile.jpeg";
                    }
                }
                else{
                    // echo"re";
                }
                ?>
                <img src="<?php echo $udp ?>" alt="<?php echo $usrnm ?>">
                <h6> <?php echo  $usrnm;  
                ?></h6>
            </div>
        </div>
        <div id="page2">
            <a href="../slambook/page1.php"  rel="noopener noreferrer">GOG GG</a>
        </div>
    </div>
</body>
</html>