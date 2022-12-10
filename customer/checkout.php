<!DOCTYPE html>
<html>
    <body>
        <?php
            $host="localhost";
            $user="root";
            $password = '';  
            $db_name = "food-delivery-system";  
            
            $conn = mysqli_connect($host, $user, $password, $db_name);  
            if(mysqli_connect_errno()) {  
                die("Failed to connect with MySQL: ". mysqli_connect_error());
            }

            $sql = "SELECT * FROM menu";
            $result = $conn -> query($sql);

            $totalCost = 0;
        ?>
        
        <table>
            <tr>
                <th>Quantity</th>
                <th>Meal</th>
                <th>Price</th>
            </tr>
            <?php
                $orderDetails = "";

                while ($row = $result->fetch_assoc())   {
                    $itemQuantity = $_POST['item-'.$row['MENU_ID']];
                    $price = $row['MENU_PRICE'];

                    echo("<tr>");
                    if ($itemQuantity != null)    {
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

        <form method="post">
            <input type="hidden" name="cost" value="<?php echo($totalCost); ?>">
            <input type="hidden" name="order-details" value="<?php echo($orderDetails); ?>">
            <input type="submit" name="place-order" value="Place Order">
        </form>

        <?php
            if (isset($_POST["place-order"]))   {
                // Gets user information
                    //session_start();
                    //$username = unserialize($_SESSION('username'));           FIX LATER
                    $username = "aaaa";
                $sql = "SELECT * FROM customer WHERE CUS_UNAME=\"".$username."\"";
                $result = $conn -> query($sql);
                $row = $result->fetch_assoc();

                $userid = $row['CUS_ID'];
                $address = $row['CUS_ADDRESS'];
                $name = $row['CUS_NAME'];
                $contactNumber = $row['CUS_CONTACT_NO'];
                $totalCost = $_POST["cost"];
                $orderDetails = $_POST["order-details"];

                echo("Order Details: ".$_POST["order-details"]);

                $sql = "INSERT INTO cus_order (CUS_ID, CUS_ADDRESS, CUS_NAME, CUS_CONTACT_NO, ORDER_COST, ORDER_DETAILS)
                VALUES ("
                    .$userid.","
                    ."'".$address."'".","
                    ."'".$name."'".","
                    .$contactNumber.","
                    .$totalCost.","
                    ."\"".$orderDetails."\""
                    .")";

                if ($conn->query($sql) === TRUE) {
                    echo "Record inserted successfully";
                }
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn -> close();
            }
        ?>
    </body>
</html>