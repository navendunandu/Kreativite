<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");



if(isset($_POST["btn_submit"]))
{
    // New Code
    $flag = 0;
    $sdate = $_POST["start-date"];
    $edate = $_POST["end-date"];
        $checksel = "select * from tbl_locationbooking where location_id='".$_GET["applyId"]."'";
        $testData = $con->query($checksel);
        while($testrow = $testData->fetch_assoc())
        {
            if($sdate >= $testrow["booking_startdate"] && $sdate <= $testrow["booking_enddate"] && $testrow["booking_status"] != 2)
            {
                $dbStartDate = $testrow["booking_startdate"];
                $dbEndDate = $testrow["booking_enddate"];
                $flag = $flag + 1;
                break;
            }
        }

        if($flag > 0)
        {
            ?>
    <script>
         var sdate = <?php echo json_encode($dbStartDate); ?>;
        var edate = <?php echo json_encode($dbEndDate); ?>;
        alert(`No slots available from ${sdate} to ${edate} try again in a different date`)
    </script>

<?php


        }
        else
        {






    // 



    $selQry = "select location_rent from tbl_locationdetails where location_id = '".$_GET["applyId"]."'";
    $data = $con->query($selQry);
    $row = $data->fetch_assoc();
    $startDateStr = $_POST["start-date"];
    $endDateStr = $_POST["end-date"];

    // Create DateTime objects from the input strings
    $startDate = new DateTime($startDateStr);
    $endDate = new DateTime($endDateStr);

    // Calculate the difference between the two dates
    $interval = $startDate->diff($endDate);

    // Get the number of days from the interval
    $numberOfDays = $interval->days;
    $amt = $numberOfDays*$row["location_rent"];
    $payAmt=$amt * .3;
    $balamt=$amt-$payAmt;

	$ins = "insert into tbl_locationbooking(hiring_id,location_id,booking_adv_amt,booking_balanceamt,booking_startdate,booking_enddate) values('".$_SESSION["hid"]."','".$_GET["applyId"]."','".$payAmt."','".$balamt."','".$_POST["start-date"]."','".$_POST["end-date"]."')";
	
	if($con->query($ins))
	{
		header("location:MyBooking.php");
	}
	else
	{
		echo "Failed";
	}
}
}
 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KREATIVITE</title>
</head>

<body>
	
<div class="container mt-5">
        <form class="needs-validation" novalidate method="POST">
            <input type="hidden" name="txtid" id="txtid" value="<?php echo $_GET['applyId'] ?>">
            <table class="table table-bordered">
                <tr>
                    <td>Start Date:</td>
                    <td>
                        <input required type="date" min="<?php echo date('Y-m-d'); ?>" name="start-date" id="start-date" class="form-control" onchange="setMin()">
                        <div class="invalid-feedback">Please enter a date</div>
                    </td>
                </tr>
                <tr>
                    <td>End Date:</td>
                    <td>
                        <input required type="date" name="end-date" id="end-date" class="form-control">
                        <div class="invalid-feedback">Please enter a date</div>
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
        <p id="invalid"></p>
    </div>
</body>
<script src="../Assets/jQ/jQuery.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const startDateInput = document.getElementById("start-date");
        const endDateInput = document.getElementById("end-date");
        const bookingForm = document.getElementById("bookingForm");

        // Add an event listener to the form to handle form submission
        bookingForm.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the form from submitting

            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            // Check if start date is before end date
            if (startDate >= endDate) {
                alert("End date must be after the start date.");
            } else {
                // Calculate the number of days between the start and end dates
                const oneDay = 24 * 60 * 60 * 1000; // hours * minutes * seconds * milliseconds
                const diffDays = Math.round((endDate - startDate) / oneDay);

                // Fetch location rent from the database (you can use AJAX)

                // Calculate payment amounts
                const locationRent = 100; // Replace with actual location rent
                const amt = diffDays * locationRent;
                const payAmt = amt * 0.3;
                const balAmt = amt - payAmt;

                // You can now proceed with the form submission or further processing
                // You may also update the UI with the calculated amounts if needed
            }
        });

        // Initialize the jQuery UI Datepicker
        $(function () {
            var selectedLocationId =document.getElementById('txtid').value
            $("#start-date, #end-date").datepicker({
                minDate: 0, // Start date cannot be in the past
                dateFormat: "yy-mm-dd",
                beforeShowDay: function (date) {
                    // Convert the date to yyyy-mm-dd format
                    const formattedDate = $.datepicker.formatDate("yy-mm-dd", date);

                    // Fetch booked dates using AJAX
                    $.ajax({
                        url: "../Assets/AjaxPages/fetch_booked_dates.php",
                        method: "POST",
                        data: {
                            locationId: selectedLocationId
                        },
                        success: function (bookedDates) {
                            // Parse the booked dates from the response
                            const bookedDatesArray = JSON.parse(bookedDates);

                            // Check if the date is in the bookedDates array and disable it
                            if (bookedDatesArray.includes(formattedDate)) {
                                return [false];
                            }
                        }
                    });

                    return [true];
                },
                onClose: function (selectedDate) {
                    // Set the minimum date for the end date picker based on the selected start date
                    $("#end-date").datepicker("option", "minDate", selectedDate);
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
            var form = document.querySelector('.needs-validation');

            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            });
        });

        const startDate =document.querySelector("#start-date")
        const endDate =document.querySelector("#end-date")

        function setMin()
        {
            endDate.min =startDate.value
        }

    
</script>

</html>

<?php
ob_flush();
include("Foot.php");

?>