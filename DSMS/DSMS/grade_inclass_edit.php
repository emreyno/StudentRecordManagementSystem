<?php include('connection.php');
session_start();

if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

 if (isset($_GET['ids'])){
        echo "1";
    $id=$_GET['ids'];
    $sql = "SELECT * FROM `enrolled` left join class using(class_id) 
    left join student using(stud_num) 
    WHERE enrolled_id=$id";
	$query=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($query);
 
 echo "Name: " .$row['f_name']. " ".$row['m_name']. " ".$row['l_name']. "</br>" ;
 echo "Name: " .$row['course_title']."</br>" ;

 //for the login history
 $log_name = $_SESSION['ln'];
 $status = $_SESSION['stat'];

 $name = "".$row['f_name']. " ".$row['m_name']. " ".$row['l_name']."";
 $class_title = "".$row['course_title']."";
 
 $action = "Edited Grade For ".$name." in Course ".$class_title."";
 $sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
 $result1 = mysqli_query($con, $sql1);
 ?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Grade</title>
</head>
<body>
	<h2>Edit Grade</h2>
	<form method="POST" action="update_inclass_grade.php">
        <label><?php echo $row['course_number']; ?></label> <input type="hidden" name="course_number" value="<?php echo $row['course_number']; ?>">
        <label></label> <input type="hidden" name="stud_num" value="<?php echo $row['stud_num']; ?>">
        <label></label> <input type="hidden" name="enrolled_id" value="<?php echo $row['enrolled_id']; ?>">
        <label></label> <input type="hidden" name="class_id" value="<?php echo $row['class_id']; ?>">
		<label>Grade:</label><input type="text" value="<?php echo $row['final_grade']; ?>" name="grade">
		<label>Status:</label>
                <select name="status" id="status">
        <?php if($row['status'] == "Pending") { ?>
                                    <option selected="selected" value="Pending">Pending</option>
                                    <option value="Complete">Complete</option>
                                    <option value="Incomplete">Incomplete</option>
                                    <option value="Removals">Removals</option>
                                    <option value="Failed">Failed</option>
                                    <option value="Dropped">Dropped</option> 
                            <?php } 
                            else if($row['status'] == "Complete"){ ?>
                                <option  value="Pending">Pending</option>
                                    <option selected="selected" value="Complete">Complete</option>
                                    <option value="Incomplete">Incomplete</option>
                                    <option value="Removals">Removals</option>
                                    <option value="Failed">Failed</option>
                                    <option value="Dropped">Dropped</option>
                                    
                            <?php }
                            else if($row['status'] == "Incomplete"){ ?>
                            <option  value="Pending">Pending</option>
                                    <option value="Complete">Complete</option>
                                    <option  selected="selected" value="Incomplete">Incomplete</option>
                                    <option value="Removals">Removals</option>
                                    <option value="Failed">Failed</option>
                                    <option value="Dropped">Dropped</option>
                            <?php } 
                            else if($row['status'] == "Removals"){ ?>
                            <option  value="Pending">Pending</option>
                                    <option value="Complete">Complete</option>
                                    <option  value="Incomplete">Incomplete</option>
                                    <option selected="selected" value="Removals">Removals</option>
                                    <option value="Failed">Failed</option>
                                    <option value="Dropped">Dropped</option>
                            <?php } 
                            else if($row['status'] == "Failed"){ ?>
                            <option  value="Pending">Pending</option>
                                    <option value="Complete">Complete</option>
                                    <option  value="Incomplete">Incomplete</option>
                                    <option value="Removals">Removals</option>
                                    <option selected="selected" value="Failed">Failed</option>
                                    <option value="Dropped">Dropped</option>
                            <?php }
                            else if($row['status'] == "Dropped"){ ?>
                            <option  value="Pending">Pending</option>
                                    <option value="Complete">Complete</option>
                                    <option  value="Incomplete">Incomplete</option>
                                    <option value="Removals">Removals</option>
                                    <option  value="Failed">Failed</option>
                                    <option selected="selected" value="Dropped">Dropped</option>
                                    <?php }else{ ?>
                            <option  value="Pending">Pending</option>
                                    <option value="Complete">Complete</option>
                                    <option  value="Incomplete">Incomplete</option>
                                    <option value="Removals">Removals</option>
                                    <option  value="Failed">Failed</option>
                                    <option value="Dropped">Dropped</option>
                                    <?php } ?>
                        </select>

                
            
                </select>

        
        
		<input type="submit" name="submit">

		<a href="indiv_class.php?id=<?php echo $row['course_number']; ?>">Back</a>
      
	</form>
</body>
</html> 
<?php }

else{
        if (isset($_GET['id'])){
                echo "2";
                $id=$_GET['id'];
                $sql = "SELECT * FROM `removal_grade` left join class using(class_id) 
                left join student using(stud_num) 
                WHERE removal_id=$id";
               
                    $query=mysqli_query($con,$sql);
                    $row=mysqli_fetch_array($query);
             
             echo "Name: " .$row['f_name']. " ".$row['m_name']. " ".$row['l_name']. "</br>" ;
             echo "Stud Num. " .$row['stud_num']. "</br>" ;
             echo "Course Title: " .$row['course_title']."</br>" ;
             ?>
            
            <!DOCTYPE html>
            <html>
            <head>
            <title>Basic MySQLi Commands</title>
            </head>
            <body>
                    <h2>Edit Grade</h2>
                    <form method="POST" action="update_removalgrade_inclass.php">
                    <label></label> <input type="hidden" name="course_num" value="<?php echo $row['course_num']; ?>">
                    <label></label> <input type="hidden" name="stud_num" value="<?php echo $row['stud_num']; ?>">
                    <label></label> <input type="hidden" name="class_id" value="<?php echo $row['class_id']; ?>">
                    <label></label> <input type="hidden" name="removal_id" value="<?php echo $row['removal_id']; ?>">
                <label>Initial Grade:</label><input type="text" value="<?php echo $row['initial_grade']; ?>" name="i_grade">
                <label>Removal Grade:</label><input type="text" value="<?php echo $row['removal_grade']; ?>" name="r_grade">
                            <label>Status:</label>
                    <select name="status" id="status">
                    <?php if($row['status'] == "Pending") { ?>
                                                <option selected="selected" value="Pending">Pending</option>
                                                <option value="Complete">Complete</option>
                                        <?php } 
                                        else if($row['status'] == "Complete"){ ?>
                                            <option  value="Pending">Pending</option>
                                                <option selected="selected" value="Complete">Complete</option>
                                                <?php }else{ ?>
                                        <option  value="Pending">Pending</option>
                                                <option value="Complete">Complete</option>
                                                <?php } ?>
                                    </select>
            
                            
                        
                            </select>
            
                    
                    
                            <input type="submit" name="submit">
            
                            <a href="indiv_student.php?id=<?php echo $row['stud_num']; ?>">Back</a>
                  
                    </form>
            </body>
            </html> 
            <?php }} ?>

