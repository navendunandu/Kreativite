<?php
ob_start();
include('Head.php');
?>

<?php
include("../Assets/Connection/connection.php");

//Verify

	if(isset($_GET["update"]))
	{
		$updateQry = "update tbl_locationlender set lender_status = 1 where lender_id='".$_GET["update"]."'";
		if($con->query($updateQry))
		{
			echo "Verification Success";
		}
		else
		{
			echo "Verification Failed";
		}
	}
	if(isset($_GET["reject"]))
	{
		$updateQry = "update tbl_locationlender set lender_status = 2 where lender_id='".$_GET["reject"]."'";
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
                        <th>Name</th>
                        <th>Contact No</th>
                        <th>District</th>
                        <th>State</th>
                        <th>Image</th>
                        <th>Proof</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $selQry = "SELECT * FROM tbl_locationlender l  INNER JOIN tbl_place p ON l.place_id = p.place_id 
                    INNER JOIN tbl_district d ON p.district_id = d.district_id INNER JOIN tbl_state s ON d.district_id = s.state_id  
                    WHERE lender_status = 0";
                    $selData = $con->query($selQry);
                    while ($row = $selData->fetch_assoc()) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row["lender_name"] ?></td>
                            <td><?php echo $row["lender_contact"] ?></td>
                            <td><?php echo $row["district_name"] ?></td>
                            <td><?php echo $row["state_name"] ?></td>
                            <td><img src="../Assets/Files/Loclender/Photo/<?php echo $row["lender_photo"] ?>" width="75" height="75" /></td>
                            <td><a href="ViewProofLender.php?view=<?php echo $row["lender_id"] ?>"><img src="../Assets/Files/Loclender/Proof/<?php echo $row["lender_proof"] ?>" width="75" height="75" /></a></td>
                            <td>
                                <a href="LocationLenderVerification.php?update=<?php echo $row["lender_id"] ?>" class="btn btn-success">Accept</a> /
                                <a href="LocationLenderVerification.php?reject=<?php echo $row["lender_id"] ?>" class="btn btn-danger">Reject</a>
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