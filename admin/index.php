<!DOCTYPE html>

<html>

<head>
    <title>LOGIN</title>

    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
<?php 
$image_url='https://d1csarkz8obe9u.cloudfront.net/posterpreviews/food-delivery-logo-design-template-5997896464b733d7a04807aebd739df2_screen.jpg?ts=1628241737';
?>

<img src="<?php echo $image_url;?>" width="300" height="200" >

     <form action="login.php" method="post">

        <h2>LOGIN</h2>

        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>

        <label>User Name</label>

        <input type="text" name="uname" placeholder="User Name"><br>

        <label>Password</label>

        <input type="password" name="password" placeholder="Password"><br> 

        <button type="submit">Login</button>

     </form>

    <?php if (isset($_POST['uname']) && isset($_POST['password'])) {

        function validate($data){

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;

        }

        $uname = validate($_POST['uname']);

        $pass = validate($_POST['password']);

        if (empty($uname)) {

            header("Location: index.php?error=Username is required");

            exit();

        }else if(empty($pass)){

            header("Location: index.php?error=Password is required");

            exit();

        }else{

            $sql = "SELECT * FROM admin WHERE ADMIN_UNAME='$uname' AND ADMIN_PASSWORD='$pass'";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 1) {

                $row = mysqli_fetch_assoc($result);

                if ($row['ADMIN_UNAME'] === $uname && $row['ADMIN_PASSWORD'] === $pass) {

                    echo "Logged in!";

                    $_SESSION['user_name'] = $row['ADMIN_UNAME'];

                    header("Location: home.php");

                    exit();

                }else{

                    header("Location: index.php?error=Incorrect username or password");

                    exit();

                }

            }else{

                header("Location: index.php?error=Incorrect username or password");

                exit();

            }

        }

    }
    ?>
</body>

</html>

