<!DOCTYPE html>
<html>
    <head>
        <title>Checkout</title>
        <?php 
            include 'Temps/header.php';
            include("config/db_connect.php");

            session_start();
            $userID = unserialize($_SESSION['userID']);

            $sql = "SELECT * FROM customer WHERE CUS_ID=\"".$userID."\"";
            $result = $conn -> query($sql);
            $row = $result->fetch_assoc();

            $name = $row['CUS_NAME'];
            $address = $row['CUS_ADDRESS'];
            $contactNumber = $row['CUS_CONTACT_NO'];
        ?>

        <form method="post">
            <label>Your Name:</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
            <label>Address</label>
            <input type="text" name="address" value="<?php echo $address; ?>">
            <label>Contact</label>
            <input type="text" name="contact" value="<?php echo $contactNumber; ?>">

            <br>
            <table>
                <tr>
                    <th>Quantity</th>
                    <th>Meal</th>
                    <th>Price</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM menu";
                    $result = $conn -> query($sql);

                    $totalCost = 0;

                    $orderDetails = "";

                    while ($row = $result->fetch_assoc())   {
                        $itemQuantity = $_POST['item-'.$row['MENU_ID']];
                        $price = $row['MENU_PRICE'];

                        echo("<tr>");
                        if ($itemQuantity != null and $itemQuantity != 0)    {
                            echo("<td>".$itemQuantity."</td>");
                            echo("<td>".$row['MENU_NAME']."</td>");
                            echo("<td>".($price*$itemQuantity)."</td>");

                            $totalCost += $price*$itemQuantity;

                            $orderDetails = $orderDetails.$row['MENU_NAME']." x".$itemQuantity.",";
                        }
                        echo("</tr>");
                    }
                    echo("<tr>");
                    echo("<td colspan=\"2\">Total</td>");
                    echo("<td>".$totalCost."</td>");
                    echo("</tr>");

                    $orderDetails = substr_replace($orderDetails,"",-1); // removes the last comma
                ?>
            </table>

        
            <input type="hidden" name="cost" value="<?php echo($totalCost); ?>">
            <input type="hidden" name="order-details" value="<?php echo($orderDetails); ?>">
            <input type="submit" name="place-order" value="Place Order">
        </form>

        <?php
            if (isset($_POST["place-order"]))   {
                // Gets user information from session and database
                session_start();
                $userID = unserialize($_SESSION['userID']);

                $sql = "SELECT * FROM customer WHERE CUS_ID=\"".$userID."\"";
                $result = $conn -> query($sql);
                $row = $result->fetch_assoc();

                $name = $_POST['name'];
                $address = $_POST['address'];
                $contactNumber = $_POST['contact'];
                $totalCost = $_POST["cost"];
                $orderDetails = $_POST["order-details"];

                $sql = "INSERT INTO cus_order (CUS_ID, CUS_ADDRESS, CUS_NAME, CUS_CONTACT_NO, ORDER_COST, ORDER_DETAILS)
                VALUES ("
                    .$userID.","
                    ."'".$address."'".","
                    ."'".$name."'".","
                    .$contactNumber.","
                    .$totalCost.","
                    ."\"".$orderDetails."\""
                    .")";

                if ($conn->query($sql) === TRUE) {
                    // go to customer homepage
                    header("Location: http://localhost/food-delivery-system/customer/index.php");
                    exit();
                }
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn -> close();
            }
        ?>
    <?php include 'Temps/footer.php'; ?>
</html>