<?php
$con=mysqli_connect("localhost","root","");
mysqli_query($con,"CREATE DATABASE  if not exists yaari_infinity");    



$con=mysqli_connect("localhost","root","","yaari_infinity");
if(!$con){
    // echo"CON DONE<BR>";
    $err=mysqli_connect_error();
    header("Location:404.php?err=$err");
}

$users="CREATE TABLE if not exists users(
    id int unique key AUTO_INCREMENT,
    fname varchar(150) not null,
    lname varchar(100) not null,
    phoneno bigint(50) not null,
    profile varchar(255) default 'profiles/no_profile.jpeg',
    dob date not null,
    gender varchar(10) not null,
    username varchar(150) not null primary key,
    password varchar(100) not null,
    rollno varchar(50) not null unique,
    branch varchar(50) not null,
    year varchar(15) not null,
    email_otp varchar(10) not null,
    email_status text default 'pending'

)";

$posts = "CREATE TABLE if not exists posts(
    id int primary key AUTO_INCREMENT,
    post_dp varchar(255) not null,
    post_uid varchar(150) not null,
    posted_on varchar(100) not null,
    post_phpto varchar(300) ,
    posted_by varchar(150) not null,
    post_content text

)";

$reqtb="CREATE TABLE if not exists requests(
    id int primary key AUTO_INCREMENT,
    requid varchar(200) not null,
    reqname varchar(70) not null,
    reqfrom varchar(50) not null,
    reqto varchar(50) not null,
    reqdate date not null
)";

$frtb="CREATE TABLE if not exists friends(
    id int primary key AUTO_INCREMENT,
    sender varchar(50) not null,
    receiver varchar(50) not null,
    reqstat varchar(15) not null
)";


if(!mysqli_query($con,$users) || !mysqli_query($con,$posts) || !mysqli_query($con,$reqtb) || !mysqli_query($con,$frtb)){
    // echo"Table Creation not done";
    $err=mysqli_error($con);
    header("Location:404.php?err=$err");
}
else{
    $err= "ALL set";
    header("Location:404.php?err=$err");
}

// mysqli_query(mysqli_connect("localhost","root",""),"DROP DATABASE yaari_infinity");
session_start();
if(isset($_SESSION['userid'])){
    $id=$_SESSION['userid'];
    $name=$_SESSION['name'];
    $status=$_SESSION['emailstatus'];
    if($status=="verified"){

        header("Location:dashboard/");
    }
    else{
        header("Location:emailverification.php");
    }
}
else{
    header("Location:authentication/");
}


?>