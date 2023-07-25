<!-- ACCEPT Request -->
<?php
require('../dbcon.php');

$frtb="CREATE TABLE if not exists friends(
    id int primary key AUTO_INCREMENT,
    sender varchar(50) not null,
    receiver varchar(50) not null,
    reqstat varchar(15) not null
)";

if(mysqli_query($con,$frtb)){
    echo "tb fr s";
}
else{
    echo mysqli_error($con);
}
$dt=date('Y-m-d');
echo $dt.'<br>';
$sender=$_REQUEST['reqfrom'];
$receiver=$_REQUEST['reqto'];
$stat=$_REQUEST['req'];

$sel="SELECT * FROM friends where sender='$sender' and receiver='$receiver'";
if($res=mysqli_query($con,$sel)){
    if(mysqli_num_rows($res)>0){
        echo "You Both are alredy Friends";
        header("Location:index.php");
    }
    else{

        $ins="INSERT INTO friends VALUES('','$sender','$receiver','$stat')";
        if(mysqli_query($con,$ins)){
            echo "You Became Friends";
            $del="DELETE FROM requests where  reqto='$receiver' and reqfrom='$sender'";
            if(mysqli_query($con,$del)){
                echo "<br>Deleted from Requests";
                header("Location:index.php");
            }
    
    
            else{
                echo mysqli_error($con);
                
            }
        }


        else{
            echo mysqli_error($con);
            
        }
        
       
        
    }
}
else{
    echo mysqli_error($con);
}
?>