<?php include('parcials/menu.php'); ?>

<div class="container">
    <div class="row">
        <h1>Update Category</h1>
        <div class="">
            <a href="manage-category.php" class=" btn btn-success">Back </a>
            <a href="add-category.php" class=" btn btn-primary">Add Category</a>
        </div>
        <br>
        <br>

        <hr>
        <br>
        <br>
        <?php   

          if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $sql = "SELECT * FROM  tbl_category WHERE id =$id ";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count == 1)
                {
                    $rows = mysqli_fetch_assoc($res);
                    // $id = $rows['id'];
                    $title = $rows['title'];
                    $current_image = $rows['image_name'];
                    $featured= $rows['featured'];
                    $active= $rows['active'];
                }
                else
                {
                    //message show when a user try to add wrong category by inputting url manually
                    $_SESSION['not-cat-found'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>No Such Category ID Was Found</div>";
                    header('location:' .SITEURL . 'admin/manage-category.php');
                }
            }
            else
            {
                $_SESSION['User Pre-defined']  = '<div class="mx-auto bg-success text-white w-50 my-3" >Removing Query Strings May Break Your Workflow.</div>';
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        
        ?>
        <!-- update form starts -->
        <form id="myForm" action="" method="POST" enctype="multipart/form-data" class="form">
            <label class="form-label" for="">Title</label>
            <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">

            <label class="form-label" for="">Current Image</label>

            <?php 
            if($current_image != "")
            {
                ?>

            <img class="form-control" src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ;?>"
                class="img-cat" style="width:100px;" alt="">

            <?php
            }
            else
            {
                echo "<div class='mx-auto bg-danger text-white w-50 my-3'>Image has not been Added </div>";
            }
            ?>


            <label class="form-label" for="">New Image</label>
            <input type="file" class="form-control" name="image">


            <label class="form-check-label" for="">Featured</label>
            <div class="form-check">
                <input <?php if($featured == "yes"){ echo "checked";} ?> class="form-check-input" type="radio"
                    name="featured" value="yes"> Yes
            </div>
            <div class="form-check">
                <input <?php if($featured == "no"){ echo "checked";} ?>class="form-check-input" type="radio"
                    name="featured" value="no"> No
            </div>
            <label class="form-check-label" for="">Active</label>
            <div class="form-check">
                <input <?php if($active == "yes"){ echo "checked";} ?> class="form-check-input" type="radio"
                    name="active" value="yes"> Yes
            </div>
            <div class="form-check">
                <input <?php if($active == "no"){ echo "checked";} ?>class="form-check-input" type="radio" name="active"
                    value="no"> No
            </div>

            <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
            <input type="hidden" name=" id" value="<?php echo $id;?>">
            <input type="submit" name="submit" class="btn btn-primary mt-3 mb-3" value="Update Category" />
        </form>
        <!-- update form starts -->
    </div>
</div>

<?php
if(isset($_POST['submit']))
{
        // echo "clicked"   ;
        // 1- get all data from our form
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //2-updating new image
        //check whether imag is selected or not
        if(isset($_FILES['image']['name']))
        {
            //get the image details
            $image_name = $_FILES['image']['name'];
            //check whether the image is availavle or not
            if($image_name != "")
            {
                //image available
                //A. upload the new image

                 //auto rename our image
        //get extenstion of our image
        $ext = end(explode('.' , $image_name));
        //rename the image
        $image_name = "Food_Category_".rand(000, 999). '.' . $ext;

        $source_path = $_FILES['image']['tmp_name'];//source path info

        $destination_path ="../images/category/" . $image_name;

        //finally upload the image
        $upload = move_uploaded_file($source_path, $destination_path);
        
        //check whether the image is uploaded or not
        //and if the image is not uploaded then we stop the process and redirect with error messagae
        if($upload == false)
        {
            //set message
            $_SESSION['img-upload-error'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>New Image is not uploaded </div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
            //stop the process
            die();
        } 
        
                
                // B.remove the current image if available 
                if($current_image != "")
                {
                    $remove_path = "../images/category/" . $current_image;
                    $remove = unlink($remove_path);
                    //check whether the image is removed or not
                    //if failed to remove then display message and stop the process
                    if($remove == false)
                    {
                        //failed to remove the image
                        $_SESSION['failed-remove'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>Failed to Remove the Current Image</div>";
                        header('location: ' .SITEURL  . 'admin/manage-category.php');
                        //stop the process
                        die();
                    }
                

                }
                
            }
            else
            {
                $image_name = $current_image;
            }
        }
        else
        {
            $image_name = $current_image;
        }

        //3-update the database
        $sql2 = "UPDATE tbl_category set 
        title='$title', 
        image_name='$image_name', 
        featured='$featured', 
        active='$active' 
        where id=$id
        ";
        //execute query
        $res2 = mysqli_query($conn, $sql2);
        //4-redirect to manage-category with message
        //check whether the query is excuted or not
        if($res == true)
        {
            $_SESSION['update'] = "<div class='mx-auto bg-success text-white w-50 my-3'>Category Updated Successfully.</div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
        }
        else
        $_SESSION['update'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>Failed to Update Category.</div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
        
        
        
        
        
}


?>




<?php include('parcials/footer.php'); ?>