<?php include('connection.php');
session_start();
error_reporting(0);

if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

 if (isset($_GET['id'])){
    $id = $_GET['id'];

 
}
 /*if (isset($_GET['SY'])){
    $SY = $_GET['id'];
 }*/
 
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/x-icon" href="icon1.png">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Source+Serif+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">


<link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />

<title>Class Info</title>
</head>
<body class="custom-body">
<div class="custom-head">
        <div class="px-3 custom-head-content mx-auto  ">
        <h1 style = "text-align: left; margin-top:60px;">DIGITAL STUDENT RECORD MANAGEMENT</h1>
            <!--<p>By Ch!lly Alpha</p>-->
        </div>

    </div>



<?php
include "header.php";
?>


<div class="py-5 custom-content mx-auto">
    <div class="custom-form-container mx-auto">
        <p class="form-title">CLass Information</p>
        <div class="line"></div>

        <br>
            <p class="field-title">CLASS DETAILS</p>
            <?php
                $sql = "SELECT * FROM `class` where course_num = $id ";
                $result = mysqli_query($con,$sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        
            ?>
            <div class="form-fields mx-auto">
                <div class="container">
                        <div class="row">
                            <div class="col-10 class-details">
                            
                            </div>
                  
                            <div class="col-2 class-details">
                            <a  class="dl-pdf" href="genpdf_indiv_class.php?id=<?php echo $id; ?>" target="_blank">Download PDF</a>
                            </div>
                        
                        </div>
                </div>
                    <br>
                    <div class="container">
                        <div class="row">
                            <div class="col class-details">
                            <strong>Course Number:</strong> <?php echo $row["course_num"]; ?>
                            </div>
                            <div class="col class-details">
                            <strong>Semester:</strong> <?php echo $row["course_sem"]; ?>
                            </div>
                            <div class="col class-details">
                            <strong>Academic Year:</strong> <?php echo $row["course_year"]; ?>
                            </div>
                        
                        </div>
                    </div>
                    <br>
                    <div class="container">
                        <div class="row">
                            <div class="col class-details">
                            <strong>Course Title:</strong> <?php echo $row["course_title"]; ?>
                            </div>
                            <div class="col-8 class-details">
                            <strong>Course Description:</strong> <?php echo $row["course_description"]; ?>
                            </div>
                        
                        </div>
                    </div>

            </div>
                <?php
}
                }

   ?>

            
            <div>
            <BR>
            <p class="field-title">STUDENTS ENROLLED</p>
            <div class="form-fields mx-auto">
            <div class="container">
            <form method="POST" action="enrolled_class.php">
                
                    <input type="hidden" name="class_num" value="<?php echo $id; ?>">

                    <strong>Add Student:</strong>
                    <select class="select"name="student_num" id="student_num">
                    <?php
                      
                      $query = "SELECT * 
                      FROM student 
                      WHERE stud_num NOT IN 
                          (SELECT stud_num 
                           FROM enrolled 
                           WHERE course_number =$id)";
                      $result = mysqli_query($con,$query);
                      if (mysqli_num_rows($result)> 0){
                          echo "<option value = others> -Select- </option>";
                          while($row = mysqli_fetch_assoc($result)){
                              echo "<option value = '".$row['stud_num']."'>"
                              .$row['stud_num']." - ".$row['f_name']." ".$row['m_name']." ".$row['l_name']."</option>";
                          }
                          echo "</select>";
                      }
                     
                  ?>
                  <input type="submit" class="btn col-t"name="submit" value = "add">
                </select>
                
            </form>
            </div>
            </div>
        <br>
        <div class="form-fields mx-auto">
                    <div class="container class-tb-h">
                        <div class="row">
                            <div class="col class-details-h">
                            Student Number
                            </div>
                            <div class="col class-details-h">
                            Student Name
                            </div>
                            <div class="col class-details-h">
                            Final Grade
                            </div>
                            <div class="col class-details-h">
                            &emsp; Status
                            </div>
                            <div class="col class-details-h">
                            &emsp; Action
                            </div>
                        
                        </div>
                    </div>
    <?php
    $sql = "SELECT *,enrolled.class_id as classid FROM `enrolled` left join class using(class_id) 
                                    left join student using(stud_num) 
                                    left join removal_grade using(stud_num, class_id)
                                    WHERE course_num=$id";
                                    
    $result = mysqli_query($con,$sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            
                    $class_id = $row["classid"];
                    $sql2 = "SELECT * FROM `removal_grade` where stud_num = '$row[stud_num]' and class_id = $class_id; ";
                   
                    $result2 = mysqli_query($con,$sql2);
    ?>
  


                    <div class="container class-tb-td">
                        <div class="row">
                            <div class="col class-details-td">
                            &emsp;&ensp;<?php echo $row["stud_num"]; ?>
                            </div>
                            <div class="col-3 class-details-td">
                            <?php echo $row['f_name'].' '.$row['m_name'].' '.$row['l_name']; ?>
                            </div>
                            <?php  
                      
                    
                            if (mysqli_num_rows( $result2 )> 0){ ?>
                            <div class="col class-details-td">
                                <table>
                                    <tr>
                                    <th style="border-right:1px solid black;"> Initial </th>
                                    <th> Removal </th>
                                </tr>
                                <tr>
                                <td style="border-right:1px solid black;"><?php echo $row["initial_grade"]; ?> </td>
                                <td><?php echo $row["removal_grade"]; ?> </td>
                                </tr>
                                </table>
                                Status: <?php echo $row["removal_status"]; ?>
                                </br>
                                <!-- <a href="grade_edit.php?id=<?php echo $row['removal_id']; ?>">Update</a>
                                <a href="delete_enrolled_student.php?id=<?php echo $row['removal_id']; ?>">Remove</a> -->
                                <a class="class-a" onclick="updateRemovalGrade(<?php echo $row['removal_id']?>)">Update</a>
                          <!-- <a class="class-a" onclick="deleteRemovalGrade(<?php echo $row['removal_id']; ?>)">Remove</a> -->
                          <a class="class-a" onclick="deleteRemovalGrade(<?php echo $row['removal_id']; ?>)">Remove</a>
                            </div>

                            <?php }
                         else  {  ?>
                              <div class="col class-details-td"><?php echo $row["final_grade"]; ?></div>
                            <?php
                         }  ?>

                            <div class="col class-details-td">
                            <?php echo $row["status"]; ?>
                            </div>

                            <div class="col class-details-td">
                                <!-- <a class="class-a"href="grade_inclass_edit.php?ids=<?php echo $row['enrolled_id']; ?>">Edit</a> -->
                                <!-- <button type="button" class="class-a" onclick="getDetails(<?php echo $row['enrolled_id']; ?>)">Edit</button> -->
                                <a class="class-a"  onclick="getDetails(<?php echo $row['enrolled_id']; ?>)">Edit</a>
                            <!-- <a class="class-a" href="delete_enrolled_class.php?ids=<?php echo $row['enrolled_id']; ?>">Delete</a> -->
                                <a class="class-a"  onclick="deleteCourse(<?php echo $row['enrolled_id']; ?>)">Delete</a>
                                <a class="class-a" href="indiv_student.php?id=<?php echo $row['stud_num']; ?>">View</a>
                            </div>
                        
                   
                        </div>
                    </div>
                        <?php
                        }
                    
                    } else {
                        echo "0 results";
                    }
                    $con->close();
                    
                
                        ?>    

            </div>

        


        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Launch demo modal
        </button> -->
        
    </div>




<br>
<br>
</div>
  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

<script type="text/javascript">
            //for update products
            function getDetails(id){
                
           $.post("get_grade_inclass_edit.php",{updateId:id},function(data,status){
            // alert(updateId);
               var json=JSON.parse(data);
            //    $("#update_ID").val(json.item_ID);
            //    $("#stud_name").val(json.item_Name);
            $('#stud_num').val(json.stud_num); //
            $('#course_number').val(json.course_num); //
            $('#enrolled_id').val(json.enrolled_id);//
            $("#class_id").val(json.class_id);//
            $('#grade_stat').val(json.final_grade);// 
            $("#stud_name").val(json.f_name.concat(" ",json.m_name," ",json.l_name));//
            $("#course_title").val(json.course_title);//
            $('#status').val(json.status);
               
              
              
               $('#course_number').val(json.course_number);
            //    alert("Data: " + data );
             
           });
           $('#updateItemModal').modal('show');
       };

       
       function updateRemovalGrade(id){
           $.post("get_grade_inclass_edit.php",{removal:id},function(data,status){
               var json=JSON.parse(data);

               $("#stud_name1").val(json.f_name.concat(" ",json.m_name," ",json.l_name));//
               $('#course_number1').val(json.course_num); //
               $('#stud_num1').val(json.stud_num);
               $("#course_title1").val(json.course_title);//
               $("#class_id1").val(json.class_id);
               $('#removal_id').val(json.removal_id);
               $('#removal_grade').val(json.removal_grade);
               $('#initial_grade').val(json.initial_grade);
               $('#removeStat').val(json.removal_status);
             
           });
           $('#updateRemovalGradeModal').modal('show');
       };

       function deleteCourse(key){
        let a=key;
        let add = "delete_enrolled_class.php?removeCourse=";
        let address=add+a;
        // alert(address);
        if (confirm("Are you sure want to remove student from this course ? ")) {
            window.location.href = address;
        }else {
        return null;
        };
           
       };

       function deleteRemovalGrade(key){
        let a=key;
        let add = "delete_enrolled_class.php?deleteRemoval=";
        let address=add+a;
        // alert(address);
        if (confirm("Are you sure want to delete student grade ? ")) {
            window.location.href = address;
        }else {
        return null;
        };
           
       };

    

</script>

    <!-- Update Item Modal ##################################-->
    <div class="modal fade" id="updateItemModal" tabindex="-1" aria-labelledby="updateItemModalLabel"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateItemModalLabel">UPDATE FORM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="row g-3"  action="update_inclass_grade.php" method="post">
                    <input type="hidden" id="stud_num" name="stud_num" >
                    <input type="hidden" id="course_number" name="course_number" >
                    <input type="hidden" id="class_id" name="class_id" >
                    <input type="hidden" id="enrolled_id" name="enrolled_id" >
                        <div class="col-12">
                            <label for="updateItem_Name" class="form-label">Course Title</label>
                            <input type="text" class="form-control" id="course_title" name="course_title" disabled>
                        </div>
                        <div class="col-12">
                            <label for="updateItem_Name" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="stud_name" name="updateItem_Name" disabled>
                        </div>

                        <div class="col-6">
                            <label for="updateItemWeight" class="form-label">Grade</label>
                            <input type="text" class="form-control" name="grade"id="grade_stat"  required>
                        </div>

                

                        <div class="col-md-6">
                            <label for="updateRetail_Price" class="form-label">Status</label>
      
                            <select class="form-control" name="status" id="status">
                                    <option  value="Pending">Pending</option>
                                    <option value="Complete">Complete</option>
                                    <option  value="Incomplete">Incomplete</option>
                                    <option value="Removals">Removals</option>
                                    <option  value="Failed">Failed</option>
                                    <option value="Dropped">Dropped</option>
                            </select>
                        </div>
               
                                                    
                                                    
                        <div class="col-12">
                            <button type="submit" class="btn col-t" name="onclickUpdate" >UPDATE</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                                               
                </div>
            </div>
        </div>
    </div>


    
      <!-- Update Removal grade Modal ##################################-->
    <div class="modal fade" id="updateRemovalGradeModal" tabindex="-1" aria-labelledby="updateItemModalLabel"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateItemModalLabel">UPDATE FORM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="row g-3"  action="update_removalgrade_inclass.php" method="post">

                    <input type="hidden" id="course_number1" name="course_num" >
                    <input type="hidden" id="stud_num1" name="stud_num" >
                    <input type="hidden" id="class_id1" name="class_id" >
                    <input type="hidden" id="removal_id" name="removal_id" >
                    <div class="col-12">
                            <label for="updateItem_Name" class="form-label">Course Title</label>
                            <input type="text" class="form-control" id="course_title1" name="course_title" disabled>
                        </div>
                        <div class="col-12">
                            <label for="updateItem_Name" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="stud_name1" name="name" disabled>
                        </div>

                        <div class="col-6">
                            <label for="updateItemWeight" class="form-label">Initial Grade</label>
                            <input type="text" class="form-control" name="i_grade"id="initial_grade"  required>
                        </div>  
                        <div class="col-6">
                            <label for="updateItemWeight" class="form-label">Removal Grade</label>
                            <input type="text" class="form-control" name="r_grade"id="removal_grade"  required>
                        </div>

                        <input type="hidden" class="form-control" id="update_ID" name="updateItem_ID">

                        <div class="col-md-6">
                            <label for="removeStat" class="form-label">Status</label>
                            <select class="form-control" name="removeStatus" id="removeStat">
                                <option value="Pending">Pending</option>
                                <option value="Complete">Complete</option>
                            </select>
                            <!-- <input type="text" class="form-control" name="removeStatus" id="removeStat"  required> -->

                
            
                
                        </div>
               
                                                    
                                                    
                        <div class="col-12">
                            <button type="submit" class="btn col-t" name="onclickUpdate" >UPDATE</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                                               
                </div>
            </div>
        </div>
    </div>



         <!-- Success Modal updated Student grade ##################################-->
         <?php
 if($_SESSION['class_updated']){
        echo '<script>
        setTimeout(function(){  $(\'#class_updated\').modal("show"); }, 300);
        setTimeout(function(){  $(\'#class_updated\').modal("hide"); }, 3000);
        </script>';
        $_SESSION['class_updated']=false;
    }
    ?>
 <div class="modal fade" id="class_updated" tabindex="-1" aria-labelledby="updateItemModalLabel"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateItemModalLabel">SUCCESS!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body"style="text-align:center;">
                  <img src="./images/success.gif" alt="hghg"style="width:100px;">
                  <br>
                   Student grade was successfully updated.
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                                               
                </div> -->
            </div>
        </div>
    </div>


             <!-- Success Modal updated Student removal grade ##################################-->
 <?php
 if($_SESSION['StudRemoval_updated']){
        echo '<script>
        setTimeout(function(){  $(\'#StudRemoval_updated\').modal("show"); }, 300);
        setTimeout(function(){  $(\'#StudRemoval_updated\').modal("hide"); }, 3000);
        </script>';
        $_SESSION['StudRemoval_updated']=false;
    }
    ?>
 <div class="modal fade" id="StudRemoval_updated" tabindex="-1" aria-labelledby="updateItemModalLabel"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateItemModalLabel">SUCCESS!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body"style="text-align:center;">
                  <img src="./images/success.gif" alt="hghg"style="width:100px;">
                  <br>
                   Student removal grade was successfully updated.
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                                               
                </div> -->
            </div>
        </div>
    </div>

             <!-- Success Modal removed student class ##################################-->
 <?php
 if($_SESSION['StudClass_removed']){
        echo '<script>
        setTimeout(function(){  $(\'#StudClass_removed\').modal("show"); }, 300);
        setTimeout(function(){  $(\'#StudClass_removed\').modal("hide"); }, 3000);
        </script>';
        $_SESSION['StudClass_removed']=false;
    }
    ?>
 <div class="modal fade" id="StudClass_removed" tabindex="-1" aria-labelledby="updateItemModalLabel"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateItemModalLabel">SUCCESS!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body"style="text-align:center;">
                  <img src="./images/success.gif" alt="hghg"style="width:100px;">
                  <br>
                   Student was successfully removed from the class.
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                                               
                </div> -->
            </div>
        </div>
    </div>

    

<body onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()">
 
<script type="text/javascript">
 
var timer = setInterval(function(){ auto_logout() }, 60000);
 

function reset_interval(){
 
    clearInterval(timer);

    timer = setInterval(function(){ auto_logout() }, 60000);
 
}
 
function auto_logout(){

        alert("Session expired. To continue please login again.")

        window.location="logout.php";
 
}
</script>

</body>
</html>
