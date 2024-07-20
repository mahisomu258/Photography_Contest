<!DOCTYPE html>
<html>
<head>
<title>Forgot password</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../css/default.css" rel="stylesheet" type="text/css">
<style>
.popup{
    width:400px;
    background: #C4D9FE;
    border-radius:6px;
    border:5px solid;
    position: absolute;
    top:0;
    left:50%;
    transform:translate(-50%,-50%)scale(0.1);
    text-align:center;
    padding: 0 30px 30px;
    color:#333;
    visibility:hidden;
    transition: transform 0.4s,top 0.4s;
}
.popup h2{
    font-size:38px;
    font-weight:500;
    margin: 30px 30px;
}
.popup button{
    width:100%;
    margin-top:50px;
    padding: 10px 0;
    background: #6fd649;
    color: #fff;
    border: 0;
    outline: none;
    font-size: 18px;
    border-radius:4px;
    cursor: pointer;
    box-shadow: 0 5px 5px rgba(0,0,0,0.2);
}
.open-popup{
    visibility:visible;
    position:fixed;
    left:50%;
    top:50%;
    transform:translate(-50%,-50%)scale(1);
}

</style>
</head>


<body style="background-image:url('../image/bg.gif');font-family:Old Standard TT, serif;">
<div class="topnav">
  <a href="usersignup.php">Sign Up</a>
  <a href="userlogin.php">Login</a>
  <a href="#Winner">Winner</a>
  <a href="#About">About Us</a>
    <a class="active" href="#home">Home</a>
    <p style="float: left;">PIXELS</p>

</div>
<br><br><br><br><br>

<div class="logintitle" style="width:500px; text-align:center;margin:auto">
	<img alt="" src="../image/reset.png" width="80px" height="80px">
	<h2>Reset Password</h2>
	<button type="submit" class="button button1" onclick="openPopup()">Gmail</button>
	<div class = "popup" id="popup">
    	<h2>Password Changed!</h2>
        <p>Recovery password is successfully send to your Gmail account.</p>
        <button type="button" onclick="closePopup()">OK</button>
    </div><br/><br/>
    <a href="userlogin.php" >
	<button type="button" class="button button1">Back to login page</button>
    </a>
    <p>A password change verification will send to your Gmail account.</p>
</div>

<script>
let popup = document.getElementById("popup");

function openPopup(){
    popup.classList.add("open-popup");
}
function closePopup(){
    popup.classList.remove("open-popup");
}

</script>

<!-- footer -->
<div class="footer" style="margin-top:100px">
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
