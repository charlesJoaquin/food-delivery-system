<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $position = $employee_id = "";
$name_err = $position_err = $employee_id_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate position
    $input_position = trim($_POST["position"]);
    if(empty($input_position)){
        $position_err = "Please enter an position.";     
    } else{
        $position = $input_position;
    }
    
    // Validate employee_id
    $input_employee_id = trim($_POST["employee_id"]);
    if(empty($input_employee_id)){
        $employee_id_err = "Please enter the employee_id amount.";     
    } elseif(!ctype_digit($input_employee_id)){
        $employee_id_err = "Please enter a positive integer value.";
    } else{
        $employee_id = $input_employee_id;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($position_err) && empty($employee_id_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employees (name, position, employee_id) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_position, $param_employee_id);
            
            // Set parameters
            $param_name = $name;
            $param_position = $position;
            $param_employee_id = $employee_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($position_err)) ? 'has-error' : ''; ?>">
                            <label>position</label>
                            <textarea name="position" class="form-control"><?php echo $position; ?></textarea>
                            <span class="help-block"><?php echo $position_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($employee_id_err)) ? 'has-error' : ''; ?>">
                            <label>employee_id</label>
                            <input type="text" name="employee_id" class="form-control" value="<?php echo $employee_id; ?>">
                            <span class="help-block"><?php echo $employee_id_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="home.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>