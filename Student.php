<?php
$host = "localhost";
$user = "id15900966_tuitionsystem";
$password ="Dbp_Section3";
$database = "id15900966_tuitionsys";

$message ="";
$message1 ="";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// connect to mysql database
try{
    $connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
    $message = 'Error';
}


// View

if(isset($_POST['view']))
{

    $view_Query = "SELECT * FROM student  ";

    $view_Result = mysqli_query($connect, $view_Query);
    echo '<table align="center" border="1" cellspacing="2" cellpadding="2">
      <tr>
          <td> <font face="Arial">Student ID</font> </td>
          <td> <font face="Arial">Student First Name</font> </td>
          <td> <font face="Arial">Student Last Name</font> </td>
          <td> <font face="Arial">Student Address</font> </td>
          <td> <font face="Arial">Gender</font> </td>
          <td> <font face="Arial">Date of Birth</font> </td>
          <td> <font face="Arial">Tutor ID</font> </td>
      </tr>';

    if($view_Result)
    {
        if(mysqli_num_rows($view_Result))
        {
            while($row = mysqli_fetch_array($view_Result))
            {
              $field1name = $row["STD_ID"];
              $field2name = $row["STD_FN"];
              $field3name = $row["STD_LN"];
              $field4name = $row["ADDR"];
              $field5name = $row["GENDER"];
              $field6name = $row["DOB"];
              $field7name = $row["TR_ID"];

              echo '<tr>
                        <td>'.$field1name.'</td>
                        <td>'.$field2name.'</td>
                        <td>'.$field3name.'</td>
                        <td>'.$field4name.'</td>
                        <td>'.$field5name.'</td>
                        <td>'.$field6name.'</td>
                        <td>'.$field7name.'</td>
                    </tr>';

            }
        }else{
            $message1 = 'No Data For This Student Id';
        }
    }else{
        $message1 = 'Result Error';
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View Students</title>
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
        <h1 style="font-style: Georgia; color: #fff; font-size:80px; font-weight: normal; text-align: center;">View the lists of Students</h1>

      </div>
</div>
<!-- View Student  --><br><br><br>
      <div  style="text-align: center;" >

                <form action="Student.php" method="post">
                        <br>
                          <button type="submit" class="button" name="view" value="View">View </button><br>
                          <?php echo $message;?><br>
                          <?php echo $message1;?>
                    </form>
                    <br><br>
        </div>
        </div>
    <!-- End view -->


      </body>



    </html>
