<?php include('parcials/menu.php'); ?>

<!-- main content section starts-->
<div class="container">
    <div class="row">
        <h1>Manage Admin</h1>
        <!-- button for adding atdmin -->

        <div class="">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <!-- <a href="manage-admin.php" class="btn btn-primary">Back</a> -->
                <a href=" add-admin.php" class="btn btn-primary">Add Admin</a>
            </div>
        </div>

        <!-- success message -->
        <?php 
        if(isset($_SESSION['add']))
        {
            echo  $_SESSION['add'] ; //display session message
            unset($_SESSION['add']);// remove sessoin message
        }
        //delete message
        if(isset($_SESSION['delete']))
        {
            echo  $_SESSION['delete'] ; //display session message
            unset($_SESSION['delete']);// remove sessoin message
        }

        //Update  message
        if(isset($_SESSION['update']))
        {
            echo  $_SESSION['update'] ; //display session message
            unset($_SESSION['update']);// remove sessoin message
        }
         //Update  Password
         if(isset($_SESSION['user-not-found']))
         {
             echo  $_SESSION['user-not-found'] ; //display session message
             unset($_SESSION['user-not-found']);// remove sessoin message
         }

          //New  Password and confirm password does not match
          if(isset($_SESSION['password-not-match']))
          {
              echo  $_SESSION['password-not-match'] ; //display session message
              unset($_SESSION['password-not-match']);// remove sessoin message
          }

          //Password Updated
          if(isset($_SESSION['password-match']))
          {
              echo  $_SESSION['password-match'] ; //display session message
              unset($_SESSION['password-match']);// remove sessoin message
          }
        ?>


        <!-- !button for adding admin -->
        <br>
        <br>
        <hr>
        <!-- Datatable for admin -->
        <table id="table_id" class="display">
            <thead>

                <tr>
                    <th>Sr. No.</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>


                <?php
                //query to get all admins
                $sql = "SELECT * FROM `tbl_admin`  ORDER BY ID DESC";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //check wheater the query is executed or not
                if($res == true  ) 
                {
                    //count rows wheather  we have data in database or not
                    $count = mysqli_num_rows($res);//function to get all the db from db
                    $sn = 1;
                    //check the num of rows
                    if($count > 0)
                    {
                        //we have data in database
                        while($rows = mysqli_fetch_assoc($res))
                        {
                            //get individual data
                            $id=$rows['id'];
                            $fullname=$rows['fullname'];
                            $username=$rows['username'];
                             //display data in the table

                             ?>

                <tr>
                    <td><?php echo $sn++;  ?></td>
                    <td><?php echo $fullname ?></td>
                    <td><?php echo $username?></td>
                    <td>
                        <a href="<?php echo SITEURL;?>/admin/update-password.php?id=<?php echo $id;?>"
                            class="btn btn-primary">Update Password</a>
                        <a href="<?php echo SITEURL;?>/admin/update-admin.php?id=<?php echo $id; ?>"
                            class="btn btn-success">Update</a>
                        <a href="<?php echo SITEURL;?>/admin/delete-admin.php?id=<?php echo $id;?>"
                            class="btn btn-danger">Delete</a>
                    </td>
                </tr>

                <?php


                }
                }
                else
                {
                // we do not have data in database
                }
                }
                ?>


            </tbody>
        </table>
        <!-- Datatable for admin -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- !main content section starts-->

<?php include('parcials/footer.php'); ?>