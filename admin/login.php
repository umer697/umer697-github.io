<?php include('../config/constant.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- !bootstrap css -->
</head>

<body>
    <div class="container mt-5 pt-5">
        <div class="row text-center">
            <h1 class="text-center">Login</h1>

            <?php
        // Login failed message -->
        if(isset($_SESSION['login'])) 
        { echo $_SESSION['login'] ; //display session message
          unset($_SESSION['login']);// remove sessoin message 
        }
        // avoid direct access to inner pages message -->
        if(isset($_SESSION['login-error-message'])) 
        { echo $_SESSION['login-error-message'] ; //display session message
          unset($_SESSION['login-error-message']);// remove sessoin message 
        }
        
        ?>
            <!-- !Login message -->


            <!-- form start -->
            <div class="d-flex justify-content-center">
                <form id="myForm" action="" method="POST" class="">
                    <label class="form-label" for="">User Name</label>
                    <input type="text" class="form-control w-100" name="username" placeholder="User Name" />
                    <label class="form-label" for="">Password</label>
                    <input type="password" class="form-control  w-200" name="password" placeholder="Password" />

                    <input type="submit" name="submit" class="btn btn-primary my-3 m-auto" value="Add Admin" />
                </form>
            </div>
            <!-- !form start  -->

            <p class="bottom text-center">Created by - <a href="">Umer Farooq</a></p>

        </div>
    </div>
    <!-- <script src="../js/custom.js"></script> -->
</body>

</html>
<?php
//check whether the submit button clicked or not



if(isset($_POST['submit']))
{
    // echo "button clicked";
    //process fr login
    //1-get data from login form
    $username =mysqli_real_escape_string($conn, $_POST['username']) ;
    $raw_password = md5($_POST['password']);
    $password =mysqli_real_escape_string($conn, $raw_password);

    //2-sql to check whether the user with username and password exists or not
        $sql = "SELECT * from tbl_admin where username='$username' and password='$password' ";
    //3-execute the query
        $res = mysqli_query($conn, $sql);

    
    //4-check whether the data exist in database
     $count = mysqli_num_rows($res);
     
    
    if($count == 1)
    {
        //user exists
        $_SESSION['login'] =" <div class='mx-auto text-center bg-success text-white w-50 my-3'>Login Successful. Welcome Back!</div>";
        $_SESSION['user'] = $username;// this is to check whether the user is login or not and logout will unset
        header('location:' . SITEURL . 'admin/index.php');
    }
    else
    {
        //user does not exist
        $_SESSION['login'] = "<div class='mx-auto  bg-danger text-white w-50 my-3'>Loing Failed Please try again</div>";
        header('location:' .SITEURL . 'admin/login.php');
    }
}



?>