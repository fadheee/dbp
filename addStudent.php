<?php
$host = "localhost";
$user = "id15900966_tuitionsystem";
$password ="Dbp_Section3";
$database = "id15900966_tuitionsys";

$STD_ID = "";
$STD_FN = "";
$STD_LN= "";
$ADDR = "";
$GENDER ="";
$DOB ="";
$TR_ID ="";
$message ="";
$message1 ="";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// connect to mysql database
try{
    $connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
    $message = 'Error';
}

// Add

function getPosts()
{
  $posts = array();
  $posts[0] = $_POST['STD_ID'];
  $posts[1] = $_POST['STD_FN'];
  $posts[2] = $_POST['STD_LN'];
  $posts[3] = $_POST['ADDR'];
  $posts[4] = $_POST['GENDER'];
  $posts[5] = $_POST['DOB'];
  $posts[6] = $_POST['TR_ID'];
  return $posts;
}


// Insert
if(isset($_POST['add']))
{
    $data = getPosts();
    $insert_Query = "INSERT INTO student (STD_ID, STD_FN, STD_LN, ADDR, GENDER, DOB, TR_ID) VALUES ('$data[0]', '$data[1]','$data[2]','$data[3]','$data[4]', '$data[5]', '$data[6]')";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);

        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                $message1 ='New student successfully added.';
            }else{
                $message1 ='Data Not Inserted';
            }
        }
    } catch (Exception $ex) {
        $message1 ='Error Insert '.$ex->getMessage();
    }
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add Student</title>
    <link rel="stylesheet" href="CSS/styles.css">
  </head>
  <body>
      <a href="index.php" class="logo"><img src="images/book.png" alt=" logo" height="67" width="170"></a>
    <div class="topnav">
      <div class="dropdown">
        <button href="About.php" class="dropbtn">About &#x25BC; </button>
        <div class="dropdown-content">
          <a href="About.php">Our Story</a>
        </div>
      </div>
      <div class="dropdown">
        <button href="Tutor.php" class="dropbtn">Tutor &#x25BC;</button>
        <div class="dropdown-content">
          <a href="Tutor.php">View Tutor</a>
          <a href="addTutor.php">Add Tutor</a>
          <a href="updelTutor.php">Update/Delete Tutor</a>
        </div>
      </div>
      <div class="dropdown">
        <button href="Courses.php" class="dropbtn">Courses &#x25BC;</button>
        <div class="dropdown-content">
          <a href="Courses.php">View Courses</a>
          <a href="addCourse.php">Add new course</a>
          <a href="updelCourse.php">Update/Delete course</a>
        </div>
      </div>
      <div class="dropdown">
      <button href="Student.php" class="dropbtn">Students &#x25BC;</button>
      <div class="dropdown-content">
        <a href="Student.php">View Students</a>
        <a href="addStudent.php">Add new student</a>
        <a href="updelStudent.php">Update/Delete student</a>
      </div>
      </div>
      <div class="dropdown">
      <button href="index.php" class="dropbtn">Home &#x25BC;</button>
      <div class="dropdown-content">
        <a href="index.php">Homepage</a>
        <a href="StudentFee.php">Students Fee</a>
        <a href="TutorSalary.php">Raise Tutor Salary</a>
        <a href="StudentStatus.php">Students Status</a>
      </div>
      </div>
    </div>

<div class="header-image" style="height: 600px;">
    <div class="header-text" >
        <h1 style="font-style: Georgia; color: #fff; font-size:80px; font-weight: normal; text-align: center;">Add new student</h1>

      </div>
</div>
<!-- Add Student  --><br><br><br>
      <div class="columnc" style="text-align: center;;" >
        <h3>Add New Student</h3>
                <form action="addStudent.php" method="post">
                        <br>
                        <p>
                           <label for="studentId">New Student ID(19-2*):</label>
                           <input type="text" name="STD_ID" id="studentId" value="<?php echo $STD_ID;?>">
                       </p>
                        <p>
                           <label for="firstName">First Name:</label>
                           <input type="text" name="STD_FN" id="firstName" value="<?php echo $STD_FN;?>">
                       </p>
                       <p>
                           <label for="lastName">Last Name:</label>
                           <input type="text" name="STD_LN" id="lastName" value="<?php echo $STD_LN;?>">
                       </p>
                       <p>
                           <label for="Address">Address:</label>
                           <input type="text" name="ADDR" id="Address" value="<?php echo $ADDR;?>">
                       </p>
                       <p>
                           <label for="Gender">Gender(F/M):</label>
                           <input type="text" name="GENDER" id="Gender" value="<?php echo $GENDER;?>">
                       </p>
                       <p>
                           <label for="Date Of Birth">Date Of Birth:</label>
                           <input type="date" name="DOB" id="Date Of Birth" value="<?php echo $DOB;?>">
                       </p>
                       <p>
                           <label for="Gender">Tutor ID(80*):</label>
                           <input type="text" name="TR_ID" id="tutorId" value="<?php echo $TR_ID;?>">
                       </p>
                          <button type="submit" class="button" name="add" value="Add">Add </button><br><br>
                          <?php echo $message;?><br>
                          <?php echo $message1;?>
                    </form>
                    <br><br>
        </div>
        </div>
    <!-- End Add -->


      </body>



    </html>
