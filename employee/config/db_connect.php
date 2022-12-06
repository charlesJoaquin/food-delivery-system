<?php 

    // connect to database
    $host="localhost";
    $user="root";
    $password = '';  
    $db_name = "food-delivery-system";
    
    $conn = mysqli_connect($host, $user, $password, $db_name);

    // check connection
    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

 ?>