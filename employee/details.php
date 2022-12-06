<?php 

	include('config/db_connect.php');

	if(isset($_POST['cancelorder'])){

		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

		$sql = "DELETE FROM cus_order WHERE id = $id_to_delete";

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
		$sql = "SELECT * FROM cus_order WHERE id = $id";

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

	<?php include 'Temps/header.php'; ?>

		<div class="container center">
			<?php if ($order): ?>

				<h4><?php echo htmlspecialchars($order['name']); ?></h4>
				<p><?php echo date($order['ordered_time']); ?></p>
				<h5>Order</h5>
				<p><?php echo htmlspecialchars($order['order_name']); ?></p>

				<!-- DELETE FORM -->
				<form action="details.php" method="POST">
					<input type="hidden" name="id_to_delete" value="<?php echo $id ?>">
					<input type="submit" name="cancelorder" value="Cancel Order" class="btn brand z-depth-0">
					<a href="update.php" class="btn brand z-depth-0" name="updateorder" value="Update Order">Update Order</a>
				</form>



			<?php else: ?>

				<h5>No such order exists!</h5>

			<?php endif; ?>
		</div>

	<?php include 'Temps/footer.php'; ?>

 </html>