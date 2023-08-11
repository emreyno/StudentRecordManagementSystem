<?php 
include('connection.php');
session_start();
if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

$output= array();
$sql = "SELECT * FROM student "; 


$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);



$columns = array(
	0 => 'stud_num',
	1 => 'f_name',
	2 => 'm_name',
	3 => 'l_name',
	4 => 'college',
	5 => 'degreeProg',
	6 => 'sex',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE f_name like '%".$search_value."%'";
	$sql .= " OR l_name like '%".$search_value."%'";
	$sql .= " OR m_name like '%".$search_value."%'";
	$sql .= " OR stud_num like '%".$search_value."%'";
	$sql .= " OR degreeProg like '%".$search_value."%'";
	$sql .= " OR college like '%".$search_value."%'";
	$sql .= " OR sex like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY stud_num desc";
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
	$sub_array[] = $row['stud_num' ];
	$sub_array[] = $row['f_name'];
	$sub_array[] = $row['m_name'];
	$sub_array[] = $row['l_name'];	
	$sub_array[] = $row['college'];
	$sub_array[] = $row['degreeProg'];	
	$sub_array[] = $row['sex'];
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['stud_num'].'"  class="btn btn-sm editbtn class-a" >Edit</a>  					
					<a href="javascript:void();" data-id="'.$row['stud_num'].'"  class="btn  btn-sm deleteBtn class-a" >Delete</a> 
					<a href="indiv_student.php? id='.$row['stud_num'].'"  class="btn  btn-sm generatebtn class-a"  >View</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
