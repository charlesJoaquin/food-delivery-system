<!DOCTYPE html>

<html>
    <head>
        <title>Menu</title>
        <?php 
            include 'Temps/header.php'; 
            include("config/db_connect.php"); 
        ?>
    
        <h4 class="center grey-text">Menu</h4>
        <form class="white" method="post" id="menu" action="checkout.php">
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
                                echo("<td>"."<input type=\"number\" value=\"0\" min=\"0\" max=\"25\" name=\"item-".$row['MENU_ID']."\"></td>");
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
                                echo("<td>"."<input type=\"number\" value=\"0\" min=\"0\" max=\"25\" name=\"item-".$row['MENU_ID']."\"></td>");
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
                                echo("<td>"."<input type=\"number\" value=\"0\" min=\"0\" max=\"25\" name=\"item-".$row['MENU_ID']."\"></td>");
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
                                echo("<td>"."<input type=\"number\" value=\"0\" min=\"0\" max=\"25\" name=\"item-".$row['MENU_ID']."\"></td>");
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
                                echo("<td>"."<input type=\"number\" value=\"0\" min=\"0\" max=\"25\" name=\"item-".$row['MENU_ID']."\"></td>");
                                echo("<td>".$row['MENU_NAME']."</td>");
                                echo("<td>".$row['MENU_PRICE']."</td>");
                            echo("</tr>");
                        }
                    ?>
                </table>
            </fieldset>

            <div class="center">
                <input type="submit" value="Checkout" name="order" class="btn brand z-depth-0">
            </div>
        </form>
    <?php include 'Temps/footer.php'; ?>
</html>