<?php
include 'welcomes.php';
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$product_name = $description = $image = $quantity = $sdate = $edate = "";
$product_name_err = $description_err = $image_err = $quantity_err = $sdate_err = $edate_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name

    $input_product_name = trim($_POST["product_name"]);
    if(empty($input_product_name)){
        $product_name_err = "Please enter a product_name.";
    } elseif(!filter_var($input_product_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $product_name_err = "Please enter a valid product_name.";
    } else{
        $product_name = $input_product_name;
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
	

   
    
    // Check input errors before inserting in database
    if(empty($product_name_err) && empty($description_err) && empty($image_err) && empty($quantity_err) && empty($sdate_err) && empty($edate_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO product (product_name,description,image,quantity,sdate,edate,users_id ) VALUES (?, ?, ?, ? , ? ,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_product_name, $param_description, $param_image,$param_quantity,$param_sdate,$param_edate,$param_users_id);
            
            // Set parameters
            $param_product_name = $product_name;
            $param_description = $description;
			$param_image = $image;
            $param_quantity = $quantity;
			$param_sdate = $sdate;
			$param_edate = $edate;
            
            $param_users_id = htmlspecialchars($_SESSION["id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
                        <h2>Create Product</h2>
                        
                    </div>
                    <p>Please fill this form and submit to add product record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($product_name_err)) ? 'has-error' : ''; ?>">
                            <label>Product_Name</label>
                            <input type="text" name="product_name" class="form-control" value="<?php echo $product_name; ?>">
                            <span class="help-block"><?php echo $product_name_err;?></span>
                        </div>


                        <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                            <label>Description</label>
                            <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                            <span class="help-block"><?php echo $description_err;?></span>
                        </div>


                        <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
                            <label> Product_Image</label>
                            <input type="file" name="image" class="form-control" value="<?php echo $image; ?>">
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
                            <span class="help-block"><?php echo $sdate_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($edate_err)) ? 'has-error' : ''; ?>">
                            <label>End Date</label>
                            <input type="date" name="edate" class="form-control" value="<?php echo $edate; ?>">
                            <span class="help-block"><?php echo $edate_err;?></span>
                        </div>
						
  
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="indexs.php" class="btn btn-default">Cancel</a>
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