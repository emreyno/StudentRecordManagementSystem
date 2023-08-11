<?php
require "fpdf.php";
include('connection.php');
//$db = new PDO('mysql:host=localhost;dbname=dsms5','root', '');

//if (isset($_GET['id'])){
    //$id = $_GET['id'];
 
//}

//$stud_num = $_POST['id'];
//$id = $_GET['id'];


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
		$this->Cell(65,5,'Course Title',1,0,'C');
		$this->Cell(60,5,'Year Taken',1,0,'C');
		$this->Cell(33,5,'Final Grade',1,0,'C');
		$this->Ln();
	}

	function studentInfoHeader(){
		$this->SetFont('Times','B', 10);
		$this->Cell(30,5,'Student Number',1,0,'C');
		$this->Cell(65,5,'Name',1,0,'C');
		//$this->Cell(60,5,'College',1,0,'C');
		//$this->Cell(33,5,'Degree Program',1,0,'C');
		$this->Ln();
	}

	function studentInfoHeader2(){
		$this->SetFont('Times','B', 10);
		//$this->Cell(30,5,'Student Number',1,0,'C');
		//$this->Cell(65,5,'Name',1,0,'C');
		$this->Cell(100,5,'College',1,0,'C');
		$this->Cell(100,5,'Degree Program',1,0,'C');
		$this->Ln();
	}

	function studentInfoHeader3(){
		$this->SetFont('Times','B', 10);
		//$this->Cell(30,5,'Student Number',1,0,'C');
		//$this->Cell(65,5,'Name',1,0,'C');
		//$this->Cell(60,5,'College',1,0,'C');
		$this->Cell(100,5,'Degree Program',1,0,'C');
		$this->Ln();
	}

	function studentInfo2(){
		include('connection.php');
		$id = $_GET['id'];
		$this->SetFont('Times','',8);
		$sqla = "SELECT * FROM `student` WHERE stud_num = '$id' ";
		$resulta = mysqli_query($con,$sqla);
        if ($resulta->num_rows > 0){
        	while($rowa = $resulta->fetch_assoc()){
        		$this->SetFont('Times','B', 10);
				//$this->Cell(30,5,$rowa['stud_num'],1,0,'C');
				//$name = "".$rowa['f_name'].' '.$rowa['m_name'].' '.$rowa['l_name']."";
				//$this->Cell(65,5,$name,1,0,'C');
				$this->Cell(100,5,$rowa['college'],1,0,'C');
				$this->Cell(100,5,$rowa['degreeProg'],1,0,'C');
				$this->Ln(10);
        	}
        }
	}

	function studentInfo3(){
		include('connection.php');
		$id = $_GET['id'];
		$this->SetFont('Times','',8);
		$sqla = "SELECT * FROM `student` WHERE stud_num = '$id' ";
		$resulta = mysqli_query($con,$sqla);
        if ($resulta->num_rows > 0){
        	while($rowa = $resulta->fetch_assoc()){
        		$this->SetFont('Times','B', 10);
				//$this->Cell(30,5,$rowa['stud_num'],1,0,'C');
				//$name = "".$rowa['f_name'].' '.$rowa['m_name'].' '.$rowa['l_name']."";
				//$this->Cell(65,5,$name,1,0,'C');
				//$this->Cell(60,5,$rowa['college'],1,0,'C');
				$this->Cell(100,5,$rowa['degreeProg'],1,0,'C');
				$this->Ln(10);
        	}
        }
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
				$this->Cell(65,5,$name,1,0,'C');
				//$this->Cell(60,5,$rowa['college'],1,0,'C');
				//$this->Cell(33,5,$rowa['degreeProg'],1,0,'C');
				$this->Ln(10);
        	}
        }
	}
	/*function viewTable($con){
		$id = $_GET['id'];
		$this->SetFont('Times','',10);
		$c = "SELECT * FROM `enrolled` left join class using(class_id) 
                                    left join student using(stud_num) 
                                    WHERE stud_num=".$id."";
		$stmt = $db->query($c);
		while($data = $stmt->fetch(PDO::FETCH_OBJ)){
			$this->SetFont('Times','B', 10);
			$this->Cell(30,5,$data['']->Course_Number,1,0,'C');
			$this->Cell(65,5,$data->Course_Title,1,0,'C');
			$this->Cell(60,5,'Year Taken',1,0,'C');
			//$this->Cell(33,5,'Final Grade',1,0,'C');
			$this->Ln();
		}
	}*/

	function viewTable($con){
		$id = $_GET['id'];
		//echo $id;
		$this->SetFont('Times','',10);
		$sql = "SELECT * FROM `enrolled` left join `class` using(class_id) left join `student` using(stud_num) WHERE stud_num = '$id' ";
		//$sql = "SELECT * FROM `student` where stud_num = '$id' ";
		//$stmt = $db->query($c);
        $result = mysqli_query($con,$sql);
        if ($result->num_rows > 0){
        	while($row = $result->fetch_assoc()){
        		$this->SetFont('Times','B', 10);
				$this->Cell(30,5,$row['course_number'],1,0,'C');
				$this->Cell(65,5,$row['course_title'],1,0,'L');
				$taken = "A.Y. ".$row['course_year'].' '.$row['course_sem']." Semester";
				$this->Cell(60,5,$taken,1,0,'L');
				$this->Cell(33,5,$row['final_grade'],1,0,'L');
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
$pdf->studentInfoHeader2();
$pdf->studentInfo2();
//$pdf->studentInfoHeader3();
//$pdf->studentInfo3();
$pdf->headerTable();
$pdf->viewTable($con);
$pdf->Output();
