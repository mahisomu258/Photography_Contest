<?php
include("connect.php");
include("session.php");
$customerID = $_SESSION['Customer_ID'];

?>

<!DOCTYPE html>
<html>

<head>
  <title>Photography competition</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../css/default.css" rel="stylesheet" type="text/css">
</head>

<body style="background-color:#fdfbf4;font-family:Old Standard TT, serif">


  <div class="topnav">
    <a href="logout.php">Logout</a>
    <a href="editprofile.php">Profile</a>
    <a href="userhome.php">Winner</a>
    <a href="userhome.php">About Us</a>
    <a class="active" href="userhome.php">Home</a>
    <p style="float: left;">PIXELS</p>

  </div>

  <p style="margin-left:50px; margin-top:20px">
    <a href="userhome.php"><button class="button button1">BACK</button></a>
  </p>

  <br>
  <br>
  <br>

  <form name="compread2" action="viewcontent.php" method="get" style=" padding-left:6px;">
    <?php
    $fetchData = mysqli_query($con, "SELECT * FROM competition ORDER BY CompetitionID Desc");
    while ($row = mysqli_fetch_assoc($fetchData)) {

      $displayData = '
      
      <div class="box1" style="background-color:#e3e5d8;text-align:center;">
      <h2>Title: <input type="text" value = "' . $row["CompetitionTitle"] . '" name="title"  style="width:200px" readonly/></h2>
      <img src="data:image/jpg;base64, ' . base64_encode($row["CompetitionImage"]) . '" style="width:300px; height:300px; ">
      <br>
      <br>

      <p> Theme: <input type="text" value = "' . $row["Theme"] . '" name="theme"   readonly/></p>
      <p> Register Date: <input type="text" value = "' . $row["RegisterDate"] . '" name="registerdate"   readonly/> </p>
      <p> Deadline: <input type="text" value = "' . $row["Deadline"] . '" name="deadline"  style="width:210px" readonly/></p>
      <p> Competition Date: <input type="text" value = "' . $row["CompetitionDate"] . '" name="compdate"  style="width:150px" readonly/></p>
      <p> Prize:  <textarea name = "prize" cols=40  rows=3 style="width: 80%;height: 90px;background: #f1f1f1;font-size:16px" readonly>' . $row["Prize"] . '</textarea></p>
      <p> Eligibility: <input type="text" value = "' . $row["Eligibility"] . '" name="eligibility"   readonly/></p>

    </div> 
    <div class="box2" style="background-color:#e3e5d8; margin-bottom:100px">
      <h3> Description </h3>
      <textarea name = "description" cols=40  rows=3 style="width: 90%;height: 330px;margin-left:25px;background: #f1f1f1;font-size:20px" readonly>' . $row["Description"] . '</textarea>
      
      <h3> Guideline </h3>
      <textarea name = "guideline" cols=40  rows=3 style="width: 90%;height: 345px;margin-left:25px;background: #f1f1f1;font-size:20px" readonly>' . $row["Guideline"] . '</textarea>

      <form method="get" action="viewcontent.php">
      <div style="padding-right:10px;padding-bottom:50px">
      <input type ="submit" class="btn btn-primary" style="margin-left:530px;"  value= "Go Voting"/>
      <input style="display:none;" type="text" name="CompID" value=' . $row["CompetitionID"] . '>	
      </div>
      </form>
    </div> ';
      echo $displayData;
    }
    ?>
  </form>

</body>

</html>