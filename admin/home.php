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
                        <h2 class="pull-left">Admin Home</h2>
                        
                        <a href="logout.php" class="btn btn-success pull-right">Logout</a>
                    </div>

                    <a class="btn btn-success" href="employee/home.php">Employee Table</a>
                    <a class="btn btn-success" href="customer/home.php">Customer Table</a>
                    <a class="btn btn-success" href="order/home.php">Order Table</a>
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

