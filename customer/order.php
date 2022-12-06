<!DOCTYPE html>

<html>
    <header>
        <title>Menu</title>
    </header>

    <body>
        <h1>Order here!</h1>

        <?php
            $host="localhost";
            $user="root";
            $password = '';  
            $db_name = "food-delivery-system";  
            
            $conn = mysqli_connect($host, $user, $password, $db_name);  
            if(mysqli_connect_errno()) {  
                die("Failed to connect with MySQL: ". mysqli_connect_error());
            }
        ?>
        <form method="post" id="menu">
            <fieldset>
                <legend>Pizza</legend>
                <table>
                    <tr>
                    <th>Qty.</th>
                        <th>Meal Name</th>
                        <th>Price</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM menu WHERE MENU_TYPE=\"PIZZA\"";
                        $result = $conn -> query($sql);

                        while ($row = $result->fetch_assoc())   {
                            echo("<tr id=\"".$row['MENU_ID']."\">");
                                echo("<td>"."<input type=\"text\" name=\"".$row['MENU_ID']."\"></td>");
                                echo("<td>".$row['MENU_NAME']."</td>");
                                echo("<td>".$row['MENU_PRICE']."</td>");
                            echo("</tr>");
                        }
                    ?>
                </table>
            </fieldset>

            <fieldset>
                <legend>Pasta</legend>
                <table>
                    <tr>
                        <th>Qty.</th>
                        <th>Meal Name</th>
                        <th>Price</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM menu WHERE MENU_TYPE=\"PASTA\"";
                        $result = $conn -> query($sql);

                        while ($row = $result->fetch_assoc())   {
                            echo("<tr id=\"".$row['MENU_ID']."\">");
                                echo("<td>"."<input type=\"text\" name=\"".$row['MENU_ID']."\"></td>");
                                echo("<td>".$row['MENU_NAME']."</td>");
                                echo("<td>".$row['MENU_PRICE']."</td>");
                            echo("</tr>");
                        }
                    ?>
                </table>
            </fieldset>

            <fieldset>
                <legend>Rice Meals</legend>
                <table>
                    <tr>
                    <th>Qty.</th>
                        <th>Meal Name</th>
                        <th>Price</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM menu WHERE MENU_TYPE=\"MEAL\"";
                        $result = $conn -> query($sql);

                        while ($row = $result->fetch_assoc())   {
                            echo("<tr id=\"".$row['MENU_ID']."\">");
                                echo("<td>"."<input type=\"text\" name=\"".$row['MENU_ID']."\"></td>");
                                echo("<td>".$row['MENU_NAME']."</td>");
                                echo("<td>".$row['MENU_PRICE']."</td>");
                            echo("</tr>");
                        }
                    ?>
                </table>
            </fieldset>

            <fieldset>
                <legend>Sides</legend>
                <table>
                    <tr>
                    <th>Qty.</th>
                        <th>Meal Name</th>
                        <th>Price</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM menu WHERE MENU_TYPE=\"SIDE\"";
                        $result = $conn -> query($sql);

                        while ($row = $result->fetch_assoc())   {
                            echo("<tr id=\"".$row['MENU_ID']."\">");
                                echo("<td>"."<input type=\"text\" name=\"".$row['MENU_ID']."\"></td>");
                                echo("<td>".$row['MENU_NAME']."</td>");
                                echo("<td>".$row['MENU_PRICE']."</td>");
                            echo("</tr>");
                        }
                    ?>
                </table>
            </fieldset>

            <fieldset>
                <legend>Beverages</legend>
                <table>
                    <tr>
                    <th>Qty.</th>
                        <th>Meal Name</th>
                        <th>Price</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM menu WHERE MENU_TYPE=\"BEVERAGE\"";
                        $result = $conn -> query($sql);

                        while ($row = $result->fetch_assoc())   {
                            echo("<tr id=\"".$row['MENU_ID']."\">");
                                echo("<td>"."<input type=\"text\" name=\"".$row['MENU_ID']."\"></td>");
                                echo("<td>".$row['MENU_NAME']."</td>");
                                echo("<td>".$row['MENU_PRICE']."</td>");
                            echo("</tr>");
                        }
                    ?>
                </table>
            </fieldset>

            <input type="submit" value="Place Order" name="order" onClick="calculateCost()">
        </form>
        
        <script>
            function calculateCost()    {
                var form = document.getElementById('menu');
                var formData = new FormData(form);

                var totalCost = 0;
                var orderDetails = "";

                

                console.log(totalCost);
                console.log(orderDetails);
            }
        </script>
        
    </body>
</html>