<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

//Accept
if(isset($_GET["hireId"]))
{
	$update = "update tbl_projectapplication set application_status =1 where application_id='".$_GET["hireId"]."'";
	if($con->query($update))
	{
		?>
        <script>
            alert('Hired')
            window.location="ViewApplication.php?appId=<?php echo $_GET['id']?>"
            </script>
        <?php
	}
	else
	{
		echo "Failed";
	}
}
//Reject
if(isset($_GET["rejectId"]))
{
	$update = "update tbl_projectapplication set application_status =2 where application_id='".$_GET["rejectId"]."'";
	if($con->query($update))
	{
		?>
        <script>
            alert('Rejected')
            window.location="ViewApplication.php?appId=<?php echo $_GET['id']?>"
            </script>
        <?php
	}
	else
	{
		echo "Failed";
	}
}


 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Application</title>
</head>
<body>
<div class="container-fluid mt-5">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>SI No</th>
                    <th>Applicant Name</th>
                    <th>Project Name</th>
                    <th>Applicant Details</th>
                    <th>View Applicant Profile</th>
                    <th>Action</th>
					<th>Contact</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $selQry = "select * from tbl_projectapplication pa inner join tbl_userregistration ur on pa.user_id = ur.user_id inner join tbl_projectdetails pd on pa.project_id = pd.project_id inner join tbl_hiringteam ht on pd.hiring_id = ht.hiring_id  where ht.hiring_id = '".$_SESSION["hid"]."' and pa.project_id = '".$_GET["appId"]."'";
                $data = $con->query($selQry);
                while($row = $data->fetch_assoc())
                {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $row["userreg_name"] ?></td>
                    <td><?php echo $row["project_title"] ?></td>
                    <td><?php echo $row["application_details"] ?></td>
                    <td><a href="Previousworks.php?userId=<?php echo $row["user_id"] ?>" class="btn btn-primary">Go to Applicant Profile</a></td>
                    <td><?php
                    if($row['application_status']==0){
                        ?>
                        <a href="ViewApplication.php?hireId=<?php echo $row["application_id"]?>&id=<?php echo $_GET["appId"]?>" class="btn btn-success">Hire</a>
                        <a href="ViewApplication.php?rejectId=<?php echo $row["application_id"]?>&id=<?php echo $_GET["appId"]?>" class="btn btn-danger">Reject</a>
		<?php
        }
        else if($row['application_status']==1){
            echo "Hired";
        }
        else if($row['application_status']==2){
            echo "Rejected";
        }
        ?>
                    </td>
					<td><a href="Chat.php?chatId=<?php echo $row["user_id"] ?>" class="btn btn-primary">Chat</a> <a href="ComplaintUser.php?complaintId=<?php echo $row["user_id"] ?>" class="btn btn-primary">Complaint</a></td></td>
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