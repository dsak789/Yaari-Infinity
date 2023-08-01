<?php
session_start();
$id= $_SESSION["userid"];
$nm= $_SESSION["name"];
include("../dbcon.php");
require("../nav/header.php");
$sel="SELECT * FROM users where username='$id'";
if($users=mysqli_query($con,$sel)){
    if( $users=mysqli_fetch_assoc($users)){
        $nm=$users['fname'].' '.$users['lname'];
        $dp=$users['profile'];
        $_SESSION['from']=$users['rollno'];
        $curo=$users['rollno'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../images/my_logo_balck.png" type="image/x-icon">
        <link rel="stylesheet" href="../css/makefriend.css">
        <title><?php echo $nm?>! | Lets Makes Friends </title>
    </head>
    <body>
        <script>
            function nav(btn){
                alf=document.getElementById("allfriends");
                afb=document.getElementById("af");
                mf=document.getElementById("myfriends");
                mfb=document.getElementById("mf");
                r=document.getElementById("requests");
                rb=document.getElementById("r");
                if(btn=="af"){
                    // alert(btn);
                    alf.style.display="block";
                    afb.style.background="cyan";
                    mf.style.display="none";
                    mfb.style.background="";
                    r.style.display="none";
                    rb.style.background="";
                }
                else if(btn=="mf"){
                    // alert(btn);
                    alf.style.display="none";
                    afb.style.background="";
                    mf.style.display="block";
                    mfb.style.background="cyan";
                    r.style.display="none";
                    rb.style.background="";
                    
                }
                else if(btn=="r"){
                    // alert(btn);
                    alf.style.display="none";
                    afb.style.background="";
                    mf.style.display="none";
                    mfb.style.background="";
                    r.style.display="block";
                    rb.style.background="cyan";
                    
                }
            }
        </script>
        <div class="main">
            <nav>
                <h1 id="af" onclick="nav('af')">All Users</h1>
                <h1 id="mf" onclick="nav('mf')">My Friends</h1>
                <h1 id="r" onclick="nav('r')">Requests</h1>
            </nav>
            <div id="allfriends"><h1>ALL USERS</h1> 
                <?php
                    $getfrnds="SELECT * FROM users";
                    if($res=mysqli_query($con,$getfrnds)){
                        while($allfriends= mysqli_fetch_assoc($res)){
                            $dp=$allfriends['profile'];
                            $nm=$allfriends['fname'].' '.$allfriends['lname'];
                            $uno=$allfriends['rollno'];
                            $frid=$allfriends['username'];
                            
                            
                            
                            
                            if($id!=$allfriends['username']){
                                $chfrs1="SELECT * FROM friends WHERE sender='$curo' and receiver='$uno'";
                                $chfrs2="SELECT * FROM friends WHERE sender='$uno' and receiver='$curo'";
                                $chfres1=mysqli_query($con,$chfrs1);
                                $chfres2=mysqli_query($con,$chfrs2);
                                $chreq1="SELECT * FROM requests WHERE reqfrom='$curo' and reqto='$uno'";
                                $chrres1=mysqli_query($con,$chreq1);
                                $chreq2="SELECT * FROM requests WHERE reqfrom='$curo' and reqto='$uno'";
                                $chrres2=mysqli_query($con,$chreq2);
                                if($frs=mysqli_fetch_assoc($chfres1)){
                                    
                                    
                                    echo"
                                    <div id='addfriend'>
                                    <img src='$dp' id='dp' alt=' $nm' height='100' width='100' >
                                    <div id='details'>
                                    <h3 id='name'>
                                    $nm 
                                    </h3>
                                    <h5>$frid</h5>                                
                                    <button id='btn_add' onclick='window.location.assign(`check.php?$curo&&cuid=id=$uno`)'>Already Friends</button>
                                    </div>
                                    </div>";
                                }
                                else if($frs=mysqli_fetch_assoc($chfres2)){
                                    
                                    
                                    echo"
                                    <div id='addfriend'>
                                    <img src='$dp' id='dp' alt=' $nm' height='100' width='100' >
                                    <div id='details'>
                                    <h3 id='name'>
                                    $nm 
                                    </h3>
                                    <h5>$frid</h5>
                                    <button id='btn_add' onclick='window.location.assign(`check.php?$curo&&cuid=id=$uno`)'>Already Friends</button>
                                    </div>
                                    </div>";
                                }
                                else if($frs=mysqli_fetch_assoc($chrres1)){

                                    echo"
                                    <div id='addfriend'>
                                    <img src='$dp' id='dp' alt=' $nm' height='100' width='100' >
                                    <div id='details'>
                                    <h3 id='name'>
                                                $nm
                                            </h3>
                                            <h5>$frid</h5>
                                            <button id='btn_add' onclick='window.location.assign(`check.php?cuid=$curo&&id=$uno`)'>Request Sent</button>
                                        </div>
                                    </div>";
                                }
                                else if($frs=mysqli_fetch_assoc($chrres2)){

                                    echo"
                                    <div id='addfriend'>
                                    <img src='$dp' id='dp' alt=' $nm' height='100' width='100' >
                                    <div id='details'>
                                    <h3 id='name'>
                                                $nm
                                            </h3>
                                            <h5>$frid</h5>
                                            <button id='btn_add' onclick='window.location.assign(`check.php?cuid=$curo&&id=$uno`)'>Request Sent</button>
                                        </div>
                                    </div>";
                                }
                                else{

                                    echo"
                                    <div id='addfriend'>
                                    <img src='$dp' id='dp' alt=' $nm' height='100' width='100' >
                                    <div id='details'>
                                    <h4 id='name'>
                                                $nm
                                            </h4>
                                            <h5>$frid</h5>
                                            <button id='btn_add' onclick='window.location.assign(`addfriend.php?frid=$id&&cuid=$curo&&id=$uno`)'>ADD Friend</button>
                                        </div>
                                    </div>";
                                }

                                
                                }
                                

                        }
                        $uno="";
                        $curo="";
                    }
                
                ?>
            </div>
            <div id="myfriends">
                <h1>My Friends</h1>
                <?php
                    $reqto=$_SESSION['roll'];
                    echo $curo;
                    $getrequests1="SELECT * FROM friends WHERE receiver='$curo'or sender='$reqto'";
                    $getrequests2="SELECT * FROM friends WHERE receiver='$reqto'or sender='$curo'";
                    
                    if($reqres=mysqli_query($con,$getrequests1)){
                        while($requests= mysqli_fetch_assoc($reqres)){
                            // $reqname=$requests['reqname'];
                            $reqfrom=($requests['sender']);
                            $reqto=($requests['receiver']);
                            {
                                echo"
                                <div id='addfriend'>
                                <div id='details'>
                                <img src='../profiles/no_profile.jpeg' id='dp' alt=' $' height='100' width='100' >
                                <h3 id='name'>
                                            You and $reqto | You both Became Friends!
                                        </h3>
                                        <button id='btn_add' onclick='window.location.assign(`request.php?reqfrom=&&reqto=&&req=`)'>View Profile</button>
                                    </div>
                                </div>";
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
                                <div id='addfriend'>
                                <div id='details'>
                                <img src='../profiles/no_profile.jpeg' id='dp' alt=' $' height='100' width='100' >
                                <h3 id='name'>
                                            You and $reqfrom | You both Became Friends!
                                        </h3>
                                        <button id='btn_add' onclick='window.location.assign(`request.php?reqfrom=&&reqto=&&req=`)'>View Profile</button>
                                    </div>
                                </div>";
                            }
                        }
                    }
                    
                    else{
                       echo mysqli_error($con);
                    }
                
                ?>

            </div>
            <div id="requests">
                <h1> Requests</h1>
                <?php
                    $reqto=$_SESSION['roll'];
                    $getrequests="SELECT * FROM requests WHERE reqto='$reqto'";
                    if($reqres=mysqli_query($con,$getrequests)){
                        while($requests= mysqli_fetch_assoc($reqres)){
                            $reqname=$requests['reqname'];
                            $reqfrom=($requests['reqfrom']);
                            $reqto=($requests['reqto']);
                            $reqfrid=($requests['requid']);
                            
                            
                            {
                                echo"
                                <div id='addfriend'>
                                <div id='details'>
                                <img src='../profiles/no_profile.jpeg' id='dp' alt=' $reqname' height='100' width='100' >
                                <h4 id='name'>
                                            $reqname sent you frnd Request!
                                        </h4>
                                        <h5>$reqfrid</h5>
                                        <button id='btn_add' onclick='window.location.assign(`request.php?reqfrom=$reqfrom&&reqto=$reqto&&req=a`)'>Confirm</button>
                                        <button id='btn_add' onclick='window.location.assign(`request.php?reqfrom=$reqfrom&&reqto=$reqto&&req=r`)'>Reject</button>
                                    </div>
                                </div>";
                            }
                        }
                    }
                
                ?>
            </div>
    </div>
</body>
</html>