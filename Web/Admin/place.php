<?php
ob_start();
include('Head.php');
?>

<?php

//General php code
include("../Assets/Connection/connection.php");
//Inserting into the table

if(isset($_POST["btn_submit"]))
{
	$insPlaceQry = "insert into tbl_place(place_name,district_id) values('".$_POST["place"]."', '".$_POST["district"]."')";
	if($con->query($insPlaceQry))
	{
		echo "Data Inserted";
	}
	else
	{
		echo "Insertion Failed";
	}
}

//Deletion from the table
if(isset($_GET["delID"]))
{
	$delquery="delete from tbl_place where place_id='".$_GET["delID"]."'";
	if($con->query($delquery))
	{
		echo "Data Deleted";
	}
	else{
		echo " Deletion Failed";
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
        <a href="Homepage.php" class="btn btn-primary">Home</a>

        <form method="POST">
            <table class="table table-bordered" align="center">
                <tr>
                    <td>State:</td>
                    <td>
                        <select required name="state" id="state" onchange="getDistrict(this.value)" class="form-control">
                            <option value="">Select State</option>
                            <?php
                            // PHP code to display states from tbl_state in the select box
                            $selStateQuery = "select * from tbl_state";
                            $stateData = $con->query($selStateQuery);
                            while ($state = $stateData->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $state['state_id'] ?>"><?php echo $state['state_name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>District:</td>
                    <td>
                        <select required name="district" id="district" class="form-control">
                            <option value="">Select</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Place:</td>
                    <td>
                        <input required type="text" name="place" id="place" class="form-control" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Submit" name="btn_submit" id="btn_submit" class="btn btn-success" />
                    </td>
                    <td>
                        <input type="reset" value="Reset" name="btn_reset" id="btn_reset" class="btn btn-secondary" />
                    </td>
                </tr>
            </table>
        </form>

        <table class="table table-bordered" align="center">
            <thead>
                <tr>
                    <th>SI No:</th>
                    <th>Place</th>
                    <th>District</th>
                    <th>State</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Selecting data and printing it in a table
                $i = 0;
                $selPlaceQuery = "select * from tbl_place p inner join tbl_district d on d.district_id = p.district_id inner join tbl_state s on s.state_id = d.state_id";
                $placeData = $con->query($selPlaceQuery);
                while ($placeRow = $placeData->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $placeRow["place_name"] ?></td>
                        <td><?php echo $placeRow["district_name"] ?></td>
                        <td><?php echo $placeRow["state_name"] ?></td>
                        <td><a href="Place.php?delID=<?php echo $placeRow["place_id"] ?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JavaScript and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
        function getDistrict(sid) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxDistrict.php?sid=" + sid,
                success: function (html) {
                    $("#district").html(html);
                }
            });
        }
    </script>
</body>
</html>

<?php
        include('Foot.php');
        ob_flush();
        ?>


