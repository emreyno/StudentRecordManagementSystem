<?php
session_start();

include 'connection.php';

error_reporting(0);

  if($_SESSION['user_status'] != "admin"){
    header("Location: home.php");
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

<title>History Log</title>
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
     <div class="container">
       
       <div class="row">
                            <div class="col-10 class-details">
                            <p class="form-title">History Log</p>
                            </div>
                  
                            <div class="col-2 class-details">
                            <a  class="dl-pdf" href="clearlog.php">Clear Log</a>
                            </div>
                        
        </div>
      </div>
        <div class="table-fields">


        <div class="container">          
        
            
              <table id="history" class="table">
              <thead>
                <!-- <th>Log id</th> -->
                <th>User</th>
                <th>Status</th>
                <th>Action</th>
                <th>Date/Time</th>
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
    
      $('#history').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('log_name', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'fetch_LogHistory.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            // "aTargets": [3]
          },

        ]
      });
    });

    </script>

   <!-- Success Modal For deleted class ##################################-->
   <?php
 if($_SESSION['log_cleared']){
        echo '<script>
        setTimeout(function(){  $(\'#log_cleared\').modal("show"); }, 300);
        setTimeout(function(){  $(\'#log_cleared\').modal("hide"); }, 3000);
        </script>';
        $_SESSION['log_cleared']=false;
    }
    ?>
 <div class="modal fade" id="log_cleared" tabindex="-1" aria-labelledby="updateItemModalLabel"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateItemModalLabel">SUCCESS!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body"style="text-align:center;">
                  <img src="./images/success.gif" alt="hghg"style="width:100px;">
                  <br>
                   Log History was successfuly cleared.
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                                               
                </div> -->
            </div>
        </div>
    </div>

<body onmousemove="reset_interval()" onclick="reset_interval()" onkeypress="reset_interval()" onscroll="reset_interval()">
 
<script type="text/javascript">
 
var timer = setInterval(function(){ auto_logout() }, 30000);
 

function reset_interval(){
 
    clearInterval(timer);

    timer = setInterval(function(){ auto_logout() }, 30000);
 
}
 
function auto_logout(){

        alert("Session expired. To continue please login again.")

        window.location="logout.php";
 
}
</script>

</body>
</html>