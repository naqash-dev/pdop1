<?php
include "config.php";
session_start();
session_destroy();
header("Location: http://localhost/pdo/pdocrud_login/login.php");
?>