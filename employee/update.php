<?php
    include('config/db_connect.php');

    if(count($_POST)>0) {
        mysqli_query($conn,"UPDATE cus_order set id='" . $_POST['id'] . "', name='" . $_POST['name'] . "', order_name='" . $_POST['order_name'] . "', address='" . $_POST['address'] . "' , contact='" . $_POST['contact'] . "' WHERE id='" . $_POST['id'] . "'");
        $message = "Record Modified Successfully";
    }

    $result = mysqli_query($conn,"SELECT * FROM cus_order WHERE id='" . $_GET['id'] . "'");
    $row= mysqli_fetch_array($result);
?>

<html>
    <?php include 'Temps/header.php'; ?>

    
    <section class="container grey-text">
        <h4 class="center">Update Order!</h4>
        <form class="white" action="update.php" method="POST">
            <label>Your Name:</label>
            <input type="text" name="name" value="<?php echo $row['name']; ?>">
            <label>Order</label>
            <input type="text" name="order_name" value="<?php echo $row['order_name']; ?>">
            <label>Address</label>
            <input type="text" name="address" value="<?php echo $row['address']; ?>">
            <label>Contact</label>
            <input type="text" name="contact" value="<?php echo $row['contact']; ?>">
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
    

    <?php include 'Temps/footer.php'; ?>
</html>