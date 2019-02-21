
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
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
                        <h2 class="pull-left">Product Details</h2>
                        <a href="logouts.php" class="btn btn-danger">Sign Out of Your Account</a>
                        <a href="creates.php" class="btn btn-success pull-right">Create Product</a>
                    </div>

                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM product";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Product_name</th>";
                                        echo "<th>Description</th>";
                                        echo "<th>Image</th>";
                                        echo "<th>Quantity</th>";
										 echo "<th>Sdate</th>";
										  echo "<th>Edate</th>";
										   echo "<th>Price</th>";
                                        echo "<th>Action</th>";
										
										
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['product_name'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
										
                                echo "<td><img src= ../product/image/" . $row['image'] . " alt='rose' width='50px' height='50px'></td>";



                                     echo "<td>" . $row['quantity'] . "</td>";
                                     
										echo "<td>" . $row['sdate'] . "</td>";
							            echo "<td>" . $row['edate'] . "</td>";
										echo "<td>" . $row['price'] . "</td>";

                                        
                                        echo "<td>";
                                            echo "<a href='reads.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='updates.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='deletes.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
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