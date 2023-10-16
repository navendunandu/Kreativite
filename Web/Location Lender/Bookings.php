<?php

include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

//Updating
if(isset($_GET["acceptId"]))
{
	$update = "update tbl_locationbooking set booking_status= 1 where booking_id='".$_GET["acceptId"]."'";
	if($con->query($update))
	{
		echo "Success";
		header("location:Bookings.php");
	}
	else
	{
		echo "Failed";
	}
}

if(isset($_GET["rejId"]))
{
	$update = "update tbl_locationbooking set booking_status= 2 where booking_id='".$_GET["rejId"]."'";
	if($con->query($update))
	{
		echo "Success";
		header("location:Bookings.php");
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
<title>Bookings</title>
</head>
<body>
<div class="container mt-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SL.No</th>
                    <th>Hiring Team Name</th>
                    <th>Start Date:</th>
                    <th>End Date:</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $selQry = "select * from tbl_locationbooking lb inner join tbl_hiringteam h on lb.hiring_id = h.hiring_id inner join tbl_locationdetails ld on lb.location_id = ld.location_id where ld.lender_id=".$_SESSION['lid'];
                $data = $con->query($selQry);
                while($row = $data->fetch_assoc())
                {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row["hiring_name"] ?></td>
                    <td><?php echo $row["booking_startdate"] ?></td>
                    <td><?php echo $row["booking_enddate"] ?></td>
                    <td>
                        <?php
                        if($row['booking_status']==0)
                        {
                        ?>
                        <a href="Bookings.php?acceptId=<?php echo $row["booking_id"]?>" class="btn btn-success">Accept</a>
                        <a href="Bookings.php?rejId=<?php echo $row["booking_id"]?>" class="btn btn-danger">Reject</a>
                        <?php
                        }
                        else if($row['booking_status']==1)
                        {
                            echo "Waiting for Payment";
                        }
                        else if($row['booking_status']==2)
                        {
                            echo "Rejected";
                        }
                        else if($row['booking_status']==3 && $row["payment_status"] == 1)
                        {
                            echo "Payment Completed";
                        }
                        ?>
                    </td>
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