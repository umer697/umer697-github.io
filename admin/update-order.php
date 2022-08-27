<?php include('parcials/menu.php'); ?>

<div class="container">
    <div class="row">
        <h1>Update Order</h1>


        <div class="">

            <a href="manage-order.php" class="btn btn-success">Back </a>
        </div>
        <br>
        <br>

        <hr>
        <br>
        <br>
        <?php   

          if(isset($_GET['id']))
            {
                // echo "clicked"; die();
                $id = $_GET['id'];
                $sql = "SELECT * FROM  tbl_order WHERE id =$id ";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count == 1)
                {
                    $rows = mysqli_fetch_assoc($res);
                    $id = $rows['id'];
                    $food = $rows['food'];
                    $price = $rows['price'];
                    $qty = $rows['qty'];
                    $total = $rows['total'];
                    $order_date = $rows['order_date'];
                    $status = $rows['status'];
                    $customer_name = $rows['customer_name'];
                    $customer_contact = $rows['customer_contact'];
                    $customer_email = $rows['customer_email'];
                    $customer_address = $rows['customer_address'];
                }
                else
                {
                    //message show when a user try to add wrong category by inputting url manually
                    $_SESSION['not-order-id-found'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>No Such Order ID Was Found</div>";
                    header('location:' .SITEURL . 'admin/manage-order.php');
                }
            }
            else
            {
                $_SESSION['User-Pre-defined']  = '<div class="bg-danger text-white w-50 my-3" >Put valid Data.</div>';
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
        
        ?>
        <!-- update form starts -->
        <form id="myForm" action="" method="POST" enctype="multipart/form-data" class="">
            <label class="form-label" for="">Food</label>
            <b class="">
                <?php echo $food;?>
            </b>
            <br>
            <br>
            <label class="form-label" for="">Price</label>
            <b>$
                <?php echo $price;?>
            </b>
            <br>
            <br>
            <label class="form-label" for="">Qty</label>
            <input type="number" name="qty" class="form-control" value="<?php echo $qty; ?>">

            <label class="form-label" for="">Total</label>
            <input type="text" name="total" class="form-control" value="<?php echo $total; ?>">

            <label class="form-label" for="">Order Date</label>
            <input type="date" name="order_date" class="form-control" value="<?php echo $order_date; ?>">

            <label class="form-label" for="">Status</label>
            <select class="form-control" name="status" id="">
                <option <?php if($status=="ordered" ) {echo "selected" ; }?> value="ordered">Ordered</option>
                <option <?php if($status=="on-delivery" ) {echo "selected" ; }?> value="on-delivery">On Delivery
                </option>
                <option <?php if($status=="delivered" ) {echo "selected" ; }?>value="delivered">Delivered</option>
                <option <?php if($status=="cancelled" ) {echo "selected" ; }?> value="cancelled">Cancelled</option>
            </select>

            <label class="form-label" for="">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $customer_name; ?>">

            <label class="form-label" for="">Contact</label>
            <input type="text" name="contact" class="form-control" value="<?php echo $customer_contact; ?>">

            <label class="form-label" for="">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $customer_email; ?>">

            <label class="form-label" for="">Address</label>
            <textarea name="address" id="" class="form-control" name="" cols="30" rows="10">
                <?php echo $customer_address;?>
             </textarea>


            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="hidden" name="price" value="<?php echo $price;?>">
            <input type="submit" name="submit" class="btn btn-primary my-3" value="Update Order">
        </form>
        <!-- update form starts -->
    </div>
</div>
<?php
if(isset($_POST['submit']))
{
        // echo "clicked"; die();
        // 1- get all data from our form
        // $id = $_POST['id'];
        // $food = $_POST['food'];
        // $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        $order_date = $_POST['order_date'];
        $status = $_POST['status'];
        $customer_name = $_POST['name'];
        $customer_contact = $_POST['contact'];
        $customer_email = $_POST['email'];
        $customer_address = $_POST['address'];


        //3-update the database
        $sql2 =  "UPDATE tbl_order set
        -- food= '$food' ,
        -- price= $price ,
        qty =$qty,
        total =$total,
        order_date ='$order_date',
        status ='$status',
        customer_name ='$customer_name',
        customer_contact ='$customer_contact',
        customer_email ='$customer_email',
        customer_address ='$customer_address'
        where   id =$id
        ";
        //execute query
        // echo $sql2; die();
        $res2 = mysqli_query($conn, $sql2);
        //4-redirect to manage-category with message
        //check whether the query is excuted or not
        if($res2 == true)
        {
            $_SESSION['update'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>Order Updated Successfully.</div>";
            // header('location:' . SITEURL . 'admin/manage-order.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='mx-auto bg-danger text-white w-50 my-3'>Failed to Update Order.</div>";
                // header('location:' . SITEURL . 'admin/manage-order.php');
        }
        
}


?>
<?php include('parcials/footer.php'); ?>