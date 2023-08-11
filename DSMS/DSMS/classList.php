
<?php 
session_start();
include('connection.php');
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

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />

<title>Class List</title>
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
      <p class="form-title">Class List</p>
      <div class="table-fields">



      <div class="container">
            
              <table id="example" class="table">
              <thead>
                <th>Course No.</th>
                <th>Title</th>
                <th>Description</th>
                <th>School Year</th>
                <th>Semester</th>
                <th>Options</th>
              </thead>
              <tbody>
              </tbody>
              </table>
    
        </div>


  </div>
  
  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
    
      $('#example').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'fetch_Classdata.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [5]
          },

        ]
      });
    });

    

    $(document).on('submit', '#updateUser', function(e) {
      e.preventDefault();
      var course_num = $('#course_num').val();
      var course_description = $('#course_description').val();
      var course_title = $('#course_title').val();
      var course_year = $('#course_year').val();
      var course_sem = $('#course_sem').val();
      var trid = $('#trid').val();
      var id = $('#id').val();
      if (course_num != '' && course_description != '' && course_title != '' && course_year != '' && course_sem != '') {
        $.ajax({
          url: "update_class.php",
          type: "post",
          data: {
            course_num: course_num,
            course_description: course_description,
            course_title: course_title,
            course_year: course_year,
            course_sem: course_sem,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#example').DataTable();
              // table.cell(parseInt(trid) - 1,0).data(id);
              // table.cell(parseInt(trid) - 1,1).data(username);
              // table.cell(parseInt(trid) - 1,2).data(email);
              // table.cell(parseInt(trid) - 1,3).data(mobile);
              // table.cell(parseInt(trid) - 1,4).data(city);
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, course_num, course_description, course_title, course_year, course_sem, button]);
              $('#exampleModal').modal('hide');
            } else {
              alert('failed');
            }
          }
         
        });
        $('#exampleModal').modal('hide');
        // $('#example').DataTable().ajax.reload();
        window.location.reload();
      } else {
        alert('Fill all the required fields');
      }
    });



    $('#example').on('click', '.editbtn ', function(event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('class_id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      $('#exampleModal').modal('show');

      $.ajax({
        url: "get_classData_toEdit.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#course_num').val(json.course_num);
          $('#course_description').val(json.course_description);
          $('#course_title').val(json.course_title);
          $('#course_year').val(json.course_year);
           $('#course_sem').val(json.course_sem);
          $('#id').val(id);
          $('#trid').val(trid);
        }
      })
    });

    $(document).on('click', '.deleteBtn', function(event) {
      var table = $('#example').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("Are you sure want to delete this class? ")) {
        $.ajax({
          url: "delete_class.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              //table.fnDeleteRow( table.$('#' + id)[0] );
              //$("#example tbody").find(id).remove();
              //table.row($(this).closest("tr")) .remove();
              $("#" + id).closest('tr').remove();
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
          <h5 class="modal-title" id="exampleModalLabel">Update Class Info</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <div class="mb-3 row">
              <label for="course_num" class="col-md-3 form-label">Course No.</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="course_num" name="course_num">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="course_description" class="col-md-3 form-label">Class Description</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="course_description" name="course_description">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="course_title" class="col-md-3 form-label">Class Title</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="course_title" name="course_title">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="course_year" class="col-md-3 form-label">Academic Year</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="course_year" name="course_year">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="course_sem" class="col-md-3 form-label">Semester</label>
              <div class="col-md-9">
                <!-- <input type="text" class="form-control" id="course_sem" name="course_sem"> -->
                <select  class="form-control" class="select"  id="course_sem" name="course_sem">
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                            <option value="Midyear">Midyear</option>       
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



   <!-- Success Modal For new class ##################################-->
 <?php
 if($_SESSION['class_success']){
        echo '<script>
        setTimeout(function(){  $(\'#class_success\').modal("show"); }, 300);
        setTimeout(function(){  $(\'#class_success\').modal("hide"); }, 3000);
        </script>';
        $_SESSION['class_success']=false;
    }
    ?>
 <div class="modal fade" id="class_success" tabindex="-1" aria-labelledby="updateItemModalLabel"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateItemModalLabel">SUCCESS!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body"style="text-align:center;">
                  <img src="./images/success.gif" alt="hghg"style="width:100px;">
                  <br>
                   Class was successfully added to the Database.
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                                               
                </div> -->
            </div>
        </div>
    </div>

      <!-- Success Modal For deleted class ##################################-->
 <?php
 if($_SESSION['class_removed']){
        echo '<script>
        setTimeout(function(){  $(\'#class_removed\').modal("show"); }, 300);
        setTimeout(function(){  $(\'#class_removed\').modal("hide"); }, 3000);
        </script>';
        $_SESSION['class_removed']=false;
    }
    ?>
 <div class="modal fade" id="class_removed" tabindex="-1" aria-labelledby="updateItemModalLabel"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateItemModalLabel">SUCCESS!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body"style="text-align:center;">
                  <img src="./images/success.gif" alt="hghg"style="width:100px;">
                  <br>
                   Class was successfully removed from the Database.
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                                               
                </div> -->
            </div>
        </div>
    </div>

          <!-- Success Modal updated class ##################################-->
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
                   Class details was successfully updated.
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