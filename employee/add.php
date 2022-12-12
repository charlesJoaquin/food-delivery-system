<?php 

    include('config/db_connect.php');

    $name = $order = $address = $contact = '';
    $errors = array('name' => '', 'order' => '', 'address' => '', 'contact' => '');

    
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

        // check orders
        $sql = "SELECT * FROM menu";
        $result = $conn -> query($sql);
        $totalCost = 0;
        while ($row = $result->fetch_assoc())   {
            $itemQuantity = $_POST['item-'.$row['MENU_ID']];
            $price = $row['MENU_PRICE'];

            if ($itemQuantity != null and $itemQuantity != 0)    {
                $totalCost += $price*$itemQuantity;
                $orderDetails = $orderDetails.$row['MENU_NAME']." x".$itemQuantity.",";
            }
        }
        if ($totalCost == 0)    {
            $errors['order'] = 'You must order at least one menu item';
        }
        

        if (array_filter($errors)) {
            //echo 'there are errors in the form';
        } else {
            $sql = "SELECT * FROM menu";
            $result = $conn -> query($sql);

            // Generate order details and calculate total cost
            $totalCost = 0;
            $orderDetails = "";
            while ($row = $result->fetch_assoc())   {
                $itemQuantity = $_POST['item-'.$row['MENU_ID']];
                $price = $row['MENU_PRICE'];

                if ($itemQuantity != null and $itemQuantity != 0)    {
                    $totalCost += $price*$itemQuantity;
                    $orderDetails = $orderDetails.$row['MENU_NAME']." x".$itemQuantity.",";
                }
            }
            $orderDetails = substr_replace($orderDetails,"",-1); // removes the last comma

            // Gets user information from previously submitted form
            $userID = 999999999;
            $address = $_POST['address'];
            $name = $_POST['name'];
            $contactNumber = $_POST['contact'];

            // Insert into table
            $sql = "INSERT INTO cus_order (CUS_ID, CUS_ADDRESS, CUS_NAME, CUS_CONTACT_NO, ORDER_COST, ORDER_DETAILS)
            VALUES ("
                .$userID.","
                ."'".$address."'".","
                ."'".$name."'".","
                .$contactNumber.","
                .$totalCost.","
                ."\"".$orderDetails."\""
                .")";

            echo "INSERT INTO cus_order (CUS_ID, CUS_ADDRESS, CUS_NAME, CUS_CONTACT_NO, ORDER_COST, ORDER_DETAILS)
            VALUES ("
                .$userID.","
                ."'".$address."'".","
                ."'".$name."'".","
                .$contactNumber.","
                .$totalCost.","
                ."\"".$orderDetails."\""
                .")";

            if ($conn->query($sql) === TRUE) {
                // go to employee homepage
                header("Location: http://localhost/food-delivery-system/employee/index.php");
                exit();
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn -> close();
        }

    }


 ?>

 <!DOCTYPE html>
 <html>
 
 	<?php include 'Temps/header.php'; ?>

    <section class="container grey-text">
        <h4 class="center">Add Order</h4>
        <form class="white" action="add.php" method="POST">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
            <div class="red-text"><?php echo $errors['name'] ?></div>
            <label>Address</label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($address) ?>">
            <div class="red-text"><?php echo $errors['address'] ?></div>
            <label>Contact</label>
            <input type="text" name="contact" value="<?php echo htmlspecialchars($contact) ?>">
            <div class="red-text"><?php echo $errors['contact'] ?></div>

            <div class="red-text"><?php echo $errors['order'] ?></div>
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