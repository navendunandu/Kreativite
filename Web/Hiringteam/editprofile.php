<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
$selQuery = "select * from tbl_hiringteam where hiring_id='".$_SESSION["hid"]."'";
$hireData = $con->query($selQuery);
$row = $hireData->fetch_assoc();

//Updation
if(isset($_POST["btn_submit"]))
{
	$name = $_POST["hirer-name"];
	$contact = $_POST["hirer-contact"];
	$email = $_POST["hirer-email"];
	$address = $_POST["hirer-address"];
	$updateQry = "update tbl_hiringteam set hiring_name='".$name."',hiring_contact='".$contact."',hiring_email='".$email."',hiring_address='".$address."' where hiring_id = '".$_SESSION["hid"]."'";
	if($con->query($updateQry))
	{
		echo "Updation Success";
	}
	else
	{
		echo "Updation Failed";
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
                    <td>Name:</td>
                    <td>
                        <input type="text" name="hirer-name" id="hirer-name" value="<?php echo $row["hiring_name"] ?>" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>Contact:</td>
                    <td>
                        <input type="text" name="hirer-contact" id="hirer-contact" value="<?php echo $row["hiring_contact"] ?>" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="text" name="hirer-email" id="hirer-email" value="<?php echo $row["hiring_email"] ?>" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td>
                        <input type="text" name="hirer-address" id="hirer-address" value="<?php echo $row["hiring_address"] ?>" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Submit" id="btn_submit" name="btn_submit" class="btn btn-primary"></td>
                    <td><input type="reset" value="Reset" id="btn_reset" name="btn_reset" class="btn btn-secondary"></td>
                </tr>
            </table>
            <a href="changepassword.php" class="btn btn-link">Change Password</a>
        </form>
    </div>
</body>
</html>

<?php
ob_flush();
include("Foot.php");

?>