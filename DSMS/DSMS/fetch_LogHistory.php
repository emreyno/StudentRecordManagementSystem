<?php 
include('connection.php');
session_start();
if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

$output= array();
$sql = "SELECT * FROM login_history "; 


$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);



$columns = array(
	// 0 => 'log_id',
	0 => 'log_name',
	1 => 'log_status',
	2 => 'action',
	3 => 'log_time'
	
,
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE log_name like '%".$search_value."%'";
	$sql .= " OR log_status like '%".$search_value."%'";
	$sql .= " OR action like '%".$search_value."%'";
	$sql .= " OR log_time like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY log_time desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{

	$sub_array = array();
	// $sub_array[] = $row['log_id'];
	$sub_array[] = $row['log_name'];
	$sub_array[] = $row['log_status'];
	$sub_array[] = $row['action'];
	$sub_array[] = $row['log_time'];
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
