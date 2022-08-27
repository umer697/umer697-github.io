<?php include('parcials-front/menu.php') ?>
<?php

if(isset($_GET['category_id']))
{
    $category_id = $_GET['category_id'];

    
    $sql = "SELECT * FROM   tbl_category where id = $category_id ";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count == 1)
    {
        $row = mysqli_fetch_assoc($res);
        $category_title =$row['title'];  
        
    }
    else
    {
        $_SESSION['cat-id-not-found']=" <div class='session-error'>No Such Category ID Found.</div>";
         header('location: ' . SITEURL);
    }
}
else
{
    header('location:' . SITEURL);
}

?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title;?>"
            </a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        $sql2 = "SELECT * FROM tbl_food where category_id = $category_id";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);
        
        if($count2 > 0)
        {
            while($row = mysqli_fetch_assoc($res2))
            {
                $id = $row['id']; 
                $title = $row['title']; 
                $description = $row['description']; 
                $price = $row['price']; 
                $image_name = $row['image_name']; 
                ?>
        <div class="food-menu-box">
            <div class="food-menu-img">
                <?php
                    if($image_name == "")
                    {
                        echo "<div class='session-error'>Image Not Added.</div>";
                    }   
                else
                {
                        ?>

                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza"
                    class="img-responsive img-curve">

                <?php
                }

                ?>
            </div>

            <div class="food-menu-desc">
                <h4>
                    <?php echo $title;?>
                </h4>
                <p class="food-price">$<?php echo $price;?></p>
                <p class="food-detail">
                    <?php echo $description;?>
                </p>
                <br>

                <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
            </div>
        </div>

        <?php
        }
        }
        else
        {
        echo "<div class='session-error'>Food not Added.</div>";
        }

        ?>





        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('parcials-front/footer.php') ?>