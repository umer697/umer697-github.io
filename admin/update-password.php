<?php include('parcials/menu.php') ?>

<div class="container">
    <div class="row">
        <h1>Change Password</h1>
        <hr>
        <div class="text-right">
            <a href="manage-admin.php" class="btn btn-success ">Back</a>
        </div>
        <br>
        <br>
        <div>
            <?php
                    if(isset($_GET['id']))
                    {
                        $id = $_GET['id'];
                    }
            ?>
            <!-- form starts -->
            <form id="myForm" action="" method="POST">

                <label class="form-label" for=""> Current Password</label>
                <input type="password" class="form-control" name="current-password" placeholder="Old Password" />
                <label class="form-label" for=""> New Password</label>
                <input type="password" class="form-control" name="new-password" placeholder="New Password" />
                <label class="form-label" for=""> Confirm Password</label>
                <input type="password" class="form-control" name="confirm-password" placeholder="Confirm Password">

                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" class="btn btn-primary mt-3" value="Change Password" />
            </form>
            <!-- form starts -->
        </div>
    </div>
</div>



<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    // echo "clicked";
    
    //1-get data from form
        $id  =  $_POST['id'];
        $current_password       = md5($_POST['current-password']);
        $new_password           = md5($_POST['new-password']);
        $confirm_password       = md5($_POST['confirm-password']);
    //2-check whether the user with current id and current password exists or not
          $sql =   "SELECT * FROM `tbl_admin` WHERE id=$id and password='$current_password' ";
        
    //execute the query
        $res = mysqli_query($conn, $sql) ;
        
        if($res == true)
        {
            //check whether data is available or not
            $count = mysqli_num_rows($res);
            if($count == 1)
            {
                
                //user exist and  password can be changed
                // echo "user found";

                //check whether the new password and confrim password match or not
                if($new_password == $confirm_password)
                {
                    //update the password
                     $sql2 = "UPDATE tbl_admin SET password ='$new_password' where id=$id";

                     //execute the query
                     $res2 = mysqli_query($conn, $sql2);

                     //check whether the query executed or not
                     if($res2 == true)
                     {
                     //success message   
                     $_SESSION['password-match'] = "<p class='mx-auto bg-success text-white w-50 my-3'>Password Updated Successfully.</p>";
                     header("location: " . SITEURL . 'admin/manage-admin.php');  
                     }
                     else
                     {
                        //error messagae
                        $_SESSION['password-match'] = "<p class='mx-auto bg-success text-white w-50 my-3'>Failed to Change the Password.</p>";
                        header("location: " . SITEURL . 'admin/manage-admin.php');  
                        
                     }
                }
                else
                {
                    //redirec to the manage-admin page with error message
                    $_SESSION['password-not-match'] = "<p class='mx-auto bg-success text-white w-50 my-3'>New Password and the Confirm Password Does not Match</p>";
                    header("location: " . SITEURL . 'admin/manage-admin.php');      
                }
            }
            else
            {
                //user does not exist set message and redirect
                $_SESSION['user-not-found'] = "<p class='mx-auto bg-success text-white w-50 my-3'>User Not Found</p>";
                header("location: " . SITEURL . 'admin/manage-admin.php');
            }
            
        }
    //3-check whether the new password and confirm  password match or not

    //4-change password if all above conditinos are true

    
}

?>

<?php include('parcials/footer.php') ?>