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

</body>

</html>

