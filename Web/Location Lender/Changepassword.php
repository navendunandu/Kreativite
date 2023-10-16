<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

if(isset($_POST["btn_submit"]))
{
	$selQry = "select * from tbl_locationlender where lender_id = '".$_SESSION["lid"]."'";
	$lenderData = $con->query($selQry);
	$lenderRow = $lenderData->fetch_assoc();
	$dbPassword = $lenderRow["lender_password"];
	$oldPassword = $_POST["existing-password"];
	$newPassword = $_POST["new-password"];
	$confirmPassword = $_POST["confirm-password"];
	
	if(($dbPassword == $oldPassword) && ($newPassword == $confirmPassword) )
	{
		$updateQry = "update tbl_locationlender set lender_password = '".$newPassword."' where lender_id = '".$_SESSION["lid"]."'";
		if($con->query($updateQry))
		{
			echo "Updation Success";
		}
		else
		{
			echo "Updation Failed";
		}
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
	
<div class="container mt-5">
        <form method="post">
            <table class="table table-bordered">
                <tr>
                    <td>Existing Password</td>
                    <td>
                        <input type="password" id="existing-password" name="existing-password" class="form-control" />
                    </td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" id="new-password" name="new-password" class="form-control" />
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" id="confirm-password" name="confirm-password" class="form-control" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary" value="Submit" />
                    </td>
                    <td>
                        <input type="reset" name="btn_reset" id="btn_reset" class="btn btn-secondary" value="Reset" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>


<?php
	 ob_flush();
	 include("Foot.php");
	 
	 ?>