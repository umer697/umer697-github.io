<?php
include('../config/constant.php');

//echo "delete page";
//check whether the image_name and value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //
    // echo 'get value and delete';
    $id = $_GET['id'];
    $image = $_GET['image_name'];
    
    if($image !=  "")
    {
        $path = "../images/category/" . $image;
        $remove = unlink($path);
          
        if($remove == false)
        {
            $_SESSION['remove'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>Failed to Remove the Image File</div>";
            header('location:' .SITEURL . 'admin/manage-category.php');
            die();
        }
    }
    $sql = "DELETE FROM tbl_category WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    if($res == true)
    {
        $_SESSION['delete'] = "<div class='mx-auto bg-success text-white w-50 my-3'>Category Deleted Successfully.</div>";
        header('location:' .SITEURL . 'admin/manage-category.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>Failed to Delete the Category.</div>";
        header('location:' .SITEURL . 'admin/manage-category.php');
    }
   
}
else
{
    $_SESSION['id-image'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>Whether the Id or image is not Correcct.</div>";
    header('location: ' .SITEURL . 'admin/manage-category.php');
}

?>