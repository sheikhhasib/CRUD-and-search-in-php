<?php
//process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    //include config file
    require_once "config.php";

    //prepare a delete statement 
    $sql = "DELETE FROM student_info WHERE id=?";
    if($stmt = mysqli_prepare($link,$sql)){
        //bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt,"i",$param_id);

        //set paremeters 
        $param_id = trim($_POST["id"]);
        if(mysqli_stmt_execute($stmt)){
            //record deleted successfully . redirect to landing page
            header("location: index.php");
            exit();
        }else{
            echo "Oops! something went wrong. please try again later";
        }
    }

    //close statement
    mysqli_stmt_close($stmt);

    //close connection
    mysqli_close($link);
}else{
    //check existence of id parameter 
    if(empty(trim($_GET["id"]))){
        header("location: error.php");
        exit();
    }
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
                        <h1>Delete Record</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
