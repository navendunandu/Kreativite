<?php
ob_start();
include('Head.php');
?>


<?php

include("../Assets/Connection/connection.php");



if(isset($_POST["btnSubmit"]))
{
	if($_POST["txt_update"]=="")
	{
		$insQry = "insert into tbl_adminregistration(adminregistration_name,adminregistration_email,adminregistration_contact,adminregistration_password)values('".$_POST["txtName"]."','".$_POST["txtEmail"]."','".$_POST["txtContact"]."','".$_POST["txtPassword"]."')";
		if($con->query($insQry))
		{
				echo "Value Inserted";
		}
		else
		{
				echo "Insertion Failed";
		}
	}
	else
	{
		$updateqry = "update tbl_adminregistration set adminregistration_name='".$_POST["txtName"]."',adminregistration_email='".$_POST["txtEmail"]."',adminregistration_contact='".$_POST["txtContact"]."',adminregistration_password='".$_POST["txtPassword"]."' where adminregistration_id='".$_GET["edit"]."' ";
			$con->query($updateqry);
		header("location:AdminRegistration.php");
		}
}

if(isset($_GET["delID"]))
{
		$delQry = "delete  from  tbl_adminregistration where adminregistration_id='".$_GET["delID"]."'";
		if($con->query($delQry))
		{
				echo "Value Deleted";
				header("location:AdminRegistration.php");
		}
		else
		{
				echo "Deletion Failed";
		}
}
//Selecting vlue to edit

//Declaring null values to store values to be edited
$ename = "";
$eemail = "";
$econtact = "";
$epassword = "";
$eid="";
//Checking for edit button
if(isset($_GET["edit"]))
{
	$selQry1 = "select*from tbl_adminregistration";
	$row1 = $con->query($selQry1);
	$data1 = $row1->fetch_assoc();
	$ename= $data1["adminregistration_name"];
	$eemail = $data1["adminregistration_email"];
	$econtact = $data1["adminregistration_contact"];
	$epassword = $data1["adminregistration_password"];
	$eid = $data1["adminregistration_id"];
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<div class="container mt-4">
<a href="Homepage.php" class="btn btn-primary mb-4">Home</a>
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered" width="500" align="center">
                <tr>
                    <td width="208">Name</td>
                    <td width="366">
                        <input required type="text" name="txtName" id="txtName" class="form-control" value="<?php echo $ename ?>" />
                        <input type="hidden" name="txt_update" id="txt_update" value="<?php echo $eid ?>" />
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input required type="text" name="txtEmail" id="txtEmail" class="form-control" value="<?php echo $eemail ?>" />
                    </td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td>
                        <input required type="text" name="txtContact" id="txtContact" class="form-control" value="<?php echo $econtact ?>" />
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input required type="text" name="txtPassword" id="txtPassword" class="form-control" value="<?php echo $epassword ?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary" value="Submit" />
                        <input type="reset" name="btnCancel" id="btnCancel" class="btn btn-secondary" value="Cancel" />
                    </td>
                </tr>
            </table>
        </form>

        <table class="table table-bordered" align="center">
            <thead>
                <tr>
                    <th>SI NO</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $selQry = "select * from tbl_adminregistration";
                $data = $con->query($selQry);
                while ($row = $data->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row["adminregistration_name"] ?></td>
                        <td><?php echo $row["adminregistration_email"] ?></td>
                        <td><?php echo $row["adminregistration_contact"] ?></td>
                        <td><?php echo $row["adminregistration_password"] ?></td>
                        <td>
                            <a href="AdminRegistration.php?delID=<?php echo $row["adminregistration_id"] ?>" class="btn btn-danger">Delete</a>
                            <a href="AdminRegistration.php?edit=<?php echo $row["adminregistration_id"] ?>" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
<br />

<?php
        include('Foot.php');
        ob_flush();
        ?>

