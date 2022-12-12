<!DOCTYPE html>

<html>

<?php
    include("config/db_connect.php");
?>

<head>
    <title>LOGIN</title>

    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

     <form action="login.php" method="post">

        <h2>LOGIN</h2>

        <label>User Name</label>
        <input type="text" name="username" placeholder="User Name"><br>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br> 

        <input type="submit" name="login" value="Login">
     </form>
     <?php
        if (isset($_POST["login"]))   {
                $username = $_POST["username"];
                $password = $_POST["password"];

                $sql = "SELECT EMP_UNAME, EMP_PASSWORD FROM employee";
                $result = $conn -> query($sql);

                $invalidCredentials = true;
                while ($row = $result->fetch_assoc())   {
                    if ($username == $row['EMP_UNAME'] and $password == $row['EMP_PASSWORD'])   {
                        // get user ID
                        $sql = "SELECT * FROM employee WHERE EMP_UNAME=\"".$username."\"";
                        $result = $conn -> query($sql);
                        $row = $result->fetch_assoc();
                        $userID = $row['EMP_ID'];
                        
                        // add username and user ID to session
                        session_start();
                        $_SESSION['username'] = serialize($username);
                        $_SESSION['userID'] = serialize($userID);

                        // go to customer homepage
                        header("Location: http://localhost/food-delivery-system/employee/index.php");
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