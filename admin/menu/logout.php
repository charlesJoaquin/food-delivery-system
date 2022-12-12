<?php 

session_start();

session_unset();

session_destroy();

header("Location: https://localhost/food-delivery-system/admin/index.php");

    