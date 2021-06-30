
<?php
// include database connection file
include "config.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>PHP CRUD Operations using PDO Extension </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
        <style >
        </style>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>PHP CRUD Operations using PDO Extension with login and logout function</h3> <hr />
                    <?php
                    if(isset($_SESSION['username'])){
                    echo "<h2>Login: ".$_SESSION['username']."</h2>";
                    echo '<a href="insert.php"><button class="btn btn-primary"> Insert Record</button></a><br><br>';
                    echo '<a href="logout.php"><button class="btn btn-primary">Logout</button></a><br><br>';
                    }else{
                    echo '<p>If you are already Registered just go to login for Update Record<a href="login.php"> Login Now!</a></p>';
                    }
                    ?>
                    <!-- <a href="insert.php"><button class="btn btn-primary"> Insert Record</button></a> -->
                    <div class="table-responsive">
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                
                                
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * from student";
                                //Prepare the query:
                                $query = $conn->prepare($sql);
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
                                <!-- Display Records -->
                                <tr>
                                    <td><?php echo ($result->id);?></td>
                                    <td><?php echo ($result->first_name);?></td>
                                    <td><?php echo ($result->last_name);?></td>
                                    <td><?php echo ($result->email_id);?></td>
                                    <td><?php echo ($result->contact_no);?></td>
                                    <td><?php echo ($result->address_no);?></td>
                                    <td><a href="update.php?id=<?php echo ($result->id);?>"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a></td>
                                    <td><a href="delete.php?del=<?php echo ($result->id);?>"><button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete");' ><span class="glyphicon glyphicon-trash"></span></button></a></td>
                                    
                                </tr>
                                <?php
                                // for serial number increment
                                // $cnt++;
                                }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>