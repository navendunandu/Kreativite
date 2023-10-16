<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
$selQry = "select * from tbl_locationlender where lender_id = '".$_SESSION["lid"]."'";
$data = $con->query($selQry);
$row = $data->fetch_assoc();

//Updation
if(isset($_POST["btn_submit"]))
{
	$name = $_POST["lender-name"];
	$contact = $_POST["lender-contact"];
	$email = $_POST["lender-email"];
	$address = $_POST["lender-address"];
	
	$updateQry = "update tbl_locationlender set lender_name = '".$name."', lender_contact = '".$contact."',lender_email='".$email."',lender_address='".$address."' where lender_id='".$_SESSION["lid"]."'";
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
            <table class="table table-bordered">
                <tr>
                    <td>Name:</td>
                    <td>
                        <input type="text" name="lender-name" id="lender-name" class="form-control" value="<?php echo $row["lender_name"] ?>" />
                    </td>
                </tr>
                <tr>
                    <td>Contact:</td>
                    <td>
                        <input type="text" name="lender-contact" id="lender-contact" class="form-control" value="<?php echo $row["lender_contact"] ?>" />
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="text" name="lender-email" id="lender-email" class="form-control" value="<?php echo $row["lender_email"] ?>" />
                    </td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td>
                        <input type="text" name="lender-address" id="lender-address" class="form-control" value="<?php echo $row["lender_address"] ?>" />
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
        <a href="Changepassword.php" class="btn btn-warning">Change Password</a>
    </div>
</body>
</html>


<?php
	 ob_flush();
	 include("Foot.php");
	 
	 ?>