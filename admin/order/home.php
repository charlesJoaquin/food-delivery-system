<?php 

session_start();

if (isset($_SESSION['user_name'])) {

 ?>

<!DOCTYPE html>

<html>

<head>
<meta charset="UTF-8">
    <title>HOME</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
     </script>
</head>

<body>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                    <h2 class="pull-left"><a href="/food-delivery-system/admin/home.php">Admin</a></h2>
                        <a class="btn btn-success pull-right" href="/food-delivery-system/admin/employee/home.php">Employee Table</a>
                        <a class="btn btn-success pull-right" href="/food-delivery-system/admin/customer/home.php">Customer Table</a>
                        <a class="btn btn-success pull-right" href="/food-delivery-system/admin/order/home.php">Order Table</a>
                        <a href="logout.php" class="btn btn-success pull-right">Logout</a>
                    </div>

                <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM cus_order";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Order ID #</th>";
                                        echo "<th>Time Placed</th>";
                                        echo "<th>Cost</th>";
                                        echo "<th>Details</th>";
                                        echo "<th>Customer ID #</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Address</th>";
                                        echo "<th>Contact Number</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['ORDER_ID'] . "</td>";
                                        echo "<td>" . $row['ORDER_TIME'] . "</td>";
                                        echo "<td>" . $row['ORDER_COST'] . "</td>";
                                        echo "<td>" . $row['ORDER_DETAILS'] . "</td>";
                                        echo "<td>" . $row['CUS_ID'] . "</td>";
                                        echo "<td>" . $row['CUS_NAME'] . "</td>";
                                        echo "<td>" . $row['CUS_ADDRESS'] . "</td>";
                                        echo "<td>" . $row['CUS_CONTACT_NO'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='update.php?id=". $row['ORDER_ID'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['ORDER_ID'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            echo "<a href=\"add.php\" class=\"btn btn-success pull-right\">Add Order</a>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                ?>
                </div>
            </div>        
        </div>
    </div>
    
    
    
    
</body>
</html>

<?php 

}else{

     header("Location: index.php");

     exit();

}

 ?>

