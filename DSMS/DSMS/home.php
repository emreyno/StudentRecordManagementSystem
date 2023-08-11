
<?php
session_start(); 
include('connection.php'); 

error_reporting(0);
/*if($_SESSION['stat'] != "admin"){
    if($_SESSION['stat'] != "assistant"){
        header("Location: index.php");
    }
}*/

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

<title>Home</title>
</head>
<body class="custom-body">
<div class="custom-head">
        <div class="px-3 custom-head-content mx-auto  ">
      
                        <h1 style = "text-align: left; margin-top:60px;">DIGITAL STUDENT RECORD MANAGEMENT</h1>

        </div>

    </div>


<?php
include "header.php";
?>

<div class=" home-content mx-auto">
    <div class="home-col-1">

        <a href="studentList.php">
            <p>Students in Database</p>
            <?php
            $sqls = "SELECT * from student";

            if ($results = mysqli_query($con, $sqls)) {

            // Return the number of rows in result set
            $rowcount = mysqli_num_rows( $results );

            echo "<p class='prompt-val'>".$rowcount."</p>";
    
             }
            ?>
        </a>
    
        <a href="classList.php">
            <p>Classes in Database</p>
            <?php
            $sqlc = "SELECT * from class";

            if ($resultc = mysqli_query($con, $sqlc)) {

            // Return the number of rows in result set
            $rowcountc = mysqli_num_rows( $resultc);

            echo "<p class='prompt-val'>".$rowcountc."</p>";
    
             }
            ?>
        </a>

        <div>
           
            <script type = "text/javascript">
                setInterval(displayclock, 500);

                function displayclock () {
                    var time = new Date();
                    var hrs = time.getHours();
                    var min = time.getMinutes();
                    var sec = time.getSeconds();

                document.getElementById('clock').innerHTML = hrs + ':' + min + ':' + sec;

                const date = new Date();

                const formattedDate = date.toLocaleString("en-GB", {
                    day: "numeric",
                    month: "long",
                    year: "numeric",
                    //hour: "numeric",
                    //minute: "2-digit"
                });

                document.getElementById('datetoday').innerHTML = formattedDate;

                }
                </script>
            <p id="datetoday"></p>
            <style>
                    .datesettings{
                        margin: 0px;
                        padding: 0px;
                    }

                    @font-face {
                        font-family: Clock;
                        src: url("digital-dismay.regular.otf") format("opentype");
                    }

                    @font-face {
                        font-family: Welcome;
                        src: url("simpletix 400.otf") format("opentype");
                    }
                </style>
            
            <p id="clock" class="prompt-val" style = "font-family: Clock;"></p>
            
                <?php
                $date = date('d/m/y');
                ?>
                
                <!--<p class = "datesettings"><?php echo $date ?></p>-->
            
        </div>
    </div>

    <div class="home-col-2"style = "border: none !important;">
        <div class="home-reminder">
            <div class="rem-displ">
                <div class="disp-title">
                     <?php

                    if($_SESSION['user_status'] == "admin"){
                        $displayName = "Neil";
                    }else{
                        $displayName = "Guest";
                    }

                    date_default_timezone_set('Asia/Hong_Kong');

                    $hourMin = date('H:i');

                    if ($hourMin >= 00 && $hourMin < 12 ){
                        $greeting = "Good Morning ";
                    }else if($hourMin > 12 && $hourMin < 18 ){
                        $greeting = "Good Afternoon ";
                    }else if($hourMin > 18){
                        $greeting = "Good Evening ";
                    }

                    //$toDisplay = $greeting + $displayName;
                    $toDisplay = $greeting.$displayName;

                    ?>
                    <!--<h2 style = "font-family: Welcome; font-size: 250%;">Welcome <?php echo $displayName ?>!</h2>-->
                    <h2 id = "welcomeuser" style = "font-family: Welcome; font-size: 350%; font-weight: bold; padding: 10px"><?php echo $toDisplay ?>!</h2>
                    <!--<p>Welcome and have a good day! Honor and Excellence!</p>-->
                    <p style="text-align: right; font-size: 120%;">-Ch!lly Alpha Team</p> 
               
                </div>
            </div>
            <div class="line-sep"></div>
            <h3>&nbsp;&nbsp;</h3>
            <h3>REMINDERS</h3>
            <div class="reminder-line"></div>
            <div class="reminder-input">
                <form method="POST" action="add_reminder.php">
                    <div >
                        <input  class="rem-title" name = "title" type="text" placeholder="Title">
                    </div>
                    <div>
                        <textarea class="rem-body" name = "content" placeholder="Write Something..."></textarea>
                    </div>
                    <div>
                        <button class="rem-submit"type="submit">Add</button>
                    </div>
                    
                </form>
            </div>
            

        </div>
        <div class="home-calendar"><h3>NOTES</h3>
            <style>
                .b1 {
                    border: none;
                    background: none;
                    cursor: pointer;
                    margin: 0;
                    padding: 0;
                    text-decoration: none;
                    color:black;
                }

                .home-calendar {
                    overflow-y: scroll;
                    height: 600px;
                }
                .home-calendar::-webkit-scrollbar {
                    display: none;
                }
                .home-calendar {
                    -ms-overflow-style: none;  
                    scrollbar-width: none;  
                }
            </style>

                <?php
                      
                      $query = "select * from reminder";
                      $result = mysqli_query($con,$query);
                      while($row = $result->fetch_assoc()) {
                          ?>

                          <div class="line-sep"></div>
                        <div class="disp-title">

                        <table style="width:100%">
                            <tr>
                                <th><h4 align = "left"><?php echo $row["reminder_title"]; ?></h4></th>
                                <th><p align = "right"><a href="reminder_delete.php? id=<?php echo $row["reminder_id"]; ?>"  class="b1" >&#10006;</a></p></th>
                            </tr>
                        </table>
                       
                        <p><?php echo $row["reminder_content"]; ?></p> 
                        <p align = "right">created: <?php echo $row["ts"]; ?></p> 
                        
                        </div>
                         </select>
                      <?php
                      }
                     
                  ?>
        </div>

    </div>


</div>
<?php
include "footer.php";
?>

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
