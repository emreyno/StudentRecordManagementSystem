<?php include('connection.php');
session_start();

if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

$id = $_POST['id'];
$sql = "SELECT * FROM class WHERE course_num='$id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
