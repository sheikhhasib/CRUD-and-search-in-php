<?php

//include config file
require_once "config.php";
//define variable and initialize with empty values
$name = $father = $dateofb = $age = $mstatus = $religion = $nationality ="";
$name_err = $father_err = $dateofb_err = $age_err = $mstatus_err = $religion_err = $nationality_err = "";

//processing from data when form submitted
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
    //validate father name 
    // Validate name
    $father_name = trim($_POST["father"]);
    if(empty($father_name)){
        $father_err = "Please enter your father name.";
    } elseif(!filter_var($father_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $father_err = "Please enter a valid name.";
    } else{
        $father = $father_name;
    }
    //validate maritial status
    $mstatus_name = trim($_POST["mstatus"]);
    if(empty($mstatus_name)){
        $mstatus_err = "Please enter maritial status.";
    } elseif(!filter_var($mstatus_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $mstatus_err = "Please enter a maritial status.";
    } else{
        $mstatus = $mstatus_name;
    }

    //validation religion
    $religion_name = trim($_POST["religion"]);
    if(empty($religion_name)){
        $religion_err = "Please enter religion.";
    } elseif(!filter_var($religion_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $religion_err = "Please enter religion.";
    } else{
        $religion = $religion_name;
    }

    //validation nationality
    $nationality_name = trim($_POST["nationality"]);
    if(empty($nationality_name)){
        $nationality_err = "Please enter nationality .";
    } elseif(!filter_var($nationality_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nationality_err = "Please enter nationality.";
    } else{
        $nationality = $nationality_name;
    }
    // Validate date of birth
    $input_dateofb = trim($_POST["dateofb"]);
    if(empty($input_dateofb)){
        $dateofb_err = "Please enter an date of birth.";     
    } else{
        $dateofb = $input_dateofb;
    }

     // Validate date of birth
     $input_age = trim($_POST["age"]);
     if(empty($input_age)){
         $age_err = "Please enter your age.";     
     } else{
         $age = $input_age;
     }


     //check input errors before inserting in database
     if(empty($name_err) && empty($father_err) && empty($dateofb_err) && empty($age_err) && empty($mstatus_err) && empty($religion_err)  && empty($nationality_err)){
         $sql = "INSERT INTO student_info ( name, father, dateofb, age, mstatus,religion, nationality) VALUES (?,?,?,?,?,?,?)";
         
         if($stmt = mysqli_prepare($link,$sql)){
             //bind variable to the prepared statement as parameters
             mysqli_stmt_bind_param($stmt, "sssssss", $param_name, $param_father, $param_dateofb,$param_age,$param_mstatus,$param_religion,$param_nationality);
            
             // Set parameters
             $param_name = $name;
             $param_father = $father;
             $param_dateofb = $dateofb;
             $param_age = $age;
             $param_mstatus = $mstatus;
             $param_religion = $religion;
             $param_nationality = $nationality;


             //attempt to execute the prepared statement
             if(mysqli_stmt_execute($stmt)){
                 //records created successfully .refirect to  landing page
                 header("location: index.php");
                 exit();
             }else{
                 echo "Something went wrong .Please try again later .";
             }
         }
        //close statement
        mysqli_stmt_close($stmt);
     }
      



//close connection
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
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($father_err)) ? 'has-error' : ''; ?>">
                            <label>Father</label>
                            <input type="text" name="father" class="form-control" value="<?php echo $father; ?>">
                            <span class="help-block"><?php echo $father_err;?></span>
                        </div>
                        
                        
                        
                        <div class="form-group <?php echo (!empty($mstatus_err)) ? 'has-error' : ''; ?>">
                            <label>Marital Status</label>
                            <input type="text" name="mstatus" class="form-control" value="<?php echo $mstatus; ?>">
                            <span class="help-block"><?php echo $mstatus_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($religion_err)) ? 'has-error' : ''; ?>">
                            <label>Religion</label>
                            <input type="text" name="religion" class="form-control" value="<?php echo $religion; ?>">
                            <span class="help-block"><?php echo $religion_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($nationality_err)) ? 'has-error' : ''; ?>">
                            <label>Nationality</label>
                            <input type="text" name="nationality" class="form-control" value="<?php echo $nationality; ?>">
                            <span class="help-block"><?php echo $nationality_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($dateofb_err)) ? 'has-error' : ''; ?>">
                        <label>Date of Birth</label>
                        <input type="date" name="dateofb" class="form-control" id="exampleInputDOB1" value="<?php echo $dateofb; ?>" placeholder="Date of Birth">
                        <span class="help-block"><?php echo $dateofb_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($age_err)) ? 'has-error' : ''; ?>">
                            <label>Age</label>
                            <input type="number" name="age" class="form-control" value="<?php echo $age; ?>">
                            <span class="help-block"><?php echo $age_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>