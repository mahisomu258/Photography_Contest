<?php
include("connect.php");
include("adminsession.php");
$AdminID = $_SESSION['adminID'];
?>

<!DOCTYPE html>
<html>

<head>
	<title>Content</title>
	<style>
		.popup {
			width: 400px;
			background: #C4D9FE;
			border-radius: 6px;
			border: 5px solid;
			position: absolute;
			top: 0;
			left: 50%;
			transform: translate(-50%, -50%)scale(0.1);
			text-align: center;
			padding: 0 30px 30px;
			color: #333;
			visibility: hidden;
			transition: transform 0.4s, top 0.4s;
		}

		.popup h2 {
			font-size: 38px;
			font-weight: 500;
			margin: 30px 30px;
		}

		.popup button {
			width: 100%;
			margin-top: 50px;
			padding: 10px 0;
			background: #6fd649;
			color: #fff;
			border: 0;
			outline: none;
			font-size: 18px;
			border-radius: 4px;
			cursor: pointer;
			box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
		}

		.open-popup {
			visibility: visible;
			position: fixed;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%)scale(1);
		}
	</style>
	<link href="../css/default.css" rel="stylesheet" type="text/css">
</head>

<body style="background-image:url('../image/bg.gif');font-family:Old Standard TT, serif;">
	<div class="topnav">
		<a href="logout.php">Logout</a>
		<a href="adminhome.php">Winner</a>
		<a class="active" href="adminhome.php">Home</a>
		<p style="float: left;">PIXELS</p>
	</div>
	<nav class="buttonbackground">
		<p>
			<a href="adminhome.php"><button class="compbtn">Back</button></a>
		</p>
	</nav>
	<h2 style="text-align:center">PARTICIPANT CONTENT</h2>

	<form method="get">
		<?php
		$fetchData = mysqli_query($con, "SELECT * FROM competition WHERE CompetitionID = " . $_GET['CompID']);
		while ($row = mysqli_fetch_assoc($fetchData)) {

			$displayData = '
			<h2 style="text-align:center"><input type="text" value = "' . $row["CompetitionTitle"] . '" name="title" size="30" maxlength="60" style="background-color:transparent;font-size:24px; text-align:center" readonly/></h2>';
			echo $displayData;
		}
		?>
	</form>

	<br>

	<!-- <form method="get" action="comment.php" style="margin:auto"> -->
	<nav class="content1 title">
		<?php
		$fetchData = mysqli_query($con, "SELECT * FROM verifycontent WHERE vcompetitionID = " . $_GET['CompID']);
		while ($row = mysqli_fetch_assoc($fetchData)) {
			echo '<input style="display:none;" type="text" name="CompID" value=' . $_GET["CompID"] . '>';

			$displayData = '
	  
<div class="flex-container" style="margin:auto;  justify-content:center">
	<div style="padding-top:80px">
		<div id="contentpicture1">
		<img src="data:image/jpg;base64, ' . base64_encode($row["vcontentImage"]) . '" style="width:400px; height:250px">
		</div>
	</div>

	<div>
		<div id="contentdescription1" style="width:600px; height:420px">
			
			<label for="ContentTitle"><b>Content Title:</b><input type="text" value = "' . $row["vcontentTitle"] . '" name="title"  class="compread2" style="width:300px" readonly/></label>
			<br>
			<label for="Description"><b>Description: </b></label>
			<div style="padding-left:10px"><textarea name = "description" cols=40  rows=3 style="width: 80%;height: 90px;margin-top:15px;background: #f1f1f1" readonly>' . $row["vcontentDescription"] . '</textarea></div>
			<label for="Participant"><b>Participant Name: </b><input type="text" value = "' . $row["ParticipantName"] . '" name="name"  class="compread2" readonly/></label>
			
	
			<form name="viewcomment" method="get" action="adminreadcomment.php">

				<input type ="submit" value= "Read Comments" style="width:540px;background-color:#AFB4A4;cursor: pointer;"/>	
				<input style="display:none;" type="text" name="vconID" value=' . $row["vcontentID"] . '>
				<input style="display:none;" type="text" name="vcompetitionID" value=' . $row["vcompetitionID"] . '>
			</form>

		</div>
	</div>
</div>';
			echo $displayData;
		}
		?>
	</nav>
	<!-- </form> -->
	<!-- <form name="comment" method="get" action="comment.php" style="padding-left:200px; margin:auto">
			<div style="display:inline-block; float:right;">		
				<input class = "button button1" type ="submit"  value= "Comment" name="comment" style="width:100px;margin-right:20px"/>	
				<input style="display:none;" type="text" name="vconID" value='.$row["vcontentID"].'>
				<input style="display:none;" type="text" name="vcompetitionID" value='.$row["vcompetitionID"].'>
				
			</div>
			</form> -->
	<script>
		let popup = document.getElementById("popup");

		function openPopup() {
			popup.classList.add("open-popup");
		}

		function closePopup() {
			popup.classList.remove("open-popup");
		}
	</script>

	<!-- footer -->
	<div class="footer column" style="font-size:14px">
		<div class="flex-container" style="align-items:center; justify-content:center; text-align:left">
			<div style="padding-top:20px">
				<img class="logo" style="width:120px; height:100px" src="https://t3.ftcdn.net/jpg/05/00/09/00/360_F_500090048_Vwr47TpMANq2xG8YHmOo4mFtw0PPkXAt.jpg"></br></br>
			</div>
			<div>
            <p><b>PIXELS</b></p>
            SRM university, </br>
            neerukonda,</br>
            guntur,andhrapradesh</br>
          </div></br>
	</div></br>
</body>

</html>