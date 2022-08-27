<?php 
ob_start();

include('parcials/menu.php'); ?>


<div class="container">
    <div class="row">
        <h1>Add Food</h1>
        <div class="">
            <a href="manage-food.php" class=" btn btn-success">Back</a>
        </div>
        <br>
        <br>

        <?php
        
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
        ?>


        <!-- add admin form -->
        <form id="myForm" action="" method="POST" enctype="multipart/form-data" class="form">

            <label class="form-label" for="">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Title">


            <label class="form-label" for="">Description</label>
            <textarea name="description" id="" cols="23" rows="5" class="form-control"
                placeholder="Food Description"></textarea>

            <label class="form-label" for="">Price</label>
            <input type="number" class="form-control" name="price" placeholder="Price">

            <label class="form-label" for="">Select Image</label>
            <input type="file" class="form-control" name="image">
            <br>
            <label class="form-label" for="">Category</label>
            <select name="category" class="form-control" id="">
                <?php
                               //display category from database
                              //1.sql query for creating active categories form database
                                $sql = "SELECT * FROM tbl_category where active ='yes' ";
                                $res = mysqli_query($conn, $sql);
                                //check whether we have categories or not
                                $count = mysqli_num_rows($res);
                                 // if count is greater than zero we have category else we don't have   
                                if($count > 0)
                                {
                                    //we have categories
                                    while($row= mysqli_fetch_assoc($res))
                                    {
                                        //get details of categories
                                      $id = $row['id'];
                                      $title = $row['title'];
                            ?>

                <option value="<?php echo $id;?>"><?php echo $title;?></option>

                <?php
                            }

                            }
                            else
                            {
                            ?>

                <option value="1">No Category Found</option>

                <?php
                            // we don't have categories

                            }
                            //2-display in dropdown
                            ?>
            </select>
            <br>
            <label class="form-label" for="">Featured</label>
            <input type="radio" class="form-check-input" name="featured" value="yes">Yes
            <input type="radio" class="form-check-input" name="featured" value="no">No
            <br>
            <label class="form-label" for="">Active</label>
            <input type="radio" class="form-check-input" name="active" value=" yes">Yes
            <input type="radio" class="form-check-input" name="active" value="no">No
            <br>


            <input type="submit" name="submit" class="btn  btn-primary mb-3" value="Add Food" />

        </form>
        <!-- !add admin form -->
    </div>
</div>



<?php include('parcials/footer.php'); ?>


<?php

if(isset($_POST['submit']))
{
    // $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    // $image = $_POST['image'];
    
    $category = $_POST['category'];

    if(isset($_POST['featured']))
    {
        $featured = $_POST['featured'];
    }
    else
    {
        $featured = 'no';
    }
    if(isset($_POST['active']))
    {
        $active = $_POST['active'];
    }
    else
    {
        $active = 'no';
    }
    //upload image if selected
    //check whetther the image is clicked or not and upload the image only if the image is selected
    if(isset($_FILES['image']['name']))
    {
        //get the details of selected iamge
        $image_name = $_FILES['image']['name'];
        //check whether the image is selected or not and upload iamge only if selected
         if($image_name != "")
         {
            //image is selected
            //A. rename the image
            //get extension of the selected image 
            $ext = explode('.' , $image_name);
            $ext1 = end($ext);
            
            //create new name of image
            $image_name="Food-name-" . rand(0000,9999) . '.' . $ext1 ;
            //B. upload the image
            //get the source path and destination path
            
            //source path is the current location of the image
            $src = $_FILES['image']['tmp_name'];
            $dst= "../images/food/" . $image_name;
            //finally upload image
            $uploaded = move_uploaded_file($src, $dst);
            
            if($uploaded == false)
            {
                //
                $_SESSION['upload']= '<div class="mx-auto bg-danter text-white w-50 my-3">Failed to Upload Image</div>';
                header('location:' . SITEURL . 'admin/add-food.php');
                die();
            }
         }
    }
    else
    {
        $image_name = "";   //set default value as blank
    }
    //insert into database 
    //sql query
    
    $sql2 =  "INSERT INTO tbl_food SET
    title='$title',
    description ='$description',
    price = $price,
    image_name ='$image_name',
    category_id= $category,
    featured='$featured',
    active='$active'
     ";
     
     $res2 = mysqli_query($conn, $sql2);
     
     if($res2 == true)
     {
        $_SESSION['add'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>Food Added Successfully.</div>";
        header('location: ' .SITEURL . 'admin/manage-food.php');
     }
     else
     {
        $_SESSION['add']='<div class="mx-auto bg-danger text-white w-50 my-3">Faild to Add Food.</div>';
        header('location: ' .SITEURL . 'admin/add-food.php');
     }
}

ob_end_flush();
?>