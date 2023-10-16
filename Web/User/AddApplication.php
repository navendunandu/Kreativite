<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");


if(isset($_POST["btn_submit"]))
{
		$photo=$_FILES['application-file']['name'];
		$tempphoto=$_FILES['application-file']['tmp_name'];
		move_uploaded_file($tempphoto, '../assets/files/user/Application/'.$photo);
		
		$insQry = "insert into tbl_projectapplication(application_details,application_file,user_id,project_id)values('".$_POST["application-details"]."','".$photo."','".$_SESSION["uid"]."','".$_GET["applyId"]."')";
		if($con->query($insQry))
		{
			echo "Insertion Success";
		}
		else
		{
			echo "Insertion Failed";
		}
}
 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Application</title>
</head>

<body>
<form method="post" enctype="multipart/form-data">
	<table border="2">
    	<tr>
        	<td>Apllication Details</td>
            <td>
            	<textarea name="application-details"></textarea>
            </td>
        </tr>
        <tr>
        <tr>
        	<td>Application File</td>
            <td>
            	<input type="file" name="application-file" id="application-file" />
            </td>
        </tr>
        <tr>
        	<td>
            	<input type="submit" value="Submit" name="btn_submit" />
            </td>
            <td>
            	<input type="reset" value="Reset" name="btn_reset" />
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