<!DOCTYPE html>

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

<html>
    <header>
        <title>Login/Register - Customer View</title>
    </header>

    <body>
        <h1>Hello Customer!</h1>
        <form method="post">
            <fieldset>
                <legend>Login</legend>
                <p><label>Username:</label> <input type="text" name="username"></p>
                <p><label>Password:</label> <input type="password" name="password"></p>
                <input type="submit" name="login" value="Login">
            </fieldset>
        </form>
        
        <?php
            if (isset($_POST["login"]))   {
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    $sql = "SELECT CUS_UNAME, CUS_PASSWORD FROM customer"; 
                    $result = $conn -> query($sql);

                    $invalidCredentials = true;
                    while ($row = $result->fetch_assoc())   {
                        if ($username == $row['CUS_UNAME'] and $password == $row['CUS_PASSWORD'])   {
                            header("Location: http://localhost/food-delivery-system/customer/order.php");
                            exit();
                            $invalidCredentials = false;
                        }
                    }
                    if ($invalidCredentials)
                        echo("Invalid login credentials. Try again.");

                    $conn -> close();
            }
        ?>

        <form method="post">
            <fieldset>
                <legend>Register</legend>
                <p><label>Username:</label> <input type="text" name="username"></p>
                <p><label>Password:</label> <input type="text" name="password"></p>
                <p><label>Name:</label> <input type="text" name="name"></p>
                <p><label>Address:</label> <input type="text" name="address"></p>
                <p><label>Contact Number:</label> <input type="text" name="contact-number"></p>
                <input type="submit" name="register" value="Register">
            </fieldset>
        </form>

        <?php
            if (isset($_POST["register"]))   {
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $name = $_POST["name"];
                    $address = $_POST["address"];
                    $contactNumber = $_POST["contact-number"];

                    $sql = "INSERT INTO customer (CUS_UNAME, CUS_PASSWORD, CUS_NAME, CUS_ADDRESS, CUS_CONTACT_NO)
                    VALUES ("
                        ."'".$username."'".","
                        ."'".$password."'".","
                        ."'".$name."'".","
                        ."'".$address."'".","
                        ."'".$contactNumber."'"
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
