<?php include('parcials/menu.php'); ?>

<!-- main content -->
<div class="container mb-3">
    <div class="row">
        <h1>Manage Order</h1>
        <!-- button for adding admin -->
        <div class="">
            <div class="">

            </div>
        </div>
        <!-- !button for adding admin -->
        <br>
        <br>
        <hr>
        <?php
          //update messagee
          if(isset($_SESSION['not-order-id-found']))
          {
              echo $_SESSION['not-order-id-found'];
              unset($_SESSION['not-order-id-found']);
          }
          //update messagee
          if(isset($_SESSION['User-Pre-defined']))
          {
              echo $_SESSION['User-Pre-defined'];
              unset($_SESSION['User-Pre-defined']);
          }
        //update messagee
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
                    <th>S.N.</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>E-mail</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM tbl_order order by id desc ";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;
                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                            $id =$row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $order_date =$row['order_date'];
                            $status = $row['status']; // ordered, on delivery, delivered , cancelled.
                            $fullname = $row['customer_name'];
                            $contact = $row['customer_contact'];
                            $email = $row['customer_email'];
                            $address = $row['customer_address'];
                    ?>

                <tr>
                    <td>
                        <?php echo $sn++;?>
                    </td>
                    <td>
                        <?php echo $food;?>
                    </td>
                    <td>
                        <?php echo $price;?>
                    </td>
                    <td>
                        <?php echo $qty;?>
                    </td>
                    <td>
                        <?php echo $total;?>
                    </td>
                    <td>
                        <?php echo $order_date;?>
                    </td>
                    <td>
                        <?php
                        if($status == "ordered")
                        {
                            echo "<label >$status</label>";
                        }
                        elseif($status == "on-delivery")
                        {
                            echo "<label style='color:orange;' >$status</label>";
                        }
                        elseif($status == "delivered")
                        {
                            echo "<label style='color:green;' >$status</label>";
                        }
                        elseif($status == "cancelled")
                        {
                            echo "<label style='color:red;' >$status</label>";
                        }
                        ?>

                    </td>
                    <td>
                        <?php echo $fullname;?>
                    </td>
                    <td>
                        <?php echo $contact;?>
                    </td>
                    <td>
                        <?php echo $email;?>
                    </td>
                    <td>
                        <?php echo $address;?>
                    </td>
                    <td>
                        <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>"
                            class="btn btn-success">Update</a><br><br>
                        <!-- <a href="#" class="update-btn btnn">Delete</a> -->
                    </td>
                </tr>
                <?php

                            
                    }
                }
                else
                {
                    echo "<div class='mx-auto bg-danger text-white w-50 my-3'>Order Not Available.</div>";
                }
            
            ?>

            </tbody>
        </table>
        <!-- Datatable for admin -->
        <div class=" clearfix">
        </div>
    </div>
</div>
<!-- !main content -->








<?php include('parcials/footer.php'); ?>