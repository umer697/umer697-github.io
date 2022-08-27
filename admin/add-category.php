<?php include('parcials/menu.php') ?>

<div class="container">
    <div class="row">
        <h1>Add Category</h1>
        <hr>
        <div class="text-right">
            <a href="manage-category.php" class="btn btn-success ">Back</a>
        </div>
        <br>
        <br>

        <?php       
                        if(isset($_SESSION['img-upload-error']))
                        {
                            echo $_SESSION['img-upload-error'];
                            unset($_SESSION['img-upload-error']);
                        } 
        ?>

        <!-- form starts -->
        <form id="myForm" action="" method="POST" enctype="multipart/form-data" class="form">
            <label class="form-label" for="">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Category Title">
            <label class="lab" class="form-label" for="">Select Image</label>
            <input type="file" class="form-control" name="image">

            <label class="  " for="flexRadioDefault1">
                Featured
            </label>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="yes" name="featured" id="flexRadioDefault1">Yes
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="no" name="featured" id="flexRadioDefault1">No
            </div>

            <label class="form-check-label" for="flexRadioDefault1">
                Active
            </label>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="yes" name="active" id="flexRadioDefault1">Yes
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" value="no" name="active" id="flexRadioDefault1">No
            </div>



            <input type="submit" name="submit" class="btn btn-primary  submit" value="Add Category" />
        </form>
        <!-- form starts -->
    </div>
</div>


<!-- php for add category -->
<?php
if(isset($_POST['submit']))
{
    // echo "button clicked";
    // die();
    $title = $_POST['title'];
    
    if(isset($_POST['featured']))
    {
     //get value from form
        $featured = $_POST['featured'];
    }
    else
    {
        //set default value
        $featured = "no";
    }
    if(isset($_POST['active']))
    {
        //
        $active = $_POST['active'];
    }
    else
    {
        //set default value
        $active = "no";
    }

    //check whether the image is selected or not
    // print_r($_FILES['image']);
    // die(); // break the code
    $image_name = $_FILES['image']['name'];
            //check whether the image is availavle or not
            if($image_name != "")
            {
        //image available
        //A. upload the new image

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
            $_SESSION['img-upload-error'] = "<div class='mx-auto bg-danger text-white w-50 my-3'> Image is not uploaded </div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
            //stop the process
            die();
        } 
        }
        else
        {
            //don't uplaod image and set the image_name value as blank
            $image_name = "";
        }
    //2- sql query
    $sql = "INSERT INTO tbl_category SET title='$title',image_name= '$image_name', featured='$featured', active='$active' ";

    //3-execute query
    $res = mysqli_query($conn, $sql);
    //4-check whether the query executed or not and data added
    if($res == true)
    {
        //query executed and category added
        $_SESSION['add'] = "<div class='mx-auto bg-success text-white w-50 my-3'>Category Added Successfully.</div>";
        header('location:' . SITEURL .'admin/manage-category.php');
    }
    else
    {
        $_SESSION['add'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>Failed to  Add Category.</div>";
        header('location:' . SITEURL .'admin/add-category.php');
    }
}


?>

<?php include('parcials/footer.php') ?>