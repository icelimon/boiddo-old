<?php 

     // $username = "boiddoco_comred"; 
     // $password = "com&red!2C"; 
     // $host = "localhost"; 
     // $dbname = "boiddoco_boiddo"; 

$username = "root"; 
$password = ""; 
$host = "localhost"; 
$dbname = "boiddo"; 

$db_conx = mysqli_connect($host,$username,$password); 
$db = mysqli_select_db($db_conx,$dbname);

session_start();
?>