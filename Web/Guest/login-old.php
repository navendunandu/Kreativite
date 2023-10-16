<?php
include("../Assets/Connection/connection.php");
session_start();
	if(isset($_POST["btn_submit"]))
	{
		$email = $_POST["email"];
		$password = $_POST["password"];
		//Admin
		$selAdmin = "select * from tbl_adminregistration where adminregistration_email = '".$email."' and adminregistration_password = '".$password."' ";
		$resAdmin = $con->query($selAdmin);
		//User
	    $selUser = "select * from tbl_userregistration where userreg_email = '".$email."' and userreg_password = '".$password."' ";
		$resUser = $con->query($selUser);
		//Hiring team
		$selHirer = "select * from tbl_hiringteam where hiring_email='".$email."' and hiring_password = '".$password."' ";
		$resHirer = $con->query($selHirer);
		
		//Location Lender
		$selLender = "select * from tbl_locationlender where lender_email='".$email."' and lender_password='".$password."'";
		$resLender = $con->query($selLender);
		if($resAdmin->num_rows>0)
		{
			$row= $resAdmin->fetch_assoc();
			$_SESSION['aid']= $row["adminregistration_id"];
			$_SESSION["aname"] = $row["adminregistration_name"];
			header('location: ../Admin/homepage.php');
		}
		else if($resUser->num_rows>0)
		{
			$row = $resUser->fetch_assoc();
			$_SESSION["uid"] = $row["user_id"];
			$_SESSION["uname"] = $row["userreg_name"];
			header("location: ../User/homepage.php");
		}
		else if($resHirer->num_rows>0)
		{
			$row = $resHirer->fetch_assoc();
			$_SESSION["hid"] = $row["hiring_id"];
			$_SESSION["hname"] = $row["hiring_name"];
			header("location: ../hiringteam/homepage.php");
			
		}
		else if($resLender->num_rows>0)
		{
			$row = $resLender->fetch_assoc();
			$_SESSION["lid"] =  $row["lender_id"];
			$_SESSION["lname"] = $row["lender_name"];
			header("Location:../Location Lender/Homepage.php");
		}
		else
		{
			echo "Inavalid Entry";
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
        	<td>Email</td>
            <td>
            	<input type="email" name="email" id="email" />
            </td>
        </tr>
        <tr>
        	<td>Password:</td>
            <td><input type="text" name="password" id="password" /></td>
        </tr>
        <tr>
        	<td>
            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
            </td>
        </tr>
    </table>
</form>
</body>
</html>