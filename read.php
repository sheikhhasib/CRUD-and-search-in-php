<?php
//check existence of id peramerter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    //include config file
    require_once "config.php";

    //prepare a select statement 

    $sql = "SELECT * FROM student_info WHERE id = ?";
    if($stmt= mysqli_prepare($link,$sql)){
        //bind variables to  the prepared statement as parameters
        mysqli_stmt_bind_param($stmt,"i",$param_id);

        //set premeters 
        $param_id = trim($_GET["id"]);

        //attemt to execute the prepared statement 
        if(mysqli_stmt_execute($stmt)){
            $result  =  mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result)==1){
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

                //Retrieve individual filed value
                $name = $row['name'];
                $father = $row['father'];
                $dateofb = $row['dateofb'];
                $age = $row['age'];
                $mstatus = $row['mstatus'];
                $religion = $row['religion'];
                $nationality = $row['nationality'];
                
            }else{
                //URL doesn't contain valid id parameter .redirect to error page
                header("location: error.php");
                exit();
            }

        }else{
            echo "Oops ! something went wrong.Please try again later";
        }
    }
    mysqli_stmt_close($stmt);
    //close connection
    mysqli_close($link);
    
}else{
    //url doesn't contain id parameter .redirect t error page 
    header("location: error.php");
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
                        <label>Name</label>
                        <p class="form-control-static"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Father</label>
                        <p class="form-control-static"><?php echo $row["father"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <p class="form-control-static"><?php echo $row["dateofb"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Age </label>
                        <p class="form-control-static"><?php echo $row["age"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Maritial status</label>
                        <p class="form-control-static"><?php echo $row["mstatus"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Religion</label>
                        <p class="form-control-static"><?php echo $row["religion"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Nationality</label>
                        <p class="form-control-static"><?php echo $row["nationality"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>