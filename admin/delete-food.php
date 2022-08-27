<?php 
include('../config/constant.php'); 

if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //1- get id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //remove the iamge if available
    if($image_name !=  "")
    {
        $path = "../images/food/" . $image_name;

        $remove = unlink($path);
        if($remove == false)
        {
            $_SESSION['remove-img'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>Failed to Remove Image</div>";
            header('location: ' . SITEURL . 'admin/manage-food.php');
            die();
        }
    }

    //delete from database
    $sql = "Delete from tbl_food where id=$id ";
    $res = mysqli_query($conn, $sql);
    if($res == true)
    {
        //redirect to manage-food page
        $_SESSION['delete'] = "<div class='mx-auto bg-success text-white w-50 my-3'>Food Deleted Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }    
    else
    {
        $_SESSION['delete'] = "<div class='mx-auto bg-success text-white w-50 my-3'>Failed to Add Food.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
}
else
{
    $_SESSION['unauthorised'] = "<div class='mx-auto bg-success text-white w-50 my-3'>Unauthorised Access.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
}














?>