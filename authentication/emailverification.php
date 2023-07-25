<?php 
include("../dbcon.php");
// $con=mysqli_connect("localhost","root","","pms");

session_start();
$email=$_SESSION["userid"];
$nm=$_SESSION["name"];
$status=$_SESSION['emailstatus'];
$sel="SELECT * from users WHERE username='$email'";
$res=mysqli_query($con,$sel);
if($res && $data = mysqli_fetch_assoc($res)){
$dp=$data["profile"];
$estat=$data["email_status"];
$eotp=$data["email_otp"];
if($estat=="verified" && ($eotp==""||$eotp==null)){
     echo "email verified";
     header("Location:../dashboard/");
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="bgimages/my_logo_balck.png" type="image/x-icon">
    <link rel="stylesheet" href="emailverification.css">
    <title>Email Verification</title>
</head>
<body>
    <div class="main">
        <div class="logoname">
            YAARI INFINITY
        </div>
        <div id="user">
            <div id="details">
                <img src="<?php echo $dp ?>" alt="dask" id="dp">
                <div id="details2">
                    <h3>Name: <?php echo $nm ?></h3>    <br>
                    <h3>Email: <?php echo $email ?></h3>
                    <br>
                    <span id="button">
                        incorrect Mail..? <br>   <button onclick="show()" >Edit Mail</button>
                    </span> 
                    <script>
                        function show(){
                            document.getElementById("editmail").style.display='block';
                            document.getElementById("button").style.display='none';

                        }
                    </script>
                    <form action="#" method="post" id="editmail">
                        <input type="email" name="chmail" placeholder="Enter Valid Email" value="<?php echo $email ?>">
                        <input type="text" name="sotp" id="sotp" value="0000000" hidden>
                        <button type="submit" onclick="sendotp()" name="change_mail" value="Update Mail & Send OTP" >Update Mail & Send OTP</button>
            <!-- <button type="submit" name="signup"id="signupbtn" value="SIGNUP" onclick="sendotp()" >SIGNUP</button> -->

                    </form>
                </div>
            </div>
            <div id="email-verifiaction"><hr><br>
                <h1>Email Verification Status: <span><?php echo $estat  ?></span></h1>
                <div id="otpvalidate">
                    <form action="#" method="post" >
                        <input type="text" name="otp" id="otpinp" placeholder="Enter OTP">
                        <input type="submit" name="verify" value="VERIFY">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>
    
    emailjs.init('3KTAPgyNBLDh1UUNo');

    function otpgenerator(){
        char=["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
        "0","1","2","3","4","5","6","7","8","9",
        "a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"]
        otp=""
        for(i=0;i<7;i++){
            // console.log(char[Math.floor(Math.random()*62)])
            otp=otp+char[Math.floor(Math.random()*62)]
        }
         console.log(otp)
        
        return otp
    }
    
    
    
    let generated= otpgenerator();
    
    function sendotp(){
        
        
        // send.style.display="none";
        // let name=;
        let mail=document.getElementById("chmail").value;
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
        alert("OTP Sent to "+mail+" verify your account in the Same page");
        
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
<?php 
if(isset($_POST["change_mail"])){
    $inpmail=$_POST["chmail"];
    $otp=$_POST["sotp"];
            $up="UPDATE users SET email_otp='$otp',username='$inpmail' WHERE username='$email'";
            if(mysqli_query($con,$up)){
                echo "email change success ";
                $_SESSION['userid']="$inpmail";
            }
            else{
                echo mysqli_error($con);
            }
    
        }




if(isset($_POST["verify"])){
$inpotp=$_POST["otp"];
    if($inpotp==$eotp){
        $up="UPDATE users SET email_otp='', email_status='verified' WHERE username='$email'";
        if(mysqli_query($con,$up)){
            echo "verification success";
            $_SESSION['emailstatus']="";
            header("Location:../dashboard/");
        }
        else{
            echo mysqli_error($con);
        }

    }
    else{
        echo "inavlid otp";
    }

}




?>
<a href="signout.php">
    <button style="color :black ; font-family:'Times New Roman', Times, serif; font-size:large;">logout</button> </a>


</body>
</html>