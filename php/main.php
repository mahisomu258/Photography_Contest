<?php
    include("connect.php");
	
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Link to CSS -->
  <link rel = "stylesheet" href = "../css/main.css">
<title>Home</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
</head>


<body style="background-color:#fdfbf4;font-family:Old Standard TT, serif;">
<div class="topnav">
  <a href="usersignup.php">Sign Up</a>
  <a href="userlogin.php">Login</a>
  <a href="#Winner">Winner</a>
  <a href="#About">About Us</a>
    <a class="active" href="#home">Home</a>
    <p style="float: left;">PIXELS</p>
</div>

<!-- <h2 id="home" style="margin:25px; text-align:center">Home</h2> -->
<img id="home" style="object-fit: contain;width:100%;height:100%" src = "https://cdn.pixabay.com/photo/2018/03/20/22/04/camera-3244872_1280.jpg">
<div class=title style="font-size:16px;border-color:#e3e5d8;background-color:#e3e5d8 ;margin:auto; margin-top:18px; margin:25px">
	<form name="login" method="get" action="compread2.php" style="padding-left:200px; margin:auto">
		<table>
		<?php
  			$fetchData = mysqli_query($con, "SELECT * FROM competition ORDER BY CompetitionID DESC LIMIT 1");
  			while($row = mysqli_fetch_assoc($fetchData)) 
  		{		
			
		$displayData = '
		<tr>
		<td rowspan="11">			
		<img src="data:image/jpg;base64, '.base64_encode($row["CompetitionImage"]).'" style="object-fit: contain;width:500px; height:600px; padding-top:10px;padding-right:35px ">
		</td>
		<td></td>
		<td colspan="3"style="font-size:24px; padding-top:10px;padding-left:15px;color:red"><b>Open for Registration Now!!!</b><br/></td>
		</tr>
		<tr><td></td></tr>
		<tr>
			<td></td>
			<td style="text-align:left;padding-left:15px;font-weight:bold">Title</td>
			<td>:</td>
			<td><input type="text" value = "'.$row["CompetitionTitle"].'" name="title" size="37" maxlength="50" style="background-color:transparent;border:none" readonly/></td>
		</tr>
		<tr>
			<td></td>
			<td style="text-align:left;padding-left:15px;font-weight:bold">Theme</td>
			<td>:</td>
			<td><input type="text" value = "'.$row["Theme"].'" name="theme" size="37" maxlength="30" style="background-color:transparent;border:none" readonly/></td>
		</tr>
		<tr>
			<td></td>
			<td style="text-align:left;padding-left:15px;font-weight:bold">Register Date</td>
			<td>:</td>
			<td><input type="text" value = "'.$row["RegisterDate"].'" name="registerdate" size="37" maxlength="15" style="background-color:transparent;border:none" readonly/></td>
		</tr>
		<tr>
			<td></td>
			<td style="text-align:left;padding-left:15px;font-weight:bold">Deadline</td>
			<td>:</td>
			<td><input type="text" value = "'.$row["Deadline"].'" name="deadline" size="37" maxlength="15" style="background-color:transparent;border:none" readonly/></td>
		</tr>
		<tr>
			<td></td>
			<td style="text-align:left;padding-left:15px;font-weight:bold">Competition Date</td>
			<td>:</td>
			<td><input type="text" value = "'.$row["CompetitionDate"].'" name="compdate" size="37" maxlength="15" style="background-color:transparent;border:none" readonly/></td>
		</tr>
		<tr>
			<td></td>
			<td style="text-align:left;padding-left:15px;font-weight:bold">Prize</td>
			<td>:</td>
			<td><textarea name = "prize" style="width: 80%;height: 80px;background:transparent;border:none;" readonly>'.$row["Prize"].'</textarea></td>
		</tr>
		<tr>
			<td></td>
			<td style="text-align:left;padding-left:15px;font-weight:bold">Eligibility</td>
			<td>:</td>
			<td><input type="text" value = "'.$row["Eligibility"].'" name="eligibility" size="37" maxlength="8" style="background-color:transparent;border:none" readonly/></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="3" style="padding-left:15px">
				<br>
				<a href="userlogin.php"><button type="button" class="btn btn-primary">Login for more information</button></a>
			</td>
		</tr>';
		echo $displayData;  
	}
	?>	
		</table>

	</form>
	</div>

	<br><br>

	<h2 id="Winner" style="margin:25px; text-align:center;font-family:Franklin Gothic Medium">Voting Session</h2>
	<div style="padding-right:10px; margin:auto">
		<div class="title" style="text-align:center;border-color:#e3e5d8;background-color:#e3e5d8;">
		<?php
  			$fetchData = mysqli_query($con, "SELECT * FROM competition ORDER BY CompetitionID DESC LIMIT 2");
  			while($row = mysqli_fetch_assoc($fetchData)) 
  		{		
			
		$displayData = '
			<input type="text" value = "'.$row["CompetitionTitle"].'" name="title" style="height:50px;border:none;border-color:#e3e5d8;background-color:#e3e5d8;font-size:28px" readonly/>
			<b style="font-size:28px"></b><br/><br/>
			<img src="data:image/jpg;base64, '.base64_encode($row["CompetitionImage"]).'" style="object-fit: contain;max-width:500px;max-height:500px">
			<br><br>
			<form method="get" action="userlogin.php">
			<input type ="submit" class="btn btn-primary"  value= "Click here to vote and Comment"/>
			<input style="display:none;" type="text" name="CompID" value='.$row["CompetitionID"]. '>
			</form>
			<br><br>';
			echo $displayData;  
		}
		?>	
		</div>
	
	</div>

	<div style="padding-right:10px; margin:auto" >
	<div class="title" style="text-align:center;height:300px;border-color:#e3e5d8;background-color:#e3e5d8  ;padding-top:20px">
		<img style="object-fit: contain;width:150px;height:300px;margin-right:30px" src = "../image/clickhere.png">
		<a href="userlogin.php">
				<button type="button" class="btn btn-primary">Click here for more competitions</button>
			</a>
		</div>
	</div>
<br>
<br>


<h2 id="Winner" style="margin:25px; text-align:center;font-family:Franklin Gothic Medium">Winner Dashboard</h2>
<div class="title" style="border-color:#e3e5d8;background-color:#e3e5d8 ">
	<p style="text-align:center; font-size:24px">Winner for the latest competition:</p>
	<?php
  			$fetchData = mysqli_query($con, "SELECT * FROM winner1 ORDER BY winnerID DESC LIMIT 1");
  			while($row = mysqli_fetch_assoc($fetchData)) 
  		{		
			
		$displayData = '
			<div style="font-size:24px;font-weight:bold;padding-left:500px">
			<u>Competition Title: <input type="text" value = "'.$row["wcompTitle"].'" name="title" style="border:none;background-color:transparent;font-weight: bold;text-decoration: underline;" readonly/>
			</u></div><br>
			';
			echo $displayData;  
		}
		?>
	<div style="display:flex;justify-content:space-around;text-align:center">
	<?php
  			$fetchData = mysqli_query($con, "SELECT * FROM `winner1` ORDER BY winnerID DESC LIMIT 1");
  			while($row = mysqli_fetch_assoc($fetchData)) 
  		{		
			
		$displayData = '
			<div style="display:inline-block;font-size:18px">
			<h3>1st Place Winner</h3>
			<img style="object-fit: contain;width:100%;height:300px" src="data:image/jpg;base64, '.base64_encode($row["wcontentImage"]).'"><br>
			<div style="text-align:center"><b>Content Title:</b> <input type="text" value = "'.$row["wcontentTitle"].'" name="ctitle" style="border:none;background-color:transparent" readonly/></div>
			<div style="padding-left:30px"><b>Participant Name:</b><input type="text" value = "'.$row["wname"].'" name="name" style="border:none;background-color:transparent" readonly/></div>
			</div>
			';
			echo $displayData;  
		}
		?>
			
	<?php
  			$fetchData = mysqli_query($con, "SELECT * FROM `winner2` ORDER BY winnerID DESC LIMIT 1");
  			while($row = mysqli_fetch_assoc($fetchData)) 
  		{		
			
		$displayData = '
			<div style="display:inline-block;text-align:center;font-size:18px;">
			<h3>2nd Place Winner</h3>
			<img style="object-fit: contain;width:100%;height:300px"src="data:image/jpg;base64, '.base64_encode($row["wcontentImage"]).'">
			<br><div style="padding-left:50px"><b>Content Title:</b> <input type="text" value = "'.$row["wcontentTitle"].'" name="ctitle" style="border:none;background-color:transparent" readonly/></div>
			<div style="padding-left:90px"><b>Participant Name:</b> <input type="text" value = "'.$row["wname"].'" name="name" style="border:none;background-color:transparent" readonly/></div>
			</div>
			';
			echo $displayData;  
		}
		?>

	<?php
  			$fetchData = mysqli_query($con, "SELECT * FROM `winner3` ORDER BY winnerID DESC LIMIT 1");
  			while($row = mysqli_fetch_assoc($fetchData)) 
  		{		
			
		$displayData = '
			<div style="display:inline-block;text-align:center;font-size:18px">
			<h3>3rd Place Winner</h3>
			<img style="object-fit: contain;width:100%;height:300px" src="data:image/jpg;base64, '.base64_encode($row["wcontentImage"]).'">
			<br><div style="padding-left:40px"><b>Content Title:</b><input type="text" value = "'.$row["wcontentTitle"].'" name="ctitle" style="border:none;background-color:transparent" readonly/></div>
			<div style="padding-left:80px"><b>Participant Name:</b><input type="text" value = "'.$row["wname"].'" name="name" style="border:none;background-color:transparent" readonly/></div>
			</div>
			';
			echo $displayData;  
		}
		?>
	</div>
</div><br/><vr/>

<h2 id="About" style="margin:25px; text-align:center;font-family:Franklin Gothic Medium;">About Us</h2>
<div class="title" style="text-align:justify; margin:25px;font-size:20px;border-color:#e3e5d8;background-color:#e3e5d8;"> 
<img style="object-fit: contain;width:50%;height:300px;margin-left:auto;margin-right:auto;display:block" src = "https://lh3.googleusercontent.com/p/AF1QipOWs7Y5ePwBqiN5M9adp_5EhwT2NcrN2LaoJeNw=s1360-w1360-h1020">
	<br>	
	<p>We are passionate about photography and believe everyone deserves a platform to showcase their talent. That's why we created PIXELS, a photography competition website dedicated to fostering creativity and celebrating the power of visual storytelling.</p>
	<p>What Makes Us Unique is our Fair Voting System. This system ensures that every image is judged on its own artistic merit, not simply by how many friends or followers a photographer has. We also have a supportive Community.We foster a positive and constructive environment where photographers can learn from each other, share feedback, and grow their skills.Whether you're a seasoned professional or a budding enthusiast with a passion for capturing the world around you, we invite you to join our vibrant community. Submit your photos, participate in competitions, and discover the beauty of storytelling through the lens.</p>
	<br/><br/>
	<a href="userlogin.php"><p style="text-align:center; font-size:20px;color:blue">LOGIN and JOIN US NOW!!</p></a>
</div>
<br><br><br><br>

<!-- footer -->
<div class="footer" style="font-size:14px" >
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