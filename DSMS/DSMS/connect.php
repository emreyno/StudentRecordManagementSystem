<?php
	session_start();
    include("connection.php");

    if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

    $stud_num    = $_POST['stud_num'];
    $degreeProg  = $_POST['degreeProg']; 
    $college     = $_POST['college'];
    $f_name      = $_POST['f_name'];
    $m_name      = $_POST['m_name']; 
    $l_name      = $_POST['l_name']; 
    $sex         = $_POST['sex']; 

    $conn = new mysqli('localhost','root','','DSMS');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
    	$stmt = $conn->prepare("insert into student(stud_num, degreeProg, college, f_name, m_name, l_name, sex) values(?, ?, ?, ?, ?, ?, ?)");
    	$stmt->bind_param("issssss", $stud_num, $degreeProg, $college, $f_name, $m_name, $l_name, $sex);
		$execval = $stmt->execute();
		//echo $execval;
		//echo "New student was successfully added to the database...";
		$_SESSION['isInserted']=true;
        $_SESSION['stud_success']=true;
		//for the login history
        $log_name = $_SESSION['ln'];
        $status = $_SESSION['stat'];

       	$action = "Added New Student - [".$stud_num."] ".$f_name."".$m_name."".$l_name."";
        $sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
        $result1 = mysqli_query($con, $sql1);

		header('Location: studentList.php');
		$stmt->close();
		$conn->close();
    }
?>