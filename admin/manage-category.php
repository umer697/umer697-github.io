<?php include('parcials/menu.php'); ?>

<!-- main content -->
<div class="container">
    <div class="row">
        <h1>Manage Category</h1>
        <!-- button for adding admin -->
        <div class="">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <!-- <a href="manage-category.php" class="btn btn-primary">Back</a> -->
                <a href=" add-category.php" class="btn btn-primary">Add Category</a>
            </div>
        </div>
        <!-- !button for adding admin -->
        <br>
        <br>
        <hr>

        <?php
                //flash message
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];//display session message
                    unset($_SESSION['add']);//remove sessoin message
                }
              
                
                //add message
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
              
                //not-cat-found
                //message show when a user try to add wrong category by inputting url manually
                if(isset($_SESSION['not-cat-found']))
                {
                    echo $_SESSION['not-cat-found'];
                    unset($_SESSION['not-cat-found']);
                }
                //When a user remove parameters form url it should be redirected to the manage-category page
                if(isset($_SESSION['User Pre-defined']))
                {
                    echo $_SESSION['User Pre-defined'];
                    unset($_SESSION['User Pre-defined']);
                }
                //update message
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
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    $sql = "SELECT * FROM tbl_category order by id desc  ";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    $sn = 1;
                    if($count > 0)
                    {
                        while($rows = mysqli_fetch_assoc($res))
                        {
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $image = $rows['image_name'];
                                $featured = $rows['featured'];
                                $active = $rows['active'];
                ?>
                <tr>
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $title;?></td>
                    <td>
                        <?php
                        //check whether image is available or not
                        if($image != "")
                        {
                            //display the image
                        ?>
                        <img src="<?php echo SITEURL;?>images/category/<?php echo $image;?>" width="100px" alt="">

                        <?php
                        }
                        else
                        {
                          //display message
                          echo "<div class='img-error'>Image not added</div>";
                        }

                        ?>
                    </td>
                    <td><?php echo $featured;?></td>
                    <td><?php echo $active;?></td>
                    <td>
                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id;?>"
                            class="btn btn-success">Update</a>
                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image;?>"
                            class="btn btn-danger">Delete</a>
                    </td>
                </tr>


                <?php


                }
                }
                else
                {
                ?>
                <div class=" img-error text-center">No Category Found
                </div>

                <?php

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