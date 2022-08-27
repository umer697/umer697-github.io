<?php
// include constant file to get access on $conn
include('../config/constant.php');
include('../admin/parcials/login-check.php');
// 1. get id of admin to be deleted
    $id = $_GET['id'];
// 2. create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE ID =$id";
// execute query
    $res = mysqli_query($conn, $sql);
    
    // check wheather the query is executed or not
    if($res == true)
    {
        //query executed successfully and admin deleted
        //echo "Admin Deleted";
        //Create sessoin varialbe to display message
        $_SESSION['delete']  = "<p class='mx-auto bg-danger text-white w-50 my-3'> 'Admin Deleted Successfully.'
</p>";
//redirect to manage-admin page
header("location:" . SITEURL . 'admin/manage-admin.php') ;

}
else
{
// echo "Failed to Delete";
$_SESSION['delete'] = '<p class="mx-auto bg-danger text-white w-50 my-3"> " Failed to Delete Admin." </p>';
//redirect to manage-admin page
header("location:" . SITEURL . 'admin/manage-admin.php') ;
}



?>