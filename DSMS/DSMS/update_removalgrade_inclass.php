<?php
	include('connection.php');
    session_start();

    if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}


    $id = $_POST['stud_num'];
    $class = $_POST['class_id'];
	$removal_id=$_POST['removal_id'];
	$i_grade=$_POST['i_grade'];
    $r_grade=$_POST['r_grade'];
	$status=$_POST['removeStatus'];
    $course_num=$_POST['course_num'];
    echo "fdf---" .$class;
 echo "   " .$id;
 echo "</br>" ;
	$query = "update `removal_grade` set initial_grade=$i_grade,removal_grade=$r_grade, removal_status='$status' where removal_id='$removal_id'";
   echo $query;
    $query_run = mysqli_query($con, $query);
   

    if($query_run)
    {
        

        $_SESSION['StudRemoval_updated']=true;
        echo '<script> alert("Data Updated"); </script>';
       header("Location:indiv_class.php?id=$course_num");
        
        
    }
    else
    {
        echo '<script> alert("Data Not Updated"); </script>';
    }


?>
