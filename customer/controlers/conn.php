<?php
$localhost = 'localhost';
$user = 'phpmyadmin';
$password = 'coderslab';
$db = 'customer';

$conn = mysqli_connect($localhost,$user,$password,$db);

if(!$conn){
    die("Connection faild: ".mysqli_connect_error());
}