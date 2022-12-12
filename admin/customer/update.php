<?php
    // Include config file
    require_once "config.php";
    
    // Define variables and initialize with empty values
    $name = $username = $password = $address = $number = "";
    $name_err = $username_err = $password_err = $address_err = $number_err = "";
    
    // Processing form data when form is submitted
    if(isset($_POST["id"]) && !empty($_POST["id"])){
        // Get hidden input value
        $id = $_POST["id"];
        
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate username
    $input_username = trim($_POST["username"]);

    $username_taken = false;
    $sql = "SELECT CUS_ID FROM customer WHERE CUS_NAME=?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_id);
        $param_id = $input_username;

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) == 1){
                $username_taken = true;
            }
        }
    }

    // Validate password
    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Please enter a password.";
    } elseif(!filter_var($input_password, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $password_err = "Please enter a valid password.";
    } else{
        $password = $input_password;
    }

    // Validate contact number
    $input_number = trim($_POST["number"]);
    if(empty($input_number)){
        $number_err = "Please enter a contact number.";
    } elseif(!(is_numeric($input_number))){
        $number_err = "Please enter a valid contact number.";
    } else{
        $number = $input_number;
    }

    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";
    } else{
        $address = $input_address;
    }
        
        // Check input errors before inserting in database
        if(empty($name_err) && empty($address_err) && empty($number_err)){
            // Prepare an update statement
            $sql = "UPDATE customer SET CUS_NAME=?, CUS_UNAME=?, CUS_PASSWORD, CUS_ADDRESS=?, CUS_CONTACT_NO=? WHERE ORDER_ID=?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssii", $param_name, $param_username, $param_password, $param_address, $param_number, $param_id);
                
                // Set parameters
                $param_name = $name;
                $param_username = $username;
                $param_password = $password;
                $param_address = $address;
                $param_number = $number;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records updated successfully. Redirect to landing page
                    header("location: home.php");
                    exit();
                } else{
                    echo "Something went wrong. Please try again later.";
                }
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
        }
        
        // Close connection
        mysqli_close($link);
    } else{
        // Check existence of id parameter before processing further
        if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
            // Get URL parameter
            $id =  trim($_GET["id"]);
            
            // Prepare a select statement
            $sql = "SELECT * FROM customer WHERE CUS_ID = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $param_id);
                
                // Set parameters
                $param_id = $id;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    $result = mysqli_stmt_get_result($stmt);
        
                    if(mysqli_num_rows($result) == 1){
                        /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        
                        // Retrieve individual field value
                        $name = $row["CUS_NAME"];
                        $username = $row['CUS_UNAME'];
                        $password = $row['CUS_PASSWORD'];
                        $address = $row["CUS_ADDRESS"];
                        $number = $row["CUS_CONTACT_NO"];
                    } else{
                        // URL doesn't contain valid id. Redirect to error page
                        header("location: error.php");
                        exit();
                    }
                    
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
            
            // Close connection
            mysqli_close($link);
        }  else{
            // URL doesn't contain id parameter. Redirect to error page
            header("location: error.php");
            exit();
        }
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                            <span class="help-block"><?php echo $password_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($number_err)) ? 'has-error' : ''; ?>">
                            <label>Number</label>
                            <input type="text" name="number" class="form-control" value="<?php echo $number; ?>">
                            <span class="help-block"><?php echo $number_err;?></span>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="home.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>