<?php
include('connection.php');
session_start();

if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}
 
        $stud_id = $_POST['stud_id'];
        $course_id = $_POST['course'];

        $queryp = "SELECT * FROM class WHERE class_id = $course_id";
        $resultp = mysqli_query($con,$queryp);
        if ($resultp->num_rows > 0){
            $rowp = $resultp->fetch_assoc();
            $c_num = $rowp["course_num"];
            $c_name = $rowp['course_title'];
        }

        $qwerp = "SELECT * FROM student WHERE stud_num = $stud_id";
        $rqwerp = mysqli_query($con, $qwerp);
        if ($rqwerp->num_rows > 0){
            $rowq = $rqwerp->fetch_assoc();
            $stud_name = "".$rowq["f_name"]." ".$rowq["m_name"]." ".$rowq["l_name"]."";
        }
        
       //for the login history
        $log_name = $_SESSION['ln'];
        $status = $_SESSION['stat'];
        $action = "Enrolled [".$stud_id."] - ".$stud_name." to [".$c_num."] - ".$c_name."";
        $sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
        $result1 = mysqli_query($con, $sql1);


        $query = "INSERT into enrolled (class_id, stud_num, final_grade, course_number) values ('$course_id', '$stud_id', 0, $c_num)";
        echo $query;
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            // $_SESSION['stud_success']=true;
            header("Location:indiv_student.php? id=$stud_id");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
            header("Location:indiv_student.php? id=$stud_id");
        }
    
?>