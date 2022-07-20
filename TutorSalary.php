<?php
$host = "localhost";
$user = "id15900966_tuitionsystem";
$password ="Dbp_Section3";
$database = "id15900966_tuitionsys";

$message ="";


$message1 ="";
$message2 ="";
$TR_ID = "";
$TR_FN = " ";
$TR_LN = "";
$AMT = "";
$SALARY = 0;
$N_SALARY = 0 ;

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
  $posts[0] = $_POST['TR_ID'];
  $posts[1] = $_POST['AMT'];
  return $posts;
}

function raiseSalary($AMT, $SALARY)
{
  $new_sal = 0 ;

  $new_sal = $AMT + $SALARY;
  return $new_sal;
}


// view fee
if(isset($_POST['raise']))
{

    $data = getPosts();
    $sal_Query = "SELECT  TR_FN, TR_LN, SALARY
    FROM tutor
    WHERE TR_ID = '$data[0]' ";

    try{
        $sal_Result = mysqli_query($connect, $sal_Query);
        if($sal_Result)
        {
            if(mysqli_num_rows($sal_Result))
            {
                while($row = mysqli_fetch_array($sal_Result))
                {
                    $TR_ID = $data[0];
                    $AMT = $data[1];
                    $TR_FN = $row['TR_FN'];
                    $TR_LN = $row['TR_LN'];
                    $SALARY = $row['SALARY'];
                    $N_SALARY = raiseSalary($AMT, $SALARY);

                }
            }else{
                $message1 = 'No Data For This Tutor Id';
            }
        }else{
            $message1 = 'Result Error';
        }
    } catch (Exception $ex) {
        $message1 = 'Error Update '.$ex->getMessage();
    }

    $update_Query = "UPDATE `tutor` SET `SALARY` = '$N_SALARY' WHERE `TR_ID` = '$data[0]'";
    try{
        $update_Result = mysqli_query($connect, $update_Query);

        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                $message2 = 'Salary Updated';
            }else{
                $message2 = 'Salary Not Updated';
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
    <title>Raise Tutor Salary</title>
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
        <h1 style="font-style: Georgia; color: #fff; font-size:80px; font-weight: normal; text-align: center;">Raise Tutor Salary</h1>

      </div>
</div>
<!--  Student fee  --><br><br><br>
<div class="columnh" style="text-align: center;" >
          <h3>Raise Tutor Salary </h3>
          <form action="TutorSalary.php" method="post">
            <input type="number" name="TR_ID" placeholder="Enter tutor id" value="<?php echo $TR_ID;?>"><br><br>
            <input type="number" name="AMT" placeholder="Enter the amount to raise" value="<?php echo $AMT;?>"><br><br>

            <?php
            echo nl2br ("Tutor ID:  {$TR_ID}
            \nTutor Name:   {$TR_FN} {$TR_LN}
            \nPrevious Salary: RM  {$SALARY}
            \nNew Salary: RM  {$N_SALARY}");
             ?>
              <br><br>
              <button type="submit" class="button" name="raise" value="Raise">Raise </button><br><br>
              <?php echo $message;?><br>
              <?php echo $message1;?><br>
              <?php echo $message2;?>
          </form>
  </div>

    <!-- End fee -->


      </body>



    </html>
