<?php

include("includes/header.php");

$total = isset($_GET['total']) ? $_GET['total'] : 0;

?>

<div id="content">
    <div class="post">
        <h2 class="title"><a href="#">Order Summary</a></h2>
        <p class="meta"></p>
        <div class="entry">
            <h3>Order Total: Rs. <?php echo isset($_GET['total']) ? $_GET['total'] : '0'; ?></h3>
            <!-- You can display additional order details here if needed -->
            <form action="#" method="post" id="placeOrderForm">
                <input type="hidden" name="total" value="<?php echo isset($_GET['total']) ? $_GET['total'] : '0'; ?>">
                <button type="submit" class="btn">Place Order</button>
            </form>
            <div id="orderSuccessMessage" style="display: none;">
                <p><h2>Order placed successfully.</h2></p>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('placeOrderForm').addEventListener('submit', function(event) {
        // Prevent the form from submitting normally
        event.preventDefault();
        
        // Display the order success message
        document.getElementById('orderSuccessMessage').style.display = 'block';
    });
</script>

<?php
unset($_SESSION['cart']);
include("includes/footer.php");
?>
