<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

  $selQry = "select * from tbl_locationbooking lb inner join tbl_locationdetails ld on lb.location_id = ld.location_id inner join tbl_locationlender lr on ld.lender_id = lr.lender_id inner join tbl_place p on ld.place_id = p.place_id inner join tbl_district d on p.district_id = d.district_id inner join tbl_state s on d.state_id = s.state_id where hiring_id ='".$_SESSION["hid"]."'"; 	
$data = $con->query($selQry);
if($row = $data->fetch_assoc())
{

if(isset($_GET["bid"]))
{
	$updateQry = "update tbl_locationbooking set booking_status = 4 where booking_id='".$_GET["bid"]."'";
	if($con->query($updateQry))
	{
		echo "Work Completed";
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
<title>My Booking</title>
</head>
<body>
<div class="container mt-5">

        <table class="table table-bordered">
            <tr>
                <td>Lender Name:</td>
                <td><?php echo $row["lender_name"] ?></td>
            </tr>
            <tr>
                <td>Lender Contact:</td>
                <td><?php echo $row["lender_contact"] ?></td>
            </tr>
            <tr>
                <td>Location:</td>
                <td><?php echo $row["location_name"] ?></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><?php echo $row["location_address"]?>, <?php echo $row["place_name"]?>, <?php echo $row["district_name"]?>, <?php echo $row["state_name"]?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?php
                    if($row['booking_status']==0)
                    {
                        echo "Request Pending";
                    }
                    else if($row["booking_status"] == 1)
                    {
                        echo "Approved by lender";
                    }
                    else if($row["booking_status"] == 2)
                    {
                        echo "Rejected by lender";
                    }
                    else if($row["booking_status"] == 3 && $row["payment_status"] == 1)
                    {
                        echo "Payment Completed";
                    }
                    else if($row["booking_status"] == 4)
                    {
                        echo "Project Finished";
                    }
                ?>
                </td>
            </tr>
            <tr>
                <td>Action</td>
                <td>
                    <?php 
                    if($row["booking_status"] == 1)
                    {
                        ?>
                        <a href="Payment.php?bid=<?php echo $row['booking_id'] ?>" class="btn btn-primary">Continue for Payment</a>
                        <?php
                    }
                    else if($row["booking_status"] == 3 && $row["payment_status"] == 1)
                    {
                        ?>
                        <a href="MyBooking.php?bid=<?php echo $row['booking_id'] ?>" class="btn btn-success">Work Complete</a>
                        <?php
                    }
                    else if($row["booking_status"] == 4 && $row["payment_status"] == 1){
                        // Add your action for completed projects
                    }
                    else if($row["booking_status"] == 4 && $row["payment_status"] == 2){
                        // Add your action for projects with payment issues
                    }
                    ?>
                </td>
            </tr>
        </table>
		<?php } ?>
    </div>

</body>
</html>

<?php
ob_flush();
include("Foot.php");

?>