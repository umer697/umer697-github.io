<?php 

ob_start();

include('parcials/menu.php');?>

<div class="container">
    <div class="row">
        <h1>Update Food</h1>
        <hr>
        <div class=" ">
            <a href="manage-food.php" class="btn btn-success">Back</a>
        </div>
        <br>
        <br>



        <?php
            if(isset($_GET['id']))
            {
                $id =  $_GET['id'];
                $sql2 = "SELECT * FROM tbl_food where id=$id";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);
                if($count2 == 1)
                {
                    $row2              =mysqli_fetch_assoc($res2);
                    $title             =$row2['title'];
                    $description       =$row2['description'];
                    $price =            $row2['price'];
                    $current_image =    $row2['image_name'];
                    $current_category = $row2['category_id'];
                    $featured =         $row2['featured'];
                    $active =           $row2['active'];
                }
            }
            else
            {
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        ?>
        <!-- add admin form -->
        <form id="myForm" action="" method="POST" enctype="multipart/form-data" class="form">
            <label class="form-label" for="">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo $title;?>">
            <label class="form-label" for=""> Description</label>
            <textarea name="description" id="" class="form-control" cols="23" rows="5"
                value=""><?php echo $description;?></textarea>
            <label class="form-label" for=""> Price</label>
            <input type="number" name="price" class="form-control" value="<?php echo $price; ?>">
            <label class="form-label" for=""> Current Image</label>
            <?php
                        if($current_image == "")
                        {
                            echo "<div class='mx-auto bg-danger text-white w-50 my-3'>Image is not Available</div>";
                        }
                        else
                        {
                            
                            ?>

            <img class="form-control" style="width:100px ;"
                src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="100px" alt="">

            <?php
                        }
                        
                        ?>



            <label class="form-label" for=""> Select New Image</label>
            <td><input type="file" class="form-control" name="image"></td>

            <label class="form-label" for="">Category</label>
            <select class="form-control" name="category" id="">

                <?php
                            
                            $sql = "SELECT * FROM tbl_category where active ='yes' ";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if($count > 0)
                            {
                                while($row = mysqli_fetch_assoc($res))
                                {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                            ?>
                <option <?php if($current_category == $category_id){echo "selected";}?>
                    value="<?php echo $category_id;?>">
                    <?php echo $category_title;?>
                </option>

                <?php
                            // echo "<option value=' $id'>$category_title</option>";
                            }

                            }
                            else
                            {
                            echo "<option value='0'>Category Not Available</option>";
                            }
                            ?>
            </select>

            <label class="form-check-label" for="">Featured</label>
            <div class="form-check">
                <input <?php if($featured == "yes"){echo "checked";}?> class="form-check-input" type="radio"
                    name="featured" value="yes">Yes
            </div>
            <div class="form-check">
                <input <?php if($featured == "no") {echo "checked";}?> class="form-check-input" type="radio"
                    name="featured" value="no">No
            </div>
            <label class="form-check-label" for="">Active</label>
            <div class="form-check">
                <input type="radio" name="active" class="form-check-input" value="yes"
                    <?php if($active == 'yes'){echo "checked";}?>>Yes
            </div>
            <div class="form-check">
                <input type="radio" name="active" class="form-check-input" value="no"
                    <?php if($active == 'no') {echo "checked";}?>>No
            </div>
            </td>
            </tr>

            <tr>
                <td>
                    <!-- for current image id -->
                    <!-- for current image name -->
                    <input type="hidden" name=" id" value="<?php echo $id;?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">


                    <input type="submit" name="submit" class="btn  btn-primary my-3" value=" Update Food" />
                </td>
            </tr>
            </table>
        </form>
        <!-- !add admin form -->
    </div>
</div>
<?php include('parcials/footer.php');?>


<?php
if(isset($_POST['submit']))
{
    $id =               $_POST['id'];
    $title =            $_POST['title'];
    $description =      $_POST['description'];
    $price =            $_POST['price'];
    $current_image =    $_POST['current_image'];
    $category =         $_POST['category'];
    $featured =         $_POST['featured'];
    $active =           $_POST['active'];

        //upload the image if selected 
        //check whether the upload button is clicked or not
        
        if(isset($_FILES['image']['name']))
        {
            //upload button clicked
            $image_name = $_FILES['image']['name']; // new image name
            //check whether the file is available
            if($image_name != "")
            {
                //image file available
                //A.  upload new image
                // rename the image
                $ext = end(explode('.' , $image_name)); //get the extesnion of the iamge
                $iamge_name = "Food-Name-" . rand(0000,9999) . '.' . $ext; //renamed image

                $src = $_FILES['image']['tmp_name'];
                $dst = "../images/food/" . $image_name;
                
                $upload = move_uploaded_file($src, $dst);
                if($upload == false)
                {
                    //redirect 
                    $_SESSION['new-upload-img-fail'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>Failed to Upload New Image</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                    die();
                }
                //remove the current image if new image is uploaded and current image exists
                //B. remove the current iamge if available
                if($current_image != "")
                {
                    $remove_path = "../images/food/" . $current_image;
                    $remove = unlink($remove_path);

                    //check whether the image is removed or not
                        if($remove == false)
                        {
                        //failed to remove current image
                        $_SESSION['fail-to-remove-curr-img'] = '<div class="mx-auto bg-danger text-white w-50 my-3">Failed to Remove Current Image</div>';
                        header('location:' . SITEURL . 'admin/manage-food.php');
                        die();
                            }
                        }
                            }
                            else
                            {
                                $image_name = $current_image;   //default iamge when iamage is not selected
                            }
                }
                        else
                        {
                        //
                        $image_name = $current_image;   //default image when button is not clicked
                        }
    
            $sql3 = "UPDATE tbl_food SET 
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = '$category',
            featured = '$featured',
            active = '$active'
                where id= $id 
            ";

         $res3 = mysqli_query($conn, $sql3);
        
        
            if($res3 == true)
            {
            $_SESSION['update'] = "<div class='mx-auto bg-success text-white w-50 my-3'>Food Updated Successfully.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            }
            else
            {
                $_SESSION['update'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>Failed to Update Food.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }


}

ob_end_flush();

?>