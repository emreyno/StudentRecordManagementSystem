<?php
require "fpdf.php";
include('connection.php');
session_start();

if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}


class myPDF extends FPDF{
	function header(){
		$this->Image('logo3.png',10,6);
		$this->SetFont('Times','B',14);
		$this->Cell(200,5,'STUDENT GRADE RECORD',0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(200,10,'University of the Philippines',0,0,'C');
		$this->Ln(20);
	}
	function footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	function headerTable(){
		$this->SetFont('Times','B', 10);
		$this->Cell(30,5,'Course Number',1,0,'C');
		$this->Cell(30,5,'Course Title',1,0,'C');
		$this->Cell(60,5,'Year Taken',1,0,'C');
		$this->Cell(70,5,'Final Grade',1,0,'C');
		$this->Ln();
	}

	function studentInfoHeader(){
		$this->SetFont('Times','B', 10);
		$this->Cell(30,5,'Student Number',1,0,'C');
		$this->Cell(55,5,'Name',1,0,'C');
		$this->Cell(20,5,'College',1,0,'C');
		$this->Cell(85,5,'Degree Program',1,0,'C');
		$this->Ln();
	}

	function studentInfo(){
		include('connection.php');
		$id = $_GET['id'];
		$this->SetFont('Times','',8);
		$sqla = "SELECT * FROM `student` WHERE stud_num = '$id' ";
		$resulta = mysqli_query($con,$sqla);
        if ($resulta->num_rows > 0){
        	while($rowa = $resulta->fetch_assoc()){
        		$this->SetFont('Times','B', 10);
				$this->Cell(30,5,$rowa['stud_num'],1,0,'C');
				$name = "".$rowa['f_name'].' '.$rowa['m_name'].' '.$rowa['l_name']."";
				$this->Cell(55,5,$name,1,0,'C');
				$this->Cell(20,5,$rowa['college'],1,0,'C');
				$this->Cell(85,5,$rowa['degreeProg'],1,0,'C');
				$this->Ln(10);
        	}
        }
	}


	function viewTable($con){
		$id = $_GET['id'];
		//echo $id;
		$this->SetFont('Times','',10);
		$sql = "SELECT *,enrolled.class_id as classid FROM `enrolled` left join class using(class_id) 
				left join student using(stud_num) 
				left join removal_grade using(stud_num, class_id)
				WHERE stud_num=$id";//$sql = "SELECT * FROM `student` where stud_num = '$id' ";
		//$stmt = $db->query($c);
        $result = mysqli_query($con,$sql);
        if ($result->num_rows > 0){
        	while($row = $result->fetch_assoc()){
				$class_id = $row["classid"];
				$sql2 = "SELECT * FROM `removal_grade` where stud_num = '$row[stud_num]' and class_id = $class_id; ";
				$result2 = mysqli_query($con,$sql2);
        		$this->SetFont('Times','B', 10);
				$this->Cell(30,5,$row['course_number'],1,0,'C');
				$this->Cell(30,5,$row['course_title'],1,0,'C');
				$taken = "A.Y. ".$row['course_year'].' '.$row['course_sem']." Semester";
				$this->Cell(60,5,$taken,1,0,'C');
				if (mysqli_num_rows( $result2 )> 0){ 
					$this->Cell(70,5,  "Initial Grade:" .$row['initial_grade'].
					"       Removal Grade:" .$row['removal_grade']
					
					,1,0,'C');
				}else{	$this->Cell(70,5,$row['final_grade'],1,0,'C');}

							
				$this->Ln();
        	}
        }else{
        	//echo "No data!";
        }
	}

}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4', 0);
$pdf->studentInfoHeader();
$pdf->studentInfo();
$pdf->headerTable();
$pdf->viewTable($con);
$pdf->Output();
