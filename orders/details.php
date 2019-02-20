
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
                        <h2 class="pull-left">Orders Details</h2>
                        
                        
                    </div>

                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM orders";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Card_num</th>";
                                        echo "<th>Card_cvc</th>";
										 echo "<th>Card_exp_month</th>";
										  echo "<th>Card_exp_year</th>";
										   echo "<th>Item_name</th>";
                                           echo "<th>Item_number</th>";
                                           echo "<th>Item_price</th>";
                                           echo "<th>Item_price_currency</th>";
                                           echo "<th>Paid_amount</th>";
                                           echo "<th>Paid_amount_currency</th>";
                                           echo "<th>Txn_id</th>";
                                           echo "<th>Payment_status</th>";
                                           echo "<th>Created</th>";
                                           echo "<th>Modified</th>";
                                           






                                        
										
										
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
										echo "<td>" . $row['card_num'] . "</td>";
                                        echo "<td>" . $row['card_cvc'] . "</td>";
                                        echo "<td>" . $row['card_exp_month'] . "</td>";
                                        echo "<td>" . $row['card_exp_year'] . "</td>";
                                        echo "<td>" . $row['item_name'] . "</td>";
                                        echo "<td>" . $row['item_number'] . "</td>";
                                        echo "<td>" . $row['item_price'] . "</td>";
                                        echo "<td>" . $row['item_price_currency'] . "</td>";
                                        echo "<td>" . $row['paid_amount'] . "</td>";
                                        echo "<td>" . $row['paid_amount_currency'] . "</td>";
                                        echo "<td>" . $row['txn_id'] . "</td>";
                                        echo "<td>" . $row['payment_status'] . "</td>";





							            echo "<td>" . $row['created'] . "</td>";
										echo "<td>" . $row['modified'] . "</td>";

                                        
                                        
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