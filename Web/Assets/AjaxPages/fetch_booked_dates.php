<?php
// Include your database connection code here
include("../Assets/Connection/connection.php");

// Check if locationId is provided via POST
if (isset($_POST["locationId"])) {
    $locationId = $_POST["locationId"];

    // SQL query to retrieve booked dates for the given location
    $query = "SELECT booking_startdate, booking_enddate FROM tbl_locationbooking WHERE location_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $locationId);
    $stmt->execute();
    $stmt->bind_result($startDate, $endDate);

    $bookedDates = [];

    while ($stmt->fetch()) {
        // Loop through each booking and add the booked dates to the array
        $bookedDates = array_merge($bookedDates, createDateRangeArray($startDate, $endDate));
    }

    // Return the booked dates as a JSON-encoded array
    echo json_encode($bookedDates);
} else {
    echo json_encode([]); // Return an empty array if locationId is not provided
}

// Function to create an array of dates between a start and end date
function createDateRangeArray($startDate, $endDate) {
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);

    $interval = new DateInterval('P1D'); // 1 day interval
    $dateRange = new DatePeriod($start, $interval, $end);

    $dateArray = [];

    foreach ($dateRange as $date) {
        $dateArray[] = $date->format('Y-m-d');
    }

    return $dateArray;
}
