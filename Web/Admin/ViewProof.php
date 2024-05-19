<?php
include("../Assets/Connection/connection.php");
ob_start();
include('Head.php');
$selQry = "Select * from tbl_hiringteam where hiring_id='".$_GET["view"]."'";
$selData = $con->query($selQry);
$row = $selData->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Proof</title>
</head>
<body>
    <div class="row">
        <div class="col-md-6 offset-3">
        <img src="../Assets/Files/Hiringteam/Proof/<?php echo $row["hiring_proof"] ?>" />
        </div>
    </div>
</body>
</html>


<?php
        include('Foot.php');
        ob_flush();
        ?>