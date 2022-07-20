<?php
$host = "localhost";
$user = "id15900966_tuitionsystem";
$password ="Dbp_Section3";
$database = "id15900966_tuitionsys";

$message ="";
$message1 ="";
$STD_ID = "";
$STD_FN = "";
$STD_LN= "";
$ADDR = "";
$GENDER = "";
$DOB = "";
$TR_ID = "";


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

// Search

if(isset($_POST['search']))
{
    $data = getPosts();

    $search_Query = "SELECT * FROM student WHERE  STD_ID = '$data[0]' ";

    $search_Result = mysqli_query($connect, $search_Query);

    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $STD_ID = $row['STD_ID'];
                $STD_FN = $row['STD_FN'];
                $STD_LN = $row['STD_LN'];
                $ADDR = $row['ADDR'];
                $GENDER = $row['GENDER'];
                $DOB = $row['DOB'];
                $TR_ID = $row['TR_ID'];
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
    <title>Homepage</title>
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
  <div class="header-text">
    <h1 style="font-style: Georgia; color: #fff; font-size:100px; text-align: center;">Welcome to Tuition System</h1>


  </div>
  </div>
<!-- Search Student  --><br><br><br>
      <div class="columnh" style="text-align: center;" >
                <h3>Search for Students</h3>
                <form action="index.php" method="post">
                  <input type="number" name="STD_ID" placeholder="Enter student id" value="<?php echo $STD_ID;?>"><br><br>
                  <br>
                  <?php
                  echo nl2br ("Student ID:  {$STD_ID}
                  \nStudent First Name:  {$STD_FN}
                  \nStudent Last Name:   {$STD_LN}
                  \nStudent Address:   {$ADDR}
                  \nGender:   {$GENDER}
                  \nDate of Birth:   {$DOB}
                  \nTutor ID:   {$TR_ID}");
                   ?>
                    <br><br>
                    <button type="submit" class="button" name="search" value="Find">Find </button>
                    <?php echo $message;?><br>
                    <?php echo $message1;?>
                </form>
        </div>
        </div>
    <!-- End Search -->

      </body>



    </html>
