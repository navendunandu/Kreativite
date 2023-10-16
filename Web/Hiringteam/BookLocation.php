<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

$selQry = "select location_rent from tbl_locationdetails where location_id = '".$_GET["applyId"]."'";
$data = $con->query($selQry);
$row = $data->fetch_assoc();

if(isset($_POST["btn_submit"]))
{
    $startDateStr = $_POST["start-date"];
    $endDateStr = $_POST["end-date"];

    // Create DateTime objects from the input strings
    $startDate = new DateTime($startDateStr);
    $endDate = new DateTime($endDateStr);

    // Calculate the difference between the two dates
    $interval = $startDate->diff($endDate);

    // Get the number of days from the interval
    $numberOfDays = $interval->days;
	$ins = "insert into tbl_locationbooking(hiring_id,location_id,booking_adv_amt,booking_startdate,booking_enddate) values('".$_SESSION["hid"]."','".$_GET["applyId"]."','".$row["location_rent"]."','".$_POST["start-date"]."','".$_POST["end-date"]."')";
	
	if($con->query($ins))
	{
		header("location:MyBooking.php");
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
<title>Untitled Document</title>
</head>

<body>
	
<div class="container mt-5">
        <form method="POST">
            <table class="table table-bordered">
                <tr>
                    <td>Start Date:</td>
                    <td>
                        <input type="date" name="start-date" id="start-date" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>End Date:</td>
                    <td>
                        <input type="date" name="end-date" id="end-date" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Submit" id="btn_submit" name="btn_submit" class="btn btn-primary">
                    </td>
                    <td>
                        <input type="reset" value="Reset" id="btn_reset" name="btn_reset" class="btn btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>

<?php
ob_flush();
include("Foot.php");

?>