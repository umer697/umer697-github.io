<?php include('parcials/menu.php') ?>
<div class="container mb-3">
    <div class="row">
        <h1>Add Admin</h1>
        <div class="">
            <a href="manage-admin.php" class="btn btn-success">Back</a>
        </div>
        <br>
        <br>
        <!-- add admin form -->
        <form id="" action="" method="POST">
            <label class="form-label" for="">Full Name</label>
            <input type="text" name="fullname" class="form-control" placeholder="Full Name" />
            <label class="form-label" for="">User Name</label>
            <input type="text" name="username" class="form-control" placeholder="User Name" />
            <label class="form-label" for="">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" />
            <input type="submit" name="submit" class="btn  btn-primary mt-5" value="Add Admin" />
        </form>
        <!-- !add admin form -->
    </div>
</div>
<!-- footer starts -->
<?php include('parcials/footer.php')?>
<!-- !footer starts -->



<?php
//Insert data into admin table

//
if(isset($_POST['submit'])) {
    //button clicked
    // echo "button clicked" ;
    
    // no 1- get the data from form
    
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    
    // no 2- sql query to save data into database
    
    $sql = "INSERT INTO `tbl_admin`
        (`fullname`, `username`, `password`) 
        VALUES
         ('$fullname','$username','$password')";
    
    
    // no 3 and remaining steps exist in constant.php file
    
    
    $res = mysqli_query($conn, $sql) or die(mysqli_connect_error());
    
    if($res == TRUE)
    {
        //Create a session variable to display message
        $_SESSION['add'] =  ' <div class="mx-auto bg-success text-white w-50 my-3"> Admin Added Successfully. </div>';
        //redirect to manage admin page
        header("location:" . SITEURL . 'admin/manage-admin.php');
    }
    else{
        $_SESSION['add'] = "Failed to Add Admin.";
        //redirect to manage admin page
        header("location:" . SITEURL . 'admin/manage-admin');
    }
    
        
    }
    
?>