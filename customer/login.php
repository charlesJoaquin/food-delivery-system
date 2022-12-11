<!DOCTYPE html>

<?php
    include("config/db_connect.php");
?>

<html>
    <head>
        <title>Login/Register - Customer View</title>

        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

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
                            // get user ID
                            $sql = "SELECT * FROM customer WHERE CUS_UNAME=\"".$username."\"";
                            $result = $conn -> query($sql);
                            $row = $result->fetch_assoc();
                            $userID = $row['CUS_ID'];
                            
                            // add username and user ID to session
                            session_start();
                            $_SESSION['username'] = serialize($username);
                            $_SESSION['userID'] = serialize($userID);

                            // go to customer homepage
                            header("Location: http://localhost/food-delivery-system/customer/index.php");
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
                        .$contactNumber
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
