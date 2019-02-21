<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: logins.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
     
        body{ font: 14px sans-serif; text-align: center; }

       
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b>. Welcome to our site.</h1>

        <b><?php echo htmlspecialchars($_SESSION["id"]); ?></b>
    </div>
    <p>
        <a href="indexs.php" class="btn btn-info">Create Orders</a>
	    <a href="indexs.php" class="btn btn-info">Create Product</a>
        <a href="reset-passwords.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logouts.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>