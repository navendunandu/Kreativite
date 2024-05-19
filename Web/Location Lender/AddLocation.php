<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");

//Inserting
if (isset($_POST["btn_submit"])) {
	//Photo uploading
	$photo = $_FILES['loc-img']['name'];
	$tempphoto = $_FILES['loc-img']['tmp_name'];
	move_uploaded_file($tempphoto, '../assets/files/loclender/Photo/' . $photo);

	$insQry = "insert into tbl_locationdetails(location_name,location_address,place_id,location_image,lender_id,location_details,location_rent) values ('" . $_POST["loc-name"] . "','" . $_POST["loc-address"] . "','" . $_POST["loc-place"] . "','" . $photo . "','" . $_SESSION["lid"] . "','" . $_POST["loc-details"] . "','" . $_POST["loc-rent"] . "')";

	if ($con->query($insQry)) {
		echo "Insertion Success";
	} else {
		echo "Insertion Failed";
	}
}

//Deletion

if (isset($_GET["delId"])) {
	$delQry = "delete from tbl_locationdetails where location_id='" . $_GET["delId"] . "'";
	if ($con->query($delQry)) {
		echo "Deletion Success";
	} else {
		echo "Deletion Failed";
	}
}

?>





<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>AddLocation</title>
</head>

<body>
	<div class="container mt-5">
		<form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="loc-name">Location Name:</label>
						<input required type="text" class="form-control" name="loc-name" id="loc-name" />
						<div class="invalid-feedback">Please fill this field</div>
					</div>
					<div class="form-group">
						<label for="loc-address">Address:</label>
						<textarea required class="form-control" name="loc-address" id="loc-address"
							placeholder="Enter the location address"></textarea>
							<div class="invalid-feedback">Please fill this field</div>
					</div>
					<div class="form-group">
						<label for="loc-state">State:</label>
						<select required class="form-control" name="loc-state" id="loc-state" onchange="getDistrict(this.value)">
							<option value="">Choose State</option>
							<?php
							$selectState = "select * from tbl_state";
							$stateData = $con->query($selectState);
							while ($row = $stateData->fetch_assoc()) {
								?>
								<option value="<?php echo $row["state_id"] ?>">
									<?php echo $row["state_name"] ?>
								</option>
							<?php } ?>
						</select>
						<div class="invalid-feedback">Please choose an option</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="loc-district">District:</label>
						<select required class="form-control" name="loc-district" id="loc-district"
							onchange="getPlace(this.value)">
							<option value="">Choose District</option>
						</select>
						<div class="invalid-feedback">Please choose an option</div>
					</div>
					<div class="form-group">
						<label for="loc-place">Place:</label>
						<select required class="form-control" name="loc-place" id="loc-place">
							<option value="">Choose Place</option>
						</select>
						<div class="invalid-feedback">Please choose an option</div>
					</div>
					<div class="form-group">
						<label for="loc-details">Details:</label>
						<textarea required class="form-control" name="loc-details" id="loc-details"
							placeholder="Enter the location details"></textarea>
							<div class="invalid-feedback">Please fill this field</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="loc-img">Add Location Image:</label>
				<input required type="file" class="form-control-file" name="loc-img" id="loc-img" />
				<div class="invalid-feedback">Please select an image</div>
			</div>
			<div class="form-group">
				<label for="loc-rent">Location Rent:</label>
				<input required type="text" class="form-control" name="loc-rent" id="loc-rent" />
				<div class="invalid-feedback">Please fill this field</div>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="Add Location" name="btn_submit" id="btn_submit" />
				<input type="reset" class="btn btn-secondary" value="Reset" name="btn_reset" id="btn_reset" />
			</div>
		</form>
		<table class="table table-bordered mt-5">
			<thead>
				<tr>
					<th>Lender Name</th>
					<th>Location Name</th>
					<th>Location State</th>
					<th>Location District</th>
					<th>Location Place</th>
					<th>Location Address</th>
					<th>Location Image</th>
					<th>Location Rent</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$selDetails = "select * from tbl_locationdetails l inner join tbl_place p on l.place_id=p.place_id inner join tbl_district d on p.district_id = d.district_id inner join tbl_state s on d.state_id = s.state_id inner join tbl_locationlender len on l.lender_id = len.lender_id where len.lender_id ='" . $_SESSION["lid"] . "'";

				$selData = $con->query($selDetails);
				while ($row = $selData->fetch_assoc()) {
					?>
					<tr>
						<td>
							<?php echo $row["lender_name"] ?>
						</td>
						<td>
							<?php echo $row["location_name"] ?>
						</td>
						<td>
							<?php echo $row["state_name"] ?>
						</td>
						<td>
							<?php echo $row["district_name"] ?>
						</td>
						<td>
							<?php echo $row["place_name"] ?>
						</td>
						<td>
							<?php echo $row["location_address"] ?>
						</td>
						<td><img src="../assets/files/loclender/Photo/<?php echo $row["location_image"] ?>" width="100px" />
						</td>
						<td>
							<?php echo $row["location_rent"] ?>
						</td>
						<td><a href="AddLocation.php?delId=<?php echo $row["location_id"] ?>"
								class="btn btn-danger">Delete</a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	<script src="../Assets/JQ/jQuery.js"></script>
	<script>
		function getDistrict(sid) {
			$.ajax({
				url: "../Assets/AjaxPages/AjaxDistrict.php?sid=" + sid,
				success: function (html) {
					$("#loc-district").html(html);
				}
			});
		}

		//Place
		function getPlace(sid) {
			$.ajax({
				url: "../Assets/AjaxPages/AjaxPlace.php?sid=" + sid,
				success: function (html) {
					$("#loc-place").html(html);
				}
			});
		}

		document.addEventListener("DOMContentLoaded",function(){
            const form =document.querySelector(".needs-validation")
            form.addEventListener("submit",function(event){
                if(!form.checkValidity())
                {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add("was-validated")
            })
            
        })

	</script>
</body>

</html>



<?php
ob_flush();
include("Foot.php");

?>