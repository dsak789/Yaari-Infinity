<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/my_logo_balck.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/register.css">
    <title>Signup</title>
</head>
<body>
    <div id="regi_stat">
    <?php
    require("../dbcon.php");
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
    // $_SESSION["register_status"]="Register Unsuccessfull <br> Please try again";
    if(isset($_SESSION["register_status"])){
        echo "<div id='poststatus'>";
        echo $_SESSION["register_status"];
        unset($_SESSION["register_status"]);
            }
            echo"
            <script>
                setTimeout(()=>{document.getElementById('poststatus').style.display='none'},5000);
            </script>
            ";
            ?>
    </div>
    <div id="rformdiv">
        <form action="signup.php" method="post" id="rform" enctype="multipart/form-data"> 
        <fieldset>
            <legend>SIGNUP</legend>
            <input type="text" name="fname" id="fname" placeholder="Enter First Name" required>
            <input type="text" name="lname" id="lname" placeholder="Enter Last Name" required>
            <input type="numeric" name="Phno" id="phno" placeholder="Phone No" required>  
            <label >Profile Picture:<input type="file" name="image" id="img" accept=".jpg , .png, .jpeg"></label>
        <div>
            <label>DOB<input type="date" name="dob" id="dob" required></label>
            <label ><input type="radio" name="gender" id="male" value="Male"  required>Male</label>
            <label ><input type="radio" name="gender" id="female"  value="Female" required>Female</label>
            <label ><input type="radio" name="gender" id="others" value="Others"  required>Others</label>
        </div>
            <input type="email" name="username" id="usrnm" placeholder="Enter Username" required>
            <input type="text" name="otp" id="otp" value="0000000" hidden>
            <input type="password" name="password" id="rpwd" placeholder="Password" required onclick="sendotp()">
            <input type="password" name="cpassword" id="rcpwd" placeholder="Confirm Password" required>
            <h2 id="edu"> Education Details</h2>
            <input type="text" name="rno" id="rno" placeholder="Roll No" required>
            <input type="text" name="branch" id="branch" placeholder="Branch" required>
            <input type="text" name="yr-sem" id="yesm" placeholder="Year-Semester" required>
            <button type="submit" name="signup"id="signupbtn" value="SIGNUP" onclick="sendotp()" >SIGNUP</button>
            <br><hr><br>
            <h3 id="alreg">Already Registered..?<a href="login.php"> Login</a></h3>
        </fieldset>
        </form>
    </div>
    <div>
        <!--<img src="Images\SBProfile.jpg" alt="AJJU" id="ajju" >-->
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
<script>

    emailjs.init('3KTAPgyNBLDh1UUNo')
    function otpgenerator(){
    char=["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
    "0","1","2","3","4","5","6","7","8","9",
    "a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"]
    otp=""
    for(i=0;i<7;i++){
        // console.log(char[Math.floor(Math.random()*62)])
        otp=otp+char[Math.floor(Math.random()*62)]
    }
    // console.log(otp)
    
    return otp
}



let generated= otpgenerator();
let clicked="not send";
function sendotp(){
    
    if(clicked=="not send"){
        // send.style.display="none";
        let name=document.getElementById("fname").value;
    let mail=document.getElementById("usrnm").value;
    // document.getElementById("btn_send").style.display="none";
    // document.getElementById("btn_verify").style.display="block";
    // document.getElementById("otpinp").style.display="block";
    emailjs.send("service_58g8ffp","template_3ali3b1",{
        from_name: "OTP From DTU",
        otp:generated,
        subscriber:mail,
        otp_validater:"sbcreations14378@gmail.com"
    });
    let totp=document.getElementById("otp").value=generated;
    alert("otp Sent to "+mail+"verify your account in next page");
    }
    else{
        alert("Otp Already Sent to"+mail+"Please Verify Your Account to Use this Website");
    }
    clicked="send";
}
    function verifyotp(){
        inpotp=document.getElementById("otpinp").value;
        
        if(inpotp==generated){
            
            document.getElementById("verify").innerHTML="Verified";
            document.getElementById("name").style.display="none";
            document.getElementById("email").style.display="none";

        }
    }
</script>
</html>