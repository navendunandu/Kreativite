<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");


if(isset($_POST["btn_submit"]))
{
    $selQry="select * from tbl_projectapplication where project_id=".$_GET['applyId']." and user_id=".$_SESSION['uid'];
    $result=$con->query($selQry);
    if($result->fetch_assoc()){
        ?>
        <script>
            alert('Already Applied')
            </script>
            <?php
    }
    else{
		$photo=$_FILES['application-file']['name'];
		$tempphoto=$_FILES['application-file']['tmp_name'];
		move_uploaded_file($tempphoto, '../assets/files/user/Application/'.$photo);
		
		$insQry = "insert into tbl_projectapplication(application_details,application_file,user_id,project_id)values('".$_POST["application-details"]."','".$photo."','".$_SESSION["uid"]."','".$_GET["applyId"]."')";
		if($con->query($insQry))
		{
			echo "Insertion Success";
		}
		else
		{
			echo "Insertion Failed";
		}
    }
}
 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Application</title>
</head>

<body>
<div class="container mt-5">
        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <table class="table table-bordered">
                <tr>
                    <th>Application Details</th>
                    <td>
                        <textarea required id="textarea" class="form-control" name="application-details" rows="4" maxlength="200" oninput="textval()"></textarea>
                        <span id="target"></span>
                        <div class="invalid-feedback">Project details should not exceed 200 characters</div>
                    </td>
                </tr>
                <tr>
                    <th>Resume:</th>
                    <td>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="application-file" id="application-file">
                            <label class="custom-file-label" for="application-file">Choose file</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit" class="btn btn-primary" name="btn_submit">Submit</button>
                    </td>
                    <td>
                        <button type="reset" class="btn btn-secondary" name="btn_reset">Reset</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <script>
        let count = 0
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

        function textval()
        {
            const area =document.querySelector("#textarea")
            let target =document.querySelector("#target")
            count =area.value.length
            target.textContent = `${count}/200`
        }

        

        
    </script>
</body>
</html>


<?php
ob_flush();
include("Foot.php");

?>