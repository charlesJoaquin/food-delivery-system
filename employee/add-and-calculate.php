<!DOCTYPE html>
<html>
    <head>
        <title>Checkout</title>
        <?php
            include("config/db_connect.php");

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
        ?>
</html>