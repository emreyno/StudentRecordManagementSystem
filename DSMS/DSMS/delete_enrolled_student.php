<?php
session_start(); 
include('connection.php');

if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

//$id = $_POST['id'];


if (isset($_GET['removeCourse'])){

    $id = $_GET['removeCourse'];

    $sql2 = "SELECT * FROM enrolled WHERE enrolled_id = $id";
        $result2 = mysqli_query($con,$sql2);
        if ($result2->num_rows > 0){
            $row2 = $result2->fetch_assoc();
            $c_id = $row2["course_number"];
            $s_id = $row2['stud_num'];
        }

    $sql3 = "SELECT * FROM class WHERE course_num = $c_id";
        $result3 = mysqli_query($con,$sql3);
        if ($result3->num_rows > 0){
            $row3 = $result3->fetch_assoc();
            $c_name = $row3["course_title"];
        }

    $sql4 = "SELECT * FROM student WHERE stud_num = $s_id";
        $result4 = mysqli_query($con,$sql4);
        if ($result4->num_rows > 0){
            $row4 = $result4->fetch_assoc();
            $stud_name = "".$row4["f_name"]." ".$row4["m_name"]." ".$row4["l_name"]."";
        }

    //for the login history
    $log_name = $_SESSION['ln'];
    $status = $_SESSION['stat'];
    $action = "Deleted [".$s_id."] - ".$stud_name." from [".$c_id."] - ".$c_name."";
    $sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
    $result1 = mysqli_query($con, $sql1);

    $query = "DELETE FROM enrolled WHERE enrolled_id = $id";
    echo $query;
    $query_run = mysqli_query($con, $query);


if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            $_SESSION['StudClass_removed']=true;
            header("Location:indiv_student.php? id=$s_id");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
}


if (isset($_GET['deleteRemoval'])){

    $id = $_GET['deleteRemoval'];

        $sql2 = "SELECT * FROM removal_grade WHERE removal_id = $id";
            $result2 = mysqli_query($con,$sql2);
            if ($result2->num_rows > 0){
                $row2 = $result2->fetch_assoc();
                $c_id = $row2["stud_num"];
                $class_id = $row2["class_id"];
            }
    
        $query = "DELETE FROM removal_grade WHERE removal_id = $id";
        echo $query;
        $query_run = mysqli_query($con, $query);
        $query2 = "update enrolled set status='Pending' where class_id = $class_id and stud_num ='$c_id'";
       mysqli_query($con, $query2);
    
    if($query_run)
            {
                // echo '<script> alert("Data Updated"); </script>';
                $_SESSION['StudRemoval_updated']=true;
                header("Location:indiv_student.php?id=$c_id");
            }
            else
            {
                echo '<script> alert("Data Not Updated"); </script>';
            }
        }

?>