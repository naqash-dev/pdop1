<?php
include "config.php";
session_start();
if(!isset($_SESSION['username'])){
header("Location: http://localhost/pdo/pdocrud_login/login.php");
}
// include database connection file
if(isset($_POST['update']))
{
// Get the userid
$userid=$_GET['id'];
// Posted Values
$fname=$_POST['firstname'];
$lname=$_POST['lastname'];
$emailid=$_POST['emailid'];
$contactno=$_POST['contactno'];
$address=$_POST['address'];
// Query for Updation
$sql="update student set first_name=:fname,last_name=:lname,email_id=:emailid,contact_no=:contactno,address_no=:address where id=:uid";
//Prepare Query for Execution
$query = $conn->prepare($sql);
// Bind the parameters
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
$query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':uid',$userid,PDO::PARAM_STR);
// Query Execution
$query->execute();
// Mesage after updation
echo "<script>alert('Record Updated successfully');</script>";
// Code for redirection
echo "<script>window.location.href='index.php'</script>";
}
// Get the userid
$userid=$_GET['id'];
$sql = "SELECT * from student where id=:uid";
//Prepare the query:
$query = $conn->prepare($sql);
//Bind the parameters
$query->bindParam(':uid',$userid,PDO::PARAM_STR);
//Execute the query:
$query->execute();
//Assign the data which you pulled from the database (in the preceding step) to a variable.
$results=$query->fetchAll(PDO::FETCH_OBJ);
// For serial number initialization
// $cnt=1;
if($query->rowCount() > 0)
{
//In case that the query returned at least one record, we can echo the records within a foreach loop:
foreach($results as $result)
{
?>
<form name="insertrecord" method="post">
	<div class="row">
		<div class="col-md-4"><b>First Name</b>
			<input type="text" name="firstname" value="<?php echo ($result->first_name);?>" class="form-control" required>
		</div>
		<div class="col-md-4"><b>Last Name</b>
			<input type="text" name="lastname" value="<?php echo ($result->last_name);?>" class="form-control" required>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4"><b>Email id</b>
			<input type="email" name="emailid" value="<?php echo ($result->email_id);?>" class="form-control" required>
		</div>
		<div class="col-md-4"><b>Contactno</b>
			<input type="text" name="contactno" value="<?php  echo ($result->contact_no);?>" class="form-control" maxlength="10" required>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8"><b>Address</b>
			<textarea class="form-control" name="address" required><?php echo ($result->address_no);?></textarea>
		</div>
	</div>
	<?php }} ?>
	<div class="row" style="margin-top:1%">
		<div class="col-md-8">
			<input type="submit" name="update" value="Update">
		</div>
	</div>
</form>