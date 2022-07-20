<?php
$host = "localhost";
$user = "id15900966_tuitionsystem";
$password ="Dbp_Section3";
$database = "id15900966_tuitionsys";

$message ="";

$STD_ID = "";
$message1 ="";
$message2 ="";
$st_fname = "";
$st_lname = "";
$TR_ID = "";
$TR_FN = " ";
$TR_LN = "";
$v_fee = 0;
$v_total = 0 ;

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

function getDisc($v_fee, $TR_ID)
{
  $discount = 0;
  $v_tot = 0 ;
  if ( $TR_ID == 813) {
    $discount = 0.2;
  }
  elseif ($TR_ID == 808) {
    $discount = 0.1;
  }
  else {
    $discount = 0.0;
  }
  $v_tot = $v_fee - ($v_fee * $discount);
  return $v_tot;
}


// view fee
if(isset($_POST['view']))
{

    $data = getPosts();
    $fee_Query = "SELECT feepermth, STD_FN, STD_LN
    FROM fees f left join student s on s.std_id = f.std_id
    WHERE s.std_id = '$data[0]' ";

    try{
        $fee_Result = mysqli_query($connect, $fee_Query);
        if($fee_Result)
        {
            if(mysqli_num_rows($fee_Result))
            {
                while($row = mysqli_fetch_array($fee_Result))
                {
                    $STD_ID = $data[0];
                    $v_fee = $row['feepermth'];
                    $st_fname = $row['STD_FN'];
                    $st_lname = $row['STD_LN'];

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

    $disc_Query = "SELECT t.TR_ID, TR_FN, TR_LN
    FROM tutor t left join student s on s.tr_id = t.tr_id
    WHERE s.std_id ='$data[0]'";

    try{
        $disc_Result = mysqli_query($connect, $disc_Query);
        if($disc_Result)
        {
            if(mysqli_num_rows($disc_Result))
            {
                while($row = mysqli_fetch_array($disc_Result))
                {

                    $TR_ID = $row['TR_ID'];
                    $TR_FN = $row['TR_FN'];
                    $TR_LN = $row['TR_LN'];
                    $v_total = getDisc($v_fee, $TR_ID);
                }

            }else{
                $message2 = 'No Data For This Student Id';
            }
        }else{
            $message2 = 'Result Error';
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
    <title>View Student Fee</title>
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
        <h1 style="font-style: Georgia; color: #fff; font-size:80px; font-weight: normal; text-align: center;">View Student Fee</h1>

      </div>
</div>
<!--  Student fee  --><br><br><br>
<div class="columnh" style="text-align: center;" >
          <h3>View Students Fee </h3>
          <form action="StudentFee.php" method="post">
            <input type="number" name="STD_ID" placeholder="Enter student id" value="<?php echo $STD_ID;?>"><br><br>
            <br>

            <?php
            echo nl2br ("Student ID:  {$STD_ID}
            \nStudent Name:  {$st_fname} {$st_lname}
            \nTutor Name:   {$TR_FN} {$TR_LN}
            \nTotal Fee: RM  {$v_fee}
            \n(Discount only for selected tutor)\nPlease pay only: RM  {$v_total}");
             ?>
              <br><br>
              <button type="submit" class="button" name="view" value="View">View </button><br><br>
              <?php echo $message1;?><br>
              <?php echo $message1;?><br>
              <?php echo $message2;?>
          </form>
  </div>

    <!-- End fee -->


      </body>



    </html>
