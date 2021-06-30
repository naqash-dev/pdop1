  <?php 
include "config.php";
session_start();
  

   if(isset($_SESSION['username'])){
        echo "<h2>Already Login: ".$_SESSION['username']."</h2>";
        echo '<br><a href="logout.php">Logout</a>';
        header("Location: http://localhost/pdo/pdocrud_login/index.php");
   } 


	 if(isset($_POST['login']))
	 {
	 	    $email = $_POST['email'];
	 	    $passverify = $_POST['password'];
			$sql = "SELECT * FROM stulogin WHERE email = :email and status = 'active'";
			$query = $conn->prepare($sql);
			$query->bindValue(':email',$email);
			$query->execute();
		    $user = $query->fetch(PDO::FETCH_ASSOC);
          
			if($user === false){
             $_SESSION['msg']= "Incorrect email";
			}else
			{
				$validpass = password_verify($passverify, $user['password']);
            
				 if($validpass){
				 	$_SESSION['user_id'] = $user['id'];
				 	$_SESSION['username'] = $user['username'];
				 	header("Location: http://localhost/pdo/pdocrud_login/index.php");
				 }else{
				 $_SESSION['msg']="Incorrect email password";
				 }

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
		<h1>Login Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="#" method="post">
					<input class="email" type="email" name="email" placeholder="Email" required="">
					 
					<input class="text" type="password" name="password" placeholder="Password" required="">
					 
					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" name= "login" value="LOGIN">
				</form>
				<p>Forget Password? <a href="forget_email.php">Click Here!</a></p><br>
				<p>Don't have an Account? <a href="signup.php">Sign Up!</a></p><br>
<div style="font-size: 25px;margin-left: 15px">
	<?php if(isset($_SESSION['msg'])){
		echo $_SESSION['msg'];
		}else{
         echo $_SESSION['msg']="you are logout please login again.";
		} 
		?>
</div>
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