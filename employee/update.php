<?php
    include('config/db_connect.php');

    $result = mysqli_query($conn,"SELECT * FROM cus_order WHERE ORDER_ID='" . $_GET['id'] . "'");
    $row= mysqli_fetch_array($result);
?>

<html>
    <?php include 'Temps/header.php'; ?>

    <section class="container grey-text">
        <h4 class="center">Update Order!</h4>
        <form class="white" action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $row['CUS_NAME']; ?>">
            <label>Address</label>
            <input type="text" name="address" value="<?php echo $row['CUS_ADDRESS']; ?>">
            <label>Contact</label>
            <input type="text" name="contact" value="<?php echo $row['CUS_CONTACT_NO']; ?>">
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
    
    <?php
        if(isset($_POST['submit'])) {
            echo "UPDATE cus_order set ORDER_ID=" . $_POST['id'] . ", CUS_NAME='" . $_POST['name'] . "', CUS_ADDRESS='" . $_POST['address'] . "' , CUS_CONTACT_NO=" . $_POST['contact'] . " WHERE ORDER_ID=" . $_POST['id'];

            $sql = "UPDATE cus_order set ORDER_ID=" . $_POST['id'] . ", CUS_NAME='" . $_POST['name'] . "', CUS_ADDRESS='" . $_POST['address'] . "' , CUS_CONTACT_NO=" . $_POST['contact'] . " WHERE ORDER_ID=" . $_POST['id'];
            mysqli_query($conn, $sql);
            $message = "Record Modified Successfully";

            // go to employee homepage
            header("Location: http://localhost/food-delivery-system/employee/index.php");
            exit();
        }
    ?>

    <?php include 'Temps/footer.php'; ?>
</html>