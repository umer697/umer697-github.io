<?php
include('parcials/menu.php');

?>
<?php
        if(isset($_SESSION['login'])) 
        { echo $_SESSION['login'] ; //display session message
          unset($_SESSION['login']);// remove sessoin message 
        }
        ?>
<div class="container ">
    <div class="row">
        <h1>
            DashBoard
        </h1>

        <div class="card text-white bg-primary mb-3 " style="max-width: 16rem;">
            <div class="card-header">Categories</div>
            <div class="card-body">
                <?php
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            ?>
                <h1 class="card-title ">
                    <?php echo $count;?>
                </h1>
            </div>
        </div>
        <div class="card text-white bg-secondary mb-3 mx-3" style="max-width: 16rem;">
            <div class="card-header">Food</div>
            <div class="card-body">
                <?php
            $sql2 = "SELECT * FROM tbl_food";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            ?>
                <h1 class="card-title"><?php echo $count2;?></h1>
            </div>
        </div>
        <div class="card text-white bg-primary mb-3 " style="max-width: 16rem;">
            <div class="card-header">Orders</div>
            <div class="card-body">
                <?php
            $sql3 = "SELECT * FROM tbl_order ";
            $res3 = mysqli_query($conn, $sql3);
            $count3 = mysqli_num_rows($res3);
            ?>
                <h1 class="card-title"><?php echo $count3;?></h1>
            </div>
        </div>
        <div class="card text-white bg-secondary mb-3 mx-3" style="max-width: 16rem;">
            <div class="card-header">Total Revenue</div>
            <div class="card-body">
                <?php
            $sql4 = "SELECT  SUM(total) as Total FROM tbl_order  WHERE status='delivered' ";
            $res4 = mysqli_query($conn, $sql4);
            $rows = mysqli_fetch_assoc($res4);
            $total_revenue  = $rows['Total'];
            ?>
                <h1 class="card-title">$ <?php echo $total_revenue;?></h1>
            </div>
        </div>
    </div>
</div>

<?php include('parcials/footer.php'); ?>