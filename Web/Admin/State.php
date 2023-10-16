<?php
ob_start();
include('Head.php');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
include("../Assets/Connection/connection.php");
if(isset($_POST["btn"]))
{
	if($_POST["txt_id"]=="")
	{
	$insqry="insert into tbl_state(state_name)values('".$_POST["state"]."')";
	if($con->query($insqry))
	{
		echo "Data Inserted";
	}
	else{
		echo "Failed";
	}
	}
	else
	{
		$update="update tbl_state set state_name='".$_POST["state"]."' where state_id='".$_POST["txt_id"]."'";
		$con->query($update);
		header("location:State.php");
	}
}
	
	if(isset($_GET["delID"]))
{
	$delquery="delete from tbl_state where state_id='".$_GET["delID"]."'";
	if($con->query($delquery))
	{
		echo "Data Deleted";
	}
	else{
		echo " Deletion Failed";
	}
	
}
$ename="";
	$eid="";
	if(isset($_GET["edit"]))
	{
		$selquery1="select * from tbl_state where state_id='".$_GET["edit"]."'";
		$row1=$con->query($selquery1);
		$data1=$row1->fetch_assoc();
		$ename=$data1["state_name"];
		$eid=$data1["state_id"];
	}
?>


<div class="container mt-4">
<a href="Homepage.php" class="btn btn-primary mb-4">Home</a>
        <form method="POST">
            <table class="table table-bordered" align="center">
                <tr>
                    <td>State:</td>
                    <td>
                        <input type="text" id="state" name="state" class="form-control" value="<?php echo $ename ?>" />
                        <input type="hidden" id="txt_id" name="txt_id" value="<?php echo $eid ?>" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit" name="btn" class="btn btn-primary">Submit</button>
                    </td>
                    <td>
                        <button class="btn btn-secondary">Cancel</button>
                    </td>
                </tr>
            </table>
        </form>

        <table class="table table-bordered" align="center">
            <thead>
                <tr>
                    <th>SI NO</th>
                    <th>State</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $selquery = "select * from tbl_state";
                $data = $con->query($selquery);
                while ($row = mysqli_fetch_array($data)) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row["state_name"] ?></td>
                        <td>
                            <a href="State.php?delID=<?php echo $row["state_id"] ?>" class="btn btn-danger">Delete</a>
                            <a href="State.php?edit=<?php echo $row["state_id"] ?>" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<?php
        include('Foot.php');
        ob_flush();
        ?>

