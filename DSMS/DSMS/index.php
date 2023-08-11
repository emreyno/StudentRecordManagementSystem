<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
//session_unset();

include 'connection.php';

error_reporting(0);

$_SESSION['user_status'] = "guest";
$_SESSION['stat'] = "guest";
$_SESSION['ln'] = "guest";
$isWrong=false;
$islimit=false;
//$_SESSION['log_name'] = "guest";




if (isset($_POST['submit'])) {
      if(!isset($_SESSION['attempt'])){
        $_SESSION['attempt'] = 0;
        
      }

      //check if there are 3 attempts already
      if($_SESSION['attempt'] == 3){
        $_SESSION['error'] = 'Attempt limit reach';
      
        $islimit=true;
    }else{
      $email = $_POST['email'];
      $password = md5($_POST['password']);
    
      $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
      $result = mysqli_query($con, $sql);
      if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
         $_SESSION['userId'] = $users->user_id;
    
         $_SESSION['stat'] = $row['role'];
         $_SESSION['ln'] = $row['email'];
         
         $status = $row['role'];
         $log_name = $row['email'];
         $_SESSION['user_status'] = $status;
         //$_SESSION['log_name'] = $row['email'];
         echo "This is the current role".$status."";
    
         //for the login history
         $action = "Logged In";
         $sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
         $result1 = mysqli_query($con, $sql1);
    
         $isWrong=false;
         $_SESSION['success'] = 'Login successful';
                    //unset our attempt
                    unset($_SESSION['attempt']);
        header("Location: home.php");
      } else {
        $_SESSION['error'] = 'Password incorrect';
        //this is where we put our 3 attempt limit
        $_SESSION['attempt'] += 1;
        //set the time to allow login if third attempt is reach
        if($_SESSION['attempt'] == 3){
          
            $_SESSION['attempt_again'] = time() + (.5*60);
            //note 5*60 = 5mins, 60*60 = 1hr, to set to 2hrs change it to 2*60*60'

            //for the login history
            $action = "Failed Attempts to Log In (3 times or more)";
            $lname = "Unknown";
            $stratus = "Unknown";
            $sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$lname', '$stratus', '$action')";
            $result1 = mysqli_query($con, $sql1);
           
        }
      
        $isWrong=true;
      }

    } 

 
}
if(isset($_SESSION['attempt_again'])){
  $now = time();
  
  $timer =  $_SESSION['attempt_again']- $now;
  
  header("refresh:  $timer;");
  if($now >= $_SESSION['attempt_again']){
      unset($_SESSION['attempt']);
      unset($_SESSION['attempt_again']);
      $islimit=false;
  }
}

?>




    
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

<title>Log in</title>
</head>
<body class="custom-body">

  <!-- The center container -->
  <div class=" login-con mx-auto"> 

    <div class="container">

      <div class="row ">

        <div class="col login-l">
          
        </div>

        <div class="col login-r">
          <div class="log-form-con">
            <form action="" method="POST" class="">
              <div class="log-form-flex">
                <div class="log-field">
                  <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
                </div>
                <div class="log-field">
                  <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
                </div>
                <div class="log-field">
                <button name="submit" class="form-control login-btn"><strong>Login</strong></button>
                </div>
              </div>
             <br>

             
                  <?php 
                 if($isWrong){
                  echo '<p style="color:#e76018; font-weight:bold;">Email or Password is incorrect<p>';
                 }
                   if($islimit){
                  echo '<p style="color:#e76018; font-weight:bold;">Too  many failed attempts
                  </br> Try again after 30 secods<p>';
                  ?>
                 
                  <?php
                
                 }

                  ?>
              
            
            </form>
          </div>
        </div>

      </div>

    </div>

  </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

   


</body>

</html>
