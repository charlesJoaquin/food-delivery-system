<?php 

    include('config/db_connect.php');

    $name = $order_name = $address = $contact = '';
    $errors = array('name' => '', 'order_name' => '', 'address' => '', 'contact' => '');

    
    if (isset($_POST['submit'])) {

        // check name
        if (empty($_POST['name'])) {
            $errors['name'] = 'Name is required <br />';
        } else {
            $name = $_POST['name'];
            if (ctype_alpha(str_replace(' ', '', $name)) === false){
                $errors['name'] = 'Name must be letters and spaces only';
            }
        }

        // check order
        if (empty($_POST['order_name'])) {
            $errors['order_name'] = 'Order is required <br />';
        } else {
            $order_name = $_POST['order_name'];
            if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $order_name)){
                $errors['order_name'] = 'Order must be comma separated list';
                
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
            //echo 'there are errors in the form';
        } else {

            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $order_name = mysqli_real_escape_string($conn, $_POST['order_name']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $contact = mysqli_real_escape_string($conn, $_POST['contact']);

            // create sql
            $sql = "INSERT INTO cus_order(CUS_NAME,ORDER_DETAILS,CUS_ADDRESS,CUS_CONTACT_NO) VALUES ('$name', '$order_name', '$address', '$contact')";

            // save to db and check
            if (mysqli_query($conn, $sql)) {
                // success
                header('Location: index.php');
            } else {
                // error
                echo 'query error' . mysqli_error($conn);
            }

        }

    }


 ?>

 <!DOCTYPE html>
 <html>
 
 	<?php include 'Temps/header.php'; ?>

    <section class="container grey-text">
        <h4 class="center">Add Order</h4>
        <form class="white" action="add-and-calculate.php" method="POST">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
            <div class="red-text"><?php echo $errors['name'] ?></div>
            <div class="red-text"><?php echo $errors['order_name'] ?></div>
            <label>Address</label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($address) ?>">
            <div class="red-text"><?php echo $errors['address'] ?></div>
            <label>Contact</label>
            <input type="text" name="contact" value="<?php echo htmlspecialchars($contact) ?>">
            <div class="red-text"><?php echo $errors['contact'] ?></div>

            <label>Order</label>
            <fieldset>
                <table>
                    <tr>
                    <th>Qty.</th>
                        <th>Meal Name</th>
                        <th>Price</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM menu";
                        $result = $conn -> query($sql);

                        while ($row = $result->fetch_assoc())   {
                            echo("<tr id=\"".$row['MENU_ID']."\">");
                                echo("<td>"."<input type=\"number\" min=\"0\" max=\"25\" name=\"item-".$row['MENU_ID']."\"></td>");
                                echo("<td>".$row['MENU_NAME']."</td>");
                                echo("<td>".$row['MENU_PRICE']."</td>");
                            echo("</tr>");
                        }
                    ?>
                </table>
            </fieldset>

            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

 	<?php include 'Temps/footer.php'; ?>

 </html>