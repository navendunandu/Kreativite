<?php
session_start();
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<a href="../Guest/login.php">Logout</a>
<h1>Welcome Admin</h1>
<h2><?php echo $_SESSION["aname"]?></h2>
<p>&nbsp;</p>
<table width="200" border="1">
  <tr>
    <td><a href="AdminRegistration.php">AdminRegistration</a></td>
  </tr>
  <tr>
     <td><a href="State.php">State</a></td>
  </tr>
  <tr>
     <td><a href="district.php">District</a></td>
  </tr>
  <tr>
     <td><a href="place.php">Place</a></td>
  </tr>
  <tr>
      <td><a href="UserType.php">UserType</a></td>
  </tr>
  <tr>
     <td><a href="HiringTeamVerification.php">HiringTeamVerification</a></td>
  </tr>
  <tr>
    <td><a href="HiringTeamAcceptedList.php">HiringTeam Accepted List</a></td>
  </tr>
  <tr>
    <td><a href="HiringTeamRejectedList.php">HiringTeam Rejected List</a></td>
  </tr>
  <tr>
      <td><a href="LocationLenderVerification.php">LocationLenderVerification</a></td>
  </tr>
  <tr>
    <td><a href="LocationLenderAcceptedList.php">LocationLender Accpeted List</a></td>
  </tr>
  <tr>
    <td><a href="LocationLenderRejectedList.php">LocationLender Rejected List</a></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

