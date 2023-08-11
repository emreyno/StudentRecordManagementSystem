<?php
include('connection.php');
session_start();

if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}
 
        $class_num = $_POST['class_num'];
        $student_num = $_POST['student_num'];

        $queryp = "SELECT * FROM class WHERE course_num = $class_num";
        $resultp = mysqli_query($con,$queryp);
        if ($resultp->num_rows > 0){
            $rowp = $resultp->fetch_assoc();
            $c_id = $rowp["class_id"];
            $c_name = $rowp['course_title'];
        }

        $qwerp = "SELECT * FROM student WHERE stud_num = $student_num";
        $rqwerp = mysqli_query($con, $qwerp);
        if ($rqwerp->num_rows > 0){
            $rowq = $rqwerp->fetch_assoc();
            $stud_name = "".$rowq["f_name"]." ".$rowq["m_name"]." ".$rowq["l_name"]."";
        }

        
        //for the login history
        $log_name = $_SESSION['ln'];
        $status = $_SESSION['stat'];
        $action = "Enrolled [".$student_num."] - ".$stud_name." to [".$class_num."] - ".$c_name."";
        $sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
        $result1 = mysqli_query($con, $sql1);
       

        $query = "INSERT into enrolled (class_id, stud_num, final_grade, course_number) values ('$c_id', '$student_num', 0, $class_num)";
        echo $query;
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
        
            header("Location:indiv_class.php? id=$class_num");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
            header("Location:indiv_class.php? id=$class_num");
        }
     
?>