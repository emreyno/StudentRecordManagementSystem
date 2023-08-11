<?php
include('connection.php');
	session_start();
    $stud_num    = $_GET['id'];

		$sql = "SELECT student.stud_num, degreeProg, college, CONCAT(f_name , ' ' , m_name , ' ' , l_name, ' ', suffix) as Name, sex, course_num, course_description, course_title, ave_grade, transmu_grade, standing, grade_remark FROM (student INNER JOIN (enrolled INNER JOIN class ON class.class_id=enrolled.class_id) ON student.stud_num = enrolled.stud_num) INNER JOIN (grade INNER JOIN graded ON grade.grade_id = graded.grade_id) ON graded.stud_num = student.stud_num AND grade.class_id = class.class_id WHERE student.stud_num =$stud_num";
    $records = mysqli_query($con,$sql);
		require("library/fpdf.php");
		$pdf = new FPDf('L','mm','A3');

		$pdf->AddPage();
		$pdf->SetFont('Helvetica','B',8);
		$pdf->cell(30,10,"Student Number", 1, 0,'C');
		$pdf->cell(30,10,"Degree Program", 1, 0,'C');
		$pdf->cell(25,10,"College", 1, 0,'C');
		$pdf->cell(60,10,"Name", 1, 0,'C');
		$pdf->cell(30,10,"Sex", 1, 0,'C');
		$pdf->cell(30,10,"Course Number", 1, 0,'C');
		$pdf->cell(50,10,"Course Description", 1, 0,'C');
		$pdf->cell(30,10,"Course Title", 1, 0,'C');
		$pdf->cell(25,10,"Average Grade", 1, 0,'C');
		$pdf->cell(30,10,"Transmuted Grade", 1, 0,'C');
		$pdf->cell(30,10,"Standing", 1, 0,'C');
		$pdf->cell(30,10,"Remark", 1, 1,'C');
		$pdf->SetFont('Helvetica','',8);

		while($row=mysqli_fetch_array($records)){
		$pdf->cell(30,10,$row["stud_num"], 1, 0,'C');
		$pdf->cell(30,10,$row["degreeProg"], 1, 0,'C');
		$pdf->cell(25,10,$row["college"], 1, 0,'C');
		$pdf->cell(60,10,$row["Name"], 1, 0,'C');
		$pdf->cell(30,10,$row["sex"], 1, 0,'C');
		$pdf->cell(30,10,$row["course_num"], 1, 0,'C');
		$pdf->cell(50,10,$row["course_description"], 1, 0,'C');
		$pdf->cell(30,10,$row["course_title"], 1, 0,'C');
		$pdf->cell(25,10,$row["ave_grade"], 1, 0,'C');
		$pdf->cell(30,10,$row["transmu_grade"], 1, 0,'C');
		$pdf->cell(30,10,$row["standing"], 1, 0,'C');
		$pdf->cell(30,10,$row["grade_remark"], 1, 1,'C');
			
		}

		$pdf->OutPut();


		$conn->close();
?>