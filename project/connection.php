<?php
$server="localhost";
$username="root";
$password="";
$db="mydb";

$connection=mysqli_connect($server,$username,$password,$db);

if(!$connection){
    die("connection failed: ".mysqli_connect_error());
}
?>