<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/connection.php");
session_start();
$selUserQuery = "select * from tbl_userregistration where user_id = '".$_SESSION["uid"]."'";
$userData = $con->query($selUserQuery);
$userRow = $userData->fetch_assoc();

if(isset($_POST["btn_submit"]))
{
	$name = $_POST["user-name"];
	$contact = $_POST["user-contact"];
	$email = $_POST["user-email"];
	$address = $_POST["user-address"];
	$updateQuery = "update tbl_userregistration set userreg_name = '".$name."', userreg_email = '".$email."', userreg_contact = '".$contact."',userreg_address='".$address."' where userreg_id='".$_SESSION["uid"]."'";
	if($con->query($updateQuery))
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
            <div class="form-group row">
                <label for="user-name" class="col-sm-2 col-form-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" value="<?php echo $userRow["userreg_name"] ?>" name="user-name" id="user-name" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="user-email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="text" value="<?php echo $userRow["userreg_email"] ?>" name="user-email" id="user-email" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="user-address" class="col-sm-2 col-form-label">Address:</label>
                <div class="col-sm-10">
                    <input type="text" value="<?php echo $userRow["userreg_address"]?>" name="user-address" id="user-address" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="user-contact" class="col-sm-2 col-form-label">Contact:</label>
                <div class="col-sm-10">
                    <input type="text" value="<?php echo $userRow["userreg_contact"]?>" name="user-contact" id="user-contact" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <input type="submit" value="Submit" name="btn_submit" id="btn_submit" class="btn btn-primary">
                    <input type="reset" value="Reset" name="btn_reset" id="btn_reset" class="btn btn-secondary">
                </div>
            </div>
        </form>
        <a href="./Changepassword.php">Change Password</a>
    </div>
</body>
</html>


<?php
ob_flush();
include("Foot.php");

?>