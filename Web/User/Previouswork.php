<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/connection.php");
session_start();
if(isset($_POST["btn_submit"]))
{
		$photo=$_FILES['project-img']['name'];
		$tempphoto=$_FILES['project-img']['tmp_name'];
		move_uploaded_file($tempphoto, '../assets/files/user/Photo/'.$photo);
		
		$insQry = "insert into tbl_previouswork(work_details,user_id,work_image) values('".$_POST["project-desc"]."','".$_SESSION["uid"]."','".$photo."')";
		if($con->query($insQry))
		{
			echo "Insertion Success";
		}
		else
		{
			echo "Insertion Failed";
		}
}

if(isset($_GET["delId"]))
{
	$delQry = "delete from tbl_previouswork where work_id='".$_GET["delId"]."'";
	if($con->query($delQry))
	{
		echo "Deletion Success";
	}
	else
	{
		echo "Deletion Failed";
	}
}
 ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Previous Works</title>
</head>
<body>
	
<div class="container mt-5">
        <form method="post" enctype="multipart/form-data">
            <table class="table table-bordered">
                <tr>
                    <td>Project Description:</td>
                    <td>
                        <input type="text" name="project-desc" id="project-desc" required="required" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>Project Image:</td>
                    <td>
                        <input type="file" name="project-img" id="project-img" class="form-control-file">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-primary">
                    </td>
                    <td>
                        <input type="reset" name="btn_reset" id="btn_reset" value="Reset" class="btn btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <table class="table table-bordered" align="center">
            <thead class="thead-dark">
                <tr>
                    <th>User Name</th>
                    <th>Project Desc</th>
                    <th>Project Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $selQry = "select * from tbl_previouswork p inner join tbl_userregistration u on p.user_id = u.user_id where p.user_id='".$_SESSION["uid"]."'";
                $selData = $con->query($selQry);
                while($row = $selData->fetch_assoc())
                {
                ?>
                <tr>
                    <td><?php echo $row["userreg_name"]?></td>
                    <td><?php echo $row["work_details"]?></td>
                    <td>
                        <img src="../Assets/Files/User/Photo/<?php echo $row["work_image"] ?>" width="100px" alt="" name="work-photo" id="work-photo" />
                    </td>
                    <td><a href="Previouswork.php?delId=<?php echo $row["work_id"]?>" class="btn btn-danger">Delete</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

 
<?php
ob_flush();
include("Foot.php");

?>