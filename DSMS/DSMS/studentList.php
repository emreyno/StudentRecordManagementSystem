
<?php 
session_start();
include('connection.php'); 
//require("library/fpdf.php");
error_reporting(0);

if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}




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

<title>Student List</title>
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
       <p class="form-title">Student List</p>
        <div class="table-fields">


        <div class="container">          
        
            
              <table id="studInfo" class="table">
              <thead>
                <th>Student No.</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>College</th>
                <th>Degree Program</th>
                <th>Sex</th>
                <th>Options</th>
              </thead>
              <tbody>
              </tbody>
              </table>
            
           
        
        </div>


        </div>
</div>

  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
    
      $('#studInfo').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('course_num', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'fetch_Studentdata.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [7]
          },

        ]
      });
    });

   
      
      $(document).on('submit', '#updateUser', function(e) {
      e.preventDefault();
  
      var stud_num = $('#stud_num').val();
      var f_name = $('#f_name').val();
      var m_name = $('#m_name').val();
      var l_name = $('#l_name').val();
      var college = $('#college').val();
      var degreeProg = $('#degreeProg').val();
      var sex = $('#sex').val();
      var trid = $('#trid').val();
      var id = $('#id').val();
      if (stud_num != '' && f_name != '' && m_name != '' && l_name != '' && college != '' && degreeProg != '' && sex != '') {
        $.ajax({
          url: "update_student.php",
          type: "post",
          data: {
            stud_num: stud_num,
            f_name: f_name,
            m_name: m_name,
            l_name: l_name,
            college: college,
            degreeProg: degreeProg,
            sex: sex,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#studInfo').DataTable();

              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, stud_num, f_name, m_name, l_name,college,degreeProg,sex, button]);
              $('#exampleModal').modal('hide');
           
            } else {
              alert('failed');
            }
         
          }
        });
        $('#exampleModal').modal('hide');
        // $('#studInfo').DataTable().ajax.reload();
        window.location.reload();
      } else {
        alert('Fill all the required fields');
      }
    });



    $('#studInfo').on('click', '.editbtn ', function(event) {
      var table = $('#studInfo').DataTable();
      var trid = $(this).closest('tr').attr('stud_num');
      var id = $(this).data('id');

      $('#exampleModal').modal('show');

      $.ajax({
        url: "get_studentData_toEdit.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          //show data 
          var json = JSON.parse(data);
          $('#stud_num').val(json.stud_num);
          $('#f_name').val(json.f_name);
          $('#m_name').val(json.m_name);
          $('#l_name').val(json.l_name);
          $('#college').val(json.college);
          $('#degreeProg').val(json.degreeProg);
          $('#sex').val(json.sex);
          $('#id').val(id);
          $('#trid').val(trid);
        }
      })
    });



    $(document).on('click', '.deleteBtn', function(event) {
      var table = $('#studInfo').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
  //   alert(id);
      if (confirm("Are you sure want to delete this User ? ")) {
        $.ajax({
          url: "delete_student.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
           
              //table.fnDeleteRow( table.$('#' + id)[0] );
              //$("#studInfo tbody").find(id).remove();
              //table.row($(this).closest("tr")) .remove();
              $("#" + id).closest('tr').remove();
        // $('#studInfo').DataTable().ajax.reload();
              window.location.reload();
            } else {
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }



    })
  </script>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
         
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <div class="mb-3 row">
              <label for="stud_num" class="col-md-3 form-label">Student No.</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="stud_num" name="stud_num" disabled>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="f_name" class="col-md-3 form-label">First Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="f_name" name="f_name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="m_name" class="col-md-3 form-label">Middle Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="m_name" name="m_name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="l_name" class="col-md-3 form-label">Last name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="l_name" name="l_name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="college" class="col-md-3 form-label">College</label>
              <div class="col-md-9">
                
                <select class="form-control"  class="select"id="college"  name="college" >
                        <option selected="selected" value="">Select College</option>
                            <option value="CAFS">College of Agriculture and Food Science (CAFS)</option>
                            <option value="CAS">College of Arts and Sciences (CAS)</option>
                            <option value="CEM">College of Economics and Management (CEM)</option>
                            <option value="CEAT">College of Engineering and Agro-Industrial Technology (CEAT)</option>
                            <option value="SESAM">School of Environmental Science and Management (SESAM)</option>
                        </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="degreeProg" class="col-md-3 form-label">Degree Program</label>
              <div class="col-md-9">
                
                <select  class="form-control" class="select"  id="degreeProg" name="degreeProg">
                        <option selected="selected" value="">Select Degree Program</option>
                            <option value="BS Agriculture">Bachelor of Science in Agriculture</option>
                            <option value="BS Agricultural and Biosystems Engineering">Bachelor of Science in Agricultural and Biosystems Engineering</option>
                            <option value="BS Agricultural Biotechnology">Bachelor of Science in Agricultural Biotechnology</option>
                            <option value="BS Food Technology">Bachelor of Science in Food Technology</option>
                            <option value="BS Agricultural Chemistry">Bachelor of Science in Agricultural Chemistry</option>
                            <option value="BS Statistics">Bachelor of Science in Statistics</option>
                            <option value="BS Mathematics and Science Teaching">Bachelor of Science in Mathematics and Science Teaching</option>
                            <option value="BS Mathematics">Bachelor of Science in Mathematics</option>
                            <option value="BS Computer Science">Bachelor of Science in Computer Science</option>
                            <option value="BS Chemistry">Bachelor of Science in Chemistry</option>
                            <option value="BS Biology">Bachelor of Science in Biology</option>
                            <option value="BS Applied Mathematics">Bachelor of Science in Applied Mathematics</option>
                            <option value="BS Computer Science">Bachelor of Science in Computer Science</option>
                           
                            <option value="BS Electrical Engineering">Bachelor of Science in Electrical Engineering</option>
                            <option value="BS Chemical Engineering">Bachelor of Science in Chemical Engineering</option>
                        </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="sex" class="col-md-3 form-label">Sex</label>
              <div class="col-md-9">
                
                <select  class="form-control" class="select"  id="sex" name="sex">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            
                        </select>
            </div>
          </div>

            <div class="text-center">
              <button type="submit" class="btn col-t">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

 <!-- Success Modal For new Student ##################################-->
 <?php
 if($_SESSION['stud_success']){
        echo '<script>
        setTimeout(function(){  $(\'#stud_success\').modal("show"); }, 300);
        setTimeout(function(){  $(\'#stud_success\').modal("hide"); }, 3000);
        </script>';
        $_SESSION['stud_success']=false;
    }
    ?>
 <div class="modal fade" id="stud_success" tabindex="-1" aria-labelledby="updateItemModalLabel"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateItemModalLabel">SUCCESS!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body"style="text-align:center;">
                  <img src="./images/success.gif" alt="hghg"style="width:100px;">
                  <br>
                   Student was successfully added to the Database.
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                                               
                </div> -->
            </div>
        </div>
    </div>

     <!-- Success Modal For delete Student ##################################-->
 <?php
 if($_SESSION['stud_removed']){
        echo '<script>
        setTimeout(function(){  $(\'#stud_removed\').modal("show"); }, 300);
        setTimeout(function(){  $(\'#stud_removed\').modal("hide"); }, 3000);
        </script>';
        $_SESSION['stud_removed']=false;
    }
    ?>
 <div class="modal fade" id="stud_removed" tabindex="-1" aria-labelledby="updateItemModalLabel"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateItemModalLabel">SUCCESS!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body"style="text-align:center;">
                  <img src="./images/success.gif" alt="hghg"style="width:100px;">
                  <br>
                   Student was successfully removed from the Database.
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                                               
                </div> -->
            </div>
        </div>
    </div>

 <!-- Success Modal For updated Student ##################################-->
 <?php
 if($_SESSION['stud_updated']){
        echo '<script>
        setTimeout(function(){  $(\'#stud_updated\').modal("show"); }, 300);
        setTimeout(function(){  $(\'#stud_updated\').modal("hide"); }, 3000);
        </script>';
        $_SESSION['stud_updated']=false;
    }
    ?>
 <div class="modal fade" id="stud_updated" tabindex="-1" aria-labelledby="updateItemModalLabel"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateItemModalLabel">SUCCESS!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body"style="text-align:center;">
                  <img src="./images/success.gif" alt="hghg"style="width:100px;">
                  <br>
                   Student details was successfully updated.
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