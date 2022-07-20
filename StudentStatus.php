<?php
$host = "localhost";
$user = "id15900966_tuitionsystem";
$password ="Dbp_Section3";
$database = "id15900966_tuitionsys";

$message ="";

$STD_ID = "";
$DOB = date_create();
$message1 ="";
$message2 ="";
$st_fname = "";
$st_lname = "";
$v_status="";
$getS="";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// connect to mysql database
try{
    $connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
    $message = 'Error';
}

function getPosts()
{
  $posts = array();
  $posts[0] = $_POST['STD_ID'];
  return $posts;
}

function getStatus($DOB)
{
  $v_due='2001-09-30';
  $status = " ";
  if ( $DOB <= $v_due) {
    $status = ' IS: GRADUATED';
  }
  else {
    $status = ' IS: NOT GRADUATE YET';
  }
  return $status;
}


// view status
if(isset($_POST['view']))
{

    $data = getPosts();
    $status_Query = "SELECT  STD_FN, STD_LN, DOB
    FROM student
    WHERE std_id = '$data[0]' ";

    try{
        $status_Result = mysqli_query($connect, $status_Query);
        if($status_Result)
        {
            if(mysqli_num_rows($status_Result))
            {
                while($row = mysqli_fetch_array($status_Result))
                {
                    $STD_ID = $data[0];
                    $st_fname = $row['STD_FN'];
                    $st_lname = $row['STD_LN'];
                    $DOB = $row['DOB'];
                    $v_status ='THE STATUS OF ';
                    $getS= getStatus($DOB);

                }
            }else{
                $message1 = 'No Data For This Student Id';
            }
        }else{
            $message1 = 'Result Error';
        }
    } catch (Exception $ex) {
        $message1 = 'Error Update '.$ex->getMessage();
    }

}



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View Student Status</title>
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
        <h1 style="font-style: Georgia; color: #fff; font-size:80px; font-weight: normal; text-align: center;">View Student Status</h1>

      </div>
</div>
<!--  Student status  --><br><br><br>
<div class="columnh" style="text-align: center;" >
          <h3>View Students Status </h3>
          <form action="StudentStatus.php" method="post">
            <input type="number" name="STD_ID" placeholder="Enter student id" value="<?php echo $STD_ID;?>"><br><br>
            <br>

            <?php
            echo nl2br (" {$v_status} {$st_fname} {$st_lname} {$getS}");
             ?>
              <br><br>
              <button type="submit" class="button" name="view" value="View">View </button><br><br>
              <?php echo $message1;?><br>
              <?php echo $message1;?><br>
              <?php echo $message2;?>
          </form>
  </div>

    <!-- End status -->


      </body>



    </html>
