<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");



if(isset($_GET["bid"]))
{
	$updateQry = "update tbl_locationbooking set booking_status = 4 where booking_id='".$_GET["bid"]."'";
	if($con->query($updateQry))
	{
		?>
        <script>
        window.location="Payment.php?bid=<?php echo $_GET['bid']?>"
        </script>
        <?php
	}
	else
	{
		echo "Updation Failed";
	}
}
if(isset($_GET["wid"]))
{
	$updateQry = "update tbl_locationbooking set booking_status = 5, booking_balanceamt=".$_GET['amt']." where booking_id='".$_GET["wid"]."'";
	if($con->query($updateQry))
	{
		?>
        <script>
        window.location="Payment.php?pid=<?php echo $_GET['wid']?>"
        </script>
        <?php
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
                <th>SI No</th>
                <th>Lender Name</th>
                <th>Lender Contact</th>
                <th>Location Name</th>
                <th>Location Details</th>
                <th>Address</th>
                <th>Days</th>
                <th>Rent</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php
            $i=0;
            $selQry = "SELECT
            lb.*,
            ld.location_name,
            lr.lender_name,
            lr.lender_id,
            lr.lender_contact,
            ld.location_address,
            ld.location_details,
            p.place_name,
            d.district_name,
            s.state_name,
            ld.location_rent,
            DATEDIFF(CURDATE(), STR_TO_DATE(lb.booking_startdate, '%Y-%m-%d')) + 1 AS num_days,
            (ld.location_rent * (DATEDIFF(CURDATE(), STR_TO_DATE(lb.booking_startdate, '%Y-%m-%d')) + 1)) AS total_rent
        FROM tbl_locationbooking lb
        INNER JOIN tbl_locationdetails ld ON lb.location_id = ld.location_id
        INNER JOIN tbl_locationlender lr ON ld.lender_id = lr.lender_id
        INNER JOIN tbl_place p ON ld.place_id = p.place_id
        INNER JOIN tbl_district d ON p.district_id = d.district_id
        INNER JOIN tbl_state s ON d.state_id = s.state_id
         where hiring_id ='".$_SESSION["hid"]."'";
            $data = $con->query($selQry);
            while($row = $data->fetch_assoc())
            {
                $today = date('Y-m-d');
                $i++;
            ?>

            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row["lender_name"] ?></td>
                <td><?php echo $row["lender_contact"] ?></td>
                <td><?php echo $row["location_name"] ?></td>
                <td><?php echo $row["location_details"] ?></td>
                <td><?php echo $row["location_address"]?>, <?php echo $row["place_name"]?>, <?php echo $row["district_name"]?>, <?php echo $row["state_name"]?></td>
                <td><?php 
                if($row["num_days"]<0){
                    echo "------";
                }
                else{
                echo $row["num_days"] ;
                }
                ?>
                </td>    <!-- Day Count -->
                <td><?php if($row["total_rent"]<0){
                    echo "------";
                }
                else{
                echo $row["total_rent"] ;
                } ?></td>    <!-- Rent -->
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
                        echo "Advance Payment Completed";
                    }
                    else if($row["booking_status"] == 4)
                    {
                        echo "Project Finished";
                    }
                    else if($row["booking_status"] == 6)
                    {
                        echo "Project Finished";
                    }
                ?>
                </td>
                <td>
                    <?php 
                    if($row["booking_status"] == 1)
                    {
                        ?>
                        <a href="Payment.php?bid=<?php echo $row['booking_id'] ?>" class="btn btn-primary">Continue for Payment</a>
                        <?php
                    }
                    else if($row["booking_status"] == 3 && $row["payment_status"] == 1 && $today >= $row["booking_startdate"])
                    {
                        ?>
                        <a href="MyBooking.php?wid=<?php echo $row['booking_id'] ?>&amt=<?php echo $row['total_rent'] ?>" class="btn btn-success">Work Complete</a>
                        <?php
                    }
                    else if($row["booking_status"] == 4 && $row["payment_status"] == 1){
                        // Add your action for completed projects
                    }
                    else if($row["booking_status"] == 4 && $row["payment_status"] == 2){
                        // Add your action for projects with payment issues
                    }
                    else if($row["booking_status"] == 5 && $row["payment_status"] == 2){
                        // Add your action for projects with payment issues
                        echo "Work Finished";
                    }
                    else if($row["booking_status"] == 6 && $row["payment_status"] == 2){
                        // Add your action for projects with payment issues
                       ?>
                       
                       <?php
                    }
                    if($row["payment_status"] == 1 || $row["payment_status"] == 2){
                        ?>
                        <a href="ComplaintLender.php?complaintId=<?php echo $row["lender_id"] ?>" class="btn btn-primary">Complaint</a>
                       <?php
                    }
                    ?>
                </td>

            </tr>



<?php } ?>
        </table>
        <a href="./Feedback.php" class="btn btn-primary">Feedback</a>
    </div>

</body>
</html>

<?php
ob_flush();
include("Foot.php");

?>