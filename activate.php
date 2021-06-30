<?php
include "config.php";
session_start();

if(isset($_SESSION['username'])){
echo "<h2>Already Login: ".$_SESSION['username']."</h2>";
echo '<br><a href="logout.php">Logout</a>';
}
if(isset($_GET['token'])){
	$token = $_GET['token'];
	$sql = "update stulogin SET status = :status WHERE token = :token ";
$query = $conn->prepare($sql);
$query->bindValue(':status','active',PDO::PARAM_STR);
$query->bindValue(':token',$token,PDO::PARAM_STR);
$result = $query->execute();
	if($result){
		$_SESSION['msg'] = "Account activated successfully.";
		header("Location: http://localhost/pdo/pdocrud_login/login.php");
	}else{
		$_SESSION['msg']= "Sorry Acccount activate unsuccessful.";
		header("Location: http://localhost/pdo/pdocrud_login/signup.php");
	}
	
}
?>