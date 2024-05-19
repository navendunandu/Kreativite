<?php
include("../Assets/Connection/connection.php");



if(isset($_POST["btn_submit"]))
{	
	$password = $_POST["user-password"];
	$passwordConfirm = $_POST["user-password-confirm"];
	if($password == $passwordConfirm)
	{
	//Photo uploading
		$photo=$_FILES['user-photo']['name'];
		$tempphoto=$_FILES['user-photo']['tmp_name'];
		move_uploaded_file($tempphoto, '../assets/files/user/Photo/'.$photo);
		
		//Proof Uploading
		$proof = $_FILES['user-file']['name'];
		$tmpProof = $_FILES['user-file']['tmp_name'];
		move_uploaded_file($tmpProof, '../assets/files/user/Proof/'.$proof);
		
		$insQuery = "insert into tbl_userregistration(userreg_name,userreg_contact,userreg_email,userreg_address,place_id,userreg_photo,userreg_proof,usertype_id,userreg_password,userreg_gender) values('".$_POST["user-name"]."','".$_POST["user-contact"]."','".$_POST["user-email"]."',
		'".$_POST["user-address"]."','".$_POST["user-place"]."','".$photo."','".$proof."','".$_POST["user-type"]."','".$_POST["user-password"]."','".$_POST["gender"]."') ";
		
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
		echo "Passwords not matching";
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
	<form method="POST" enctype="multipart/form-data">
    	<table border="2">
        	<tr>
            	<td>Name:</td>
                <td><input type="text" name="user-name" id="user-name"/></td>
            </tr>
            <tr>
            	<td>Contact:</td>
                <td><input type="text" name="user-contact" id="user-contact"/></td>
            </tr>
            <tr>
            	<td>Email:</td>
                <td><input type="email" name="user-email" id="user-email"/></td>
            </tr>
            <tr>
            	<td>Address:</td>
                <td><input type="text" name="user-address" id="user-address"/></td>
            </tr>
            <tr>
            	<td>Gender:</td>
                <td>
                <label for="male"><input type="radio" name="gender" id="male" value="male">Male</label>
                <label for="female"><input type="radio" name="gender" id="female" value="female">Female</label>
                <label for="others"><input type="radio" name="gender" id="others" value="other">Other</label>
                </td>
            </tr>
            <tr>
            	<td>State:</td>
                <td>
                	<select name="user-state" id="user-state" onchange="getDistrict(this.value)">
                    	<option value="">Choose State</option>
                        <?php
						//State select
						$selStateQry = "select * from tbl_state";
						$stateData = $con->query($selStateQry);
						while($stateRow = $stateData->fetch_assoc())
						{
					
						?>
                        <option value="<?php echo $stateRow["state_id"]?>"><?php echo $stateRow["state_name"]?></option>
                          
                          <?php } ?>
                    </select>
                </td>
            </tr>
             <tr>
            	<td>District:</td>
                <td>
                	<select name="user-district" id="user-district" onchange="getPlace(this.value)">
                    	<option value="">Choose District</option>
                    </select>
                </td>
            </tr>
             <tr>
            	<td>Place:</td>
                <td>
                	<select name="user-place" id="user-place">
                    	<option value="">Choose Place</option>
                    </select>
                </td>
            </tr>
            <tr>
            	<td>Photo:</td>
                <td><input type="file" name="user-photo" id="user-photo"/></td>
            </tr>
            <tr>
            	<td>Proof:</td>
                <td><input type="file" name="user-file" id="user-file"/></td>
            </tr>
            <tr>
            	<td>User Type:</td>
                <td>
                	<select name="user-type" id="user-type">
                    	<option value="">Choose Usertype</option>
                        <?php
						$selUserTypeQuery = "select * from tbl_usertype";
						$userTypeData = $con->query($selUserTypeQuery);
						while($userTtpeRow = $userTypeData->fetch_assoc())
						{
						?>	
                        <option value="<?php echo $userTtpeRow["usertype_id"] ?>"><?php echo $userTtpeRow["usertype_name"] ?></option>
							
							
						<?php
						 }
						?>
                        
                    </select>
                </td>
            </tr>
            
             <tr>
            	<td>Password:</td>
                <td><input type="text" name="user-password" id="user-password"/></td>
            </tr>
            
             <tr>
            	<td>Confirm Password:</td>
                <td><input type="text" name="user-password-confirm" id="user-password-confirm"/></td>
            </tr>
            
             <tr>
            	<td><input type="submit" name="btn_submit" id="btn_submit" value="Submit"/></td>
                <td><input type="reset" name="btn_reset" id="btn_reset" value="Reset"/></td>
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
			$("#user-district").html(html);
		}
	});
}

//Place
function getPlace(sid)
{
	$.ajax({
		url:"../Assets/AjaxPages/AjaxPlace.php?sid="+sid,
		success: function(html){
			$("#user-place").html(html);
		}
	});
}
</script>
</body>
</html>