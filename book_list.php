<?php
	include("includes/header.php");
?>

<div id="content">
	<div class="post">
		<h2 class="title"><a href="#"><?php echo htmlspecialchars($_GET['cat']); ?></a></h2>
		<p class="meta"></p>
		<div class="entry">

			<?php
				include("includes/connection.php");

				$id = mysqli_real_escape_string($link, $_GET['id']); // Escape the user input to prevent SQL injection
				
				$blq = "SELECT * FROM book WHERE b_cat = ?";
				$stmt = mysqli_prepare($link, $blq);
				mysqli_stmt_bind_param($stmt, "i", $id);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);

				while ($blrow = mysqli_fetch_assoc($result)) {
					echo '<div class="book_box">
							<a href="book_detail.php?id=' . htmlspecialchars($blrow['b_id']) . '">
								<img src="' . htmlspecialchars($blrow['b_img']) . '">
								<h2>' . htmlspecialchars($blrow['b_nm']) . '</h2>
								<p>Rs.' . htmlspecialchars($blrow['b_price']) . '</p>
							</a>
						</div>';
				}
			?>
				
			<div style="clear:both;"></div>

		</div>
	</div>
</div><!-- end #content -->

<?php
	include("includes/footer.php");
?>
