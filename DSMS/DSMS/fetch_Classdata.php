<?php 
include('connection.php');
session_start();
if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

$output= array();
$sql = "SELECT * FROM class ";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'course_num',
	1 => 'course_title',
	2 => 'course_description',
	3 => 'course_year',
	4 => 'course_sem',
);

if(isset($_POST['search']['value']))
{
    $search_value = $_POST['search']['value'];
    $sql .= " WHERE course_title like '%".$search_value."%'";
    $sql .= " OR course_num like '%".$search_value."%'";
    $sql .= " OR course_description like '%".$search_value."%'";
    $sql .= " OR course_year like '%".$search_value."%'";
    $sql .= " OR course_sem like '%".$search_value."%'";
}

 if(isset($_POST['order']))
{
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
    $sql .= " ORDER BY course_num desc";
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
	$sub_array[] = $row['course_num'];
	$sub_array[] = $row['course_title'];
	$sub_array[] = $row['course_description'];
	$sub_array[] = $row['course_year'];
	$sub_array[] = $row['course_sem'];
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['course_num'].'"  class="btn btn-sm editbtn class-a" >Edit</a>  <a href="javascript:void();" data-id="'.$row['course_num'].'"  class="btn  btn-sm deleteBtn class-a" >Delete</a>  <a href="indiv_Class.php?id='.$row['course_num'].'"  class="btn  btn-sm generatebtn class-a"  >View</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
