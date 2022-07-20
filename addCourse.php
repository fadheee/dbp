<?php
$host = "localhost";
$user = "id15900966_tuitionsystem";
$password ="Dbp_Section3";
$database = "id15900966_tuitionsys";

$SUBCODE = "";
$SECTION = "";
$SUB_NAME= "";
$SUB_DAY = "";
$SUB_TIME ="";
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
  $posts[0] = $_POST['SUBCODE'];
  $posts[1] = $_POST['SECTION'];
  $posts[2] = $_POST['SUB_NAME'];
  $posts[3] = $_POST['SUB_DAY'];
  $posts[4] = $_POST['SUB_TIME'];
  return $posts;
}


// Insert
if(isset($_POST['add']))
{
    $data = getPosts();
    $insert_Query = "INSERT INTO subject (SUBCODE, SECTION, SUB_NAME, SUB_DAY, SUB_TIME) VALUES ('$data[0]', '$data[1]','$data[2]','$data[3]','$data[4]')";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);

        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                $message1 ='New course successfully added.';
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
    <title>Add Course</title>
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
        <h1 style="font-style: Georgia; color: #fff; font-size:80px; font-weight: normal; text-align: center;">Add new course</h1>

      </div>
</div>
<!-- Add Student  --><br><br><br>
      <div class="columnc" style="text-align: center;;" >
        <h3>Add New Course</h3>
                <form action="addCourse.php" method="post">
                        <br>
                        <p>
                           <label for="subCode">Subject Code:</label>
                           <input type="text" name="SUBCODE" id="subCode" value="<?php echo $SUBCODE;?>">
                       </p>
                        <p>
                           <label for="Section_">Section:</label>
                           <input type="text" name="SECTION" id="Section_" value="<?php echo $SECTION;?>">
                       </p>
                       <p>
                           <label for="subName">Subject Name:</label>
                           <input type="text" name="SUB_NAME" id="subName" value="<?php echo $SUB_NAME;?>">
                       </p>
                       <p>
                           <label for="subDay">Subject Day:</label>
                           <input type="text" name="SUB_DAY" id="subDay" value="<?php echo $SUB_DAY;?>">
                       </p>
                       <p>
                           <label for="subTime">Subject Time:</label>
                           <input type="text" name="SUB_TIME" id="subTime" value="<?php echo $SUB_TIME;?>">
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
