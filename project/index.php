
<!-- http://www.vaerenbergh.com/blog/xdebug-and-sublime-text#comment-form -->

<!-- https://packagecontrol.io/packages/Xdebug%20Client#installation -->

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
                        <h2 class="pull-left">Users Details</h2>
                        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
                        <a href="create.php" class="btn btn-success pull-right">Create Project</a>
                    </div>
<<<<<<< HEAD:project/index.php
<img src="../project/image/2.jpg"width="200" height="200">
<img src="../project/image/3.jpg"width="200" height="200">
<img src="../project/image/1.jpg"width="200" height="200">
=======
<img src="../image/2.jpg"width="200" height="200">
<img src="../image/3.jpg"width="200" height="200">
<img src="../image/1.jpg"width="200" height="200">
>>>>>>> 0d6fd774483693c3e63cc6ec8289c09b2be76f45:project/index.php
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM project";
                    echo('csdcdcsdcsdcsd');
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            
                            echo "<table class='table table-bordered table-striped'>";
                                    echo "<tr>";
                                echo "<thead>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Description</th>";
                                        echo "<th>Image</th>";
										 echo "<th>Sdate</th>";
										  echo "<th>Edate</th>";
										   echo "<th>Status</th>";
                                        echo "<th>Action</th>";
										
										
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
										
<<<<<<< HEAD:project/index.php
                                echo "<td><img src= ../project/image/" . $row['image'] . " alt='rose' width='50px' height='50px'></td>";
=======
                                echo "<td><img src= ../image/" . $row['image'] . " alt='rose' width='50px' height='50px'></td>";
>>>>>>> 0d6fd774483693c3e63cc6ec8289c09b2be76f45:project/index.php



										echo "<td>" . $row['sdate'] . "</td>";
							            echo "<td>" . $row['edate'] . "</td>";
										echo "<td>" . $row['status'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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
    
    
</body>//
</html>