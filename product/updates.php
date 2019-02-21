<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$product_name  = $description = $image = $quantity = $sdate = $edate =  $price = "";
$product_name_err = $description_err = $image_err = $quantity_err = $sdate_err = $edate_err = $price_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["product_name"]);
    if(empty($input_name)){
        $product_name_err = "Please enter a product name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $product_name_err = "Please enter a valid product name.";
    } else{
        $product_name = $input_name;
    }
    
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter an description.";     
    } else{
        $description = $input_description;
    }
    
    
    $input_image = trim($_POST["image"]);
    if(empty($input_image)){
        $image_err = "Please enter an image.";     
    } else{
        $image = $input_image;
    }

    $input_quantity = trim($_POST["quantity"]);
    if(empty($input_quantity)){
        $quantity_err = "Please enter an quantity.";     
    } else{
        $quantity = $input_quantity;
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
    
     


     $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter an price.";     
    } else{
        $price = $input_price;
    }
    // Validate salary
    
    // Check input errors before inserting in database
    if(empty($product_name_err) && empty($description_err) && empty($image_err) && empty($quantity_err) && empty($sdate_err) && empty($edate_err)&& empty($price_err)){
        // Prepare an update statement
        $sql = "UPDATE product SET product_name=?, description=?, image=?, quantity=?,sdate=?, edate=?, price=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssi", $param_product_name, $param_description, $param_image, $param_quantity , $param_sdate, $param_edate, $param_price, $param_id);
            
            // Set parameters
            $param_product_name = $product_name;
            $param_description = $description;
            $param_image = $image;
            $param_quantity = $quantity;
            $param_sdate = $sdate;
            $param_edate = $edate;
            $param_price = $price;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: indexs.php");
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
        $sql = "SELECT * FROM product WHERE id = ?";
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
                    $product_name = $row["product_name"];
                    $description = $row["description"];
                    $image = $row["image"];
                    $quantity = $row["quantity"];
                    $sdate = $row["sdate"];
                    $edate = $row["edate"];
                    $price = $row["price"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: errors.php");
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
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control" value="<?php echo $product_name; ?>">
                            <span class="help-block"><?php echo $product_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                            <label>Description</label>
                            <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                            <span class="help-block"><?php echo $description_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
                            <label>Image</label>
                            <input type="text" name="image" class="form-control" value="<?php echo $image; ?>">
                            <span class="help-block"><?php echo $image_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($quantity_err)) ? 'has-error' : ''; ?>">
                            <label>Quantity</label>
                            <input type="text" name="quantity" class="form-control" value="<?php echo $quantity; ?>">
                            <span class="help-block"><?php echo $quantity_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($sdate_err)) ? 'has-error' : ''; ?>">
                            <label>Start Date</label>
                            <input type="date" name="sdate" class="form-control" value="<?php echo $sdate; ?>">
                            <span class`="help-block"><?php echo $sdate_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($edate_err)) ? 'has-error' : ''; ?>">
                            <label>End Date</label>
                            <input type="date" name="edate" class="form-control" value="<?php echo $edate; ?>">
                            <span class="help-block"><?php echo $edate_err;?></span>
                        </div>


                        <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                            <span class="help-block"><?php echo $price_err;?></span>
                        </div>
                        
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="indexs.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
