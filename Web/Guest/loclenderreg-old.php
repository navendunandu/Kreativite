<?php
include("../Assets/Connection/connection.php");

if(isset($_POST["btn_submit"]))
{
	$password = $_POST["lender-password"];
	$confirm = $_POST["lender-password-confirm"];
	if($password == $confirm)
	{
		$photo= $_FILES["lender-photo"]["name"];
		$temPhoto = $_FILES["lender-photo"]["tmp_name"];
		move_uploaded_file($temPhoto, '../assets/files/Loclender/Photo/'.$photo);
		
		$proof= $_FILES["lender-proof"]["name"];
		$temProof = $_FILES["lender-proof"]["tmp_name"];
		move_uploaded_file($temProof, '../assets/files/Loclender/Proof/'.$proof);
		
		$insQuery = "insert into tbl_locationlender(lender_name,lender_contact,lender_address,lender_email,place_id,lender_photo,lender_proof,lender_password) values('".$_POST["lender-name"]."','".$_POST["lender-contact"]."','".$_POST["lender-address"]."','".$_POST["lender-email"]."','".$_POST["lender-place"]."','".$photo."','".$proof."','".$_POST["lender-password"]."')";
		
		if($con->query($insQuery))
		{
			echo "Insertion Success";
		}
		else
		{
			echo "Insertion Failed";
		}
	}
	else
	{
		echo "Password Mismatch";
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
<form method="post" enctype="multipart/form-data">
	<table border="2">
    <tr>
    	<td>
        Name:
        </td>
        <td>
        	<input type="text" name="lender-name" id="lender-name" />
        </td>
    </tr>
    <tr>
    	<td>Contact:</td>
        <td>
        	<input type="text" name="lender-contact" id="lender-contact" />
        </td>
    </tr>
    <tr>
    	<td>Address:</td>
        <td>
        	<input type="text" name="lender-address" id="lender-address" />
        </td>
    </tr>
    <tr>
    	<td>Email:</td>
        <td>
        	<input type="text" name="lender-email" id="lender-email" />
        </td>
    </tr>
    <tr>
    	<td>State:</td>
        <td>
        	<select name="lender-state" id="lender-state" onchange="getDistrict(this.value)">
            	<option value=" ">Choose State</option>
                <?php
				$selStateQry = "select *from tbl_state";
				$stateData = $con->query($selStateQry);
				while($row = $stateData->fetch_assoc())
				{
				
				 ?>
                 <option value="<?php echo $row["state_id"]?>"><?php echo $row["state_name"] ?></option>
                 
                 <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
    	<td>District:</td>
        <td>
        	<select name="lender-district" id="lender-district" onchange="getPlace(this.value)">
            	<option value=" ">Choose District</option>
            </select>
        </td>
    </tr>
    <tr>
    	<td>Place:</td>
        <td>
        	<select name="lender-place" id="lender-place">
            	<option value=" ">Choose Place</option>
            </select>
        </td>
    </tr>
    <tr>
    	<td>Photo:</td>
        <td>
        	<input type="file" name="lender-photo" id="lender-photo" />
        </td>
    </tr>
    <tr>
    	<td>Proof:</td>
        <td>
        	<input type="file" name="lender-proof" id="lender-proof" />
        </td>
    </tr>
    <tr>
    	<td>Password:</td>
        <td>
        	<input type="text" name="lender-password" id="lender-password" />
        </td>
    </tr>
    <tr>
    	<td>Confirm Password:</td>
        <td>
        	<input type="text" name="lender-password-confirm" id="lender-password-confirm" />
        </td>
    </tr>
    <tr>
        <td>
        	<input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        </td>
        <td>
        	<input type="reset" name="btn_reset" id="btn_reset" value="Reset" />
        </td>
    </tr>
    </table>
</form>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
function getDistrict(sid)
{
	$.ajax({
		url:"../Assets/AjaxPages/AjaxDistrict.php?sid="+sid,
		success: function(html){
			$("#lender-district").html(html);
		}
	});
}
//Place
function getPlace(sid)
{
	$.ajax({
		url:"../Assets/AjaxPages/AjaxPlace.php?sid="+sid,
		success: function(html){
			$("#lender-place").html(html);
		}
	});
}
</script>
</body>
</html>