<?php include "config.php";
session_start();
if(!isset($_SESSION['username'])){
header("Location: http://localhost/pdo/pdocrud_login/login.php");
}
$msg = "";
if(isset($_POST['insert'])){
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$emaiid = $_POST['emailid'];
$contactno = $_POST['contactno'];
$address = $_POST['address'];
$sql = "INSERT INTO student (first_name,last_name,email_id,contact_no,address_no) VALUES (:fname,:lname,:emailid,:contactno,:address)";
$query= $conn->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':emailid',$emaiid,PDO::PARAM_STR);
$query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
if($query->execute()){
$msg = "Data inserted successsfully";
}
else{
$msg = "Data not Inserted";
}
header("Location: http://localhost/pdo/pdocrud_login/index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>PHP CURD Operation using PDO Extension  </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Insert Record | PHP CRUD Operations using PDO Extension</h3>
                    <hr />
                </div>
            </div>
            <form name="insertrecord" method="post">
                <div class="row">
                    <div class="col-md-4"><b>First Name</b>
                        <input type="text" name="firstname" class="form-control" required>
                    </div>
                    <div class="col-md-4"><b>Last Name</b>
                        <input type="text" name="lastname" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"><b>Email id</b>
                        <input type="email" name="emailid" class="form-control" required>
                    </div>
                    <div class="col-md-4"><b>Contact No</b>
                        <input type="text" name="contactno" class="form-control" maxlength="10" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8"><b>Address</b>
                        <textarea class="form-control" name="address" required></textarea>
                    </div>
                </div>
                <div class="row" style="margin-top:1%">
                    <div class="col-md-8">
                        <input type="submit" name="insert" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>