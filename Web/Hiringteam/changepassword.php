<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

if(isset($_POST["btn_submit"]))
{
	$selQuery = "select * from tbl_hiringteam where hiring_id='".$_SESSION["hid"]."'";
	$selData = $con->query("$selQuery");
	$row = $selData->fetch_assoc();
	$dbpassword = $row["hiring_password"];
	$existing = $_POST["existing-password"];
	$new = $_POST["new-password"];
	$confirm = $_POST["confirm-password"];
	if(($dbpassword == $existing) && ($new == $confirm))
	{
		$updatePass = "update tbl_hiringteam set hiring_password='".$new."' where hiring_id='".$_SESSION["hid"]."'";
		if($con->query($updatePass))
		{
			echo "Password Updated";
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
            <table class="table">
                <tr>
                    <td>Existing Password:</td>
                    <td>
                        <input type="password" name="existing-password" id="existing-password" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new-password" id="new-password" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm-password" id="confirm-password" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Submit" name="btn_submit" id="btn_submit" class="btn btn-primary">
                    </td>
                    <td>
                        <input type="reset" value="Reset" name="btn_reset" id="btn_reset" class="btn btn-secondary">
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