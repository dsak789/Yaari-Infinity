<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../images/my_logo_balck.png" type="image/x-icon">

    <title>Signin</title>
</head>
<body>
<div id="regi_stat">
    <?php
    
    session_start();
    if(isset($_SESSION['userid'])){
        $id=$_SESSION['userid'];
        $name=$_SESSION['name'];
        $status=$_SESSION['emailstatus'];
        if($status=="verified"){
    
            header("Location:dashboard.php");
        }
        else{
            header("Location:emailverification.php");
        }
    }
    //  $_SESSION["register_status"]="Signup Succesful<br>Just Login Below";
    if(isset($_SESSION["register_status"])){
        echo "<div id='poststatus'>";
        echo $_SESSION["register_status"];
        unset($_SESSION["register_status"]);
    }
    echo"
    <script>
    setTimeout(()=>{document.getElementById('poststatus').style.display='none'},3000);
    </script>
    ";
    ?>
    </div>
    <div id="lform">
        <form action="signin.php" method="post"  id="lform">
            <fieldset>
                <legend>SIGNIN</legend>
                <input type="text" name="username" id="lusrnm" placeholder="Username" required>
                <input type="password" name="password" id="lpwd" placeholder="Password" required>
                <input type="submit" value="LOGIN" id="signinbtn">
                <br><hr><br>
                <h1>Create New Account
                    <a href="register.php">Signup</a>
                </h1>
            </fieldset>
        </form>
    </div>
<Script>
</Script>
</body>
</html>