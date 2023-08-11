<?php
	include('connection.php');
    session_start();

    if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

    $id = $_POST['stud_num'];
    $class = $_POST['class_id'];
	$enrolled_id=$_POST['enrolled_id'];
	$grade=$_POST['grade'];
	$status=$_POST['status'];
    echo "fdf---" .$class;
 
	$query = "UPDATE `enrolled` set final_grade='$grade', status='$status' where enrolled_id='$enrolled_id'";
   // echo $query;
   $query_run = mysqli_query($con, $query);
   $sql2 = "SELECT * FROM `removal_grade` where stud_num = '$id' and class_id = $class; ";
   $result2 = mysqli_query($con,$sql2);
   $query3 = "UPDATE removal_grade  set initial_grade='$grade' where stud_num = '$id' and class_id = $class";
    if (mysqli_num_rows( $result2 )> 0){ 
        
        echo $query3;
        $result3 = mysqli_query($con, $query3);
    }
   

    if($query_run)
    {
        $_SESSION['StudGrade_updated']=true;
         if($status == "Removals"){
                $query2 = "INSERT into removal_grade (class_id, stud_num, initial_grade) values ($class, '$id',$grade)";
                echo $query2;
                $query2_run = mysqli_query($con, $query2);
                if($query2_run){
                    echo '<script> alert("removal Updated"); </script>';
                   
                }
                else
                {
                    echo '<script> alert("Data Not Updated"); </script>';
                  
                }           
                header("Location:indiv_student.php? id=$id");
                     
            }
    
    
            echo '<script> alert("Data Updated"); </script>';
         header("Location:indiv_student.php? id=$id");
            
            
        
    
}else{
        echo '<script> alert("Data Not Updated"); </script>';
       header("Location:indiv_student.php? id=$id");
    }


?>
