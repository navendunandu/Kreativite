<?php
ob_start();
include('Head.php');
?>

<?php
include("../Assets/Connection/connection.php"); //Connection establishing

if(isset($_GET["update"]))
{
	$updateQry = "update tbl_hiringteam set hiring_vstatus = 1 where hiring_id='".$_GET["update"]."'";
	if($con->query($updateQry))
	{
		echo "Verification Success";
	}
	else
	{
		echo "Verification Failed";
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
<div class="container mt-4">
        <a href="Homepage.php" class="btn btn-primary mb-4">Home</a>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SI No</th>
                        <th>District Name</th>
                        <th>Place Name</th>
                        <th>Hiring Name</th>
                        <th>Hirer Type</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Photo</th>
                        <th>Proof</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $selQry = "SELECT * FROM tbl_hiringteam ht 
                                INNER JOIN tbl_place p ON ht.place_id = p.place_id 
                                INNER JOIN tbl_district d ON p.district_id = d.district_id 
                                WHERE ht.hiring_vstatus = 2";
                    $selData = $con->query($selQry);
                    while ($row = $selData->fetch_assoc()) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["district_name"] ?></td>
                            <td><?php echo $row["place_name"] ?></td>
                            <td><?php echo $row["hiring_name"] ?></td>
                            <td><?php echo $row["hiring_type"] ?></td>
                            <td><?php echo $row["hiring_contact"] ?></td>
                            <td><?php echo $row["hiring_email"] ?></td>
                            <td><?php echo $row["hiring_address"] ?></td>
                            <td><img src="../Assets/Files/Hiringteam/Photo/<?php echo $row["hiring_photo"] ?>" width="75" height="75" /></td>
                            <td><a href="ViewProof.php?view=<?php echo $row["hiring_id"] ?>"><img src="../Assets/Files/Hiringteam/Proof/<?php echo $row["hiring_proof"] ?>" width="75" height="75" /></a></td>
                            <td>
                                <a href="HiringTeamRejectedList.php?update=<?php echo $row["hiring_id"] ?>" class="btn btn-success">Accept</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
        include('Foot.php');
        ob_flush();
        ?>