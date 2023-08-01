<?php 
session_start();
if(isset($_SESSION["userid"])){
    $nm=$_SESSION["name"];
    $id=$_SESSION["userid"];
}
else{
    // echo "N";
    header("Location:index.php");
}
require("../dbcon.php");
// $con=mysqli_connect("localhost","root","","pms");
$ins="SELECT * FROM users WHERE username='$id'";
$query=mysqli_query($con,$ins);
if($query){
    $data=mysqli_fetch_assoc($query);
    $img=$data['profile'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="shortcut icon" href="../images/my_logo_balck.png" type="image/x-icon">
    <title>Dashboard | <?php echo $nm ." ". $id ?> </title>
</head>
<body>
    <div id="main">
        <?php include("../nav/header.php") ?>
        <div class="dopost">
            <form action="post.php" method="post" enctype="multipart/form-data" id="postform">
                <div>
                    <img src="<?php  echo $img ?>" alt="<?php echo $nm?>" id="dp" height="70" width="70">
                    <textarea name="writecontent" id="writecontent" cols="30" rows="4" placeholder="Write any thing or Add photo to Post" required></textarea>
                    <label id="photo">
                        <img src="../images/icons8-camera-50.png" alt="ADD-PHOTO" id="photobtn">
                        <input type="file" name="postphoto" id="file"  accept=".jpeg , .jpg , .png">
                    </label>
                    <label id="postbtn" >
                        <img src="../images/icons8-paper-plane-30.png" alt="POST" id="postbtn">
                        <input type="submit" value="POST" id="post">
                    </label>
            <h5>Note:   Present there no feature to edit the Post But Feel free to MENTION the NAMES  to whom u Dedicating </h6>

                </div>
            </form>
        </div>

        <?php
            if(isset($_SESSION["post_status"])){
               echo "<div id='poststatus'>";
               echo $_SESSION["post_status"];
                unset($_SESSION["post_status"]);
                // $_SESSION["post_status"]="";
            }
            echo"</div>
            <script>
                setTimeout(()=>{document.getElementById('poststatus').style.display='none'},7000);
            </script>
            ";
            ?>
        

        <?php 
// $getpost="SELECT * FROM posts WHERE postuid='$id'";
$getpost="SELECT * FROM posts ORDER BY id desc";
$res=mysqli_query($con,$getpost);
if($res){
    
    while($allpost=mysqli_fetch_assoc($res)){
        $puid=$allpost['post_uid'];
        $puid=explode("@",$puid);
        $puid=$puid[0];
        $pon=$allpost['posted_on'];
        $pdp=$allpost['post_dp'];
        $ppic=$allpost['post_photo'];
        $pby=$allpost['posted_by'];
        $pcon=$allpost['post_content'];

        echo "<div class='showposts'>
        <div id='allposts'>
            <div id='postusr'>
                <img src='$pdp' alt='$pby' id='postdp' height='100' width='100' title='$pby'>
                <img src='../images/icons8-chevron-right-32.png' alt='->'>
                
                <h2> $puid <h2>  
                <img src='../images/icons8-chevron-right-32.png' alt='->'>
                <h3> Posted On~$pon</h3>
                </div>
                
                <div id='postcontent'>
            
            "?>
            <?php
            if($ppic!=""|$ppic!=null){
               echo" 
            <img src='$ppic' alt='NO Photo Posted by $pby' id='post-photo' height='500' width='700'>";

            }
                echo"<h4><span><u>$pby</u> --</span>$pcon</h4>
                </div>
                </div>
    </div>";

    }   
}

?>


        <div class="showposts">
    <div id="allposts">
        <div id="postusr">
            <img src="../images/my_logo_balck.png" alt="YAARI INFINITY" id="postdp" height="100" width="100">
            <img src='../images/icons8-chevron-right-32.png' alt='->'>
            <h3>YAARI INFINITY <h3>
            <img src='../images/icons8-chevron-right-32.png' alt='->'><h3>Posted on~12-21-23 10:12</h3>
        </div>
        <div id="postcontent">
            <!-- <img src="" alt="postcontent" id="post-photo" height="500" width="700"> -->
            <h4><span><u>YAARI INFINITY</u> --</span>Thank you For using YAARI INFINITY</h5>
        </div>
    </div>

</div>






       
        <div id="disclaimer">
            <h3>Designed By <strong>SB<sub>7</sub> Develpoers</strong>   (C)  <strong>SAK<sub>789</sub> Company</strong></h3> 
            
        </div>
    </div>
</body>
</html>