<?php

	include('config/db_connect.php');

	if(isset($_POST['cancelorder'])){

		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

		$sql = "DELETE FROM cus_order WHERE ORDER_ID = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			// success
			header('Location: index.php');
		} else {
			// failure
			echo 'query error' . mysqli_error($conn);
		}

	}


	//check GET request id param
	if(isset($_GET['id'])){

		$id = mysqli_real_escape_string($conn, $_GET['id']);

		// make sql
		$sql = "SELECT * FROM cus_order WHERE ORDER_ID = $id";

		// get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$order = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);



	}

 ?>

 <!DOCTYPE html>
 <html>
	<header>
		<title><?php echo "Order #" . $_GET['id'] ?></title>
		<?php include 'Temps/header.php'; ?>

		<div class="container center">
			<?php if ($order): ?>

				<h4><?php echo htmlspecialchars("Order #".$order['ORDER_ID']) ?></h4>
				<h6><?php echo "Placed on ".date($order['ORDER_TIME']); ?></h6>
				<h6><?php echo "by ".$order['CUS_NAME']." (User ".$order['CUS_ID'].")"; ?></h6>
				<br>
				<h5>Customer Details</h5>
				<div><?php echo htmlspecialchars($order['CUS_ADDRESS']) ?></div>
                <div><?php echo htmlspecialchars($order['CUS_CONTACT_NO']) ?></div>
				<br>
				<h5>Orders</h5>
				<ul>
					<?php foreach(explode(',', $order['ORDER_DETAILS']) as $ord): ?>
						<li><?php echo htmlspecialchars($ord); ?></li>
					<?php endforeach; ?>
				</ul>
				<br>
				<h5>Total Cost</h5>
				<div><?php echo htmlspecialchars($order['ORDER_COST']) ?></div>

				<!-- DELETE FORM -->
				<form action="details.php" method="POST">
					<input type="hidden" name="id_to_delete" value="<?php echo $id ?>">
					<input type="submit" name="cancelorder" value="Cancel Order" class="btn brand z-depth-0">
					<a href="update.php?id=<?php echo $id ?>" class="btn brand z-depth-0" name="updateorder" value="Update Order">Update Order</a>
				</form>



			<?php else: ?>

				<h5>No such order exists!</h5>

			<?php endif; ?>
		</div>

	<?php include 'Temps/footer.php'; ?>

 </html>