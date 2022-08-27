<?php
// athorization - access control 
//check whether the user is login  or not

if(!$_SESSION['user'])//if session is not set
{
 // if user is not logged in 
 //redirect to login page with message
 $_SESSION['login-error-message'] = "<div class='session-error'>Please Login to Access Admin Panel</div>";
 //redirect
 header('location:' .  SITEURL . 'admin/login.php');
   
}
// else
// {
//     header('location:' . SITEURL . 'admin/index.php');
// }
?>