<?php
include "config.php";
session_start();
 if(!isset($_SESSION['username'])){
     header("Location: http://localhost/pdo/pdocrud_login/login.php");
   } 

// Code for record deletion
elseif(isset($_REQUEST['del']))
{
//Get row id
$uid=$_GET['del'];
//Qyery for deletion
$sql = "delete from student WHERE  id=:id";
// Prepare query for execution
$query = $conn->prepare($sql);
// bind the parameters
$query-> bindParam(':id',$uid, PDO::PARAM_STR);
// Query Execution
$query -> execute();
// Mesage after updation
echo "<script>alert('Record Updated successfully');</script>";
// Code for redirection
echo "<script>window.location.href='index.php'</script>";
}

 ?>