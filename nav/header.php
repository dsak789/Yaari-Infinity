<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <link rel="shortcut icon" href="bgimages/my_logo_balck.png" type="image/x-icon">
    <title>Header</title>
</head>
<body>
    <div id="nav">
        <div class="divlogo">
            
            <img src="bgimages/my_logo_balck.png" alt="SAK789" id="logo" height="100" width="100"><h3> Personal Slam Book</h3>
            
        </div>
        <div id="link">
            <a href="SlamBook/">Write Slam</a>
            <a href="profile.php">Profile</a>
            <a href="friends/">Make friends</a>
            <a href="about.html">About</a>
            <a href="contact.html">Contact</a>
            <a href="signout.php">Logout</a>
        </div>
        <div id="loggedas" title="<?php echo $nm ?>">
            Login as: <br>
            <?php echo $nm ?>
            <img src="<?php echo $img?>" alt="<?php echo $nm?>"  height="50" width="50">
        </div>
        
    </div>
</body>
</html> -->

<?php
// require("routes.php")
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../images/my_logo_balck.png" type="image/x-icon">
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <link rel="stylesheet" href="../css/header.css">
        <!-- <title>Menu</title> -->
    </head>
    <body>
        <div class="header">
            <div id="nav">
                <!-- <a href="#"> -->
                <div id="logo">
                    <img src="../images/my_logo_balck.png" alt="SAK789" id="logoimg" height="100" width="100"> 
                    <div id="logoname">
                        <h3>Yaari Infinity</h3>
                        <h4></h4>
                        <h4>Undconditional Love and Yaari</h4>
                        <!-- <h5></h5> -->
                    </div>   
                </div>
                <!-- </a> -->
                <script>
                    menu=()=>{
                        document.getElementById("fullmenu").style.display='block';
                    }
                </script>
                <div id="menu">
                    <ul>
                        <li><a href="../dashboard/"><ion-icon name="home"></ion-icon></a></li>
                        <li><a href="../friends/"><ion-icon name="people"></ion-icon></a></li>
                        <li><a href="../profile/" ><ion-icon name="person-circle"></ion-icon></a></li>
                        <li><a href="../slambook/" ><ion-icon name="book"></ion-icon></a></li>
                        <!-- <li><ion-icon name="grid" onclick="menu()"></ion-icon></li> -->
                        <li id="more"><a onclick="menu()"><ion-icon name="grid"></ion-icon></a>
                    </li>
                </ul>
            </div>
            <div id="fullmenu">
                <ul>
                    <li><a href="../nav/about.html">About</a></li>
                    <li><a href="../nav/contact.html">Contact</a></li>
                    <li><a href="../authentication/signout.php">LOGOUT</a></li>
                </ul>
            </div>

                <div id="loggedas" title="<?php echo $nm="Dannana Sai Ajith Kumar"?>">
                    <div id="name-about">
                        <h4><?php echo $nm ?></h4>
                        <p>Im Developer</p>
                    </div>
                    <img src="<?php  echo $img ?>" alt="<?php echo $nm ?>" height="50" width="50">
                </div>
            </div>
        </div>
</body>
</html>