<?php
session_start();
 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<h1>Welcome <?php echo $_SESSION["hname"] ?></h1>
<a href="Myprofile.php">My Profile</a>
<a href="Editprofile.php">Edit Profile</a>
<a href="Changepassword.php">CHange Password</a>
<a href="AddProject.php">AddProject</a>
<a href="ViewLocation.php">View Location</a>
<a href="Mybooking.php">My Bookings</a>
<a href="ViewApplication.php">View Application</a>

</body>
</html>