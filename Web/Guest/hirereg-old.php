<?php
include("../Assets/Connection/connection.php");
if(isset($_POST["btn_submit"]))
{
	$password = $_POST["hirer-password"];
	$confirm = $_POST["hirer-password-confirm"];
	if($password == $confirm)
	{
		$photo = $_FILES["hirer-photo"]["name"];
		$tmpPhoto = $_FILES["hirer-photo"]["tmp_name"];
		move_uploaded_file($tmpPhoto,'../Assets/Files/Hiringteam/Photo/'.$photo);
		
		// file Uploading
		$proof = $_FILES['hirer-proof']['name'];
		$tmpProof = $_FILES['hirer-proof']['tmp_name'];
		move_uploaded_file($tmpProof, '../assets/files/Hiringteam/Proof/'.$proof);
		
		$insQry = "insert into tbl_hiringteam(hiring_name,hiring_contact,hiring_email,place_id,hiring_type,hiring_photo,hiring_proof,hiring_address,hiring_password) values('".$_POST["hirer-name"]."','".$_POST["hirer-contact"]."','".$_POST["hirer-email"]."','".$_POST["hirer-place"]."','".$_POST["hiringtype"]."','".$photo."','".$proof."','".$_POST["hirer-address"]."','".$_POST["hirer-password"]."')";
		
		if($con->query($insQry))
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
		echo "Invalid Password";
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
        	<td>Name:</td>
            <td>
            <input type="text" name="hirer-name" id="hirer-name" />
            </td>
        </tr>
        <tr>
        	<td>Contact:</td>
            <td>
            <input type="text" name="hirer-contact" id="hirer-contact" />
            </td>
        </tr>
        <tr>
        	<td>Email:</td>
            <td>
            <input type="text" name="hirer-email" id="hirer-email" />
            </td>
        </tr>
        <tr>
         <td>State</td>
         <td>
         	<select name="hirer-state" id="hirer-state" onchange="getDistrict(this.value)">
            <option value="">Choose State</option>
            <?php
			$selStateQry = "select * from tbl_state";
			$stateData = $con->query($selStateQry);
			while($row= $stateData->fetch_assoc())
			{
			
			 ?>
             
             <option value="<?php echo $row["state_id"]?>"><?php echo $row["state_name"] ?></option>
             
             <?php } ?>
            </select>
         </td>
        </tr>
        <tr>
         <td>District</td>
         <td>
         	<select name="hirer-district" id="hirer-district" onchange="getPlace(this.value)">
            <option value="">Choose District</option>
            </select>
         </td>
        </tr>
        <tr>
         <td>Place</td>
         <td>
         	<select name="hirer-place" id="hirer-place">
            <option value="">Choose Place</option>
            </select>
         </td>
        </tr>
        <tr>
        	<td>Hiring Type</td>
            <td>
            <label for="production">
             <input type="radio" name="hiringtype" id="production" value="production" />Production
            </label>
             <label for="director">
             <input type="radio" name="hiringtype" id="director" value="director" />Director
            </label>
             <label for="production-manager">
             <input type="radio" name="hiringtype" id="production-manager" value="production-manager" />Production-Manager
            </label>
            </td>
        </tr>
        	<td>Photo:</td>
            <td>
            <input type="file" name="hirer-photo" id="hirer-photo" />
            </td>
        </tr>
         <tr>
        	<td>Proof:</td>
            <td>
            <input type="file" name="hirer-proof" id="hirer-proof" />
            </td>
        </tr>
         <tr>
        	<td>Address:</td>
            <td>
            <input type="text" name="hirer-address" id="hirer-address" />
            </td>
        </tr>
         <tr>
        	<td>Password:</td>
            <td>
            <input type="text" name="hirer-password" id="hirer-password" />
            </td>
        </tr>
        <tr>
        	<td>Confirm Password:</td>
            <td>
            <input type="text" name="hirer-password-confirm" id="hirer-password-confirm" />
            </td>
        </tr>
        <tr>
        	<td>
             <input type="submit" value="Submit" name="btn_submit" id="btn_submit" />
            </td>
            <td>
             <input type="reset" value="Reset" name="btn_reset" id="btn_reset" />
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
			$("#hirer-district").html(html);
		}
	});
}

//Place
function getPlace(sid)
{
	$.ajax({
		url:"../Assets/AjaxPages/AjaxPlace.php?sid="+sid,
		success: function(html){
			$("#hirer-place").html(html);
		}
	});
}

</script>

</body>
</html>