<?php
include "config.php";
session_start();
if(isset($_POST['update_pass'])){
if(isset($_GET['token']))
{
$token = $_GET['token'];
	$newpass = $_POST['password'];
	$cpass = $_POST['cpassword'];
$password = password_hash($newpass,PASSWORD_BCRYPT);
	$cpassword = password_hash($cpass,PASSWORD_BCRYPT);
	if($newpass ===  $cpass)
	{
	$sql =  "UPDATE stulogin SET password=:password WHERE token=:token";
	$query = $conn->prepare($sql);
	$query->bindValue(':token',$token);
	$query->bindValue(':password',$password);
	$result=$query->execute();
	if($result)
	{
$_SESSION['msg']="Thank you! your password has been updated.";
header("Location: http://localhost/pdo/pdocrud_login/login.php");
	}else
	{
	$_SESSION['passmsg']="Sorry Password reset unsuccessful.";
	header("Location: http://localhost/pdo/pdocrud_login/reset_password.php");
}
	}else
	{
		$_SESSION['passmsg']="Password is not matching";
	}
	
	}else
	{
		echo "No token found";
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Creative Colorlib SignUp Form</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- Custom Theme files -->
		<link href="style.css" rel="stylesheet" type="text/css" media="all" />
		<!-- //Custom Theme files -->
		<!-- web font -->
		<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
		<!-- //web font -->
	</head>
	<body>
		
		<!-- main -->
		<div class="main-w3layouts wrapper">
			<h1>Update password</h1>
			<div class="main-agileinfo">
				<div class="agileits-top">
					<form action="" method="post">
						<div style="font-size: 25px;margin-left: 15px">
							<?php if(isset($_SESSION['passmsg']))
							{
							echo $_SESSION['passmsg'];
							}else
							echo $_SESSION['passmsg'] = "";
							?>
						</div><br>
						<input class="text" type="password" name="password" placeholder="Update Password" required="">
						<input class="text" type="password" name="cpassword" placeholder="confirm Password" required="">
						<div class="wthree-text">
							<label class="anim">
								<input type="checkbox" class="checkbox" required="">
								<span>I Agree To The Terms & Conditions</span>
							</label>
							<div class="clear"> </div>
						</div>
						<input type="submit" value="Reset Password" name="update_pass">
					</form>
					<?php
					
					if(isset($_SESSION['username'])){
					echo "<h2>Already Login: ".$_SESSION['username']."</h2>";
					echo '<br><a href="logout.php">Logout</a>';
					}
					?>
					
				</div>
			</div>
			
			<ul class="colorlib-bubbles">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
		<!-- //main -->
	</body>
</html>