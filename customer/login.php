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
    </body>
</html>
