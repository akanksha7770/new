<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM product WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["product_name"];
                $description = $row["description"];
				$image = $row["image"];
                $quantity = $row["quantity"];
				$sdate = $row["sdate"];
				$edate = $row["edate"];
<<<<<<< HEAD
               $price = $row["price"];
=======
               
>>>>>>> 0d6fd774483693c3e63cc6ec8289c09b2be76f45
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: errors.php");
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
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: errors.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Product_name</label>
                        <p class="form-control-static"><?php echo $row["product_name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <p class="form-control-static"><?php echo $row["description"]; ?></p>
                    </div>
					<div class="form-group">
<<<<<<< HEAD
                        <label>Image</label>
=======
                        <label>Product_Image</label>
>>>>>>> 0d6fd774483693c3e63cc6ec8289c09b2be76f45
                        <p class="form-control-static"><?php echo $row["image"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Quantity</label>
                        <p class="form-control-static"><?php echo $row["quantity"]; ?></p>
                    </div>

					<div class="form-group">
                        <label>Sdate</label>
                        <p class="form-control-static"><?php echo $row["sdate"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Edate</label>
                        <p class="form-control-static"><?php echo $row["edate"]; ?></p>
                    </div>
                    
<<<<<<< HEAD

                    <div class="form-group">
                        <label>Price</label>
                        <p class="form-control-static"><?php echo $row["price"]; ?></p>
                    </div>
=======
>>>>>>> 0d6fd774483693c3e63cc6ec8289c09b2be76f45
                    <p><a href="indexs.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
<<<<<<< HEAD
</html>

=======
</html>
>>>>>>> 0d6fd774483693c3e63cc6ec8289c09b2be76f45
