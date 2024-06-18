<?php
session_start();
include("includes/header.php");

// Calculate total amount from session data
$total = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $val) {
        $rate = $val['qty'] * $val['price'];
        $total += $rate;
    }
}

?>

<div id="content">
    <div class="post">
        <h2 class="title"><a href="#">Cart</a></h2>
        <p class="meta"></p>
        <div class="entry">
            
        <form action="addtocart.php" method="post">
            <table class="cart" cellspacing="0" border="0" width="100%">
                <tr align="center">
                    <th width="7%">No</th>
                    <th width="30%">Name</th>
                    <th width="20%">Image</th>
                    <th width="15%">Qty</th>
                    <th width="10%">Price</th>
                    <th width="10%">Rate</th>
                    <th width="7%">Remove</th>
                </tr>

                <?php

                    $count=1;

                    if(isset($_SESSION['cart']))
                    {
                        // $total=0; Remove this line as it resets the total
                        foreach($_SESSION['cart'] as $id=>$val)
                        {
                            $rate=$val['qty'] * $val['price'];
                            $total=$total+$rate;

                            echo '<tr>
                                    <td>'.$count.'</td>
                                    <td>'.$val['nm'].'</td>
                                    <td><img src="'.$val['img'].'" width="80" height="60"></td>
                                    <td><input type="number" min="1" value="'.$val['qty'].'" style="width: 50px" name="'.$id.'"></td>
                                    <td>'.$val['price'].'</td>
                                    <td>'.$rate.'</td>
                                    <td><a style="color: red;text-decoration:none;" href="addtocart.php?id='.$id.'">X</a></td>
                                </tr>';

                            $count++;
                        }
                    }
                ?>

                <tr style="font-weight: bold;">
                    <td colspan="5">Total : </td>
                    <td colspan="2">Rs. <?php echo $total; ?></td>
                </tr>
            </table>

            <div align="center" style="margin-top: 20px">
                <input type="Submit" value="Calculate" class="btn_refresh">
                
                <a href="order_process.php?total=<?php echo $total; ?>" class="btn_confirm" style="font-family: open sans; margin-left: 10px">Confirm & Submit Order</a>

            </div>

    </form>

        </div>
    </div>
</div><!-- end #content -->

<?php
    include("includes/footer.php");
?>
    