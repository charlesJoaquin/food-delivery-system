<?php
    include('config/db_connect.php');

    $result = mysqli_query($conn,"SELECT * FROM cus_order WHERE ORDER_ID='" . $_GET['id'] . "'");
    $row= mysqli_fetch_array($result);

    $name = $address = $contact = '';
    $errors = array('name' => '', 'address' => '', 'contact' => '');

    if(isset($_POST['submit'])) {

        // check name
        if (empty($_POST['name'])) {
            $errors['name'] = 'Name is required <br />';
        } else {
            $name = $_POST['name'];
            if (ctype_alpha(str_replace(' ', '', $name)) === false){
                $errors['name'] = 'Name must be letters and spaces only';
            }
        }

        // check address
        if (empty($_POST['address'])) {
            $errors['address'] = 'Address is required <br />';
        } else {
            $address = $_POST['address'];
            if (!preg_match("`(.+)`s", $address)){
                $errors['address'] = 'Address invalid';
            }
        }

        // check contact
        if (empty($_POST['contact'])) {
            $errors['contact'] = 'Contact is required <br />';
        } else {
            $contact = $_POST['contact'];
            if (preg_match("/[^0-9]/", $contact)){
                $errors['contact'] = 'Contact invalid';
            }
        }

        if (array_filter($errors)) {
            //echo 'there are errors in the form'
        } else {
            $sql = "UPDATE cus_order set ORDER_ID=" . $_POST['id'] . ", CUS_NAME='" . $_POST['name'] . "', CUS_ADDRESS='" . $_POST['address'] . "' , CUS_CONTACT_NO=" . $_POST['contact'] . " WHERE ORDER_ID=" . $_POST['id'];
            mysqli_query($conn, $sql);
            $message = "Record Modified Successfully";

            // go to employee homepage
            header("Location: http://localhost/food-delivery-system/customer/index.php");
            exit();
        }
    }
?>

<html>
    <?php include 'Temps/header.php'; ?>

    <section class="container grey-text">
        <h4 class="center">Update Order!</h4>
        <form class="white" action="update.php" method="POST">
            <input type="hidden" name="id" value="
            <?php 
            if ($_POST == null)
                echo $_GET['id']; 
            else
                echo $_POST['id'];        
            ?>
            ">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $row['CUS_NAME']; ?>">
            <div class="red-text"><?php echo $errors['name'] ?></div>
            <label>Address</label>
            <input type="text" name="address" value="<?php echo $row['CUS_ADDRESS']; ?>">
            <div class="red-text"><?php echo $errors['address'] ?></div>
            <label>Contact</label>
            <input type="text" name="contact" value="<?php echo $row['CUS_CONTACT_NO']; ?>">
            <div class="red-text"><?php echo $errors['contact'] ?></div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <?php include 'Temps/footer.php'; ?>
</html>