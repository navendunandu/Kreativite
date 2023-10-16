<?php
session_start();
 ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<h1>Welcome <?php echo $_SESSION["uname"] ?></h1>
<a href="Myprofile.php">myprofile</a>
<a href="Editprofile.php">Edit Profile</a>
<a href="Changepassword.php">Change Password</a>
<a href="Previouswork.php">Previous Works</a>
<a href="ViewProject.php">View Projects</a>
<a href="ViewApplication.php">View Applications</a>
<body>
</body>
</html>