<?php
include 'welcome.php';
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $description = $image = $sdate = $edate = $status = "";
$name_err = $description_err = $image_err = $sdate_err = $edate_err = $status_err = "";
 
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
	$input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter an description.";     
    } else{
        $description = $input_description;
    }
    
    // Validate address
    $input_image = trim($_POST["image"]);
    if(empty($input_image)){
        $image_err = "Please enter an image.";     
    } else{
        $image = $input_image;
    }
	
	$input_sdate = trim($_POST["sdate"]);
    if(empty($input_sdate)){
        $sdate_err = "Please enter an sdate.";     
    } else{
        $sdate = $input_sdate;
    }
	
	$input_edate = trim($_POST["edate"]);
    if(empty($input_edate)){
        $edate_err = "Please enter an edate.";     
    } else{
        $edate = $input_edate;
    }
	

    // Validate salary
    $input_status = trim($_POST["status"]);
    if(empty($input_status)){
        $status_err = "Please enter an status.";     
    } else{
        $status = $input_status;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($description_err) && empty($image_err) && empty($sdate_err) && empty($edate_err) && empty($status_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO project (name,description ,image,sdate,edate,status,users_id ) VALUES (?, ?, ?, ? , ? ,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_name, $param_description, $param_image,$param_sdate,$param_edate,$param_status, $param_users_id);
            
            // Set parameters
            $param_name = $name;
            $param_description = $description;
			$param_image = $image;
			$param_sdate = $sdate;
			$param_edate = $edate;
            $param_status = $status;
            $param_users_id = htmlspecialchars($_SESSION["id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Create Project</h2>
                        
                    </div>
                    <p>Please fill this form and submit to add project record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
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
                            <input type="file" name="image" class="form-control" value="<?php echo $image; ?>">
                            <span class="help-block"><?php echo $image_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($sdate_err)) ? 'has-error' : ''; ?>">
                            <label>Start Date</label>
                            <input type="date" name="sdate" class="form-control" value="<?php echo $sdate; ?>">
                            <span class="help-block"><?php echo $sdate_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($edate_err)) ? 'has-error' : ''; ?>">
                            <label>End Date</label>
                            <input type="date" name="edate" class="form-control" value="<?php echo $edate; ?>">
                            <span class="help-block"><?php echo $edate_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($status_err)) ? 'has-error' : ''; ?>">
                            <label>Status</label>
                            
							<select name="status" class="form-control" value="<?php echo $status; ?>">
                              <option value="true">True</option>
                                <option value="false">False</option>
                                  
                                       </select>
                           <span class="help-block"><?php echo $status_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
						</br>
						</br>
						</br>
						</br>
                    </form>
                    <p> 
       
                </div>
            </div>        
        </div>
    </div>
<!DOCTYPE html>
<html lang="en">
<head>
   
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b>. Welcome to our site.</h1>

        <b><?php echo htmlspecialchars($_SESSION["id"]); ?></b>
    </div>
</body>
</html>
    
</body>
</html>