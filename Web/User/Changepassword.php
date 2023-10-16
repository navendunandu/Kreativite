<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/connection.php");
session_start();

if(isset($_POST["btn_submit"]))
{
	$selQuery = "select * from tbl_userregistration where user_id = '".$_SESSION["uid"]."'";
	$userData = $con->query($selQuery);
	$userRow = $userData->fetch_assoc();
	$dbPassword = $userRow["userreg_password"];
	$oldPassword = $_POST["existing-password"];
	$newPassword = $_POST["new-password"];
	$confirm = $_POST["confirm-password"];
	
	if(($dbPassword == $oldPassword)&&($newPassword == $confirm))
	{
		$updateQuery = "update tbl_userregistration set userreg_password ='".$newPassword."' where userreg_id='".$_SESSION["uid"]."'";
		if($con->query($updateQuery))
		{
			echo "Updation Success";
		}
		else
		{
			echo "Updation Failed";
		}
	}
	else
	{
		echo "Invalid entry";
	}
}


 ?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>

<form method="post">
	<table>
    <tr>
    	<td>
        	Existing Password:
        </td>
        <td>
         <input type="text" name="existing-password" id="existing-password" />
        </td>
    </tr>
    <tr>
    	<td>
        	New Password:
        </td>
        <td>
         <input type="text" name="new-password" id="new-password" />
        </td>
    </tr>
    <tr>
    	<td>
        	Confirm Password:
        </td>
        <td>
         <input type="text" name="confirm-password" id="confirm-password" />
        </td>
    </tr>
    <tr>
    	<td>
        	<input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        </td>
        <td>
        	<input type="reset" name="btn_reset" id="btn_reset" value="Reset" />
        </td>
    </tr>
    
    </table>
</form>
</body>
</html>



<?php
ob_flush();
include("Foot.php");

?>