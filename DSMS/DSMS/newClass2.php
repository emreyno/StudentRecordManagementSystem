<?php
session_start();
//DB connection
include("connection.php");
//End of DB connection
error_reporting(0);

if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

if(isset($_POST['add'])){
   // echo "It went inside isset yesh";
    $class_num = $_POST['class_num'];
    $class_desc = $_POST['class_desc'];
    $class_title = $_POST['class_title'];
    $class_year = $_POST['class_year'];
    $class_sem = $_POST['class_sem'];

    //$a=array();
    //$b=array();


    if(!empty($class_num) && !empty($class_desc) && !empty($class_title) && !empty($class_year) && !empty($class_sem)){
        $query1a = "INSERT INTO class (course_num,course_description,course_title,course_year,course_sem) VALUES ('$class_num','$class_desc'
        ,'$class_title','$class_year','$class_sem')";
        $res1a = mysqli_query($con, $query1a);
        $classID = mysqli_insert_id($con);

        //for the login history
        $log_name = $_SESSION['ln'];
        $status = $_SESSION['stat'];

        $action = "Added New Class - [".$class_num."] ".$class_title."";
        $sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
        $result1 = mysqli_query($con, $sql1);

        //$_SESSION['class_id'] = $classID;
        //$_SESSION['class_num'] = $class_num;
        //$_SESSION['class_desc'] = $class_desc;
        //$_SESSION['class_title'] = $class_title;

        //$_SESSION['a'] = $a;
        //$_SESSION['b'] = $b;
        $_SESSION['class_success'] =true;
        header("Location: classList.php");
        die;
    }
}
?>


<!--<?php include('connection.php'); ?>-->

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="icon" type="image/x-icon" href="icon1.png">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Source+Serif+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<title>New Class</title>
</head>
<body class="custom-body">
<div class="custom-head">
        <div class="px-3 custom-head-content mx-auto  ">
        <h1 style = "text-align: left; margin-top:60px;">DIGITAL STUDENT RECORD MANAGEMENT</h1>
            <!--<p>By Ch!lly Alpha</p>-->
        </div>

    </div>

    <?php
        include "header.php";
    ?>    

    <div class="py-5 custom-content mx-auto">
        <div class="custom-form-container mx-auto">
            <p class="form-title">New Class Form</p>
            <div class="line"></div>

            <form class="custom-form" method="post" name="add" action="./newClass2.php">
                <p class="field-title">CLASS INFORMATION</p>
                <div class="form-fields mx-auto">

                    <div class="fields-col-1" >
                        <input  name="class_num" type="number" placeholder="Class Number">
                    </div>

                    

                    <div class="class-col-2" >
                        <input  name="class_title" type="text" placeholder="Class Title e.g. 'CMSC 162'">
                        <input  name="class_desc" type="text" placeholder="Class Decription e.g. 'Artifical Intelligence'">
                    </div>

                    <!-- <div class="class-col-2" >
                        <input  name="class_year" type="text" placeholder="Academic Year e.g. '2021-2022'">
                        
                        

                        
                        <select  class="select" name="class_sem" required>
                        <option selected="selected" value="">Select Semester</option>
                            <option value="1st">First Semester</option>
                            <option value="2nd">Second Semester</option>
                            <option value="Midyear">Midyear</option>                       
                        </select>
                    </div> -->

                    <div class="class-col-2" >
                    <input  name="class_year" type="text" placeholder="Academic Year e.g. '2021-2022'">
                        
                        <!-- <select  class="" name="class_year" required>
                        <option selected="selected" value="">Select Academic Year</option>
                            <option value="2021-2022">2021-2022</option>
                            <option value="2020-2021">2020-2021</option>
                            <option value="2019-2020">2019-2020</option>
                            <option value="2018-2019">2018-2019</option>
                            <option value="2017-2018">2017-2018</option>
                            <option value="2016-2017">2016-2017</option>
                            <option value="2015-2016">2015-2016</option>
                            <option value="2014-2015">2014-2015</option>
                            <option value="2013-2014">2013-2014</option>
                            <option value="2012-2013">2012-2013</option>
                        </select> -->

                        
                        <select  class="" name="class_sem" required>
                        <option selected="selected" value="">Select Semester</option>
                            <option value="1st">First Semester</option>
                            <option value="2nd">Second Semester</option>
                            <option value="Midyear">Midyear</option>
                            
                        </select>
                    </div>

                   
                </div>
                
                <!--<button type="submit" class="add btn btn-primary" name="add">Add Class</button>-->
                <button type="submit" class="btn add" name="add">Add</button>
                </div>
                
                
            </form>
            
        </div>



    </div>
    <body onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()">
 
<script type="text/javascript">
 
var timer = setInterval(function(){ auto_logout() }, 60000);
 
  
function reset_interval(){
 
    clearInterval(timer);
  
    timer = setInterval(function(){ auto_logout() }, 60000);
 
}
 
function auto_logout(){
    
        alert("Session expired. To continue please login again.")

        window.location="logout.php";
 
}
</script>
</body>
</html>



