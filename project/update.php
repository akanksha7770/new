<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name  = $description = $image = $sdate = $edate =  $status = "";
$name_err = $description_err = $image_err =  $sdate_err = $edate_err = $status_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $name = trim($_POST["name"]);
    if(empty($name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $name;
    }
    
<<<<<<< HEAD:project/update.php
    $input_description = trim($_POST["description"]);
=======


      $input_description = trim($_POST["description"]);
>>>>>>> 0d6fd774483693c3e63cc6ec8289c09b2be76f45:project/update.php
    if(empty($input_description)){
        $description_err = "Please enter an description.";     
    } else{
        $description = $input_description;
    }
<<<<<<< HEAD:project/update.php
    
    
    $input_image = trim($_POST["image"]);
=======


      
     $input_image = trim($_POST["image"]);
>>>>>>> 0d6fd774483693c3e63cc6ec8289c09b2be76f45:project/update.php
    if(empty($input_image)){
        $image_err = "Please enter an image.";     
    } else{
        $image = $input_image;
    }
<<<<<<< HEAD:project/update.php

   
    
    
    $input_sdate = trim($_POST["sdate"]);
=======
   
   
     $input_sdate = trim($_POST["sdate"]);
>>>>>>> 0d6fd774483693c3e63cc6ec8289c09b2be76f45:project/update.php
    if(empty($input_sdate)){
        $sdate_err = "Please enter an sdate.";     
    } else{
        $sdate = $input_sdate;
    }
<<<<<<< HEAD:project/update.php
    
    $input_edate = trim($_POST["edate"]);
=======
   



   $input_edate = trim($_POST["edate"]);
>>>>>>> 0d6fd774483693c3e63cc6ec8289c09b2be76f45:project/update.php
    if(empty($input_edate)){
        $edate_err = "Please enter an edate.";     
    } else{
        $edate = $input_edate;
    }
<<<<<<< HEAD:project/update.php
    


     $input_status = trim($_POST["status"]);
=======
   


   $input_status = trim($_POST["status"]);
>>>>>>> 0d6fd774483693c3e63cc6ec8289c09b2be76f45:project/update.php
    if(empty($input_status)){
        $status_err = "Please enter an status.";     
    } else{
        $status = $input_status;
    }
<<<<<<< HEAD:project/update.php

    // Validate salary
=======
   

   
    
    
    
>>>>>>> 0d6fd774483693c3e63cc6ec8289c09b2be76f45:project/update.php
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($description_err) && empty($image_err) &&  empty($sdate_err) && empty($edate_err) && empty($status_err)){
        // Prepare an update statement
        $sql = "UPDATE project SET name=?, description=?, image=?, sdate=?, edate=?, status=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssi", $param_name, $param_description, $param_image, $param_sdate, $param_edate, $param_status, $param_id);
            
            // Set parameters
            $param_name = $name;
            $param_description = $description;
            $param_image = $image;
            
            $param_sdate = $sdate;
            $param_edate = $edate;
           $param_status = $status;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
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
        $sql = "SELECT * FROM project WHERE id = ?";
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
                    $name = $row["name"];
                    $description = $row["description"];
                    $image = $row["image"];
                    
                    $sdate = $row["sdate"];
                    $edate = $row["edate"];
                    $status = $row["status"];
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
                        <div class="form-group <?php echo (!empty($product_name_err)) ? 'has-error' : ''; ?>">
                            <label>Project Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                            <label>Description</label>
                            <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                            <span class="help-block"><?php echo $description_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
                            <label>Project Image</label>
                            <input type="text" name="image" class="form-control" value="<?php echo $image; ?>">
                            <span class="help-block"><?php echo $image_err;?></span>
                        </div>
<<<<<<< HEAD:project/update.php
                        
                        <div class="form-group <?php echo (!empty($sdate_err)) ? 'has-error' : ''; ?>">
                            <label>Start Date</label>
                            <input type="date" name="sdate" class="form-control" value="<?php echo $sdate; ?>">
                            <span class`="help-block"><?php echo $sdate_err;?></span>
=======



                       <div class="form-group <?php echo (!empty($sdate_err)) ? 'has-error' : ''; ?>">
                            <label>Sdate</label>
                            <textarea name="sdate" class="form-control"><?php echo $sdate; ?></textarea>
                            <span class="help-block"><?php echo $sdate_err;?></span>
>>>>>>> 0d6fd774483693c3e63cc6ec8289c09b2be76f45:project/update.php
                        </div>
                        <div class="form-group <?php echo (!empty($edate_err)) ? 'has-error' : ''; ?>">
                            <label>End Date</label>
                            <input type="date" name="edate" class="form-control" value="<?php echo $edate; ?>">
                            <span class="help-block"><?php echo $edate_err;?></span>
                        </div>
                        

                        <div class="form-group <?php echo (!empty($status_err)) ? 'has-error' : ''; ?>">
                            <label>Status</label>
                            <input type="text" name="status" class="form-control" value="<?php echo $status; ?>">
                            <span class="help-block"><?php echo $status_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
