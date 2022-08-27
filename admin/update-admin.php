<?php include('parcials/menu.php') ?>
<div class="container">
    <div class="row">
        <h1>Update Admin</h1>
        <hr>
        <div class=" ">
            <a href="manage-admin.php" class="btn btn-success">Back</a>
        </div>

        <?php
                if(isset($_GET['id']))
                {
                $id = $_GET['id'];
                $sql = "SELECT * FROM  tbl_admin WHERE id =$id ";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count == 1)
                {
                    $rows = mysqli_fetch_assoc($res);
                    $fullname = $rows['fullname'];
                    $username = $rows['username'];
                }
                else
                {
                    //message show when a user try to add wrong category by inputting url manually
                    $_SESSION['user-not-found'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>No Category Found</div>";
                    header('location:' .SITEURL . 'admin/manage-category.php');
                }
                }
                else
                {
                    header('location:' . SITEURL . 'admin/manage-category.php');
                }
        ?>

        <!-- add admin form -->
        <form id="myForm" action="" method="POST">
            <label class="form-label" for="">Full Name</label>
            <input type="text" class="form-control" name="fullname" value="<?php echo $fullname ?>" />
            <label class="form-label" for="">User Name</label>
            <input type="text" class="form-control" name="username" value="<?php echo $username ?>" />

            <input type="hidden" name="id" value="<?php echo $id;?>">

            <input type="submit" name="submit" class="btn btn-primary mt-3" value="Update Admin" />
        </form>
        <!-- !add admin form -->
    </div>
</div>


<?php
//check whether submit button clicked or not
   if(isset($_POST['submit']))
   {
        // echo "button clicked";
         $id       = $_POST['id'];
         $fullname = $_POST['fullname'];
         $username = $_POST['username'];
        
         
         //create sql query
        $sql =  "UPDATE `tbl_admin` SET `fullname`= '$fullname',`username`='$username' WHERE  ID= '$id'";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //check whether the query is executed successfully
        if($res == true)
        {
            //query executed and admin updated
            $_SESSION['update']= "<p class='mx-auto bg-success text-white w-50 my-3'> Admin Updated Successfully</p>";
            header("location:" . SITEURL . 'admin/manage-admin.php');

        }
        else
        {
        //failed to update admin
        $_SESSION['update']= "<div class='mx-auto bg-success text-white w-50 my-3'> Failed to Update Admin</div>";
        header("location:" . SITEURL . 'admin/manage-admin');
        }

}

?>


<!-- footer starts -->
<?php include('parcials/footer.php')?>
<!-- !footer starts -->