<?php

$servername = "localhost";
$dbname = "kubbshve_christdmm";
$username = "kubbshve_christdmm";
$password = "W7AUsQ7QNt2RRMED3LUp";


$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn) {

die(" PROBLEM WITH CONNECTION : " . mysqli_connect_error());

}
?>