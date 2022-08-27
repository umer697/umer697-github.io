<?php include('parcials/menu.php'); ?>

<!-- main content -->
<div class="container mb-3">
    <div class="row">
        <h1>Manage Food</h1>
        <!-- button for adding admin -->

        <div class="">
            <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn btn-primary pull-rigth">Add Food</a>
        </div>

        <!-- !button for adding admin -->
        <br>
        <br>
        <hr>
        <?php
        
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        //failed to remove image from manage-food.php page
        if(isset($_SESSION['remove-img']))
        {
            echo $_SESSION['remove-img'];
            unset($_SESSION['remove-img']);
        }
        //unauthorised
        if(isset($_SESSION['unauthorised']))
        {
            echo $_SESSION['unauthorised'];
            unset($_SESSION['unauthorised']);
        }
        // failed to upload new image
        if(isset($_SESSION['new-upload-img-fail']))
        {
            echo $_SESSION['new-upload-img-fail'];
            unset($_SESSION['new-upload-img-fail']);
        }
         // failed to remove current image
         if(isset($_SESSION['fail-to-remove-curr-img']))
         {
             echo $_SESSION['fail-to-remove-curr-img'];
             unset($_SESSION['fail-to-remove-curr-img']);
         }
         // update messagae to remove current image
                  if(isset($_SESSION['update']))
         {
             echo $_SESSION['update'];
             unset($_SESSION['update']);
         }
         ?>

        <!-- Datatable for admin -->
        <table id="table_id" class="display">
            <thead>

                <tr>
                    <th>Sr. No.</th>
                    <th>Title</th>
                    <!-- <th>Description</th> -->
                    <th>Price</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM tbl_food order by  id desc";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    $sn = 1;
                    if($count > 0)
                    {
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $category = $row['category_id'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                             ?>
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $title; ?></td>
                    <td><?php echo $price; ?></td>
                    <td>
                        <?php  
                        if($image_name == "")
                        {
                            echo "<div class='mx-auto bg-danger text-white w-50 my-3'>Image not Added</div>";
                        }
                        else
                        {
                            ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>  " width=" 100px">
                        <?php
                     } ?>
                    </td>
                    <td><?php echo $category ?></td>
                    <td><?php echo $featured ?></td>
                    <td><?php echo $active ?></td>
                    <td>
                        <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id?>"
                            class="btn btn-success">Update</a>
                        <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id?>&image_name=<?php echo $image_name;?>"
                            class="btn btn-danger">Delete</a>
                    </td>
                </tr>

                <?php
                }

                }
                else
                {
                    echo "<div class='mx-auto bg-danger text-white w-50 my-3'>Food not Added Yet.</div>";
                }


                ?>



            </tbody>
        </table>
        <!-- Datatable for admin -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- !main content -->








<?php include('parcials/footer.php'); ?>