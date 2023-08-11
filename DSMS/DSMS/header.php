
<?php
session_start();
?>

    <div class="custom-navbar">
        <div class="px-3 custom-navbar-content mx-auto">
            <a class="navbar-link" href="home.php">HOME</a>

            <div class="dropdown">
                <a class=" navbar-link" href="#">STUDENTS</a>
                <div class="dropdown-content">
                  <a class="dropdown-link" href="newStudent.php">NEW STUDENT</a>
                  <a class="dropdown-link" href="studentList.php">LIST OF STUDENTS</a>
                </div>
            </div>

            <div class="dropdown">
                <a class=" navbar-link" href="#">CLASSES</a>
                <div class="dropdown-content">
                  <a class="dropdown-link" href="newClass2.php">NEW CLASS</a>
                  <a class="dropdown-link" href="classList.php">LIST OF CLASSES</a>
                </div>
            </div>

        <?php 

        if($_SESSION['user_status'] == "admin"){
            echo "<a class='navbar-link' href='loghistory.php'>HISTORY LOG</a>";
        }
        ?>

        <a class="navbar-link" href="logout.php">LOGOUT</a>
        </div>
        
    </div>