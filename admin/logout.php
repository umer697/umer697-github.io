<?php
include('../config/constant.php');
// destory session
session_destroy();//unsets $_SESSION['user']
//redirect
header('location: ' . SITEURL . 'admin/login.php');


?>