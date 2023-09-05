<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/slamcp.css">
    <link rel="shortcut icon" href="../images/my_logo_balck.jpg" type="image/x-icon">
    <title>SLAMBOOK coverpage</title>
</head>
<body>
    <div class="main">
        
        <?php 
        session_start();
        $nm=$_SESSION['name'];
        $img="../profiles/no_profile.jpeg";
        include("../nav/header.php");
        ?>

        <div class="coverpage">
            <?php
            $b="right";
            for($i=2;$i<=7;$i++){
                $j=$i*2;
                if ($b=="right"){
                    $b="left";
                }
                else{
                    $b="right";
                    
                }
                echo "<marquee behavior='scroll' direction='$b' scrollamount='$j'>Yaari's SLAM</marquee>";
            }
            ?>
            <div class="page">
                <h2 id="belong">Make a Slam Dedication</h2>
                <div class="people">
                    <div class="me">
                        <div id="profile">
                            <img src="../profiles/no_profile.jpeg" alt="profile" height="150" width="150">
                        </div>
                        <div id="details">
                            Dannana Sai Ajith Kumar

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>

