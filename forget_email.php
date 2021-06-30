<?php
include "config.php";
session_start();
if(isset($_POST['submit'])){
$email = $_POST['email'];
$sql = "SELECT * FROM stulogin WHERE email = :email";
$query = $conn->prepare($sql);
$query->bindValue(':email',$email);
$query->execute();
// $query->store_result();
$row = $query->fetch(PDO::FETCH_ASSOC);
if($row)
{
$username = $row['username'];
$token = $row['token'];
// $to_email = "receipient@gmail.com";
$subject = "Password Reset";
$body = "Hi, $username Click here to reset your password
http://localhost/pdo/pdocrud_login/reset_password.php?token=$token";
$headers = "From:alinaqash71@gmail.com";
if(mail($email, $subject, $body, $headers)) {
$_SESSION['msg']="Check you email to reset your password.";
header("Location: http://localhost/pdo/pdocrud_login/login.php");
} else {
echo "Email sending failed...";
}
}else
{
echo "No Email Found";
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
      <h1>Recover Acount</h1>
      <div class="main-agileinfo">
        <div class="agileits-top">
          <form action="#" method="post">
            
            <input class="text email" type="email" name="email" placeholder="Email" required="">
            
            <div class="wthree-text">
              <label class="anim">
                <input type="checkbox" class="checkbox" required="">
                <span>I Agree To The Terms & Conditions</span>
              </label>
              <div class="clear"> </div>
            </div>
            <input type="submit" value="Send Email" name="submit">
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