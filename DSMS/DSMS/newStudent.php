


<?php include('connection.php'); 
session_start();
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

<title>New Student</title>
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
        <p class="form-title">New Student Form</p>
        <div class="line"></div>

        <form class="custom-form" action="connect.php" method="POST">
            <p class="field-title">STUDENT INFORMATION</p>
            <div class="form-fields mx-auto">
                <div class="fields-col-3" >
                    <div class="form-group">
                    <input  name="stud_num" type="number"  placeholder="Student Number">
                    </div>
                    
                        <select  class="select" name="college" required>
                        <option selected="selected" value="">Select College</option>
                            <option value="CAFS">College of Agriculture and Food Science (CAFS)</option>
                            <option value="CAS">College of Arts and Sciences (CAS)</option>
                            <option value="CEM">College of Economics and Management (CEM)</option>
                            <option value="CEAT">College of Engineering and Agro-Industrial Technology (CEAT)</option>
                            <option value="SESAM">School of Environmental Science and Management (SESAM)</option>
                        </select>
                    
                        <select  class="select" name="degreeProg" required>
                        <option selected="selected" value="">Select Degree Program</option>
                            <option value="BS Agriculture">Bachelor of Science in Agriculture</option>
                            <option value="BS Agricultural Biotechnology">Bachelor of Science in Agricultural Biotechnology</option>
                            <option value="BS Food Technology">Bachelor of Science in Food Technology</option>
                            <option value="BS Agricultural and Biosystems Engineering">Bachelor of Science in Agricultural and Biosystems Engineering</option>
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



                <div class="fields-col-3" >
                    <input  name="f_name" type="text" placeholder="First Name" required>
                    <input  name="m_name" type="text" placeholder="Middle Name" required>
                    <input  name="l_name" type="text" placeholder="Last Name & Suffix" required>
                </div>

                

                <div class="fields-double fields-col-3 " >
                    <select  class="select" name="sex" required>
                        <option selected="selected" value="">Select Sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                
                        </select>
                </div>

            </div>


            
            <div>
           

              <button type="submit" class="btn add">Add Student</button>
            </div>
            
        </form>
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Launch demo modal
        </button> -->
        
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
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








