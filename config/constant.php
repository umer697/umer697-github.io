<?php
session_start();



define('SITEURL','http://localhost/food/');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food');
define('LOCALHOST','localhost');
//database connection
$conn   = mysqli_connect(LOCALHOST,DB_USERNAME, DB_PASSWORD)  or die(mysqli_connect_error());
//select database
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_connect_error());

?>