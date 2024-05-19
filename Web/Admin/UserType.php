<?php
ob_start();
include('Head.php');
?>


<?php
include("../Assets/Connection/connection.php"); //Connection establishing

//inserting values to table
if(isset($_POST["btn_submit"]))
{
	if($_POST["txt_id"]=="")
	{
	$insUsertypeQuery = "insert into tbl_usertype(usertype_name) values('".$_POST["userType"]."')";
	if($con->query($insUsertypeQuery))
	{
		echo "Usertype Inserted Successfully";
	}
	else
	{
		echo "Usertype insertion failed";
	}
	}
	else
	{
			$update="update tbl_usertype set usertype_name='".$_POST["userType"]."' where usertype_id='".$_POST["txt_id"]."'";
		$con->query($update);
		header("location:UserType.php");
	}
}


//Deleting from table

if(isset($_GET["DelId"]))
{
	$delUsertypeQuery = "delete from tbl_usertype where usertype_id='".$_GET["DelId"]."'";
	if($con->query($delUsertypeQuery))
	{
		echo "Sucessfully Deleted";
	}
	else
	{
		echo "Deletion Failed";
	}
}


//Updation
$ename="";
	$eid="";
	if(isset($_GET["edit"]))
	{
		$selquery="select * from tbl_usertype where usertype_id='".$_GET["edit"]."'";
		$row=$con->query($selquery);
		$data=$row->fetch_assoc();
		$ename=$data["usertype_name"];
		$eid=$data["usertype_id"];
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

        <form method="POST">
            <table class="table table-bordered" align="center">
                <tr>
                    <td>User Type:</td>
                    <td><input required  type="text" name="userType" id="userType" required="required" class="form-control" value="<?php echo $ename ?>" /></td>
                    <input type="hidden" id="txt_id" name="txt_id" value="<?php echo $eid ?>" />
                </tr>
                <tr>
                    <td><input type="submit" value="Submit" name="btn_submit" id="btn_submit" class="btn btn-success" /></td>
                    <td><input type="reset" value="Reset" name="btn_reset" id="btn_reset" class="btn btn-danger" /></td>
                </tr>
            </table>
        </form>

        <table class="table table-bordered" align="center">
            <tr>
                <th>S.No</th>
                <th>User Type</th>
                <th>Action</th>
            </tr>
            <?php
            // Displaying the inserted values.
            $i = 0;
            $selUsertypeQuery = "SELECT * FROM tbl_usertype";
            $usertypeData = $con->query($selUsertypeQuery);
            while ($usertypeRow = $usertypeData->fetch_assoc()) {
                $i++;
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $usertypeRow["usertype_name"] ?></td>
                    <td>
                        <a href="UserType.php?DelId=<?php echo $usertypeRow["usertype_id"] ?>" class="btn btn-danger">Delete</a>
                        <a href="UserType.php?edit=<?php echo $usertypeRow["usertype_id"] ?>" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div></body>
</html>

<?php
        include('Foot.php');
        ob_flush();
        ?>

