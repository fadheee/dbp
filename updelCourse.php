<?php
$host = "localhost";
$user = "id15900966_tuitionsystem";
$password ="Dbp_Section3";
$database = "id15900966_tuitionsys";

$message ="";

$SUBCODE = "";
$SECTION = "";
$SUB_NAME= "";
$SUB_DAY = "";
$SUB_TIME ="";
$message1 ="";
$message2 ="";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// connect to mysql database
try{
    $connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
    $message = 'Error';
}

function getPosts1()
{
  $posts = array();
  $posts[0] = $_POST['SUBCODE'];
  $posts[1] = $_POST['SECTION'];
  return $posts;
}

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


// Delete
if(isset($_POST['delete']))
{
    $data = getPosts1();
    $delete_Query = "DELETE  FROM `subject` WHERE `SUBCODE` = '$data[0]' AND `SECTION` = '$data[1]' ";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);

        if($delete_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                $message1 = 'Data Deleted';
            }else{
                $message1 = 'Data Not Deleted';
            }
        }
    } catch (Exception $ex) {
        $message1 = 'Error Delete '.$ex->getMessage();
    }
}

// Edit
if(isset($_POST['update']))
{
    $data = getPosts();
    $update_Query = "UPDATE `subject` SET `SECTION` = '$data[1]', `SUB_NAME` = '$data[2]', `SUB_DAY` = '$data[3]', `SUB_TIME` = '$data[4]' WHERE `SUBCODE` = '$data[0]'";
    try{
        $update_Result = mysqli_query($connect, $update_Query);

        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                $message2 = 'Data Updated';
            }else{
                $message2 = 'Data Not Updated';
            }
        }
    } catch (Exception $ex) {
        $message2 = 'Error Update '.$ex->getMessage();
    }
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update/Delete Course</title>
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
        <h1 style="font-style: Georgia; color: #fff; font-size:80px; font-weight: normal; text-align: center;">Update/Delete course</h1>

      </div>
</div>
<!-- UPDEL Student  --><br><br><br>
<div class="two">
          <div class="column1">
                      <h3>Delete Course</h3>
                      <p>Please enter the correct values. You may refer to the list of courses for reference.</p>
                      <form action="updelCourse.php" method="post">
                          <input type="number" name="SUBCODE" placeholder="Subject Code" value="<?php echo $SUBCODE;?>"><br><br>
                           <input type="number" name="SECTION" placeholder="Section" value="<?php echo $SECTION;?>"><br><br>
                          <button type="submit" class="button" name="delete" value="Delete">Delete </button><br><br>
                          <?php echo $message1;?></form>
                        </div>

                        <div class="column2">
                            <h3>Update Course</h3>
                            <p>Please enter the correct values. You may refer to the list of courses for reference.</p>
                            <form action="updelCourse.php" method="post">
                              <p>Insert the subject code that you want to update</p>
                                <input type="number" name="SUBCODE" placeholder="Subject Code" value="<?php echo $SUBCODE;?>"><br><br>
                              
                                <p>Update the course's section, subject name, subject day and subject time</p>
                                <input type="number" name="SECTION" placeholder="Section" value="<?php echo $SECTION;?>"><br><br>
                                <input type="text" name="SUB_NAME" placeholder="Subject name" value="<?php echo $SUB_NAME;?>"><br><br>
                                <input type="text" name="SUB_DAY" placeholder="Subject day" value="<?php echo $SUB_DAY;?>"><br><br>
                                <input type="text" name="SUB_TIME" placeholder="Subject time" value="<?php echo $SUB_TIME;?>"><br><br>
                                <button type="submit" class="button" name="update" value="Update">Update </button><br><br>
                                <?php echo $message;?><br>
                                <?php echo $message1;?><br>
                                <?php echo $message2;?>
                                </form>
                              </div>
                              </div>

    <!-- End UPDEL -->


      </body>



    </html>
